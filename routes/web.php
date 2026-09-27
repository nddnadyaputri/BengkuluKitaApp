<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SiteSettingController;


/*
|--------------------------------------------------------------------------
| HALAMAN PEMBELI
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/produk', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/produk/{product}', [ProductController::class, 'show'])
    ->name('products.show');


/*
|--------------------------------------------------------------------------
| KERANJANG & CHECKOUT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::patch('/keranjang/{product}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/keranjang/{product}', [CartController::class, 'remove'])
        ->name('cart.remove');


    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/checkout/sukses/{order}', [CheckoutController::class, 'success'])
        ->name('checkout.success');
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | PENGATURAN WEBSITE
        |--------------------------------------------------------------------------
        */

        Route::get('/settings', [SiteSettingController::class, 'edit'])
            ->name('admin.settings.edit');

        Route::put('/settings', [SiteSettingController::class, 'update'])
            ->name('admin.settings.update');

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | PRODUK
        |--------------------------------------------------------------------------
        */

        Route::get('/products', [AdminProductController::class, 'index'])
            ->name('admin.products.index');

        Route::get('/products/create', [AdminProductController::class, 'create'])
            ->name('admin.products.create');

        Route::post('/products', [AdminProductController::class, 'store'])
            ->name('admin.products.store');

        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])
            ->name('admin.products.edit');

        Route::put('/products/{product}', [AdminProductController::class, 'update'])
            ->name('admin.products.update');

        Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])
            ->name('admin.products.destroy');
            


        /*
        |--------------------------------------------------------------------------
        | PESANAN
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('admin.orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('admin.orders.show');

        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('admin.orders.status');

        Route::patch('/orders/{order}/payment', [AdminOrderController::class, 'updatePaymentStatus'])
            ->name('admin.orders.payment');


        /*
        |--------------------------------------------------------------------------
        | PENGEMBALIAN / REFUND
        |--------------------------------------------------------------------------
        */

        Route::patch('/orders/{order}/refund', [AdminOrderController::class, 'processRefund'])
            ->name('admin.orders.refund');
    });


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';