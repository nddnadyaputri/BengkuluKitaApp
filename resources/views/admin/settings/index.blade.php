@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#f7f0e4]">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="hidden lg:flex w-72 bg-[#29251f] text-white flex-col">

            {{-- LOGO --}}
            <div class="p-6 border-b border-white/10">

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-xl bg-[#f5e7c7] flex items-center justify-center overflow-hidden">

                        @if($settings->logo)
                            <img
                                src="{{ asset('storage/' . $settings->logo) }}"
                                alt="{{ $settings->business_name }}"
                                class="w-9 h-9 object-contain"
                            >
                        @else
                            <img
                                src="{{ asset('images/logo-kue.png') }}"
                                alt="Logo BengkuluKita"
                                class="w-9 h-9 object-contain"
                            >
                        @endif

                    </div>

                    <div>

                        <div class="font-extrabold text-lg">
                            {{ $settings->business_name }}
                        </div>

                        <div class="text-xs text-[#d8c3a5]">
                            Admin Panel
                        </div>

                    </div>

                </a>

            </div>


            {{-- MENU --}}
            <nav class="flex-1 p-4 space-y-2">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#eee5d8] hover:bg-white/10 transition"
                >
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>


                <a
                    href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#eee5d8] hover:bg-white/10 transition"
                >
                    <span>📦</span>
                    <span>Produk</span>
                </a>


                <a
                    href="{{ route('admin.orders.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#eee5d8] hover:bg-white/10 transition"
                >
                    <span>🛒</span>
                    <span>Pesanan</span>
                </a>


                <a
                    href="{{ route('admin.settings.edit') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#8b6b45] text-white"
                >
                    <span>⚙️</span>
                    <span class="font-semibold">Pengaturan</span>
                </a>


                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#eee5d8] hover:bg-white/10 transition"
                >
                    <span>🌐</span>
                    <span>Lihat Website</span>
                </a>

            </nav>


            {{-- USER ADMIN --}}
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

            {{-- TOPBAR --}}
            <header class="bg-[#fffaf2] border-b border-[#e2d5c3]">

                <div class="px-6 lg:px-10 py-5">

                    <p class="text-sm text-[#8b6b45]">
                        Admin Panel
                    </p>

                    <h1 class="text-2xl font-extrabold text-[#29251f]">
                        Pengaturan Website
                    </h1>

                </div>

            </header>


            {{-- CONTENT --}}
            <div class="p-6 lg:p-10">

                @if(session('success'))

                    <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-green-700">

                        <div class="flex items-center gap-3">

                            <span class="text-xl">✓</span>

                            <span class="font-medium">
                                {{ session('success') }}
                            </span>

                        </div>

                    </div>

                @endif


                @if($errors->any())

                    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-5 py-4 text-red-700">

                        <p class="font-bold mb-2">
                            Terdapat kesalahan:
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


                <form
                    action="{{ route('admin.settings.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6"
                >

                    @csrf
                    @method('PUT')


                    {{-- IDENTITAS --}}
                    <section class="bg-white rounded-2xl border border-[#e2d5c3] shadow-sm overflow-hidden">

                        <div class="px-6 py-5 border-b border-[#eee5d8]">

                            <h2 class="text-lg font-bold text-[#29251f]">
                                Identitas Website
                            </h2>

                            <p class="text-sm text-[#8b6b45] mt-1">
                                Informasi utama yang ditampilkan pada website.
                            </p>

                        </div>


                        <div class="p-6 space-y-6">

                            {{-- NAMA --}}
                            <div>

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    Nama Website / Usaha
                                </label>

                                <input
                                    type="text"
                                    name="business_name"
                                    value="{{ old('business_name', $settings->business_name) }}"
                                    placeholder="Contoh: BengkuluKita"
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                    required
                                >

                            </div>


                            {{-- DESKRIPSI --}}
                            <div>

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    Deskripsi Usaha
                                </label>

                                <textarea
                                    name="description"
                                    rows="4"
                                    placeholder="Deskripsi singkat mengenai BengkuluKita..."
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                >{{ old('description', $settings->description) }}</textarea>

                            </div>


                            {{-- FOOTER --}}
                            <div>

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    Teks Footer
                                </label>

                                <input
                                    type="text"
                                    name="footer_text"
                                    value="{{ old('footer_text', $settings->footer_text) }}"
                                    placeholder="Contoh: Pusatnya Oleh-Oleh Bengkulu."
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                >

                            </div>

                        </div>

                    </section>


                    {{-- KONTAK --}}
                    <section class="bg-white rounded-2xl border border-[#e2d5c3] shadow-sm overflow-hidden">

                        <div class="px-6 py-5 border-b border-[#eee5d8]">

                            <h2 class="text-lg font-bold text-[#29251f]">
                                Kontak & Informasi
                            </h2>

                            <p class="text-sm text-[#8b6b45] mt-1">
                                Informasi yang dapat digunakan pelanggan untuk menghubungi usaha.
                            </p>

                        </div>


                        <div class="p-6 grid md:grid-cols-2 gap-6">

                            {{-- PHONE --}}
                            <div>

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    Nomor Telepon
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone', $settings->phone) }}"
                                    placeholder="08xxxxxxxxxx"
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                >

                            </div>


                            {{-- WHATSAPP --}}
                            <div>

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    Nomor WhatsApp
                                </label>

                                <input
                                    type="text"
                                    name="whatsapp"
                                    value="{{ old('whatsapp', $settings->whatsapp) }}"
                                    placeholder="628xxxxxxxxxx"
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                >

                                <p class="text-xs text-[#8b6b45] mt-2">
                                    Gunakan format 628xxxx tanpa tanda + atau spasi.
                                </p>

                            </div>


                            {{-- EMAIL --}}
                            <div>

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $settings->email) }}"
                                    placeholder="email@contoh.com"
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                >

                            </div>


                            {{-- ADDRESS --}}
                            <div>

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    Alamat
                                </label>

                                <textarea
                                    name="address"
                                    rows="3"
                                    placeholder="Alamat usaha..."
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                >{{ old('address', $settings->address) }}</textarea>

                            </div>


                            {{-- OPENING --}}
                            <div class="md:col-span-2">

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    Jam Operasional
                                </label>

                                <input
                                    type="text"
                                    name="opening_hours"
                                    value="{{ old('opening_hours', $settings->opening_hours) }}"
                                    placeholder="Contoh: Senin - Sabtu, 08.00 - 21.00 WIB"
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                >

                            </div>

                        </div>

                    </section>


                    {{-- SOSIAL MEDIA --}}
                    <section class="bg-white rounded-2xl border border-[#e2d5c3] shadow-sm overflow-hidden">

                        <div class="px-6 py-5 border-b border-[#eee5d8]">

                            <h2 class="text-lg font-bold text-[#29251f]">
                                Media Sosial
                            </h2>

                            <p class="text-sm text-[#8b6b45] mt-1">
                                Masukkan username atau link akun media sosial usaha.
                            </p>

                        </div>


                        <div class="p-6 grid md:grid-cols-2 gap-6">

                            {{-- INSTAGRAM --}}
                            <div>

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    Instagram
                                </label>

                                <input
                                    type="text"
                                    name="instagram"
                                    value="{{ old('instagram', $settings->instagram) }}"
                                    placeholder="@bengkulukita"
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                >

                            </div>


                            {{-- FACEBOOK --}}
                            <div>

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    Facebook
                                </label>

                                <input
                                    type="text"
                                    name="facebook"
                                    value="{{ old('facebook', $settings->facebook) }}"
                                    placeholder="BengkuluKita"
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                >

                            </div>


                            {{-- TIKTOK --}}
                            <div>

                                <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                    TikTok
                                </label>

                                <input
                                    type="text"
                                    name="tiktok"
                                    value="{{ old('tiktok', $settings->tiktok) }}"
                                    placeholder="@bengkulukita"
                                    class="w-full rounded-xl border-[#dfcfb8] bg-[#fffaf2] focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                                >

                            </div>

                        </div>

                    </section>


                    {{-- LOGO --}}
                    <section class="bg-white rounded-2xl border border-[#e2d5c3] shadow-sm overflow-hidden">

                        <div class="px-6 py-5 border-b border-[#eee5d8]">

                            <h2 class="text-lg font-bold text-[#29251f]">
                                Logo Website
                            </h2>

                            <p class="text-sm text-[#8b6b45] mt-1">
                                Logo yang digunakan pada website dan panel admin.
                            </p>

                        </div>


                        <div class="p-6">

                            <div class="flex flex-col md:flex-row md:items-center gap-6">

                                {{-- CURRENT LOGO --}}
                                <div class="w-32 h-32 rounded-2xl bg-[#f5e7c7] border border-[#dfcfb8] flex items-center justify-center overflow-hidden">

                                    @if($settings->logo)

                                        <img
                                            src="{{ asset('storage/' . $settings->logo) }}"
                                            alt="{{ $settings->business_name }}"
                                            class="w-[78%] h-[78%] object-contain"
                                        >

                                    @else

                                        <img
                                            src="{{ asset('images/logo-kue.png') }}"
                                            alt="Logo BengkuluKita"
                                            class="w-[78%] h-[78%] object-contain"
                                        >

                                    @endif

                                </div>


                                                <div class="bg-[#fffaf2] border border-[#e2d5c3] rounded-2xl p-5">
                    <h3 class="font-bold text-[#29251f]">QRIS Pembayaran</h3>
                    <p class="text-sm text-[#8b6b45] mt-1">Upload gambar QRIS toko. Gambar ini akan muncul otomatis saat pembeli checkout.</p>

                    @if($settings->qris_image)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $settings->qris_image) }}" alt="QRIS" class="w-56 h-56 object-contain rounded-xl border border-[#e2d5c3] bg-white p-2">
                        </div>
                    @endif

                    <input type="file" name="qris_image" accept=".jpg,.jpeg,.png,.webp"
                           class="mt-4 block w-full rounded-xl border border-[#d8cbbb] bg-white px-4 py-3 text-sm">
                    @error('qris_image') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                </div>

<div class="flex-1">

                                    <label class="block text-sm font-semibold text-[#29251f] mb-2">
                                        Ganti Logo
                                    </label>

                                    <input
                                        type="file"
                                        name="logo"
                                        accept=".jpg,.jpeg,.png,.webp"
                                        class="block w-full text-sm text-[#8b6b45] file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-[#29251f] file:text-white hover:file:bg-[#8b6b45] file:cursor-pointer"
                                    >

                                    <p class="text-xs text-[#8b6b45] mt-2">
                                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- BUTTON --}}
                    <div class="flex flex-col sm:flex-row justify-end gap-3">

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="px-6 py-3 rounded-xl border border-[#dfcfb8] bg-white text-[#29251f] font-semibold text-center hover:bg-[#fffaf2] transition"
                        >
                            Batal
                        </a>


                        <button
                            type="submit"
                            class="px-7 py-3 rounded-xl bg-[#29251f] text-white font-semibold hover:bg-[#8b6b45] transition shadow-sm"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </main>

    </div>

</div>

@endsection