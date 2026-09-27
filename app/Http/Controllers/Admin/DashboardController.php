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

        $newOrders = Order::where('status', 'pending')->count();

        $processingOrders = Order::where('status', 'processing')->count();

        $shippedOrders = Order::where('status', 'shipped')->count();

        $completedOrders = Order::where('status', 'completed')->count();

        $cancelledOrders = Order::where('status', 'cancelled')->count();

        $returnedOrders = Order::where('status', 'returned')->count();


        /*
        |--------------------------------------------------------------------------
        | KEUANGAN
        |--------------------------------------------------------------------------
        */

        // Hanya pembayaran yang sudah berhasil dianggap sebagai penjualan.
        $salesRevenue = Order::where('payment_status', 'paid')
            ->sum('total');

        // Total uang yang sudah dikembalikan kepada pelanggan.
        $refundRevenue = Order::where('refund_status', 'completed')
            ->sum('refund_amount');

        // Pendapatan bersih.
        $netRevenue = max(
            $salesRevenue - $refundRevenue,
            0
        );


        /*
        |--------------------------------------------------------------------------
        | PESANAN TERBARU
        |--------------------------------------------------------------------------
        */

        $latestOrders = Order::with('items')
            ->latest()
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PENJUALAN TERBARU
        |--------------------------------------------------------------------------
        */

        $latestSales = Order::where('payment_status', 'paid')
            ->latest('paid_at')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PENGEMBALIAN TERBARU
        |--------------------------------------------------------------------------
        */

        $latestRefunds = Order::where('refund_status', 'completed')
            ->latest('refunded_at')
            ->take(5)
            ->get();


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

            'salesRevenue',
            'refundRevenue',
            'netRevenue',

            'latestOrders',
            'latestSales',
            'latestRefunds'
        ));
    }
}