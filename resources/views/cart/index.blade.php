<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Keranjang - BengkuluKita</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="bg-[#f7f0e4] text-[#29251f]">


    {{-- NAVBAR --}}

    <nav
        class="sticky top-0 z-50
               bg-[#fffaf2]/95 backdrop-blur
               border-b border-[#e2d5c3]"
    >

        <div
            class="max-w-7xl mx-auto
                   px-5 sm:px-6 py-4"
        >

            <div
                class="flex items-center
                       justify-between"
            >

                {{-- LOGO --}}

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3"
                >

                    <div
                        class="w-11 h-11
                               rounded-2xl
                               bg-[#29251f]
                               text-[#f7f0e4]
                               flex items-center
                               justify-center
                               font-black text-lg
                               shadow-md"
                    >
                        BK
                    </div>

                    <div>

                        <h1
                            class="font-black text-lg
                                   leading-none"
                        >
                            BengkuluKita
                        </h1>

                        <p
                            class="text-xs
                                   text-[#8b6b45]
                                   mt-1"
                        >
                            Pusatnya Oleh-Oleh Bengkulu
                        </p>

                    </div>

                </a>


                {{-- MENU DESKTOP --}}

                <div
                    class="hidden md:flex
                           items-center gap-6
                           text-sm font-semibold"
                >

                    {{-- BERANDA --}}

                    <a
                        href="{{ route('home') }}"
                        class="hover:text-[#8b6b45]
                               transition"
                    >
                        Beranda
                    </a>


                    {{-- PRODUK --}}

                    <a
                        href="{{ route('products.index') }}"
                        class="hover:text-[#8b6b45]
                               transition"
                    >
                        Produk
                    </a>


                    {{-- FAQ --}}

                    <a
                        href="{{ route('home') }}#faq"
                        class="hover:text-[#8b6b45]
                               transition"
                    >
                        FAQ
                    </a>


                    {{-- KONTAK --}}

                    <a
                        href="{{ route('home') }}#kontak"
                        class="hover:text-[#8b6b45]
                               transition"
                    >
                        Kontak
                    </a>


                    {{-- KERANJANG --}}

                    <a
                        href="{{ route('cart.index') }}"
                        class="text-[#8b6b45]
                               hover:text-[#29251f]
                               transition"
                    >

                        Keranjang

                        @php
                            $cartCount = collect(
                                session('cart', [])
                            )->sum('quantity');
                        @endphp

                        @if($cartCount > 0)

                            <span
                                class="ml-1
                                       inline-flex
                                       min-w-5
                                       h-5
                                       px-1
                                       rounded-full
                                       bg-[#8b6b45]
                                       text-white
                                       text-[10px]
                                       font-black
                                       items-center
                                       justify-center"
                            >
                                {{ $cartCount }}
                            </span>

                        @endif

                    </a>


                    {{-- LOGIN / AKUN --}}

                    @auth

                        {{-- ADMIN LOGIN --}}

                        @if(auth()->user()->role === 'admin')

                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="bg-[#29251f]
                                       text-white
                                       px-4 py-2
                                       rounded-xl
                                       font-bold
                                       hover:bg-[#8b6b45]
                                       hover:-translate-y-0.5
                                       hover:shadow-lg
                                       transition"
                            >
                                Dashboard Admin
                            </a>


                        {{-- PEMBELI LOGIN --}}

                        @else

                            <span
                                class="text-[#8b6b45]
                                       font-semibold
                                       whitespace-nowrap"
                            >
                                Halo, {{ auth()->user()->name }}
                            </span>

                        @endif


                    {{-- BELUM LOGIN --}}

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="text-[#8b6b45]
                                   font-bold
                                   hover:text-[#29251f]
                                   transition
                                   whitespace-nowrap"
                        >
                            Login Pembeli
                        </a>


                        <a
                            href="{{ route('admin.login') }}"
                            class="bg-[#29251f]
                                   text-white
                                   px-4 py-2
                                   rounded-xl
                                   font-bold
                                   hover:bg-[#8b6b45]
                                   hover:-translate-y-0.5
                                   hover:shadow-lg
                                   transition
                                   whitespace-nowrap"
                        >
                            Login Admin
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>


    {{-- HEADER --}}

    <section
        class="max-w-7xl mx-auto
               px-5 sm:px-6
               pt-12 pb-8"
    >

        <span
            class="inline-block
                   bg-[#e7dccb]
                   text-[#8b6b45]
                   px-4 py-2
                   rounded-full
                   text-sm font-bold"
        >
            Keranjang Belanja
        </span>


        <h1
            class="text-4xl md:text-5xl
                   font-black
                   leading-tight
                   mt-4"
        >
            Keranjang Kamu
        </h1>


        <p
            class="mt-3
                   text-[#6f665c]
                   text-lg"
        >
            Periksa kembali produk yang ingin kamu beli
            sebelum melanjutkan ke checkout.
        </p>

    </section>


    {{-- NOTIFICATION --}}

    <div
        class="max-w-7xl mx-auto
               px-5 sm:px-6"
    >

        @if(session('success'))

            <div
                class="mb-6
                       bg-[#e7ead7]
                       border border-[#cdd4b2]
                       text-[#626744]
                       px-5 py-4
                       rounded-2xl
                       font-semibold"
            >

                ✓ {{ session('success') }}

            </div>

        @endif


        @if(session('error'))

            <div
                class="mb-6
                       bg-red-50
                       border border-red-200
                       text-red-600
                       px-5 py-4
                       rounded-2xl
                       font-semibold"
            >

                {{ session('error') }}

            </div>

        @endif

    </div>


    {{-- CONTENT --}}

    <main
        class="max-w-7xl mx-auto
               px-5 sm:px-6
               pb-16"
    >

        @if($cartItems->count() > 0)

            <div
                class="grid
                       grid-cols-1
                       lg:grid-cols-[1fr_380px]
                       gap-7"
            >


                {{-- DAFTAR PRODUK --}}

                <div class="space-y-5">

                    @foreach($cartItems as $item)

    @php
        $product = $item['product'];
        $quantity = $item['quantity'];
        $subtotal = $item['subtotal'];
    @endphp
                        @php

                            $product = $item['product'];

                            $quantity = $item['quantity'];

                            $subtotal = $item['subtotal'];

                        @endphp


                        <div
                            class="bg-white
                                   rounded-3xl
                                   border border-[#eadfce]
                                   shadow-sm
                                   p-5
                                   hover:shadow-lg
                                   transition"
                        >

                            <div
                                class="flex flex-col
                                       sm:flex-row
                                       gap-5"
                            >


                                {{-- GAMBAR PRODUK --}}

                                <a
                                    href="{{ route('products.show', $product) }}"
                                    class="shrink-0"
                                >

                                    <div
                                        class="w-full
                                               sm:w-32
                                               h-32
                                               rounded-2xl
                                               overflow-hidden
                                               bg-[#eee4d5]"
                                    >

                                        @if($product->image)

                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-full
                                                       object-cover
                                                       hover:scale-105
                                                       transition
                                                       duration-500"
                                            >

                                        @else

                                            <div
                                                class="w-full h-full
                                                       flex items-center
                                                       justify-center
                                                       text-4xl"
                                            >
                                                🍽️
                                            </div>

                                        @endif

                                    </div>

                                </a>


                                {{-- INFORMASI PRODUK --}}

                                <div
                                    class="flex-1
                                           flex flex-col
                                           justify-between"
                                >

                                    <div>

                                        @if($product->category)

                                            <span
                                                class="text-xs
                                                       font-bold
                                                       text-[#8b6b45]"
                                            >
                                                {{ $product->category->name }}
                                            </span>

                                        @endif


                                        <a
                                            href="{{ route('products.show', $product) }}"
                                        >

                                            <h2
                                                class="text-xl
                                                       font-black
                                                       mt-1
                                                       hover:text-[#8b6b45]
                                                       transition"
                                            >
                                                {{ $product->name }}
                                            </h2>

                                        </a>


                                        <p
                                            class="text-sm
                                                   text-[#91877b]
                                                   mt-1"
                                        >
                                            Rp
                                            {{ number_format($product->price, 0, ',', '.') }}
                                            / produk
                                        </p>

                                    </div>


                                    {{-- QUANTITY + SUBTOTAL --}}

                                    <div
                                        class="flex
                                               flex-col
                                               sm:flex-row
                                               sm:items-end
                                               sm:justify-between
                                               gap-4 mt-5"
                                    >


                                        {{-- QUANTITY --}}

                                        <form
                                            method="POST"
                                            action="{{ route('cart.update', $product) }}"
                                            class="flex items-center gap-3"
                                        >

                                            @csrf

                                            @method('PATCH')


                                            <label
                                                class="text-sm
                                                       font-bold"
                                            >
                                                Jumlah
                                            </label>


                                            <div
                                                class="flex items-center
                                                       border border-[#dfd1bd]
                                                       rounded-xl
                                                       overflow-hidden
                                                       bg-[#fffaf2]"
                                            >

                                                <button
                                                    type="button"
                                                    onclick="decreaseQuantity('quantity-{{ $product->id }}')"
                                                    class="w-10 h-10
                                                           font-black
                                                           text-[#8b6b45]
                                                           hover:bg-[#e7dccb]
                                                           transition"
                                                >
                                                    −
                                                </button>


                                                <input
                                                    id="quantity-{{ $product->id }}"
                                                    type="number"
                                                    name="quantity"
                                                    value="{{ $quantity }}"
                                                    min="1"
                                                    max="{{ $product->stock }}"
                                                    class="w-14 h-10
                                                           border-0
                                                           text-center
                                                           bg-transparent
                                                           font-bold
                                                           focus:ring-0"
                                                    onchange="this.form.submit()"
                                                >


                                                <button
                                                    type="button"
                                                    onclick="increaseQuantity('quantity-{{ $product->id }}')"
                                                    class="w-10 h-10
                                                           font-black
                                                           text-[#8b6b45]
                                                           hover:bg-[#e7dccb]
                                                           transition"
                                                >
                                                    +
                                                </button>

                                            </div>

                                        </form>


                                        {{-- SUBTOTAL --}}

                                        <div
                                            class="text-left
                                                   sm:text-right"
                                        >

                                            <p
                                                class="text-xs
                                                       text-[#91877b]"
                                            >
                                                Subtotal
                                            </p>


                                            <p
                                                class="text-xl
                                                       font-black
                                                       text-[#8b6b45]"
                                            >
                                                Rp
                                                {{ number_format($subtotal, 0, ',', '.') }}
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                {{-- HAPUS PRODUK --}}

                                <div
                                    class="flex
                                           sm:block
                                           sm:pt-1"
                                >

                                    <form
                                        method="POST"
                                        action="{{ route('cart.remove', $product) }}"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="text-sm
                                                   font-bold
                                                   text-red-500
                                                   hover:text-red-700
                                                   transition"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>


                    @endforeach

                </div>


                {{-- RINGKASAN PESANAN --}}

                <div>

                    <div
                        class="bg-white
                               rounded-3xl
                               border border-[#eadfce]
                               shadow-sm
                               p-6
                               lg:sticky
                               lg:top-28"
                    >

                        <h2
                            class="text-2xl
                                   font-black"
                        >
                            Ringkasan Pesanan
                        </h2>


                        <div
                            class="border-t
                                   border-[#eadfce]
                                   my-5"
                        ></div>


                        {{-- TOTAL PRODUK --}}

                        <div
                            class="flex
                                   justify-between
                                   text-sm
                                   text-[#6f665c]"
                        >

                            <span>
                                Total Produk
                            </span>

                            <span>
                                {{ $cartItems->sum('quantity') }} item
                            </span>

                        </div>


                        {{-- TOTAL PEMBAYARAN --}}

                        <div
                            class="flex
                                   justify-between
                                   items-center
                                   mt-4"
                        >

                            <span
                                class="font-bold"
                            >
                                Total Pembayaran
                            </span>


                            <span
                                class="text-2xl
                                       font-black
                                       text-[#8b6b45]"
                            >
                                Rp
                                {{ number_format($total, 0, ',', '.') }}
                            </span>

                        </div>


                        {{-- CHECKOUT --}}

                        <a
                            href="{{ route('checkout.index') }}"
                            class="block
                                   text-center
                                   w-full
                                   mt-7
                                   bg-[#29251f]
                                   text-white
                                   py-4
                                   rounded-2xl
                                   font-black
                                   hover:bg-[#8b6b45]
                                   hover:-translate-y-1
                                   hover:shadow-xl
                                   transition
                                   duration-300"
                        >
                            Lanjut ke Checkout →
                        </a>


                        {{-- LANJUT BELANJA --}}

                        <a
                            href="{{ route('products.index') }}"
                            class="block
                                   text-center
                                   mt-4
                                   text-sm
                                   font-bold
                                   text-[#8b6b45]
                                   hover:text-[#29251f]
                                   transition"
                        >
                            ← Lanjut Belanja
                        </a>

                    </div>

                </div>

            </div>


        @else

            {{-- KERANJANG KOSONG --}}

            <div
                class="bg-white
                       rounded-[2rem]
                       border border-[#eadfce]
                       shadow-sm
                       p-12
                       md:p-20
                       text-center"
            >

                <div
                    class="w-24 h-24
                           mx-auto
                           rounded-full
                           bg-[#e7dccb]
                           flex items-center
                           justify-center
                           text-5xl"
                >
                    🛒
                </div>


                <h2
                    class="text-3xl
                           md:text-4xl
                           font-black
                           mt-7"
                >
                    Keranjang Kamu Masih Kosong
                </h2>


                <p
                    class="text-[#81776b]
                           mt-3
                           max-w-lg
                           mx-auto"
                >
                    Yuk cari produk khas Bengkulu yang ingin
                    kamu beli dan tambahkan ke keranjang.
                </p>


                <a
                    href="{{ route('products.index') }}"
                    class="inline-block
                           mt-7
                           bg-[#29251f]
                           text-white
                           px-7 py-4
                           rounded-2xl
                           font-black
                           hover:bg-[#8b6b45]
                           hover:-translate-y-1
                           hover:shadow-xl
                           transition"
                >
                    Mulai Belanja →
                </a>

            </div>

        @endif

    </main>


    {{-- FOOTER --}}

    <footer
        class="bg-[#29251f]
               text-[#f7f0e4]"
    >

        <div
            class="max-w-7xl mx-auto
                   px-5 sm:px-6
                   py-10"
        >

            <div
                class="flex flex-col
                       md:flex-row
                       justify-between
                       gap-6"
            >

                <div>

                    <h3
                        class="text-xl
                               font-black"
                    >
                        BengkuluKita
                    </h3>


                    <p
                        class="text-sm
                               text-[#cfc4b4]
                               mt-2"
                    >
                        Pusatnya Oleh-Oleh Bengkulu.
                    </p>

                </div>


                <div
                    class="text-sm
                           text-[#cfc4b4]"
                >
                    © {{ date('Y') }} BengkuluKita
                </div>

            </div>

        </div>

    </footer>


    {{-- JAVASCRIPT --}}

    <script>

        function decreaseQuantity(id) {

            const input = document.getElementById(id);

            let value = parseInt(input.value) || 1;

            if (value > 1) {

                input.value = value - 1;

                input.form.submit();

            }

        }


        function increaseQuantity(id) {

            const input = document.getElementById(id);

            let value = parseInt(input.value) || 1;

            const max = parseInt(input.max);

            if (value < max) {

                input.value = value + 1;

                input.form.submit();

            }

        }

    </script>


</body>

</html>