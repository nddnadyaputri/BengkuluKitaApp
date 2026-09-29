<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produk - BengkuluKita Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7f0e4] min-h-screen text-[#29251f]">

    <!-- NAVBAR -->
    <nav class="bg-[#29251f] text-white shadow-lg">

        <div class="max-w-7xl mx-auto px-6 py-5">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <p class="text-xs uppercase tracking-[0.25em] text-[#d8c7af]">
                        BengkuluKita
                    </p>

                    <h1 class="text-2xl font-bold">
                        Katalog Produk
                    </h1>
                </div>

                <div class="flex items-center gap-3">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 transition"
                    >
                        ← Dashboard
                    </a>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="px-4 py-2 rounded-xl bg-[#8b6b45] hover:-translate-y-1 hover:shadow-lg transition"
                        >
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </nav>


    <main class="max-w-7xl mx-auto px-6 py-8">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 mb-8">

            <div>

                <p class="text-sm font-semibold text-[#8b6b45] uppercase tracking-widest">
                    Admin Panel
                </p>

                <h2 class="text-3xl md:text-4xl font-bold mt-1">
                    Kelola Produk
                </h2>

                <p class="text-[#6f6559] mt-2">
                    Tambahkan, ubah, hapus, dan atur stok produk BengkuluKita.
                </p>

            </div>


            <a
                href="{{ route('admin.products.create') }}"
                class="inline-flex items-center justify-center gap-2
                       bg-[#29251f]
                       text-white
                       px-6 py-3
                       rounded-2xl
                       font-semibold
                       hover:-translate-y-1
                       hover:shadow-xl
                       transition"
            >
                <span class="text-xl">+</span>
                Tambah Produk
            </a>

        </div>


        <!-- STATISTICS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

            <!-- TOTAL PRODUK -->
            <div
                class="bg-white rounded-3xl p-6 shadow-sm
                       border border-[#eadfce]
                       hover:-translate-y-1 hover:shadow-lg transition"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-[#756a5c]">
                            Total Produk
                        </p>

                        <p class="text-3xl font-bold mt-2">
                            {{ $totalProducts }}
                        </p>

                    </div>

                    <div
                        class="w-12 h-12 rounded-2xl
                               bg-[#f0e7d9]
                               flex items-center justify-center
                               text-2xl"
                    >
                        🛍️
                    </div>

                </div>

            </div>


            <!-- TOTAL STOK -->
            <div
                class="bg-white rounded-3xl p-6 shadow-sm
                       border border-[#eadfce]
                       hover:-translate-y-1 hover:shadow-lg transition"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-[#756a5c]">
                            Total Stok
                        </p>

                        <p class="text-3xl font-bold mt-2">
                            {{ number_format($totalStock, 0, ',', '.') }}
                        </p>

                    </div>

                    <div
                        class="w-12 h-12 rounded-2xl
                               bg-[#e6ead9]
                               flex items-center justify-center
                               text-2xl"
                    >
                        📦
                    </div>

                </div>

            </div>


            <!-- STOK MENIPIS -->
            <div
                class="bg-white rounded-3xl p-6 shadow-sm
                       border border-[#eadfce]
                       hover:-translate-y-1 hover:shadow-lg transition"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-[#756a5c]">
                            Stok Menipis
                        </p>

                        <p class="text-3xl font-bold mt-2">
                            {{ $lowStock }}
                        </p>

                    </div>

                    <div
                        class="w-12 h-12 rounded-2xl
                               bg-[#f1dfcf]
                               flex items-center justify-center
                               text-2xl"
                    >
                        ⚠️
                    </div>

                </div>

            </div>


            <!-- KATEGORI -->
            <div
                class="bg-white rounded-3xl p-6 shadow-sm
                       border border-[#eadfce]
                       hover:-translate-y-1 hover:shadow-lg transition"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-[#756a5c]">
                            Kategori
                        </p>

                        <p class="text-3xl font-bold mt-2">
                            {{ $categories }}
                        </p>

                    </div>

                    <div
                        class="w-12 h-12 rounded-2xl
                               bg-[#e4ddd2]
                               flex items-center justify-center
                               text-2xl"
                    >
                        🗂️
                    </div>

                </div>

            </div>

        </div>


        <!-- NOTIFICATION -->
        @if(session('success'))

            <div
                class="mb-6
                       bg-[#e7eddd]
                       border border-[#c8d4b7]
                       text-[#445039]
                       px-5 py-4
                       rounded-2xl"
            >
                ✓ {{ session('success') }}
            </div>

        @endif


        <!-- SEARCH -->
        <div
            class="bg-white
                   rounded-3xl
                   p-5
                   shadow-sm
                   border border-[#eadfce]
                   mb-7"
        >

            <form
                method="GET"
                action="{{ route('admin.products.index') }}"
                class="flex flex-col md:flex-row gap-3"
            >

                <div class="flex-1">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari nama produk..."
                        class="w-full
                               rounded-2xl
                               border-[#dfd2c0]
                               bg-[#fffaf3]
                               px-5 py-3
                               focus:border-[#8b6b45]
                               focus:ring-[#8b6b45]"
                    >

                </div>

                <button
                    type="submit"
                    class="bg-[#29251f]
                           text-white
                           px-7 py-3
                           rounded-2xl
                           font-semibold
                           hover:-translate-y-1
                           hover:shadow-lg
                           transition"
                >
                    Cari Produk
                </button>

                @if($search)

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="flex items-center justify-center
                               px-6 py-3
                               rounded-2xl
                               border border-[#d8cbbb]
                               hover:bg-[#f7f0e4]
                               transition"
                    >
                        Reset
                    </a>

                @endif

            </form>

        </div>


        <!-- PRODUCT GRID -->
        @if($products->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @foreach($products as $product)

                    <div
                        class="bg-white
                               rounded-3xl
                               overflow-hidden
                               border border-[#eadfce]
                               shadow-sm
                               hover:-translate-y-2
                               hover:shadow-xl
                               transition duration-300"
                    >

                        <!-- IMAGE -->
                        <div class="relative h-56 bg-[#eee5d8]">

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover"
                                >

                            @else

                                <div
                                    class="w-full h-full
                                           flex flex-col
                                           items-center
                                           justify-center
                                           text-[#9a8d7d]"
                                >

                                    <span class="text-5xl mb-2">
                                        🛍️
                                    </span>

                                    <span class="text-sm">
                                        Belum ada gambar
                                    </span>

                                </div>

                            @endif


                            <!-- STOCK BADGE -->
                            <div class="absolute top-4 right-4">

                                @if($product->stock <= 0)

                                    <span
                                        class="bg-red-100
                                               text-red-700
                                               px-3 py-1.5
                                               rounded-full
                                               text-xs
                                               font-bold"
                                    >
                                        HABIS
                                    </span>

                                @elseif($product->stock <= 5)

                                    <span
                                        class="bg-orange-100
                                               text-orange-700
                                               px-3 py-1.5
                                               rounded-full
                                               text-xs
                                               font-bold"
                                    >
                                        Stok {{ $product->stock }}
                                    </span>

                                @else

                                    <span
                                        class="bg-[#e5ecd9]
                                               text-[#536344]
                                               px-3 py-1.5
                                               rounded-full
                                               text-xs
                                               font-bold"
                                    >
                                        Stok {{ $product->stock }}
                                    </span>

                                @endif

                            </div>

                        </div>


                        <!-- CONTENT -->
                        <div class="p-5">

                            <p
                                class="text-xs
                                       uppercase
                                       tracking-wider
                                       font-semibold
                                       text-[#8b6b45]"
                            >
                                {{ $product->category->name ?? 'Tanpa Kategori' }}
                            </p>


                            <h3
                                class="text-lg
                                       font-bold
                                       mt-1
                                       line-clamp-2"
                            >
                                {{ $product->name }}
                            </h3>


                            <p
                                class="text-sm
                                       text-[#756a5c]
                                       mt-2
                                       line-clamp-2
                                       min-h-[40px]"
                            >
                                {{ $product->description ?: 'Belum ada deskripsi produk.' }}
                            </p>


                            <div class="mt-4">

                                <p class="text-xl font-bold text-[#29251f]">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                            </div>


                            <!-- ACTION -->
                            <div class="flex gap-2 mt-5">

                                <a
                                    href="{{ route('admin.products.edit', $product) }}"
                                    class="flex-1
                                           text-center
                                           bg-[#f0e7d9]
                                           text-[#5e4932]
                                           px-3 py-2.5
                                           rounded-xl
                                           font-semibold
                                           hover:bg-[#e5d8c5]
                                           hover:-translate-y-0.5
                                           transition"
                                >
                                    Edit
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('admin.products.destroy', $product) }}"
                                    class="flex-1"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="w-full
                                               bg-[#f3dddd]
                                               text-[#8b3f3f]
                                               px-3 py-2.5
                                               rounded-xl
                                               font-semibold
                                               hover:bg-[#eccaca]
                                               hover:-translate-y-0.5
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


            <!-- PAGINATION -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>

        @else

            <!-- EMPTY STATE -->
            <div
                class="bg-white
                       rounded-3xl
                       border border-[#eadfce]
                       p-12
                       text-center
                       shadow-sm"
            >

                <div class="text-6xl mb-5">
                    🛍️
                </div>

                <h3 class="text-2xl font-bold">
                    Belum ada produk
                </h3>

                <p class="text-[#756a5c] mt-2 mb-6">
                    Tambahkan produk pertama BengkuluKita.
                </p>

                <a
                    href="{{ route('admin.products.create') }}"
                    class="inline-flex
                           items-center
                           gap-2
                           bg-[#29251f]
                           text-white
                           px-6 py-3
                           rounded-2xl
                           font-semibold
                           hover:-translate-y-1
                           hover:shadow-xl
                           transition"
                >
                    + Tambah Produk
                </a>

            </div>

        @endif

    </main>

</body>

</html>