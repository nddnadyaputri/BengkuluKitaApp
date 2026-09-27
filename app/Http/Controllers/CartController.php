<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Menampilkan isi keranjang.
     */
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);

        $products = collect();

        if (!empty($cart)) {
            $products = Product::with('category')
                ->whereIn('id', array_keys($cart))
                ->get();
        }

        $cartItems = $products->map(function ($product) use ($cart) {

            $quantity = (int) ($cart[$product->id]['quantity'] ?? 0);

            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity,
            ];

        });

        $total = $cartItems->sum('subtotal');

        return view('cart.index', compact(
            'cartItems',
            'total'
        ));
    }


    /**
     * Menambahkan produk ke keranjang.
     */
    public function add(
        Request $request,
        Product $product
    ): RedirectResponse {

        if ($product->stock <= 0) {
            return back()->with(
                'error',
                'Produk tersebut sedang habis.'
            );
        }

        $cart = $request->session()->get('cart', []);

        $productId = (string) $product->id;

        if (isset($cart[$productId])) {

            $newQuantity =
                $cart[$productId]['quantity'] + 1;

            if ($newQuantity > $product->stock) {

                return back()->with(
                    'error',
                    'Jumlah produk melebihi stok yang tersedia.'
                );
            }

            $cart[$productId]['quantity'] = $newQuantity;

        } else {

            $cart[$productId] = [
                'quantity' => 1,
            ];
        }

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            $product->name . ' berhasil ditambahkan ke keranjang.'
        );
    }


    /**
     * Mengubah jumlah produk.
     */
    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {

        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $quantity = (int) $request->quantity;

        if ($quantity > $product->stock) {

            return back()->with(
                'error',
                'Jumlah yang dipilih melebihi stok produk.'
            );
        }

        $cart = $request->session()->get('cart', []);

        $productId = (string) $product->id;

        if (!isset($cart[$productId])) {

            return back()->with(
                'error',
                'Produk tidak ditemukan di keranjang.'
            );
        }

        $cart[$productId]['quantity'] = $quantity;

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Jumlah produk berhasil diperbarui.'
        );
    }


    /**
     * Menghapus produk dari keranjang.
     */
    public function remove(
        Request $request,
        Product $product
    ): RedirectResponse {

        $cart = $request->session()->get('cart', []);

        $productId = (string) $product->id;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Produk berhasil dihapus dari keranjang.'
        );
    }
}