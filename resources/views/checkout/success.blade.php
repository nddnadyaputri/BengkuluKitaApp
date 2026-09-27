@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#f7f0e4] py-10 md:py-16">

    <div class="max-w-4xl mx-auto px-5 sm:px-6">

        {{-- SUCCESS HEADER --}}
        <div class="text-center mb-8">

            {{-- SUCCESS ICON --}}
            <div class="mx-auto w-20 h-20 rounded-full bg-[#e8f3e5] flex items-center justify-center shadow-sm mb-5">

                <div class="w-12 h-12 rounded-full bg-[#6f8f5f] flex items-center justify-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-white"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>

                </div>

            </div>


            <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#8b6b45]">
                Pesanan Berhasil
            </p>

            <h1 class="text-3xl md:text-4xl font-extrabold text-[#29251f] mt-2">
                Pesanan Kamu Diterima!
            </h1>

            <p class="text-gray-600 max-w-xl mx-auto mt-3 leading-relaxed">
                Terima kasih sudah berbelanja di BengkuluKita.
                Pesanan kamu sudah berhasil dicatat dan akan segera diproses.
            </p>

        </div>


        {{-- MAIN CARD --}}
        <div class="bg-white rounded-[2rem] border border-[#e2d5c3] shadow-[0_15px_45px_rgba(70,50,30,0.08)] overflow-hidden">


            {{-- ORDER TOP --}}
            <div class="px-6 md:px-8 py-6 bg-[#fffaf3] border-b border-[#eee4d7]">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>

                        <p class="text-xs uppercase tracking-wider font-bold text-gray-500">
                            Nomor Pesanan
                        </p>

                        <p class="text-2xl font-extrabold text-[#29251f] mt-1">
                            #{{ $order->id }}
                        </p>

                    </div>


                    {{-- STATUS --}}
                    <div class="inline-flex items-center gap-2 self-start sm:self-auto px-4 py-2 rounded-full bg-[#f5e7c7] text-[#8b6b45] text-sm font-bold">

                        <span class="w-2 h-2 rounded-full bg-[#8b6b45]"></span>

                        {{ $order->status }}

                    </div>

                </div>

            </div>


            {{-- ORDER INFORMATION --}}
            <div class="p-6 md:p-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">


                    {{-- PAYMENT --}}
                    <div class="rounded-2xl bg-[#faf6ef] border border-[#eee4d7] p-5">

                        <div class="w-10 h-10 rounded-xl bg-[#29251f] flex items-center justify-center mb-4">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    width="20"
                                    height="14"
                                    x="2"
                                    y="5"
                                    rx="2"
                                />

                                <path d="M2 10h20"/>
                            </svg>

                        </div>

                        <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">
                            Pembayaran
                        </p>

                        <p class="font-bold text-[#29251f] mt-1">
                            {{ $order->payment_method }}
                        </p>

                    </div>


                    {{-- PAYMENT STATUS --}}
                    <div class="rounded-2xl bg-[#faf6ef] border border-[#eee4d7] p-5">

                        <div class="w-10 h-10 rounded-xl bg-[#8b6b45] flex items-center justify-center mb-4">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M12 2v20"/>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H7"/>
                            </svg>

                        </div>

                        <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">
                            Status Pembayaran
                        </p>

                        <p class="font-bold text-[#29251f] mt-1">
                            {{ $order->payment_status }}
                        </p>

                    </div>


                    {{-- TOTAL --}}
                    <div class="rounded-2xl bg-[#29251f] p-5 text-white">

                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center mb-4">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-[#f5e7c7]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M6 2v20"/>
                                <path d="M18 2v20"/>
                                <path d="M2 6h20"/>
                                <path d="M2 18h20"/>
                            </svg>

                        </div>

                        <p class="text-xs text-white/60 uppercase tracking-wide font-semibold">
                            Total Pesanan
                        </p>

                        <p class="text-xl font-extrabold text-[#f5e7c7] mt-1">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </p>

                    </div>

                </div>


                {{-- ORDER ITEMS --}}
                <div>

                    <div class="flex items-center justify-between mb-4">

                        <div>

                            <h2 class="text-xl font-bold text-[#29251f]">
                                Detail Pesanan
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Produk yang kamu pesan
                            </p>

                        </div>

                        <span class="text-sm font-semibold text-gray-500">
                            {{ $order->items->count() }} item
                        </span>

                    </div>


                    <div class="border border-[#e2d5c3] rounded-2xl overflow-hidden">

                        @foreach($order->items as $item)

                            <div class="flex items-center justify-between gap-4 px-5 py-4 {{ !$loop->last ? 'border-b border-[#eee4d7]' : '' }}">

                                <div class="flex items-center gap-4 min-w-0">

                                    {{-- PRODUCT ICON --}}
                                    <div class="w-11 h-11 shrink-0 rounded-xl bg-[#f5eee4] flex items-center justify-center">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 text-[#8b6b45]"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path d="M6 2l1.5 4h9L18 2"/>
                                            <path d="M4 6h16l-1 14H5L4 6z"/>
                                            <path d="M9 10v6"/>
                                            <path d="M15 10v6"/>
                                        </svg>

                                    </div>


                                    <div class="min-w-0">

                                        <p class="font-bold text-[#29251f] truncate">
                                            {{ $item->product?->name ?? 'Produk' }}
                                        </p>

                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $item->quantity }} ×
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>

                                    </div>

                                </div>


                                <p class="font-bold text-[#8b6b45] whitespace-nowrap">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- TOTAL --}}
                <div class="mt-6 pt-6 border-t border-[#e2d5c3]">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="font-bold text-[#29251f]">
                                Total Pembayaran
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Sudah termasuk seluruh produk yang dipesan.
                            </p>

                        </div>

                        <p class="text-2xl font-extrabold text-[#8b6b45]">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </p>

                    </div>

                </div>


                {{-- CUSTOMER INFORMATION --}}
                <div class="mt-8 rounded-2xl bg-[#faf6ef] border border-[#eee4d7] p-5">

                    <h3 class="font-bold text-[#29251f] mb-4">
                        Informasi Pengiriman
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>

                            <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                                Nama
                            </p>

                            <p class="font-semibold text-[#29251f] mt-1">
                                {{ $order->customer_name }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                                WhatsApp
                            </p>

                            <p class="font-semibold text-[#29251f] mt-1">
                                {{ $order->phone }}
                            </p>

                        </div>


                        <div class="md:col-span-2">

                            <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                                Alamat
                            </p>

                            <p class="font-semibold text-[#29251f] mt-1 leading-relaxed">
                                {{ $order->address }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- INFORMATION NOTE --}}
                <div class="mt-6 flex gap-3 rounded-2xl bg-[#f5e7c7]/60 border border-[#e5d2a9] p-5">

                    <div class="shrink-0 mt-0.5">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-[#8b6b45]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 11v5"/>
                            <path d="M12 8h.01"/>
                        </svg>

                    </div>

                    <div>

                        <p class="font-bold text-[#6f5437]">
                            Pesanan sedang diproses
                        </p>

                        <p class="text-sm text-[#7d674d] mt-1 leading-relaxed">
                            Simpan nomor pesanan
                            <strong>#{{ $order->id }}</strong>
                            untuk memudahkan pengecekan pesanan kamu.
                        </p>

                    </div>

                </div>


                {{-- ACTION BUTTONS --}}
                <div class="mt-8 flex flex-col sm:flex-row gap-3">

                    {{-- PRIMARY ACTION --}}
                    <a
                        href="{{ route('products.index') }}"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#29251f] text-white font-bold hover:bg-[#8b6b45] hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#8b6b45] focus:ring-offset-2"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M6 2l1.5 4h9L18 2"/>
                            <path d="M4 6h16l-1 14H5L4 6z"/>
                        </svg>

                        Lanjut Belanja

                    </a>


                    {{-- SECONDARY ACTION --}}
                    <a
                        href="{{ route('home') }}"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border-2 border-[#d8cbbb] bg-white text-[#29251f] font-bold hover:border-[#8b6b45] hover:text-[#8b6b45] hover:bg-[#fffaf4] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#8b6b45] focus:ring-offset-2"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="m3 10 9-7 9 7"/>
                            <path d="M5 9v11h14V9"/>
                            <path d="M9 20v-6h6v6"/>
                        </svg>

                        Kembali ke Beranda

                    </a>

                </div>

            </div>

        </div>


        {{-- FOOTER TEXT --}}
        <div class="text-center mt-8">

            <p class="text-sm text-gray-500">
                Terima kasih telah memilih
                <span class="font-bold text-[#8b6b45]">
                    BengkuluKita
                </span>
                ❤️
            </p>

        </div>

    </div>

</div>

@endsection