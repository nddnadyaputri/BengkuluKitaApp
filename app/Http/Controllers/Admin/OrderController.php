<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::with('items')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $newOrders = Order::where(
            'status',
            'Pesanan Baru'
        )->count();

        return view(
            'admin.orders.index',
            compact(
                'orders',
                'newOrders'
            )
        );
    }

    public function show(Order $order): View
    {
        $order->load('items.product');

        return view(
            'admin.orders.show',
            compact('order')
        );
    }

    public function updateStatus(
        Request $request,
        Order $order
    ): RedirectResponse {

        $validated = $request->validate([
            'status' => [
                'required',
                'in:Pesanan Baru,Diproses,Dikirim,Selesai,Dibatalkan',
            ],
        ]);

        $order->update([
            'status' =>
                $validated['status'],
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }

    public function updatePaymentStatus(
        Request $request,
        Order $order
    ): RedirectResponse {

        $validated = $request->validate([
            'payment_status' => [
                'required',
                'in:Belum Dibayar,Menunggu Pembayaran,Menunggu Verifikasi,Dibayar',
            ],
        ]);

        $data = [
            'payment_status' =>
                $validated['payment_status'],
        ];

        if (
            $validated['payment_status'] === 'Dibayar'
            && !$order->paid_at
        ) {
            $data['paid_at'] = now();
        }

        $order->update($data);

        return back()->with(
            'success',
            'Status pembayaran berhasil diperbarui.'
        );
    }
}