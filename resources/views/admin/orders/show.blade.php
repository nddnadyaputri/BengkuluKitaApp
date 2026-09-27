<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Pesanan #{{ $order->id }} - BengkuluKita</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f7f0e4] text-[#29251f]">

    {{-- NAVBAR --}}
    <nav class="bg-[#29251f] text-white shadow-lg">

        <div class="max-w-7xl mx-auto px-6 py-4">

            <div class="flex justify-between items-center">

                <div>
                    <h1 class="text-xl font-bold">
                        BengkuluKita Admin
                    </h1>

                    <p class="text-sm text-[#d8cbbb]">
                        Detail Pesanan #{{ $order->id }}
                    </p>
                </div>

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-xl transition"
                >
                    ← Kembali
                </a>

            </div>

        </div>

    </nav>


    <main class="max-w-7xl mx-auto px-6 py-8">

        {{-- FLASH --}}
        @if(session('success'))

            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl">
                {{ session('success') }}
            </div>

        @endif


        {{-- HEADER --}}
        <div class="mb-8">

            <p class="text-sm font-semibold text-[#8b6b45] uppercase tracking-wider">
                Detail Pesanan
            </p>

            <h2 class="text-3xl font-bold mt-1">
                Pesanan #{{ $order->id }}
            </h2>

            <p class="text-gray-500 mt-2">
                Dibuat pada {{ $order->created_at->format('d M Y, H:i') }}
            </p>

        </div>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- CUSTOMER --}}
            <div class="bg-white rounded-3xl shadow-sm border border-[#e2d5c3] p-6">

                <h3 class="text-lg font-bold mb-5">
                    Data Pelanggan
                </h3>

                <div class="space-y-4">

                    <div>
                        <p class="text-sm text-gray-500">
                            Nama
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $order->customer_name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            WhatsApp
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $order->phone }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Alamat
                        </p>

                        <p class="font-semibold mt-1 leading-relaxed">
                            {{ $order->address }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- STATUS --}}
            <div class="bg-white rounded-3xl shadow-sm border border-[#e2d5c3] p-6">

                <h3 class="text-lg font-bold mb-5">
                    Status Pesanan
                </h3>

                <form
                    method="POST"
                    action="{{ route('admin.orders.status', $order) }}"
                    class="space-y-4"
                >

                    @csrf
                    @method('PATCH')

                    <div>

                        <label class="block text-sm font-semibold mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border-[#d8cbbb] rounded-xl focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                        >

                            @foreach([
                                'Pesanan Baru',
                                'Diproses',
                                'Dikirim',
                                'Selesai',
                                'Dibatalkan'
                            ] as $status)

                                <option
                                    value="{{ $status }}"
                                    @selected($order->status === $status)
                                >
                                    {{ $status }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#29251f] text-white py-3 rounded-xl font-semibold hover:bg-[#8b6b45] transition"
                    >
                        Simpan Status
                    </button>

                </form>

            </div>


            {{-- PAYMENT --}}
            <div class="bg-white rounded-3xl shadow-sm border border-[#e2d5c3] p-6">

                <h3 class="text-lg font-bold mb-5">
                    Pembayaran
                </h3>

                <div class="mb-5">

                    <p class="text-sm text-gray-500">
                        Metode Pembayaran
                    </p>

                    <p class="font-semibold mt-1">
                        {{ $order->payment_method }}
                    </p>

                </div>

                <form
                    method="POST"
                    action="{{ route('admin.orders.payment', $order) }}"
                    class="space-y-4"
                >

                    @csrf
                    @method('PATCH')

                    <div>

                        <label class="block text-sm font-semibold mb-2">
                            Status Pembayaran
                        </label>

                        <select
                            name="payment_status"
                            class="w-full border-[#d8cbbb] rounded-xl focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                        >

                            @foreach([
                                'Belum Dibayar',
                                'Menunggu Pembayaran',
                                'Dibayar'
                            ] as $paymentStatus)

                                <option
                                    value="{{ $paymentStatus }}"
                                    @selected($order->payment_status === $paymentStatus)
                                >
                                    {{ $paymentStatus }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#29251f] text-white py-3 rounded-xl font-semibold hover:bg-[#8b6b45] transition"
                    >
                        Simpan Pembayaran
                    </button>

                </form>

            </div>

        </div>


        {{-- ORDER ITEMS --}}
        <div class="bg-white rounded-3xl shadow-sm border border-[#e2d5c3] mt-6 overflow-hidden">

            <div class="px-6 py-5 border-b border-[#eee4d7]">

                <h3 class="text-xl font-bold">
                    Produk yang Dipesan
                </h3>

            </div>


            <div class="divide-y divide-[#eee4d7]">

                @foreach($order->items as $item)

                    <div class="px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>

                            <h4 class="font-bold">
                                {{ $item->product_name }}
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                ×
                                {{ $item->quantity }}
                            </p>

                        </div>

                        <p class="font-bold text-[#8b6b45]">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </p>

                    </div>

                @endforeach

            </div>


            {{-- TOTAL --}}
            <div class="px-6 py-6 bg-[#f5eee4] flex items-center justify-between">

                <span class="text-lg font-bold">
                    Total Pesanan
                </span>

                <span class="text-2xl font-bold text-[#8b6b45]">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </span>

            </div>

        </div>

    </main>

</body>
</html>