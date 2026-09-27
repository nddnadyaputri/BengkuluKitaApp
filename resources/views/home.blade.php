<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $settings->business_name ?? 'BengkuluKita' }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="bg-[#f7f0e4] text-[#29251f] antialiased">


{{-- ========================================================= --}}
{{-- NAVBAR --}}
{{-- ========================================================= --}}

<header class="sticky top-0 z-50 bg-[#fffaf2]/95 backdrop-blur border-b border-[#e2d5c3]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="h-20 flex items-center justify-between">

            {{-- LOGO --}}
            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3 group"
            >

                <div
                    class="w-12 h-12 rounded-xl bg-[#f5e7c7] border border-[#dfcfb8] flex items-center justify-center overflow-hidden shadow-sm group-hover:-translate-y-1 group-hover:shadow-md transition-all duration-200"
                >

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


                <div class="leading-tight">

                    <div class="text-xl font-extrabold tracking-tight">
                        {{ $settings->business_name ?? 'BengkuluKita' }}
                    </div>

                    <div class="text-[10px] uppercase tracking-[0.18em] font-semibold text-[#8b6b45]">
                        Oleh-Oleh Bengkulu
                    </div>

                </div>

            </a>


            {{-- DESKTOP NAVIGATION --}}
            <nav class="hidden md:flex items-center gap-7">

                <a
                    href="#beranda"
                    class="text-sm font-semibold text-[#5e5143] hover:text-[#8b6b45] transition"
                >
                    Beranda
                </a>

                <a
                    href="#produk"
                    class="text-sm font-semibold text-[#5e5143] hover:text-[#8b6b45] transition"
                >
                    Produk
                </a>

                <a
                    href="#faq"
                    class="text-sm font-semibold text-[#5e5143] hover:text-[#8b6b45] transition"
                >
                    FAQ
                </a>

                <a
                    href="#kontak"
                    class="text-sm font-semibold text-[#5e5143] hover:text-[#8b6b45] transition"
                >
                    Kontak
                </a>

                @auth

                    <a
                        href="{{ route('cart.index') }}"
                        class="text-sm font-semibold text-[#5e5143] hover:text-[#8b6b45] transition"
                    >
                        Keranjang
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="text-sm font-semibold text-[#5e5143] hover:text-[#8b6b45] transition"
                    >
                        Login
                    </a>

                @endauth

            </nav>


            {{-- MOBILE --}}
            <div class="flex items-center gap-2 md:hidden">

                @auth

                    <a
                        href="{{ route('cart.index') }}"
                        class="w-10 h-10 rounded-xl bg-[#f5e7c7] flex items-center justify-center"
                    >
                        🛒
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="px-4 py-2 rounded-xl bg-[#29251f] text-white text-sm font-semibold"
                    >
                        Login
                    </a>

                @endauth

            </div>

        </div>

    </div>

</header>



{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}

<section
    id="beranda"
    class="relative min-h-[650px] overflow-hidden"
>

    {{-- BACKGROUND --}}
    <div class="absolute inset-0">

        <img
            src="{{ asset('images/bay-tat.jpg') }}"
            alt="Makanan khas Bengkulu"
            class="w-full h-full object-cover"
        >

        <div class="absolute inset-0 bg-gradient-to-r from-[#211c17]/90 via-[#211c17]/70 to-[#211c17]/30"></div>

    </div>


    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-[650px] flex items-center">

        <div class="max-w-2xl text-white">

            <span
                class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm text-sm font-semibold mb-6"
            >
                Oleh-Oleh Khas Bengkulu
            </span>


            <h1 class="text-5xl md:text-7xl font-black tracking-tight leading-none">

                {{ strtoupper($settings->business_name ?? 'BENGKULUKITA') }}

            </h1>


            <h2 class="mt-5 text-2xl md:text-3xl font-bold">

                Kenali Bengkulu,
                <span class="text-[#f5d99e]">
                    cintai produknya.
                </span>

            </h2>


            <p class="mt-5 text-base md:text-lg text-white/85 leading-relaxed max-w-xl">

                {{ $settings->description ?? 'Temukan berbagai makanan khas, oleh-oleh, kerajinan, minuman, dan camilan khas Bengkulu dalam satu tempat.' }}

            </p>


            <div class="mt-8 flex flex-wrap gap-3">

                <a
                    href="#produk"
                    class="px-6 py-3.5 rounded-xl bg-[#f5e7c7] text-[#29251f] font-bold hover:bg-white hover:-translate-y-1 transition-all shadow-lg"
                >
                    Jelajahi Produk
                </a>


                <a
                    href="#kontak"
                    class="px-6 py-3.5 rounded-xl bg-white/10 border border-white/30 backdrop-blur-sm text-white font-bold hover:bg-white/20 hover:-translate-y-1 transition-all"
                >
                    Hubungi Kami
                </a>

            </div>

        </div>


        {{-- FOTO SAMPING --}}
        <div class="hidden lg:block absolute right-8 bottom-10 w-[330px]">

            <div class="relative">

                <div class="absolute -inset-4 bg-[#f5e7c7]/20 rounded-[2rem] blur-2xl"></div>

                <img
                    src="{{ asset('images/anak-tat.jpg') }}"
                    alt="Anak Tat Bengkulu"
                    class="relative w-full h-[230px] object-cover rounded-[2rem] border-4 border-white/20 shadow-2xl"
                >


                <div class="absolute -bottom-16 -left-20 w-52">

                    <img
                        src="{{ asset('images/lempuk-durian.jpg') }}"
                        alt="Lempuk Durian Bengkulu"
                        class="w-full h-36 object-cover rounded-2xl border-4 border-white/20 shadow-xl"
                    >

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- PRODUK --}}
{{-- ========================================================= --}}

