<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])
    ->name('home');


// =========================
// PRODUK PUBLIC
// =========================

// Daftar produk
Route::get('/produk', [ProductController::class, 'index'])
    ->name('products.index');

// Detail produk
Route::get('/produk/{product}', [ProductController::class, 'show'])
    ->name('products.show');


// =========================
// KERANJANG
// =========================

// Halaman keranjang
Route::get('/keranjang', [CartController::class, 'index'])
    ->name('cart.index');

// Tambah produk ke keranjang
Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])
    ->name('cart.add');

// Update jumlah produk
Route::patch('/keranjang/{product}', [CartController::class, 'update'])
    ->name('cart.update');

// Hapus produk dari keranjang
Route::delete('/keranjang/{product}', [CartController::class, 'remove'])
    ->name('cart.remove');


// =========================
// CHECKOUT
// =========================

// Halaman checkout
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

// Proses checkout
Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

// Checkout berhasil
Route::get('/checkout/sukses/{order}', [CheckoutController::class, 'success'])
    ->name('checkout.success');


// =========================
// ADMIN
// =========================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        // =========================
        // DASHBOARD ADMIN
        // =========================

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');


        // =========================
        // PRODUK ADMIN
        // =========================

        // Daftar produk
        Route::get('/products', [
            AdminProductController::class,
            'index'
        ])->name('admin.products.index');

        // Form tambah produk
        Route::get('/products/create', [
            AdminProductController::class,
            'create'
        ])->name('admin.products.create');

        // Simpan produk
        Route::post('/products', [
            AdminProductController::class,
            'store'
        ])->name('admin.products.store');

        // Form edit produk
        Route::get('/products/{product}/edit', [
            AdminProductController::class,
            'edit'
        ])->name('admin.products.edit');

        // Update produk
        Route::put('/products/{product}', [
            AdminProductController::class,
            'update'
        ])->name('admin.products.update');

        // Hapus produk
        Route::delete('/products/{product}', [
            AdminProductController::class,
            'destroy'
        ])->name('admin.products.destroy');
    });


// =========================
// AUTHENTICATION
// =========================

require __DIR__ . '/auth.php';
