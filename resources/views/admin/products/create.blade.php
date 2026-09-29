<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Produk - BengkuluKita</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7f0e4] min-h-screen text-[#29251f]">

    <!-- NAVBAR -->
    <nav class="bg-[#29251f] text-white shadow-lg">

        <div class="max-w-5xl mx-auto px-6 py-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs uppercase tracking-[0.25em] text-[#d8c7af]">
                        BengkuluKita Admin
                    </p>

                    <h1 class="text-2xl font-bold">
                        Tambah Produk
                    </h1>
                </div>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="bg-white/10
                           hover:bg-white/20
                           px-4 py-2
                           rounded-xl
                           transition"
                >
                    ← Kembali
                </a>

            </div>

        </div>

    </nav>


    <main class="max-w-5xl mx-auto px-6 py-8">

        @if($errors->any())

            <div
                class="mb-6
                       bg-red-50
                       border border-red-200
                       text-red-700
                       rounded-2xl
                       p-5"
            >

                <p class="font-bold mb-2">
                    Ada data yang perlu diperbaiki:
                </p>

                <ul class="list-disc ml-5 space-y-1">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            method="POST"
            action="{{ route('admin.products.store') }}"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-7">


                <!-- LEFT : IMAGE -->
                <div class="lg:col-span-1">

                    <div
                        class="bg-white
                               rounded-3xl
                               border border-[#eadfce]
                               shadow-sm
                               p-6
                               sticky top-6"
                    >

                        <h2 class="text-lg font-bold">
                            Foto Produk
                        </h2>

                        <p class="text-sm text-[#756a5c] mt-1 mb-5">
                            Gunakan gambar yang jelas dan menarik.
                        </p>


                        <div
                            id="imagePreview"
                            class="w-full
                                   aspect-square
                                   rounded-2xl
                                   bg-[#eee5d8]
                                   overflow-hidden
                                   flex
                                   items-center
                                   justify-center
                                   mb-5"
                        >

                            <div
                                id="emptyPreview"
                                class="text-center text-[#9a8d7d]"
                            >

                                <div class="text-5xl mb-3">
                                    🖼️
                                </div>

                                <p class="text-sm">
                                    Preview gambar
                                </p>

                            </div>

                            <img
                                id="preview"
                                src=""
                                class="hidden w-full h-full object-cover"
                            >

                        </div>


                        <label class="block">

                            <span class="text-sm font-semibold">
                                Pilih Gambar
                            </span>

                            <input
                                type="file"
                                name="image"
                                accept="image/jpeg,image/png,image/webp"
                                onchange="previewImage(event)"
                                class="mt-2
                                       block
                                       w-full
                                       text-sm
                                       file:mr-4
                                       file:py-2.5
                                       file:px-4
                                       file:rounded-xl
                                       file:border-0
                                       file:bg-[#29251f]
                                       file:text-white
                                       hover:file:bg-[#8b6b45]"
                            >

                        </label>

                        <p class="text-xs text-[#8b7c6b] mt-3">
                            JPG, PNG, atau WEBP. Maksimal 2 MB.
                        </p>

                    </div>

                </div>


                <!-- RIGHT : FORM -->
                <div class="lg:col-span-2">

                    <div
                        class="bg-white
                               rounded-3xl
                               border border-[#eadfce]
                               shadow-sm
                               p-7"
                    >

                        <div class="mb-7">

                            <p
                                class="text-xs
                                       uppercase
                                       tracking-widest
                                       text-[#8b6b45]
                                       font-bold"
                            >
                                Informasi Produk
                            </p>

                            <h2 class="text-2xl font-bold mt-1">
                                Detail Produk
                            </h2>

                        </div>


                        <!-- NAMA -->
                        <div class="mb-5">

                            <label class="block font-semibold mb-2">
                                Nama Produk
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Contoh: Pendap Bengkulu"
                                required
                                class="w-full
                                       rounded-2xl
                                       border-[#dfd2c0]
                                       bg-[#fffaf3]
                                       px-5 py-3
                                       focus:border-[#8b6b45]
                                       focus:ring-[#8b6b45]"
                            >

                        </div>


                        <!-- CATEGORY -->
                        <div class="mb-5">

                            <label class="block font-semibold mb-2">
                                Kategori
                            </label>

                            <select
                                name="category_id"
                                required
                                class="w-full
                                       rounded-2xl
                                       border-[#dfd2c0]
                                       bg-[#fffaf3]
                                       px-5 py-3
                                       focus:border-[#8b6b45]
                                       focus:ring-[#8b6b45]"
                            >

                                <option value="">
                                    -- Pilih Kategori --
                                </option>

                                @forelse($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>

                                @empty

                                    <option value="" disabled>
                                        Belum ada kategori
                                    </option>

                                @endforelse

                            </select>

                            @if($categories->isEmpty())

                                <p class="text-sm text-red-600 mt-2">
                                    Belum ada data kategori di database.
                                </p>

                            @endif

                        </div>


                        <!-- PRICE + STOCK -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

                            <div>

                                <label class="block font-semibold mb-2">
                                    Harga
                                </label>

                                <div class="relative">

                                    <span
                                        class="absolute
                                               left-4
                                               top-1/2
                                               -translate-y-1/2
                                               text-[#8b6b45]
                                               font-semibold"
                                    >
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        name="price"
                                        value="{{ old('price') }}"
                                        min="0"
                                        required
                                        class="w-full
                                               rounded-2xl
                                               border-[#dfd2c0]
                                               bg-[#fffaf3]
                                               pl-12
                                               pr-5
                                               py-3
                                               focus:border-[#8b6b45]
                                               focus:ring-[#8b6b45]"
                                    >

                                </div>

                            </div>


                            <div>

                                <label class="block font-semibold mb-2">
                                    Stok
                                </label>

                                <input
                                    type="number"
                                    name="stock"
                                    value="{{ old('stock', 0) }}"
                                    min="0"
                                    required
                                    class="w-full
                                           rounded-2xl
                                           border-[#dfd2c0]
                                           bg-[#fffaf3]
                                           px-5
                                           py-3
                                           focus:border-[#8b6b45]
                                           focus:ring-[#8b6b45]"
                                >

                            </div>

                        </div>


                        <!-- SLUG -->
                        <div class="mb-5">

                            <label class="block font-semibold mb-2">
                                Slug
                                <span class="font-normal text-[#8b7c6b]">
                                    (opsional)
                                </span>
                            </label>

                            <input
                                type="text"
                                name="slug"
                                value="{{ old('slug') }}"
                                placeholder="Akan dibuat otomatis jika kosong"
                                class="w-full
                                       rounded-2xl
                                       border-[#dfd2c0]
                                       bg-[#fffaf3]
                                       px-5 py-3
                                       focus:border-[#8b6b45]
                                       focus:ring-[#8b6b45]"
                            >

                        </div>


                        <!-- DESCRIPTION -->
                        <div class="mb-7">

                            <label class="block font-semibold mb-2">
                                Deskripsi
                            </label>

                            <textarea
                                name="description"
                                rows="6"
                                placeholder="Jelaskan produk, rasa, ukuran, bahan, atau informasi lainnya..."
                                class="w-full
                                       rounded-2xl
                                       border-[#dfd2c0]
                                       bg-[#fffaf3]
                                       px-5 py-3
                                       focus:border-[#8b6b45]
                                       focus:ring-[#8b6b45]"
                            >{{ old('description') }}</textarea>

                        </div>


                        <!-- BUTTON -->
                        <div
                            class="flex
                                   flex-col-reverse
                                   sm:flex-row
                                   gap-3
                                   justify-end
                                   pt-5
                                   border-t
                                   border-[#eee4d5]"
                        >

                            <a
                                href="{{ route('admin.products.index') }}"
                                class="text-center
                                       px-6 py-3
                                       rounded-2xl
                                       border border-[#d8cbbb]
                                       font-semibold
                                       hover:bg-[#f7f0e4]
                                       transition"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="px-7 py-3
                                       rounded-2xl
                                       bg-[#29251f]
                                       text-white
                                       font-semibold
                                       hover:-translate-y-1
                                       hover:shadow-xl
                                       transition"
                            >
                                Simpan Produk →
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </main>


    <script>

        function previewImage(event) {

            const input = event.target;
            const preview = document.getElementById('preview');
            const empty = document.getElementById('emptyPreview');

            if (input.files && input.files[0]) {

                const reader = new FileReader();

                reader.onload = function(e) {

                    preview.src = e.target.result;

                    preview.classList.remove('hidden');

                    empty.classList.add('hidden');

                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

</body>

</html>