<section
    id="produk"
    class="py-20 bg-[#f7f0e4]"
>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">

            <div>

                <span class="text-sm font-bold uppercase tracking-[0.2em] text-[#8b6b45]">
                    Pilihan Produk
                </span>

                <h2 class="mt-2 text-3xl md:text-4xl font-black">
                    Temukan Oleh-Oleh Bengkulu
                </h2>

                <p class="mt-3 text-[#716354] max-w-xl">
                    Jelajahi berbagai produk khas Bengkulu yang tersedia di BengkuluKita.
                </p>

            </div>


            <a
                href="{{ route('products.index') }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#29251f] text-white font-semibold hover:bg-[#8b6b45] transition"
            >
                Lihat Semua Produk →
            </a>

        </div>


        @if($products->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($products as $product)

                    <a
                        href="{{ route('products.show', $product) }}"
                        class="group bg-white rounded-2xl overflow-hidden border border-[#e2d5c3] shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300"
                    >

                        <div class="h-56 bg-[#f1e5d2] overflow-hidden">

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                >

                            @else

                                <div class="w-full h-full flex items-center justify-center text-[#8b6b45]">
                                    Tidak ada gambar
                                </div>

                            @endif

                        </div>


                        <div class="p-5">

                            <div class="text-xs font-semibold uppercase tracking-wider text-[#8b6b45]">
                                {{ $product->category->name ?? 'Produk Bengkulu' }}
                            </div>

                            <h3 class="mt-2 text-xl font-bold">
                                {{ $product->name }}
                            </h3>

                            <p class="mt-2 text-sm text-[#716354] line-clamp-2">
                                {{ $product->description }}
                            </p>


                            <div class="mt-5 flex items-center justify-between">

                                <span class="text-lg font-black text-[#8b6b45]">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>

                                <span class="text-sm font-bold group-hover:translate-x-1 transition">
                                    Lihat →
                                </span>

                            </div>

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-2xl border border-[#e2d5c3] p-10 text-center">

                <div class="text-4xl mb-3">
                    📦
                </div>

                <h3 class="font-bold text-xl">
                    Produk belum tersedia
                </h3>

                <p class="text-[#716354] mt-2">
                    Produk akan ditampilkan di sini setelah admin menambahkannya.
                </p>

            </div>

        @endif

    </div>

</section>



{{-- ========================================================= --}}
{{-- BANTUAN CEPAT --}}
{{-- ========================================================= --}}

<section class="py-16 bg-[#29251f]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-10 items-center">

            <div class="text-white">

                <span class="text-sm font-bold uppercase tracking-[0.2em] text-[#f5d99e]">
                    Butuh Bantuan?
                </span>

                <h2 class="mt-3 text-3xl md:text-4xl font-black">
                    Ada pertanyaan atau kendala?
                </h2>

                <p class="mt-4 text-white/70 leading-relaxed max-w-xl">

                    Jangan ragu untuk menghubungi admin BengkuluKita.
                    Kami siap membantu menjawab pertanyaan mengenai produk,
                    pesanan, pembayaran, pengiriman, maupun kendala lainnya.

                </p>


                <div class="mt-7 flex flex-wrap gap-3">

                    @if($settings->whatsapp)

                        @php
                            $waNumber = preg_replace('/[^0-9]/', '', $settings->whatsapp);
                        @endphp

                        <a
                            href="https://wa.me/{{ $waNumber }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="px-5 py-3 rounded-xl bg-[#f5e7c7] text-[#29251f] font-bold hover:bg-white hover:-translate-y-1 transition"
                        >
                            💬 Chat Admin
                        </a>

                    @endif


                    @if($settings->email)

                        <a
                            href="mailto:{{ $settings->email }}"
                            class="px-5 py-3 rounded-xl bg-white/10 border border-white/20 text-white font-bold hover:bg-white/20 transition"
                        >
                            ✉ Email
                        </a>

                    @endif

                </div>

            </div>


            <div class="grid sm:grid-cols-2 gap-4">

                {{-- WHATSAPP --}}
                @if($settings->whatsapp)

                    <div class="bg-white/10 border border-white/10 rounded-2xl p-5">

                        <div class="text-2xl">
                            💬
                        </div>

                        <p class="mt-3 text-sm text-white/60">
                            WhatsApp
                        </p>

                        <p class="mt-1 text-white font-semibold">
                            {{ $settings->whatsapp }}
                        </p>

                    </div>

                @endif


                {{-- PHONE --}}
                @if($settings->phone)

                    <div class="bg-white/10 border border-white/10 rounded-2xl p-5">

                        <div class="text-2xl">
                            📞
                        </div>

                        <p class="mt-3 text-sm text-white/60">
                            Telepon
                        </p>

                        <p class="mt-1 text-white font-semibold">
                            {{ $settings->phone }}
                        </p>

                    </div>

                @endif


                {{-- EMAIL --}}
                @if($settings->email)

                    <div class="bg-white/10 border border-white/10 rounded-2xl p-5">

                        <div class="text-2xl">
                            ✉️
                        </div>

                        <p class="mt-3 text-sm text-white/60">
                            Email
                        </p>

                        <p class="mt-1 text-white font-semibold break-all">
                            {{ $settings->email }}
                        </p>

                    </div>

                @endif


                {{-- JAM --}}
                @if($settings->opening_hours)

                    <div class="bg-white/10 border border-white/10 rounded-2xl p-5">

                        <div class="text-2xl">
                            🕐
                        </div>

                        <p class="mt-3 text-sm text-white/60">
                            Jam Operasional
                        </p>

                        <p class="mt-1 text-white font-semibold">
                            {{ $settings->opening_hours }}
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- FAQ --}}
{{-- ========================================================= --}}

<section
    id="faq"
    class="py-20 bg-[#fffaf2]"
>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">

            <span class="text-sm font-bold uppercase tracking-[0.2em] text-[#8b6b45]">
                FAQ
            </span>

            <h2 class="mt-2 text-3xl md:text-4xl font-black">
                Pertanyaan yang Sering Ditanyakan
            </h2>

            <p class="mt-3 text-[#716354]">
                Temukan jawaban untuk beberapa pertanyaan umum mengenai BengkuluKita.
            </p>

        </div>


        <div class="space-y-4">

            @foreach($faqs as $faq)

                <details
                    class="group bg-white border border-[#e2d5c3] rounded-2xl overflow-hidden shadow-sm"
                >

                    <summary
                        class="flex items-center justify-between gap-5 px-6 py-5 cursor-pointer list-none font-bold text-[#29251f]"
                    >

                        <span>
                            {{ $faq['question'] }}
                        </span>

                        <span
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-[#f5e7c7] flex items-center justify-center text-[#8b6b45] group-open:rotate-45 transition"
                        >
                            +
                        </span>

                    </summary>


                    <div class="px-6 pb-6 text-[#716354] leading-relaxed">

                        {{ $faq['answer'] }}

                    </div>

                </details>

            @endforeach

        </div>


        {{-- CTA --}}
        <div class="mt-10 text-center">

            <p class="text-[#716354]">
                Belum menemukan jawaban yang kamu cari?
            </p>


            @if($settings->whatsapp)

                @php
                    $faqWaNumber = preg_replace('/[^0-9]/', '', $settings->whatsapp);
                @endphp

                <a
                    href="https://wa.me/{{ $faqWaNumber }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex mt-4 px-6 py-3 rounded-xl bg-[#29251f] text-white font-bold hover:bg-[#8b6b45] transition"
                >
                    💬 Tanya Admin Langsung
                </a>

            @endif

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- KONTAK --}}
{{-- ========================================================= --}}

