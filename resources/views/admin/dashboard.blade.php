@extends('layouts.app')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | FORMAT HARGA
    |--------------------------------------------------------------------------
    | Semua nilai uang dianggap dalam rupiah penuh.
    | Contoh:
    | 20000  -> Rp 20.000
    | 50000  -> Rp 50.000
    | 100000 -> Rp 100.000
    */
    function formatRupiah($value)
    {
        return 'Rp ' . number_format((float) $value, 0, ',', '.');
    }
@endphp

<div class="min-h-screen bg-[#f7f0e4]">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="hidden lg:flex w-72 bg-[#29251f] text-white flex-col">

            {{-- LOGO --}}
            <div class="p-6 border-b border-white/10">

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-xl bg-[#f5e7c7] flex items-center justify-center overflow-hidden">

                        <img
                            src="{{ asset('images/logo-kue.png') }}"
                            alt="Logo BengkuluKita"
                            class="w-9 h-9 object-contain"
                        >

                    </div>

                    <div>

                        <div class="font-extrabold text-lg">
                            BengkuluKita
                        </div>

                        <div class="text-xs text-[#d8c3a5]">
                            Admin Panel
                        </div>

                    </div>

                </a>

            </div>


            {{-- NAVIGATION --}}
            <nav class="flex-1 p-4 space-y-2">

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#8b6b45] text-white">

                    <span>📊</span>
                    <span class="font-semibold">Dashboard</span>

                </a>


                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#eee5d8] hover:bg-white/10 transition">

                    <span>📦</span>
                    <span>Produk</span>

                </a>


                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#eee5d8] hover:bg-white/10 transition">

                    <span>🛒</span>
                    <span>Pesanan</span>

                </a>


                <a
                    href="{{ route('admin.settings.edit') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#eee5d8] hover:bg-white/10 transition"
                >

                    <span>⚙️</span>
                    <span>Pengaturan</span>

                </a>


                <a href="{{ route('home') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#eee5d8] hover:bg-white/10 transition">

                    <span>🌐</span>
                    <span>Lihat Website</span>

                </a>

            </nav>


            {{-- USER --}}
            <div class="p-4 border-t border-white/10">

                <div class="mb-4 px-3">

                    <p class="text-sm text-[#d8c3a5]">
                        Login sebagai
                    </p>

                    <p class="font-semibold truncate">
                        {{ auth()->user()->name }}
                    </p>

                </div>


                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-[#eee5d8] hover:bg-red-500/20 hover:text-red-300 transition"
                    >

                        <span>↪</span>
                        <span>Logout</span>

                    </button>

                </form>

            </div>

        </aside>


        {{-- MAIN --}}
        <main class="flex-1 min-w-0">

            {{-- TOP BAR --}}
            <header class="bg-[#fffaf2] border-b border-[#e2d5c3]">

                <div class="px-6 lg:px-10 py-5 flex items-center justify-between">

                    <div>

                        <p class="text-sm text-[#8b6b45]">
                            Admin Panel
                        </p>

                        <h1 class="text-2xl font-extrabold text-[#29251f]">
                            Dashboard
                        </h1>

                    </div>


                    <div class="hidden sm:flex items-center gap-3">

                        <div class="text-right">

                            <p class="text-sm font-semibold text-[#29251f]">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-[#8b6b45]">
                                Administrator
                            </p>

                        </div>


                        <div class="w-10 h-10 rounded-full bg-[#8b6b45] text-white flex items-center justify-center font-bold">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </div>

                    </div>

                </div>

            </header>


            <div class="p-6 lg:p-10 space-y-8">


                {{-- WELCOME --}}
                <section>

                    <h2 class="text-xl font-bold text-[#29251f]">
                        Ringkasan BengkuluKita
                    </h2>

                    <p class="text-sm text-[#8b6b45] mt-1">
                        Pantau penjualan, pesanan, produk, dan kondisi toko dari satu halaman.
                    </p>

                </section>


                {{-- KEUANGAN --}}
                <section>

                    <div class="flex items-center justify-between mb-4">

                        <div>

                            <h3 class="text-lg font-bold text-[#29251f]">
                                Keuangan
                            </h3>

                            <p class="text-sm text-[#8b6b45]">
                                Ringkasan pemasukan dan pengembalian dana
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">


                        {{-- PENJUALAN --}}
                        <div class="bg-white rounded-2xl border border-[#e2d5c3] p-6 shadow-sm">

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm text-[#8b6b45]">
                                        Pendapatan Penjualan
                                    </p>

                                    <p class="mt-2 text-2xl font-extrabold text-[#29251f]">

                                        {{ formatRupiah($totalSales) }}

                                    </p>

                                </div>


                                <div class="w-11 h-11 rounded-xl bg-[#efe5d5] flex items-center justify-center text-xl">
                                    💰
                                </div>

                            </div>


                            <p class="text-xs text-[#8b6b45] mt-4">
                                Dari pesanan yang sudah dibayar
                            </p>

                        </div>



                        {{-- REFUND --}}
                        <div class="bg-white rounded-2xl border border-[#e2d5c3] p-6 shadow-sm">

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm text-[#8b6b45]">
                                        Pengembalian Dana
                                    </p>

                                    <p class="mt-2 text-2xl font-extrabold text-red-700">

                                        {{ formatRupiah($refundRevenue) }}

                                    </p>

                                </div>


                                <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center text-xl">
                                    ↩️
                                </div>

                            </div>


                            <p class="text-xs text-[#8b6b45] mt-4">
                                Dana yang telah dikembalikan
                            </p>

                        </div>



                        {{-- NET --}}
                        <div class="bg-[#29251f] rounded-2xl p-6 shadow-sm text-white">

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm text-[#d8c3a5]">
                                        Pendapatan Bersih
                                    </p>

                                    <p class="mt-2 text-2xl font-extrabold">

                                        {{ formatRupiah($netRevenue) }}

                                    </p>

                                </div>


                                <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center text-xl">
                                    📈
                                </div>

                            </div>


                            <p class="text-xs text-[#d8c3a5] mt-4">
                                Penjualan dikurangi pengembalian dana
                            </p>

                        </div>

                    </div>

                </section>



                {{-- OPERASIONAL --}}
                <section>

                    <h3 class="text-lg font-bold text-[#29251f] mb-4">
                        Ringkasan Operasional
                    </h3>


                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4">


                        {{-- PRODUK --}}
                        <div class="bg-white rounded-2xl border border-[#e2d5c3] p-5">

                            <p class="text-sm text-[#8b6b45]">
                                Total Produk
                            </p>

                            <p class="text-2xl font-extrabold text-[#29251f] mt-2">
                                {{ $totalProducts }}
                            </p>

                        </div>


                        {{-- STOK --}}
                        <div class="bg-white rounded-2xl border border-[#e2d5c3] p-5">

                            <p class="text-sm text-[#8b6b45]">
                                Total Stok
                            </p>

                            <p class="text-2xl font-extrabold text-[#29251f] mt-2">
                                {{ $totalStock }}
                            </p>

                        </div>


                        {{-- ORDERS --}}
                        <div class="bg-white rounded-2xl border border-[#e2d5c3] p-5">

                            <p class="text-sm text-[#8b6b45]">
                                Total Pesanan
                            </p>

                            <p class="text-2xl font-extrabold text-[#29251f] mt-2">
                                {{ $totalOrders }}
                            </p>

                        </div>


                        {{-- BARU --}}
                        <div class="bg-white rounded-2xl border border-[#e2d5c3] p-5">

                            <p class="text-sm text-[#8b6b45]">
                                Pesanan Baru
                            </p>

                            <p class="text-2xl font-extrabold text-[#8b6b45] mt-2">
                                {{ $newOrders }}
                            </p>

                        </div>


                        {{-- SELESAI --}}
                        <div class="bg-white rounded-2xl border border-[#e2d5c3] p-5">

                            <p class="text-sm text-[#8b6b45]">
                                Selesai
                            </p>

                            <p class="text-2xl font-extrabold text-green-700 mt-2">
                                {{ $completedOrders }}
                            </p>

                        </div>


                        {{-- RETURN --}}
                        <div class="bg-white rounded-2xl border border-[#e2d5c3] p-5">

                            <p class="text-sm text-[#8b6b45]">
                                Dikembalikan
                            </p>

                            <p class="text-2xl font-extrabold text-red-700 mt-2">
                                {{ $returnedOrders }}
                            </p>

                        </div>

                    </div>

                </section>



                {{-- STATUS PESANAN --}}
                <section class="bg-white rounded-2xl border border-[#e2d5c3] p-6">

                    <div class="flex items-center justify-between mb-5">

                        <div>

                            <h3 class="font-bold text-[#29251f] text-lg">
                                Status Pesanan
                            </h3>

                            <p class="text-sm text-[#8b6b45]">
                                Kondisi pesanan saat ini
                            </p>

                        </div>


                        <a href="{{ route('admin.orders.index') }}"
                           class="text-sm font-semibold text-[#8b6b45] hover:underline">

                            Lihat Semua

                        </a>

                    </div>


                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">

                        <div class="p-4 rounded-xl bg-[#f7f0e4]">
                            <p class="text-xs text-[#8b6b45]">Menunggu</p>
                            <p class="text-xl font-bold mt-1">{{ $newOrders }}</p>
                        </div>

                        <div class="p-4 rounded-xl bg-[#f7f0e4]">
                            <p class="text-xs text-[#8b6b45]">Diproses</p>
                            <p class="text-xl font-bold mt-1">{{ $processingOrders }}</p>
                        </div>

                        <div class="p-4 rounded-xl bg-[#f7f0e4]">
                            <p class="text-xs text-[#8b6b45]">Dikirim</p>
                            <p class="text-xl font-bold mt-1">{{ $shippedOrders }}</p>
                        </div>

                        <div class="p-4 rounded-xl bg-[#f7f0e4]">
                            <p class="text-xs text-[#8b6b45]">Selesai</p>
                            <p class="text-xl font-bold mt-1">{{ $completedOrders }}</p>
                        </div>

                        <div class="p-4 rounded-xl bg-[#f7f0e4]">
                            <p class="text-xs text-[#8b6b45]">Dibatalkan</p>
                            <p class="text-xl font-bold mt-1">{{ $cancelledOrders }}</p>
                        </div>

                    </div>

                </section>



                {{-- PESANAN TERBARU --}}
                <section class="bg-white rounded-2xl border border-[#e2d5c3] overflow-hidden">

                    <div class="p-6 flex items-center justify-between">

                        <div>

                            <h3 class="font-bold text-[#29251f] text-lg">
                                Pesanan Terbaru
                            </h3>

                            <p class="text-sm text-[#8b6b45]">
                                Aktivitas transaksi terbaru
                            </p>

                        </div>


                        <a href="{{ route('admin.orders.index') }}"
                           class="text-sm font-semibold text-[#8b6b45] hover:underline">

                            Kelola Pesanan

                        </a>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">

                            <thead class="bg-[#f7f0e4]">

                                <tr class="text-left text-[#8b6b45]">

                                    <th class="px-6 py-4">
                                        Pelanggan
                                    </th>

                                    <th class="px-6 py-4">
                                        Total
                                    </th>

                                    <th class="px-6 py-4">
                                        Pembayaran
                                    </th>

                                    <th class="px-6 py-4">
                                        Status
                                    </th>

                                    <th class="px-6 py-4">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-[#eee5d8]">

                                @forelse($latestOrders as $order)

                                    <tr class="hover:bg-[#fffaf2] transition">


                                        {{-- PELANGGAN --}}
                                        <td class="px-6 py-4">

                                            <p class="font-semibold text-[#29251f]">
                                                {{ $order->customer_name }}
                                            </p>

                                            <p class="text-xs text-[#8b6b45]">
                                                {{ $order->phone }}
                                            </p>

                                        </td>


                                        {{-- TOTAL --}}
                                        <td class="px-6 py-4 font-semibold">

                                            {{ formatRupiah($order->total) }}

                                        </td>


                                        {{-- PEMBAYARAN --}}
                                        <td class="px-6 py-4">

                                            @if($order->payment_status === 'Dibayar')

                                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                                    Dibayar
                                                </span>

                                            @else

                                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                                    Belum Dibayar
                                                </span>

                                            @endif

                                        </td>


                                        {{-- STATUS --}}
                                        <td class="px-6 py-4">

                                            @php

                                                $statusLabels = [

                                                    'Pesanan Baru' => 'Pesanan Baru',
                                                    'Diproses' => 'Diproses',
                                                    'Dikirim' => 'Dikirim',
                                                    'Selesai' => 'Selesai',
                                                    'Dibatalkan' => 'Dibatalkan',
                                                    'Dikembalikan' => 'Dikembalikan',

                                                ];


                                                $statusColors = [

                                                    'Pesanan Baru' => 'bg-yellow-100 text-yellow-700',
                                                    'Diproses' => 'bg-blue-100 text-blue-700',
                                                    'Dikirim' => 'bg-purple-100 text-purple-700',
                                                    'Selesai' => 'bg-green-100 text-green-700',
                                                    'Dibatalkan' => 'bg-red-100 text-red-700',
                                                    'Dikembalikan' => 'bg-orange-100 text-orange-700',

                                                ];

                                            @endphp


                                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">

                                                {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}

                                            </span>

                                        </td>


                                        {{-- AKSI --}}
                                        <td class="px-6 py-4">

                                            <a href="{{ route('admin.orders.show', $order) }}"
                                               class="text-[#8b6b45] font-semibold hover:underline">

                                                Detail

                                            </a>

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td colspan="5"
                                            class="px-6 py-10 text-center text-[#8b6b45]">

                                            Belum ada pesanan.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </section>



                {{-- AKSI CEPAT --}}
                <section>

                    <h3 class="text-lg font-bold text-[#29251f] mb-4">
                        Aksi Cepat
                    </h3>


                    <div class="grid md:grid-cols-2 gap-5">


                        <a href="{{ route('admin.products.create') }}"
                           class="group bg-[#29251f] text-white rounded-2xl p-6 hover:-translate-y-1 transition duration-200">

                            <div class="text-2xl mb-3">
                                ➕
                            </div>

                            <h4 class="font-bold text-lg">
                                Tambah Produk
                            </h4>

                            <p class="text-sm text-[#d8c3a5] mt-1">
                                Tambahkan makanan, minuman, camilan, atau oleh-oleh baru.
                            </p>

                        </a>


                        <a href="{{ route('admin.orders.index') }}"
                           class="group bg-white border border-[#e2d5c3] rounded-2xl p-6 hover:-translate-y-1 hover:shadow-md transition duration-200">

                            <div class="text-2xl mb-3">
                                🛍️
                            </div>

                            <h4 class="font-bold text-lg text-[#29251f]">
                                Kelola Pesanan
                            </h4>

                            <p class="text-sm text-[#8b6b45] mt-1">
                                Periksa pembayaran, status pesanan, dan pengembalian.
                            </p>

                        </a>

                    </div>

                </section>

            </div>

        </main>

    </div>

</div>

@endsection