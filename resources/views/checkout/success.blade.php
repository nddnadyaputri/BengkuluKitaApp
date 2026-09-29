@extends('layouts.app')

@section('content')

@php
    $paid = $order->payment_status === 'Dibayar';
    $cancelled = $order->status === 'Dibatalkan';
    $pendingPayment = $order->payment_method === 'QRIS' && ! $paid && ! $cancelled;

    if ($paid) {
        [$ring, $dot, $eyebrow, $title, $text] = ['bg-[#e8f3e5]', 'bg-[#6f8f5f]', 'Pembayaran Berhasil', 'Terima Kasih, Pembayaran Diterima!', 'Pesananmu sudah kami terima dan akan segera disiapkan.'];
    } elseif ($cancelled) {
        [$ring, $dot, $eyebrow, $title, $text] = ['bg-red-50', 'bg-red-500', 'Pesanan Dibatalkan', 'Pembayaran Tidak Selesai', 'Batas waktu pembayaran habis atau transaksi dibatalkan. Kamu bisa berbelanja lagi kapan saja.'];
    } elseif ($order->payment_status === 'Menunggu Verifikasi') {
        [$ring, $dot, $eyebrow, $title, $text] = ['bg-[#fbf0d2]', 'bg-[#d4a017]', 'Menunggu Verifikasi', 'Pembayaran Sedang Diperiksa', 'Konfirmasi pembayaran sudah diterima. Admin akan memeriksa pembayaran QRIS sebelum pesanan diproses.'];
    } elseif ($pendingPayment) {
        [$ring, $dot, $eyebrow, $title, $text] = ['bg-[#fbf0d2]', 'bg-[#d4a017]', 'Menunggu Pembayaran', 'Selesaikan Pembayaranmu', 'Pesanan sudah dibuat. Silakan scan QRIS dan lakukan pembayaran.'];
    } else {
        [$ring, $dot, $eyebrow, $title, $text] = ['bg-[#e8f3e5]', 'bg-[#6f8f5f]', 'Pesanan Berhasil', 'Pesanan Kamu Diterima!', 'Siapkan pembayaran tunai saat pesanan tiba di alamatmu.'];
    }
@endphp

<div class="min-h-screen bg-gradient-to-b from-[#fffaf2] to-[#f7f0e4] py-10 md:py-16">
<div class="max-w-3xl mx-auto px-5 sm:px-6">

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-5">{{ session('error') }}</div>
    @endif

    <div class="text-center mb-8">
        <div class="mx-auto w-24 h-24 rounded-full {{ $ring }} flex items-center justify-center mb-5 animate-pulse">
            <div class="w-14 h-14 rounded-full {{ $dot }} flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    @if($cancelled)<path d="M18 6 6 18M6 6l12 12"/>@elseif($pendingPayment)<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>@else<path d="M20 6 9 17l-5-5"/>@endif
                </svg>
            </div>
        </div>
        <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#8b6b45]">{{ $eyebrow }}</p>
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#29251f] mt-2">{{ $title }}</h1>
        <p class="text-gray-600 max-w-lg mx-auto mt-3 leading-relaxed">{{ $text }}</p>
    </div>

    <div class="bg-white rounded-[2rem] border border-[#e2d5c3] shadow-[0_15px_45px_rgba(70,50,30,0.08)] overflow-hidden">

        <div class="px-6 md:px-8 py-6 bg-[#fffaf3] border-b border-[#eee4d7] grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div>
                <p class="text-xs uppercase tracking-wider font-bold text-gray-500">No. Pesanan</p>
                <p class="text-xl font-extrabold text-[#29251f] mt-1">#{{ $order->id }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wider font-bold text-gray-500">Metode</p>
                <p class="font-bold text-[#29251f] mt-1">{{ $order->payment_method }}@if($order->payment_type)<span class="block text-xs font-medium text-gray-500">{{ str_replace('_', ' ', $order->payment_type) }}</span>@endif</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wider font-bold text-gray-500">Pembayaran</p>
                <p class="font-bold mt-1 {{ $paid ? 'text-[#4f7a3f]' : ($cancelled ? 'text-red-600' : 'text-[#b8860b]') }}">{{ $order->payment_status }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wider font-bold text-gray-500">Total</p>
                <p class="text-xl font-extrabold text-[#8b6b45] mt-1">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="p-6 md:p-8">

            @if($pendingPayment)
                <a href="{{ route('checkout.pay', $order) }}"
                    class="block text-center mb-8 bg-gradient-to-r from-[#8b6b45] to-[#6f5437] text-white py-4 rounded-xl font-bold hover:-translate-y-0.5 hover:shadow-xl transition">
                    Bayar Sekarang
                </a>
            @endif

            <h2 class="text-lg font-bold text-[#29251f] mb-4">Detail Pesanan</h2>
            <div class="border border-[#e2d5c3] rounded-2xl overflow-hidden">
                @foreach($order->items as $item)
                    <div class="flex items-center justify-between gap-4 px-5 py-4 {{ ! $loop->last ? 'border-b border-[#eee4d7]' : '' }}">
                        <div class="min-w-0">
                            <p class="font-bold text-[#29251f] truncate">{{ $item->product?->name ?? 'Produk' }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-bold text-[#8b6b45] whitespace-nowrap">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 rounded-2xl bg-[#faf6ef] border border-[#eee4d7] p-5">
                <h3 class="font-bold text-[#29251f] mb-3">Informasi Pengiriman</h3>
                <p class="font-semibold text-[#29251f]">{{ $order->customer_name }} · {{ $order->phone }}</p>
                <p class="text-gray-600 mt-1 leading-relaxed">{{ $order->address }}</p>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('products.index') }}" class="flex-1 text-center px-6 py-3.5 rounded-xl bg-[#29251f] text-white font-bold hover:bg-[#8b6b45] hover:-translate-y-0.5 hover:shadow-lg transition">Lanjut Belanja</a>
                <a href="{{ route('home') }}" class="flex-1 text-center px-6 py-3.5 rounded-xl border-2 border-[#d8cbbb] bg-white text-[#29251f] font-bold hover:border-[#8b6b45] hover:text-[#8b6b45] transition">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <p class="text-center text-sm text-gray-500 mt-8">Terima kasih telah memilih <span class="font-bold text-[#8b6b45]">BengkuluKita</span> ❤️</p>
</div>
</div>

@endsection