<section
    id="kontak"
    class="py-20 bg-[#f7f0e4]"
>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-12">

            {{-- INFO --}}
            <div>

                <span class="text-sm font-bold uppercase tracking-[0.2em] text-[#8b6b45]">
                    Kontak
                </span>

                <h2 class="mt-2 text-3xl md:text-4xl font-black">
                    Hubungi {{ $settings->business_name ?? 'BengkuluKita' }}
                </h2>

                <p class="mt-4 text-[#716354] leading-relaxed max-w-xl">

                    Jika kamu memiliki pertanyaan mengenai produk,
                    pesanan, pembayaran, pengiriman, atau ingin menyampaikan
                    keluhan, silakan hubungi kami melalui salah satu kontak berikut.

                </p>


                <div class="mt-8 space-y-4">

                    @if($settings->phone)

                        <a
                            href="tel:{{ $settings->phone }}"
                            class="flex items-center gap-4 bg-white border border-[#e2d5c3] rounded-2xl p-5 hover:-translate-y-1 hover:shadow-md transition"
                        >

                            <div class="w-12 h-12 rounded-xl bg-[#f5e7c7] flex items-center justify-center text-xl">
                                📞
                            </div>

                            <div>

                                <p class="text-sm text-[#8b6b45]">
                                    Nomor Telepon
                                </p>

                                <p class="font-bold">
                                    {{ $settings->phone }}
                                </p>

                            </div>

                        </a>

                    @endif


                    @if($settings->email)

                        <a
                            href="mailto:{{ $settings->email }}"
                            class="flex items-center gap-4 bg-white border border-[#e2d5c3] rounded-2xl p-5 hover:-translate-y-1 hover:shadow-md transition"
                        >

                            <div class="w-12 h-12 rounded-xl bg-[#f5e7c7] flex items-center justify-center text-xl">
                                ✉️
                            </div>

                            <div>

                                <p class="text-sm text-[#8b6b45]">
                                    Email
                                </p>

                                <p class="font-bold break-all">
                                    {{ $settings->email }}
                                </p>

                            </div>

                        </a>

                    @endif


                    @if($settings->address)

                        <div class="flex items-center gap-4 bg-white border border-[#e2d5c3] rounded-2xl p-5">

                            <div class="w-12 h-12 rounded-xl bg-[#f5e7c7] flex items-center justify-center text-xl">
                                📍
                            </div>

                            <div>

                                <p class="text-sm text-[#8b6b45]">
                                    Alamat
                                </p>

                                <p class="font-bold">
                                    {{ $settings->address }}
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- SOCIAL MEDIA --}}
            <div>

                <div class="bg-[#29251f] rounded-[2rem] p-7 md:p-9 text-white">

                    <h3 class="text-2xl font-black">
                        Temukan Kami di Media Sosial
                    </h3>

                    <p class="mt-3 text-white/65 leading-relaxed">
                        Ikuti media sosial BengkuluKita untuk mendapatkan informasi
                        produk, kabar terbaru, dan informasi lainnya.
                    </p>


                    <div class="mt-7 space-y-3">

                        @if($settings->instagram)

                            <a
                                href="{{ str_starts_with($settings->instagram, 'http') ? $settings->instagram : 'https://instagram.com/' . ltrim($settings->instagram, '@') }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center justify-between p-4 rounded-xl bg-white/10 hover:bg-white/15 transition"
                            >

                                <span class="flex items-center gap-3">
                                    <span class="text-xl">📸</span>
                                    <span class="font-semibold">Instagram</span>
                                </span>

                                <span>→</span>

                            </a>

                        @endif


                        @if($settings->facebook)

                            <a
                                href="{{ str_starts_with($settings->facebook, 'http') ? $settings->facebook : 'https://facebook.com/' . ltrim($settings->facebook, '@') }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center justify-between p-4 rounded-xl bg-white/10 hover:bg-white/15 transition"
                            >

                                <span class="flex items-center gap-3">
                                    <span class="text-xl">f</span>
                                    <span class="font-semibold">Facebook</span>
                                </span>

                                <span>→</span>

                            </a>

                        @endif


                        @if($settings->tiktok)

                            <a
                                href="{{ str_starts_with($settings->tiktok, 'http') ? $settings->tiktok : 'https://tiktok.com/@' . ltrim($settings->tiktok, '@') }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center justify-between p-4 rounded-xl bg-white/10 hover:bg-white/15 transition"
                            >

                                <span class="flex items-center gap-3">
                                    <span class="text-xl">♪</span>
                                    <span class="font-semibold">TikTok</span>
                                </span>

                                <span>→</span>

                            </a>

                        @endif


                        @if($settings->whatsapp)

                            @php
                                $contactWaNumber = preg_replace('/[^0-9]/', '', $settings->whatsapp);
                            @endphp

                            <a
                                href="https://wa.me/{{ $contactWaNumber }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center justify-between p-4 rounded-xl bg-[#f5e7c7] text-[#29251f] hover:bg-white transition"
                            >

                                <span class="flex items-center gap-3">
                                    <span class="text-xl">💬</span>
                                    <span class="font-bold">WhatsApp Admin</span>
                                </span>

                                <span>→</span>

                            </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer class="relative overflow-hidden bg-[#29251f] text-white">

    {{-- TUGU BACKGROUND --}}
    <div class="absolute inset-0">

        <img
            src="{{ asset('images/tugu-thomas-parr.png') }}"
            alt=""
            class="w-full h-full object-cover opacity-20"
        >

        <div class="absolute inset-0 bg-[#29251f]/85"></div>

    </div>


    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

        <div class="grid md:grid-cols-3 gap-10">

            {{-- BRAND --}}
            <div>

                <div class="flex items-center gap-3">

                    <div class="w-14 h-14 rounded-2xl bg-[#f5e7c7] flex items-center justify-center overflow-hidden">

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


                    <div>

                        <h3 class="text-xl font-black">
                            {{ $settings->business_name ?? 'BengkuluKita' }}
                        </h3>

                        <p class="text-sm text-[#d8c3a5]">
                            {{ $settings->footer_text ?? 'Pusatnya Oleh-Oleh Bengkulu.' }}
                        </p>

                    </div>

                </div>


                <p class="mt-5 text-sm text-white/60 leading-relaxed max-w-sm">

                    {{ $settings->description ?? 'Temukan berbagai produk khas Bengkulu dalam satu tempat.' }}

                </p>

            </div>


            {{-- KONTAK --}}
            <div>

                <h4 class="font-bold text-lg">
                    Kontak
                </h4>

                <div class="mt-4 space-y-3 text-sm text-white/65">

                    @if($settings->phone)
                        <p>📞 {{ $settings->phone }}</p>
                    @endif

                    @if($settings->email)
                        <p>✉️ {{ $settings->email }}</p>
                    @endif

                    @if($settings->address)
                        <p>📍 {{ $settings->address }}</p>
                    @endif

                </div>

            </div>


            {{-- SOSMED --}}
            <div>

                <h4 class="font-bold text-lg">
                    Media Sosial
                </h4>

                <div class="mt-4 space-y-3 text-sm">

                    @if($settings->instagram)

                        <a
                            href="{{ str_starts_with($settings->instagram, 'http') ? $settings->instagram : 'https://instagram.com/' . ltrim($settings->instagram, '@') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="block text-white/65 hover:text-white transition"
                        >
                            Instagram
                        </a>

                    @endif


                    @if($settings->facebook)

                        <a
                            href="{{ str_starts_with($settings->facebook, 'http') ? $settings->facebook : 'https://facebook.com/' . ltrim($settings->facebook, '@') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="block text-white/65 hover:text-white transition"
                        >
                            Facebook
                        </a>

                    @endif


                    @if($settings->tiktok)

                        <a
                            href="{{ str_starts_with($settings->tiktok, 'http') ? $settings->tiktok : 'https://tiktok.com/@' . ltrim($settings->tiktok, '@') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="block text-white/65 hover:text-white transition"
                        >
                            TikTok
                        </a>

                    @endif

                </div>

            </div>

        </div>


        <div class="mt-10 pt-6 border-t border-white/10 flex flex-col md:flex-row justify-between gap-3 text-sm text-white/50">

            <p>
                © {{ date('Y') }} {{ $settings->business_name ?? 'BengkuluKita' }}
            </p>

            <p>
                Pusatnya Oleh-Oleh Bengkulu
            </p>

        </div>

    </div>

</footer>



{{-- ========================================================= --}}
{{-- FLOATING WHATSAPP --}}
{{-- ========================================================= --}}

@if($settings->whatsapp)

    @php
        $floatingWaNumber = preg_replace('/[^0-9]/', '', $settings->whatsapp);
    @endphp

    <a
        href="https://wa.me/{{ $floatingWaNumber }}"
        target="_blank"
        rel="noopener noreferrer"
        class="fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full bg-[#29251f] text-white flex items-center justify-center shadow-2xl border-2 border-[#f5e7c7] hover:scale-110 hover:bg-[#8b6b45] transition-all duration-300"
        title="Hubungi Admin"
    >

        <span class="text-2xl">
            💬
        </span>

    </a>

@endif


</body>

</html>