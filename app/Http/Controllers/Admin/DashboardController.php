<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | PRODUK
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();

        $totalStock = Product::sum('stock');


        /*
        |--------------------------------------------------------------------------
        | PESANAN
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::count();

        $newOrders = Order::where('status', 'Pesanan Baru')->count();

        $processingOrders = Order::where('status', 'Diproses')->count();

        $shippedOrders = Order::where('status', 'Dikirim')->count();

        $completedOrders = Order::where('status', 'Selesai')->count();

        $cancelledOrders = Order::where('status', 'Dibatalkan')->count();

        $returnedOrders = Order::where('status', 'Dikembalikan')->count();


        /*
        |--------------------------------------------------------------------------
        | KEUANGAN
        |--------------------------------------------------------------------------
        |
        | Hanya pesanan yang sudah dibayar yang dihitung sebagai pendapatan.
        |
        */

        $totalSales = Order::where('payment_status', 'Dibayar')
            ->sum('total');


        /*
        |--------------------------------------------------------------------------
        | PENGEMBALIAN DANA
        |--------------------------------------------------------------------------
        */

        $refundRevenue = Order::where('status', 'Dikembalikan')
            ->sum('total');


        /*
        |--------------------------------------------------------------------------
        | PENDAPATAN BERSIH
        |--------------------------------------------------------------------------
        */

        $netRevenue = $totalSales - $refundRevenue;


        /*
        |--------------------------------------------------------------------------
        | PESANAN TERBARU
        |--------------------------------------------------------------------------
        */

        $latestOrders = Order::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalStock',
            'totalOrders',
            'newOrders',
            'processingOrders',
            'shippedOrders',
            'completedOrders',
            'cancelledOrders',
            'returnedOrders',
            'totalSales',
            'refundRevenue',
            'netRevenue',
            'latestOrders'
        ));
    }
}