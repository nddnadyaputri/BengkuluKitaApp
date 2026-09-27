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
                'in:Transfer Bank,QRIS,COD',
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
                $validated
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

                    'payment_method' =>
                        $validated['payment_method'],

                    'payment_status' =>
                        $validated['payment_method'] === 'COD'
                            ? 'Belum Dibayar'
                            : 'Menunggu Pembayaran',

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

    public function success(Order $order): View
    {
        $order->load([
            'items.product',
        ]);

        return view(
            'checkout.success',
            compact('order')
        );
    }
}