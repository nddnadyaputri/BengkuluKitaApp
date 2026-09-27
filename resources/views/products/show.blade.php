<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }} - BengkuluKita</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7f0e4] text-[#29251f]">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 bg-[#fffaf2]/95 backdrop-blur
                border-b border-[#e2d5c3]">

        <div class="max-w-7xl mx-auto px-5 sm:px-6 py-4">

            <div class="flex items-center justify-between">

                {{-- LOGO --}}
                <a href="{{ route('home') }}"
                   class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-2xl
                                bg-[#29251f] text-[#f7f0e4]
                                flex items-center justify-center
                                font-black text-lg shadow-md">
                        BK
                    </div>

                    <div>
                        <h1 class="font-black text-lg leading-none">
                            BengkuluKita
                        </h1>

                        <p class="text-xs text-[#8b6b45] mt-1">
                            Pusatnya Oleh-Oleh Bengkulu
                        </p>
                    </div>

                </a>


                {{-- MENU --}}
                <div class="hidden md:flex items-center gap-7 text-sm font-semibold">

                    <a href="{{ route('home') }}"
                       class="hover:text-[#8b6b45] transition">
                        Beranda
                    </a>

                    <a href="{{ route('products.index') }}"
                       class="text-[#8b6b45]">
                        Produk
                    </a>


                    @auth

                        <a href="{{ route('cart.index') }}"
                           class="hover:text-[#8b6b45] transition">
                            Keranjang
                        </a>

                        @if(auth()->user()->role === 'admin')

                            <a href="{{ route('admin.dashboard') }}"
                               class="bg-[#29251f] text-white
                                      px-4 py-2 rounded-xl
                                      hover:-translate-y-0.5
                                      hover:shadow-lg transition">
                                Dashboard Admin
                            </a>

                        @else

                            <span class="text-[#8b6b45]">
                                Halo, {{ auth()->user()->name }}
                            </span>

                        @endif

                    @else

                        <a href="{{ route('login') }}"
                           class="hover:text-[#8b6b45] transition">
                            Keranjang
                        </a>

                        <a href="{{ route('login') }}"
                           class="hover:text-[#8b6b45] transition">
                            Masuk
                        </a>

                        <a href="{{ route('register') }}"
                           class="bg-[#29251f] text-white
                                  px-4 py-2 rounded-xl
                                  hover:-translate-y-0.5
                                  hover:shadow-lg transition">
                            Daftar
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>


    {{-- DETAIL PRODUK --}}
    <main class="max-w-7xl mx-auto px-5 sm:px-6 py-10">

        {{-- BREADCRUMB / KEMBALI --}}
        <div class="mb-8">

            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2
                      text-sm font-bold
                      text-[#8b6b45]
                      hover:text-[#29251f]
                      transition">

                <span class="text-lg">←</span>

                Kembali ke Produk

            </a>

        </div>


        {{-- CARD DETAIL --}}
        <div class="bg-white rounded-[2rem]
                    border border-[#eadfce]
                    shadow-sm
                    overflow-hidden">

            <div class="grid grid-cols-1 lg:grid-cols-2">


                {{-- GAMBAR --}}
                <div class="bg-[#eee4d5]
                            min-h-[380px]
                            lg:min-h-[600px]
                            relative
                            flex items-center justify-center
                            overflow-hidden">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full
                                   min-h-[380px]
                                   lg:min-h-[600px]
                                   object-cover
                                   hover:scale-105
                                   transition duration-700"
                        >

                    @else

                        <div class="text-center text-[#a18f79]">

                            <div class="text-8xl mb-4">
                                🍽️
                            </div>

                            <p class="font-semibold">
                                Belum ada gambar produk
                            </p>

                        </div>

                    @endif


                    {{-- KATEGORI --}}
                    @if($product->category)

                        <div class="absolute top-6 left-6">

                            <span class="inline-block
                                         bg-[#fffaf2]/95
                                         text-[#8b6b45]
                                         px-4 py-2
                                         rounded-full
                                         text-sm
                                         font-bold
                                         shadow-lg">

                                {{ $product->category->name }}

                            </span>

                        </div>

                    @endif

                </div>


                {{-- INFORMASI PRODUK --}}
                <div class="p-7 sm:p-10 lg:p-12
                            flex flex-col justify-center">


                    {{-- LABEL --}}
                    <span class="inline-block w-fit
                                 bg-[#e7dccb]
                                 text-[#8b6b45]
                                 px-4 py-2
                                 rounded-full
                                 text-xs
                                 font-black
                                 uppercase
                                 tracking-wide">

                        Produk Bengkulu

                    </span>


                    {{-- NAMA --}}
                    <h1 class="text-4xl sm:text-5xl
                               font-black
                               leading-tight
                               mt-5">

                        {{ $product->name }}

                    </h1>


                    {{-- HARGA --}}
                    <div class="mt-7">

                        <p class="text-sm
                                  text-[#91877b]
                                  font-semibold">

                            Harga Produk

                        </p>

                        <p class="text-3xl sm:text-4xl
                                  font-black
                                  text-[#8b6b45]
                                  mt-1">

                            Rp {{ number_format($product->price, 0, ',', '.') }}

                        </p>

                    </div>


                    {{-- STOK --}}
                    <div class="mt-6">

                        @if($product->stock > 0)

                            <div class="inline-flex items-center gap-2
                                        bg-[#e7ead7]
                                        text-[#626744]
                                        px-4 py-2
                                        rounded-full
                                        text-sm
                                        font-bold">

                                <span class="w-2 h-2
                                             rounded-full
                                             bg-[#626744]">
                                </span>

                                Stok tersedia: {{ $product->stock }}

                            </div>

                        @else

                            <div class="inline-flex items-center gap-2
                                        bg-red-100
                                        text-red-600
                                        px-4 py-2
                                        rounded-full
                                        text-sm
                                        font-bold">

                                <span class="w-2 h-2
                                             rounded-full
                                             bg-red-500">
                                </span>

                                Stok sedang habis

                            </div>

                        @endif

                    </div>


                    {{-- DESKRIPSI --}}
                    <div class="mt-8 pt-7
                                border-t border-[#eadfce]">

                        <h2 class="text-lg font-black mb-3">
                            Tentang Produk
                        </h2>

                        <p class="text-[#6f665c]
                                  leading-7">

                            {{ $product->description ?: 'Produk khas Bengkulu pilihan yang cocok untuk dinikmati sendiri maupun dijadikan oleh-oleh.' }}

                        </p>

                    </div>


                    {{-- TOMBOL BELI --}}
                    <div class="mt-8">


                        {{-- USER SUDAH LOGIN --}}
                        @auth

                            @if($product->stock > 0)

                                <form
                                    method="POST"
                                    action="{{ route('cart.add', $product) }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="w-full
                                               bg-[#29251f]
                                               text-white
                                               py-4
                                               px-6
                                               rounded-2xl
                                               font-black
                                               text-base
                                               hover:bg-[#8b6b45]
                                               hover:-translate-y-1
                                               hover:shadow-xl
                                               transition
                                               duration-300"
                                    >

                                        🛒 Tambah ke Keranjang

                                    </button>

                                </form>


                                <p class="text-center
                                          text-xs
                                          text-[#91877b]
                                          mt-3">

                                    Produk akan ditambahkan ke keranjang kamu.

                                </p>

                            @else

                                <button
                                    disabled
                                    class="w-full
                                           bg-gray-200
                                           text-gray-400
                                           py-4
                                           px-6
                                           rounded-2xl
                                           font-black
                                           cursor-not-allowed"
                                >

                                    Stok Habis

                                </button>

                            @endif


                        {{-- GUEST / BELUM LOGIN --}}
                        @else

                            @if($product->stock > 0)

                                <a
                                    href="{{ route('login') }}"
                                    class="block w-full
                                           text-center
                                           bg-[#29251f]
                                           text-white
                                           py-4
                                           px-6
                                           rounded-2xl
                                           font-black
                                           text-base
                                           hover:bg-[#8b6b45]
                                           hover:-translate-y-1
                                           hover:shadow-xl
                                           transition
                                           duration-300"
                                >

                                    🔐 Login untuk Membeli

                                </a>

                                <p class="text-center
                                          text-xs
                                          text-[#91877b]
                                          mt-3">

                                    Silakan login atau daftar terlebih dahulu
                                    untuk menambahkan produk ke keranjang.

                                </p>

                            @else

                                <button
                                    disabled
                                    class="w-full
                                           bg-gray-200
                                           text-gray-400
                                           py-4
                                           px-6
                                           rounded-2xl
                                           font-black
                                           cursor-not-allowed"
                                >

                                    Stok Habis

                                </button>

                            @endif

                        @endauth

                    </div>


                    {{-- INFO TAMBAHAN --}}
                    <div class="grid grid-cols-2 gap-4 mt-8">

                        <div class="bg-[#fffaf2]
                                    border border-[#eadfce]
                                    rounded-2xl
                                    p-4">

                            <div class="text-2xl mb-2">
                                📦
                            </div>

                            <p class="text-sm font-black">
                                Produk Lokal
                            </p>

                            <p class="text-xs
                                      text-[#91877b]
                                      mt-1">
                                Khas Bengkulu
                            </p>

                        </div>


                        <div class="bg-[#fffaf2]
                                    border border-[#eadfce]
                                    rounded-2xl
                                    p-4">

                            <div class="text-2xl mb-2">
                                🛍️
                            </div>

                            <p class="text-sm font-black">
                                Belanja Mudah
                            </p>

                            <p class="text-xs
                                      text-[#91877b]
                                      mt-1">
                                Pesan secara online
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>


    {{-- FOOTER --}}
    <footer class="bg-[#29251f] text-[#f7f0e4] mt-10">

        <div class="max-w-7xl mx-auto px-5 sm:px-6 py-10">

            <div class="flex flex-col md:flex-row
                        justify-between
                        gap-6">

                <div>

                    <h3 class="text-xl font-black">
                        BengkuluKita
                    </h3>

                    <p class="text-sm
                              text-[#cfc4b4]
                              mt-2">

                        Pusatnya Oleh-Oleh Bengkulu.

                    </p>

                </div>


                <div class="text-sm
                            text-[#cfc4b4]">

                    © {{ date('Y') }} BengkuluKita

                </div>

            </div>

        </div>

    </footer>

</body>
</html>