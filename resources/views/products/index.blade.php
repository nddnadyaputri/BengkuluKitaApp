<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produk - BengkuluKita</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7f0e4] text-[#29251f]">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 bg-[#fffaf2]/95 backdrop-blur border-b border-[#e2d5c3]">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 py-4">

            <div class="flex items-center justify-between">

                {{-- LOGO --}}
                <a href="{{ route('home') }}"
                   class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-2xl bg-[#29251f] text-[#f7f0e4]
                                flex items-center justify-center font-black text-lg
                                shadow-md">
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

                    <a href="{{ route('cart.index') }}" class="relative hover:text-[#8b6b45] transition">
                        Keranjang
                        @php($cartCount = collect(session('cart', []))->sum('quantity'))
                        @if($cartCount > 0)
                            <span class="absolute -top-3 -right-5 min-w-5 h-5 px-1 rounded-full bg-[#8b6b45] text-white text-[10px] font-black flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    </a>

                    @auth

                        @if(auth()->user()->role === 'admin')

                            <a href="{{ route('admin.dashboard') }}"
                               class="bg-[#29251f] text-white px-4 py-2 rounded-xl
                                      hover:-translate-y-0.5 hover:shadow-lg transition">
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
                            Masuk
                        </a>

                        <a href="{{ route('register') }}"
                           class="bg-[#29251f] text-white px-4 py-2 rounded-xl
                                  hover:-translate-y-0.5 hover:shadow-lg transition">
                            Daftar
                        </a>

                    @endauth

                </div>

            </div>

        </div>
    </nav>


    {{-- HEADER --}}
    <section class="max-w-7xl mx-auto px-5 sm:px-6 pt-12 pb-8">

        <div class="max-w-3xl">

            <span class="inline-block bg-[#e7dccb] text-[#8b6b45]
                         px-4 py-2 rounded-full text-sm font-bold mb-4">
                Jelajahi Produk
            </span>

            <h2 class="text-4xl md:text-5xl font-black leading-tight">
                Temukan Produk Khas
                <span class="text-[#8b6b45]">
                    Bengkulu
                </span>
            </h2>

            <p class="mt-4 text-[#6f665c] text-lg">
                Pilih makanan, minuman, camilan, dan oleh-oleh khas
                Bengkulu yang kamu inginkan.
            </p>

        </div>


        {{-- FILTER --}}
        <div class="mt-8 bg-white rounded-3xl p-5 md:p-6 shadow-sm
                    border border-[#eadfce]">

            <form method="GET"
                  action="{{ route('products.index') }}"
                  id="filterForm">

                <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr_auto] gap-4">

                    {{-- SEARCH --}}
                    <div>
                        <label class="block text-sm font-bold mb-2">
                            Cari Produk
                        </label>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Contoh: Bolu Koja..."
                            class="w-full rounded-2xl border-[#dfd1bd]
                                   bg-[#fffaf2] px-4 py-3
                                   focus:border-[#8b6b45]
                                   focus:ring-[#8b6b45]"
                        >
                    </div>


                    {{-- CATEGORY --}}
                    <div>
                        <label class="block text-sm font-bold mb-2">
                            Kategori
                        </label>

                        <select
                            name="category"
                            id="categorySelect"
                            class="w-full rounded-2xl border-[#dfd1bd]
                                   bg-[#fffaf2] px-4 py-3
                                   focus:border-[#8b6b45]
                                   focus:ring-[#8b6b45]"
                        >

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>
                    </div>


                    {{-- BUTTON --}}
                    <div class="flex items-end">

                        <button
                            type="submit"
                            id="searchButton"
                            class="
                                w-full md:w-auto
                                bg-[#29251f]
                                text-white
                                px-7 py-3
                                rounded-2xl
                                font-bold
                                transition
                                hover:-translate-y-1
                                hover:shadow-xl
                                hidden
                            "
                        >
                            Cari
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </section>


    {{-- PRODUCTS --}}
    <main class="max-w-7xl mx-auto px-5 sm:px-6 pb-16">

        @if($products->count() > 0)

            <div class="flex items-center justify-between mb-6">

                <div>
                    <h3 class="text-2xl font-black">
                        Produk Kami
                    </h3>

                    <p class="text-sm text-[#81776b] mt-1">
                        {{ $products->total() }} produk tersedia
                    </p>
                </div>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @foreach($products as $product)

                    <div class="group bg-white rounded-3xl overflow-hidden
                                border border-[#eadfce]
                                shadow-sm
                                hover:-translate-y-2
                                hover:shadow-2xl
                                transition duration-300">

                        {{-- IMAGE --}}
                        <a href="{{ route('products.show', $product) }}">

                            <div class="relative h-56 bg-[#eee4d5] overflow-hidden">

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover
                                               group-hover:scale-105
                                               transition duration-500"
                                    >

                                @else

                                    <div class="w-full h-full flex items-center justify-center">

                                        <div class="text-center text-[#a18f79]">

                                            <div class="text-5xl mb-2">
                                                🍽️
                                            </div>

                                            <p class="text-sm font-semibold">
                                                Belum ada gambar
                                            </p>

                                        </div>

                                    </div>

                                @endif


                                {{-- CATEGORY --}}
                                @if($product->category)

                                    <span class="absolute top-4 left-4
                                                 bg-[#fffaf2]/95
                                                 text-[#8b6b45]
                                                 px-3 py-1.5
                                                 rounded-full
                                                 text-xs font-bold
                                                 shadow">
                                        {{ $product->category->name }}
                                    </span>

                                @endif

                            </div>

                        </a>


                        {{-- CONTENT --}}
                        <div class="p-5">

                            <a href="{{ route('products.show', $product) }}">

                                <h3 class="text-lg font-black
                                           group-hover:text-[#8b6b45]
                                           transition">
                                    {{ $product->name }}
                                </h3>

                            </a>


                            <p class="text-sm text-[#81776b] mt-2 line-clamp-2 min-h-[40px]">
                                {{ $product->description ?: 'Produk khas Bengkulu pilihan untuk kamu.' }}
                            </p>


                            <div class="flex items-center justify-between mt-5">

                                <div>
                                    <p class="text-xs text-[#91877b]">
                                        Harga
                                    </p>

                                    <p class="text-xl font-black text-[#8b6b45]">
                                       number_format($product->price, 0, ',', '.')
                                    </p>
                                </div>


                                @if($product->stock > 0)

                                    <span class="text-xs font-bold
                                                 bg-[#e7ead7]
                                                 text-[#626744]
                                                 px-3 py-1.5
                                                 rounded-full">
                                        Stok {{ $product->stock }}
                                    </span>

                                @else

                                    <span class="text-xs font-bold
                                                 bg-red-100
                                                 text-red-600
                                                 px-3 py-1.5
                                                 rounded-full">
                                        Habis
                                    </span>

                                @endif

                            </div>


                            {{-- CART BUTTON --}}
                            <div class="mt-5">

                                @auth

                                    @if($product->stock > 0)

                                        <form
                                            method="POST"
                                            action="{{ route('cart.add', $product) }}"
                                        >
                                            @csrf

                                            <button
                                                type="submit"
                                                class="w-full bg-[#29251f]
                                                       text-white
                                                       py-3
                                                       rounded-2xl
                                                       font-bold
                                                       hover:bg-[#8b6b45]
                                                       hover:-translate-y-0.5
                                                       transition"
                                            >
                                                + Tambah ke Keranjang
                                            </button>
                                        </form>

                                    @else

                                        <button
                                            disabled
                                            class="w-full bg-gray-200
                                                   text-gray-400
                                                   py-3 rounded-2xl
                                                   font-bold cursor-not-allowed"
                                        >
                                            Stok Habis
                                        </button>

                                    @endif

                                @else

                                    <a
                                        href="{{ route('login') }}"
                                        class="block text-center
                                               w-full
                                               bg-[#29251f]
                                               text-white
                                               py-3
                                               rounded-2xl
                                               font-bold
                                               hover:bg-[#8b6b45]
                                               hover:-translate-y-0.5
                                               transition"
                                    >
                                        Login untuk Membeli
                                    </a>

                                @endauth

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- PAGINATION --}}
            <div class="mt-10">
                {{ $products->links() }}
            </div>

        @else

            {{-- EMPTY --}}
            <div class="bg-white rounded-3xl border border-[#eadfce]
                        p-12 text-center shadow-sm">

                <div class="text-6xl mb-5">
                    🔎
                </div>

                <h3 class="text-2xl font-black">
                    Produk tidak ditemukan
                </h3>

                <p class="text-[#81776b] mt-2">
                    Coba gunakan kata kunci atau kategori lainnya.
                </p>

                <a
                    href="{{ route('products.index') }}"
                    class="inline-block mt-6
                           bg-[#29251f]
                           text-white
                           px-6 py-3
                           rounded-2xl
                           font-bold
                           hover:bg-[#8b6b45]
                           transition"
                >
                    Lihat Semua Produk
                </a>

            </div>

        @endif

    </main>


    {{-- FOOTER --}}
    <footer class="bg-[#29251f] text-[#f7f0e4]">

        <div class="max-w-7xl mx-auto px-5 sm:px-6 py-10">

            <div class="flex flex-col md:flex-row
                        justify-between gap-6">

                <div>
                    <h3 class="text-xl font-black">
                        BengkuluKita
                    </h3>

                    <p class="text-sm text-[#cfc4b4] mt-2">
                        Pusatnya Oleh-Oleh Bengkulu.
                    </p>
                </div>

                <div class="text-sm text-[#cfc4b4]">
                    © {{ date('Y') }} BengkuluKita
                </div>

            </div>

        </div>

    </footer>


    {{-- FILTER BUTTON SCRIPT --}}
    <script>

        const categorySelect = document.getElementById('categorySelect');
        const searchInput = document.querySelector('input[name="search"]');
        const searchButton = document.getElementById('searchButton');

        function updateSearchButton() {

            const categorySelected = categorySelect.value !== '';
            const searchFilled = searchInput.value.trim() !== '';

            if (categorySelected || searchFilled) {
                searchButton.classList.remove('hidden');
            } else {
                searchButton.classList.add('hidden');
            }
        }

        categorySelect.addEventListener('change', updateSearchButton);

        searchInput.addEventListener('input', updateSearchButton);

        updateSearchButton();

    </script>

</body>
</html>