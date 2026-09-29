@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-[#fffaf2] to-[#f7f0e4] py-10 md:py-16">
    <div class="max-w-2xl mx-auto px-5">
        <div class="bg-white rounded-[2rem] border border-[#e2d5c3] shadow-[0_20px_60px_rgba(70,50,30,0.12)] overflow-hidden">
            <div class="bg-gradient-to-br from-[#29251f] to-[#5a4327] text-white text-center px-8 py-9">
                <p class="text-xs uppercase tracking-[0.2em] text-[#f5e7c7]/80 font-bold">Pembayaran QRIS</p>
                <p class="text-4xl font-extrabold mt-3 text-[#f5e7c7]">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                <p class="text-sm text-white/70 mt-3">Pesanan #{{ $order->id }}</p>
            </div>

            <div class="p-6 md:p-8">
                <div class="text-center">
                    <h1 class="text-2xl font-black text-[#29251f]">Scan QRIS untuk membayar</h1>
                    <p class="text-sm text-gray-500 mt-2">Gunakan mobile banking atau e-wallet yang mendukung QRIS.</p>

                    @if($settings?->qris_image)
                        <div class="mt-6 inline-flex p-4 bg-white border-2 border-[#e2d5c3] rounded-3xl shadow-sm">
                            <img
                                src="{{ asset('storage/' . $settings->qris_image) }}"
                                alt="QRIS {{ $settings->business_name ?? 'BengkuluKita' }}"
                                class="w-72 h-72 object-contain rounded-xl"
                            >
                        </div>
                        <p class="font-bold text-[#29251f] mt-4">{{ $settings->business_name ?? 'BengkuluKita' }}</p>
                    @else
                        <div class="mt-6 rounded-2xl bg-amber-50 border border-amber-200 p-5 text-amber-800 text-sm">
                            QRIS toko belum dipasang. Admin perlu mengunggah gambar QRIS melalui menu Pengaturan Admin.
                        </div>
                    @endif
                </div>

                <div class="mt-7 bg-[#fffaf2] border border-[#e2d5c3] rounded-2xl p-5">
                    <p class="font-bold text-[#29251f]">Setelah pembayaran berhasil:</p>
                    <ol class="mt-2 text-sm text-gray-600 space-y-1 list-decimal list-inside">
                        <li>Pastikan nominal yang dibayar sesuai total pesanan.</li>
                        <li>Selesaikan pembayaran melalui aplikasi pilihanmu.</li>
                        <li>Kembali ke halaman ini lalu tekan “Saya Sudah Bayar”.</li>
                        <li>Admin akan memeriksa dan mengubah status pembayaran.</li>
                    </ol>
                </div>

                <form method="POST" action="{{ route('checkout.confirm-payment', $order) }}" class="mt-6">
                    @csrf
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-[#29251f] to-[#5a4327] text-white py-4 rounded-xl font-bold hover:-translate-y-0.5 hover:shadow-xl transition"
                        @disabled(!$settings?->qris_image)>
                        ✓ Saya Sudah Bayar
                    </button>
                </form>

                <a href="{{ route('checkout.success', $order) }}"
                   class="block text-center text-sm text-gray-500 hover:text-[#8b6b45] underline mt-5">
                    Lihat status pesanan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
