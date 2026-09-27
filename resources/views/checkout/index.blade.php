@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#f7f0e4] py-10">

    <div class="max-w-6xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="mb-8">

            <a
                href="{{ route('cart.index') }}"
                class="inline-flex items-center text-[#8b6b45] font-semibold hover:text-[#29251f] transition"
            >
                ← Kembali ke Keranjang
            </a>

            <h1 class="text-3xl md:text-4xl font-bold text-[#29251f] mt-5">
                Checkout
            </h1>

            <p class="text-gray-600 mt-2">
                Lengkapi data pesanan kamu sebelum membuat pesanan.
            </p>

        </div>


        {{-- ERROR VALIDATION --}}
        @if($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-5">

                <p class="font-bold mb-2">
                    Ada data yang perlu diperbaiki:
                </p>

                <ul class="list-disc list-inside text-sm space-y-1">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- SESSION ERROR --}}
        @if(session('error'))

            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-5">
                {{ session('error') }}
            </div>

        @endif


        <form
            method="POST"
            action="{{ route('checkout.store') }}"
        >

            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                {{-- DATA PELANGGAN --}}
                <div class="lg:col-span-2 space-y-6">


                    {{-- INFORMASI PELANGGAN --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-[#e2d5c3] p-6 md:p-8">

                        <h2 class="text-xl font-bold text-[#29251f] mb-6">
                            Data Pelanggan
                        </h2>


                        {{-- NAMA --}}
                        <div class="mb-5">

                            <label
                                for="customer_name"
                                class="block text-sm font-semibold text-[#29251f] mb-2"
                            >
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                id="customer_name"
                                name="customer_name"
                                value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                                required
                                maxlength="255"
                                class="w-full rounded-xl border-[#d8cbbb] bg-[#fffdf9] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                placeholder="Masukkan nama lengkap"
                            >

                        </div>


                        {{-- WHATSAPP --}}
                        <div class="mb-5">

                            <label
                                for="phone"
                                class="block text-sm font-semibold text-[#29251f] mb-2"
                            >
                                Nomor WhatsApp
                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                required
                                maxlength="30"
                                class="w-full rounded-xl border-[#d8cbbb] bg-[#fffdf9] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                placeholder="Contoh: 081234567890"
                            >

                        </div>


                        {{-- ALAMAT --}}
                        <div>

                            <label
                                for="address"
                                class="block text-sm font-semibold text-[#29251f] mb-2"
                            >
                                Alamat Pengiriman
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="5"
                                required
                                maxlength="1000"
                                class="w-full rounded-xl border-[#d8cbbb] bg-[#fffdf9] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                placeholder="Masukkan alamat lengkap untuk pengiriman"
                            >{{ old('address') }}</textarea>

                        </div>

                    </div>


                    {{-- METODE PEMBAYARAN --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-[#e2d5c3] p-6 md:p-8">

                        <h2 class="text-xl font-bold text-[#29251f] mb-6">
                            Metode Pembayaran
                        </h2>


                        <div class="space-y-4">


                            {{-- TRANSFER --}}
                            <label class="block cursor-pointer">

                                <div class="border border-[#e2d5c3] rounded-2xl p-4 hover:border-[#8b6b45] hover:bg-[#fffaf4] transition">

                                    <div class="flex items-start gap-4">

                                        <input
                                            type="radio"
                                            name="payment_method"
                                            value="Transfer Bank"
                                            class="mt-1 text-[#8b6b45] focus:ring-[#8b6b45]"
                                            {{ old('payment_method') === 'Transfer Bank' ? 'checked' : '' }}
                                        >

                                        <div>

                                            <p class="font-bold text-[#29251f]">
                                                Transfer Bank
                                            </p>

                                            <p class="text-sm text-gray-500 mt-1">
                                                Pembayaran melalui transfer bank.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>


                            {{-- QRIS --}}
                            <label class="block cursor-pointer">

                                <div class="border border-[#e2d5c3] rounded-2xl p-4 hover:border-[#8b6b45] hover:bg-[#fffaf4] transition">

                                    <div class="flex items-start gap-4">

                                        <input
                                            type="radio"
                                            name="payment_method"
                                            value="QRIS"
                                            class="mt-1 text-[#8b6b45] focus:ring-[#8b6b45]"
                                            {{ old('payment_method') === 'QRIS' ? 'checked' : '' }}
                                        >

                                        <div>

                                            <p class="font-bold text-[#29251f]">
                                                QRIS
                                            </p>

                                            <p class="text-sm text-gray-500 mt-1">
                                                Pembayaran menggunakan QRIS.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>


                            {{-- COD --}}
                            <label class="block cursor-pointer">

                                <div class="border border-[#e2d5c3] rounded-2xl p-4 hover:border-[#8b6b45] hover:bg-[#fffaf4] transition">

                                    <div class="flex items-start gap-4">

                                        <input
                                            type="radio"
                                            name="payment_method"
                                            value="COD"
                                            class="mt-1 text-[#8b6b45] focus:ring-[#8b6b45]"
                                            {{ old('payment_method') === 'COD' ? 'checked' : '' }}
                                        >

                                        <div>

                                            <p class="font-bold text-[#29251f]">
                                                COD
                                            </p>

                                            <p class="text-sm text-gray-500 mt-1">
                                                Bayar ketika pesanan diterima.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>

                </div>


                {{-- RINGKASAN --}}
                <div class="lg:col-span-1">

                    <div class="bg-white rounded-3xl shadow-sm border border-[#e2d5c3] p-6 sticky top-6">

                        <h2 class="text-xl font-bold text-[#29251f] mb-6">
                            Ringkasan Pesanan
                        </h2>


                        <div class="space-y-4">

                            @foreach($cartItems as $item)

                                <div class="flex justify-between gap-4 pb-4 border-b border-[#eee4d7]">

                                    <div class="min-w-0">

                                        <p class="font-semibold text-[#29251f]">
                                            {{ $item['product']->name }}
                                        </p>

                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $item['quantity'] }} ×
                                            Rp {{ number_format($item['product']->price, 0, ',', '.') }}
                                        </p>

                                    </div>

                                    <p class="font-bold text-[#8b6b45] whitespace-nowrap">
                                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                    </p>

                                </div>

                            @endforeach

                        </div>


                        {{-- TOTAL --}}
                        <div class="flex items-center justify-between pt-5 mt-5 border-t-2 border-[#e2d5c3]">

                            <span class="text-lg font-bold text-[#29251f]">
                                Total
                            </span>

                            <span class="text-xl font-bold text-[#8b6b45]">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>

                        </div>


                        {{-- BUTTON --}}
                        <button
                            type="submit"
                            class="w-full mt-6 bg-[#29251f] text-white py-3.5 px-5 rounded-xl font-bold hover:bg-[#8b6b45] hover:-translate-y-0.5 hover:shadow-lg transition"
                        >
                            Buat Pesanan
                        </button>


                        <p class="text-xs text-gray-500 text-center mt-4 leading-relaxed">
                            Pastikan data dan alamat pengiriman sudah benar sebelum membuat pesanan.
                        </p>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection