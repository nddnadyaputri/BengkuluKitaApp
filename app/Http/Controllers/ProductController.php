<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index(Request $request): View
    {
        // Ambil semua kategori
        $categories = Category::orderBy('name')->get();

        // Ambil produk
        $products = Product::with('category')
            // Pencarian nama produk
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where('name', 'like', '%' . $search . '%');
            })

            // Filter kategori
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })

            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact(
            'products',
            'categories'
        ));
    }


    /**
     * Menampilkan detail produk.
     */
    public function show(Product $product): View
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }
}