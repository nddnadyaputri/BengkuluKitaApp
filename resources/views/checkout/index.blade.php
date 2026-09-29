@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-b from-[#fffaf2] to-[#f7f0e4] py-10">
<div class="max-w-6xl mx-auto px-5 sm:px-6">

    {{-- Langkah --}}
    <div class="flex items-center justify-center gap-2 sm:gap-4 text-xs sm:text-sm font-semibold mb-10">
        <span class="flex items-center gap-2 text-[#8b6b45]"><span class="w-7 h-7 rounded-full bg-[#8b6b45] text-white flex items-center justify-center">✓</span>Keranjang</span>
        <span class="w-8 sm:w-16 h-0.5 bg-[#8b6b45]"></span>
        <span class="flex items-center gap-2 text-[#29251f]"><span class="w-7 h-7 rounded-full bg-[#29251f] text-white flex items-center justify-center">2</span>Checkout</span>
        <span class="w-8 sm:w-16 h-0.5 bg-[#d8cbbb]"></span>
        <span class="flex items-center gap-2 text-gray-400"><span class="w-7 h-7 rounded-full bg-[#e8dccb] text-gray-500 flex items-center justify-center">3</span>Bayar</span>
    </div>

    <div class="mb-8">
        <a href="{{ route('cart.index') }}" class="text-[#8b6b45] font-semibold hover:text-[#29251f] transition">← Kembali ke Keranjang</a>
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#29251f] mt-4">Checkout</h1>
        <p class="text-gray-600 mt-2">Tinggal satu langkah lagi untuk membawa pulang produk khas Bengkulu.</p>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-5">
            <p class="font-bold mb-2">Ada data yang perlu diperbaiki:</p>
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-5">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-6">

                {{-- Data pelanggan --}}
                <div class="bg-white rounded-3xl shadow-[0_10px_35px_rgba(70,50,30,0.06)] border border-[#e2d5c3] p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-9 h-9 rounded-xl bg-[#f5e7c7] text-[#8b6b45] flex items-center justify-center font-extrabold">1</span>
                        <h2 class="text-xl font-bold text-[#29251f]">Data Pengiriman</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label for="customer_name" class="block text-sm font-semibold text-[#29251f] mb-2">Nama Lengkap</label>
                            <input type="text" id="customer_name" name="customer_name" required maxlength="255"
                                value="{{ old('customer_name', auth()->user()->name ?? '') }}" placeholder="Nama penerima"
                                class="w-full rounded-xl border-[#d8cbbb] bg-[#fffdf9] focus:border-[#8b6b45] focus:ring-[#8b6b45]">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-[#29251f] mb-2">Nomor WhatsApp</label>
                            <input type="text" id="phone" name="phone" required maxlength="30" value="{{ old('phone') }}"
                                placeholder="081234567890"
                                class="w-full rounded-xl border-[#d8cbbb] bg-[#fffdf9] focus:border-[#8b6b45] focus:ring-[#8b6b45]">
                        </div>
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-semibold text-[#29251f] mb-2">Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="4" required maxlength="1000"
                            placeholder="Jalan, nomor rumah, kelurahan, kecamatan, kota, kode pos"
                            class="w-full rounded-xl border-[#d8cbbb] bg-[#fffdf9] focus:border-[#8b6b45] focus:ring-[#8b6b45]">{{ old('address') }}</textarea>
                    </div>
                </div>

                {{-- Metode pembayaran --}}
                <div class="bg-white rounded-3xl shadow-[0_10px_35px_rgba(70,50,30,0.06)] border border-[#e2d5c3] p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-9 h-9 rounded-xl bg-[#f5e7c7] text-[#8b6b45] flex items-center justify-center font-extrabold">2</span>
                        <h2 class="text-xl font-bold text-[#29251f]">Metode Pembayaran</h2>
                    </div>

                    <div class="space-y-4">

                        {{-- QRIS (satu-satunya metode pembayaran) --}}
                        <input type="hidden" name="payment_method" value="QRIS">
                        <div class="rounded-2xl border-2 border-[#8b6b45] bg-[#fffaf0] shadow-md p-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-extrabold text-[#29251f]">QRIS</p>
                                    <p class="text-sm text-gray-500 mt-1">Scan kode QR menggunakan aplikasi e-wallet atau mobile banking favoritmu. Status pesanan otomatis terkonfirmasi.</p>
                                </div>
                                <svg class="w-7 h-7 text-[#8b6b45] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><path d="M14 14h3v3h-3zM20 14v1M14 20h1M18 18h3v3h-3z"/></svg>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Ringkasan --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-[0_10px_35px_rgba(70,50,30,0.08)] border border-[#e2d5c3] p-6 lg:sticky lg:top-6">
                    <h2 class="text-xl font-bold text-[#29251f] mb-5">Ringkasan Pesanan</h2>

                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex gap-3 pb-4 border-b border-[#eee4d7]">
                                @if($item['product']->image ?? false)
                                    <img src="{{ asset('storage/' . $item['product']->image) }}" alt="" class="w-14 h-14 rounded-xl object-cover bg-[#f5eee4]">
                                @endif
                                <div class="min-w-0 flex-1">
                                    <p class="font-semibold text-[#29251f] leading-snug">{{ $item['product']->name }}</p>
                                    <p class="text-sm text-gray-500 mt-1">{{ $item['quantity'] }} × Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-bold text-[#8b6b45] whitespace-nowrap text-sm">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-between pt-5 mt-1">
                        <span class="text-lg font-bold text-[#29251f]">Total</span>
                        <span class="text-2xl font-extrabold text-[#8b6b45]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit"
                        class="w-full mt-6 bg-gradient-to-r from-[#29251f] to-[#5a4327] text-white py-4 rounded-xl font-bold hover:-translate-y-0.5 hover:shadow-xl transition">
                        Lanjutkan Pembayaran
                    </button>

                    <div class="flex items-center justify-center gap-2 text-xs text-gray-500 mt-4">
                        <svg class="w-4 h-4 text-[#6f8f5f]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/><path d="m9 12 2 2 4-4"/></svg>
                        Pembayaran dilakukan dengan scan QRIS toko. Setelah membayar, tekan tombol konfirmasi.
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

@endsection
