<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Produk - BengkuluKita</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="bg-[#f7f0e4] text-[#29251f]">

    <nav class="bg-[#29251f] text-white">

        <div class="max-w-5xl mx-auto px-6 py-4">

            <div class="flex items-center justify-between">

                <div>

                    <h1 class="font-black text-xl">
                        Bengkulu Kita
                    </h1>

                    <p class="text-xs text-[#d9c7aa]">
                        Pusatnya Oleh-Oleh Bengkulu
                    </p>

                </div>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="px-4 py-2 rounded-xl hover:bg-white/10 transition"
                >
                    ← Kembali
                </a>

            </div>

        </div>

    </nav>


    <main class="max-w-5xl mx-auto px-6 py-10">

        <div class="mb-8">

            <p class="text-sm font-bold uppercase tracking-widest text-[#8b6b45]">
                Produk
            </p>

            <h2 class="text-3xl font-black mt-1">
                Edit Produk
            </h2>

            <p class="text-[#746653] mt-2">
                Perbarui informasi produk {{ $product->name }}.
            </p>

        </div>


        @if($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl">

                <ul class="list-disc list-inside">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            method="POST"
            action="{{ route('admin.products.update', $product) }}"
            enctype="multipart/form-data"
            class="bg-[#fffaf2] rounded-3xl border border-[#e2d5c3] shadow-sm p-6 md:p-8"
        >

            @csrf
            @method('PUT')


            <div class="grid md:grid-cols-2 gap-6">

                <div class="md:col-span-2">

                    <label class="block font-bold mb-2">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        class="w-full rounded-2xl border-[#d9ccb9] bg-[#fdf8ef] focus:border-[#29251f] focus:ring-[#29251f]"
                        required
                    >

                </div>


                <div>

                    <label class="block font-bold mb-2">
                        Kategori
                    </label>

                    <select
                        name="category_id"
                        required
                        class="w-full rounded-2xl border-[#dfd2c0] bg-[#fffaf3] px-5 py-3 focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                            >

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label class="block font-bold mb-2">
                        Harga
                    </label>

                    <input
                        type="number"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        min="0"
                        class="w-full rounded-2xl border-[#d9ccb9] bg-[#fdf8ef] focus:border-[#29251f] focus:ring-[#29251f]"
                        required
                    >

                </div>


                <div>

                    <label class="block font-bold mb-2">
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock', $product->stock) }}"
                        min="0"
                        class="w-full rounded-2xl border-[#d9ccb9] bg-[#fdf8ef] focus:border-[#29251f] focus:ring-[#29251f]"
                        required
                    >

                </div>


                <div>

                    <label class="block font-bold mb-2">
                        Slug
                    </label>

                    <input
                        type="text"
                        name="slug"
                        value="{{ old('slug', $product->slug) }}"
                        class="w-full rounded-2xl border-[#d9ccb9] bg-[#fdf8ef] focus:border-[#29251f] focus:ring-[#29251f]"
                    >

                </div>


                <div class="md:col-span-2">

                    <label class="block font-bold mb-2">
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full rounded-2xl border-[#d9ccb9] bg-[#fdf8ef] focus:border-[#29251f] focus:ring-[#29251f]"
                    >{{ old('description', $product->description) }}</textarea>

                </div>


                <!-- CURRENT IMAGE -->

                @if($product->image)

                    <div class="md:col-span-2">

                        <label class="block font-bold mb-3">
                            Gambar Saat Ini
                        </label>

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-48 h-48 object-cover rounded-3xl border border-[#d9ccb9]"
                        >

                    </div>

                @endif


                <!-- NEW IMAGE -->

                <div class="md:col-span-2">

                    <label class="block font-bold mb-2">
                        Ganti Gambar
                    </label>

                    <input
                        type="file"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="w-full rounded-2xl border border-[#d9ccb9] bg-[#fdf8ef] p-3"
                    >

                    <p class="text-xs text-[#89765e] mt-2">
                        Kosongkan jika tidak ingin mengganti gambar.
                    </p>

                </div>

            </div>


            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('admin.products.index') }}"
                    class="px-6 py-3 rounded-2xl bg-[#e8dccb] font-bold hover:bg-[#d9ccb9] transition"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-7 py-3 rounded-2xl bg-[#29251f] text-white font-bold hover:-translate-y-1 hover:shadow-lg transition"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </main>

</body>

</html>