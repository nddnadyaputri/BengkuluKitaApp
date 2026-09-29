<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang kamu masih kosong.');
        }

        $products = Product::whereIn(
            'id',
            array_keys($cart)
        )->get();

        $cartItems = $products->map(function ($product) use ($cart) {
            $quantity = (int) (
                $cart[$product->id]['quantity'] ?? 0
            );

            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity,
            ];
        });

        $total = $cartItems->sum('subtotal');

        return view(
            'checkout.index',
            compact('cartItems', 'total')
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'address' => [
                'required',
                'string',
                'max:1000',
            ],

            'payment_method' => [
                'required',
                'in:QRIS',
            ],
        ], [
            'customer_name.required' =>
                'Nama wajib diisi.',

            'phone.required' =>
                'Nomor WhatsApp wajib diisi.',

            'address.required' =>
                'Alamat wajib diisi.',

            'payment_method.required' =>
                'Silakan pilih metode pembayaran.',
        ]);

        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Keranjang kamu masih kosong.'
                );
        }

        try {

            $order = DB::transaction(function () use (
                $cart,
                $validated,
                $request
            ) {

                /*
                |--------------------------------------------------------------------------
                | Ambil produk dan kunci datanya selama transaksi
                |--------------------------------------------------------------------------
                */

                $products = Product::whereIn(
                    'id',
                    array_keys($cart)
                )
                ->lockForUpdate()
                ->get();

                $total = 0;

                $items = [];


                /*
                |--------------------------------------------------------------------------
                | Cek stok dan hitung total
                |--------------------------------------------------------------------------
                */

                foreach ($products as $product) {

                    $quantity = (int) (
                        $cart[$product->id]['quantity'] ?? 0
                    );

                    if ($quantity <= 0) {
                        continue;
                    }

                    if ($product->stock < $quantity) {
                        throw new \Exception(
                            "Stok produk {$product->name} tidak mencukupi."
                        );
                    }

                    $subtotal =
                        $product->price * $quantity;

                    $total += $subtotal;

                    $items[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal,
                    ];
                }


                /*
                |--------------------------------------------------------------------------
                | Pastikan ada produk
                |--------------------------------------------------------------------------
                */

                if (empty($items)) {
                    throw new \Exception(
                        'Tidak ada produk yang dapat diproses.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Buat pesanan
                |--------------------------------------------------------------------------
                */

                $order = Order::create([
                    'user_id' => $request->user()?->id,

                    'customer_name' =>
                        $validated['customer_name'],

                    'phone' =>
                        $validated['phone'],

                    'address' =>
                        $validated['address'],

                    'total' =>
                        $total,

                    'status' =>
                        'Pesanan Baru',

                    'payment_method' => 'QRIS',

                    'payment_status' => 'Menunggu Pembayaran',

                    'paid_at' => null,
                ]);


                /*
                |--------------------------------------------------------------------------
                | Simpan setiap item pesanan
                |--------------------------------------------------------------------------
                */

                foreach ($items as $item) {

                    $product = $item['product'];

                    OrderItem::create([
                        'order_id' =>
                            $order->id,

                        'product_id' =>
                            $product->id,

                        'quantity' =>
                            $item['quantity'],

                        'price' =>
                            $product->price,
                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | Kurangi stok
                    |--------------------------------------------------------------------------
                    */

                    $product->decrement(
                        'stock',
                        $item['quantity']
                    );
                }

                return $order;
            });


            /*
            |--------------------------------------------------------------------------
            | Pesanan berhasil
            |--------------------------------------------------------------------------
            */

            $request->session()->forget('cart');

            $guestOrders = $request->session()->get('guest_order_ids', []);
            $guestOrders[] = $order->id;
            $request->session()->put('guest_order_ids', array_values(array_unique($guestOrders)));

            if ($validated['payment_method'] === 'QRIS') {
                return redirect()->route('checkout.pay', $order);
            }

            return redirect()
                ->route(
                    'checkout.success',
                    $order
                )
                ->with(
                    'success',
                    'Pesanan berhasil dibuat.'
                );

        } catch (\Exception $e) {

            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    private function authorizeOrder(Request $request, Order $order): void
    {
        if ($request->user()?->role === 'admin') {
            return;
        }

        $guestOrders = $request->session()->get('guest_order_ids', []);

        abort_unless(
            ($order->user_id && $request->user()?->id === $order->user_id)
            || in_array($order->id, $guestOrders, true),
            403
        );
    }

    public function pay(
        Request $request,
        Order $order
    ): View|RedirectResponse {
        $this->authorizeOrder($request, $order);

        if ($order->payment_method !== 'QRIS'
            || $order->payment_status === 'Dibayar'
            || $order->status === 'Dibatalkan') {
            return redirect()->route('checkout.success', $order);
        }

        $order->load('items.product');
        $settings = \App\Models\SiteSetting::first();

        return view('checkout.pay', [
            'order' => $order,
            'settings' => $settings,
        ]);
    }

    public function confirmPayment(
        Request $request,
        Order $order
    ): RedirectResponse {
        $this->authorizeOrder($request, $order);

        if ($order->payment_status !== 'Dibayar') {
            $order->update([
                'payment_status' => 'Menunggu Verifikasi',
            ]);
        }

        return redirect()
            ->route('checkout.success', $order)
            ->with('success', 'Konfirmasi pembayaran sudah dikirim. Admin akan memeriksa pembayaran QRIS kamu.');
    }

    public function success(
        Request $request,
        Order $order
    ): View {
        $this->authorizeOrder($request, $order);

        $order->load('items.product');

        return view('checkout.success', compact('order'));
    }
}
