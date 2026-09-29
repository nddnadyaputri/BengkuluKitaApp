<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pesanan - Admin BengkuluKita</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f7f0e4] text-[#29251f]">

    {{-- NAVBAR --}}
    <nav class="bg-[#29251f] text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-xl font-bold">
                        BengkuluKita Admin
                    </h1>

                    <p class="text-sm text-[#d8cbbb]">
                        Kelola pesanan pelanggan
                    </p>
                </div>

                <div class="flex items-center gap-3">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 transition"
                    >
                        Dashboard
                    </a>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 transition"
                    >
                        Produk
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="px-4 py-2 rounded-xl bg-red-500 hover:bg-red-600 transition"
                        >
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </div>
    </nav>


    {{-- CONTENT --}}
    <main class="max-w-7xl mx-auto px-6 py-8">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <p class="text-sm font-semibold text-[#8b6b45] uppercase tracking-wider">
                    Admin Panel
                </p>

                <h2 class="text-3xl font-bold mt-1">
                    Pesanan Pelanggan
                </h2>

                <p class="text-gray-600 mt-2">
                    Lihat dan kelola semua pesanan yang masuk.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-[#e2d5c3] px-5 py-4">

                <p class="text-sm text-gray-500">
                    Pesanan Baru
                </p>

                <p class="text-2xl font-bold text-[#8b6b45]">
                    {{ $newOrders }}
                </p>

            </div>

        </div>


        {{-- FLASH MESSAGE --}}
        @if(session('success'))

            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl">
                {{ session('error') }}
            </div>

        @endif


        {{-- ORDER LIST --}}
        <div class="bg-white rounded-3xl shadow-sm border border-[#e2d5c3] overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-[#f5eee4]">

                        <tr class="text-left text-sm">

                            <th class="px-6 py-4 font-bold">
                                Pesanan
                            </th>

                            <th class="px-6 py-4 font-bold">
                                Pelanggan
                            </th>

                            <th class="px-6 py-4 font-bold">
                                Total
                            </th>

                            <th class="px-6 py-4 font-bold">
                                Pembayaran
                            </th>

                            <th class="px-6 py-4 font-bold">
                                Status
                            </th>

                            <th class="px-6 py-4 font-bold text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-[#eee4d7]">

                        @forelse($orders as $order)

                            <tr class="hover:bg-[#fffaf4] transition">

                                {{-- ORDER --}}
                                <td class="px-6 py-5">

                                    <p class="font-bold">
                                        #{{ $order->id }}
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $order->items->count() }} jenis produk
                                    </p>

                                </td>


                                {{-- CUSTOMER --}}
                                <td class="px-6 py-5">

                                    <p class="font-semibold">
                                        {{ $order->customer_name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $order->phone }}
                                    </p>

                                </td>


                                {{-- TOTAL --}}
                                <td class="px-6 py-5">

                                    <p class="font-bold text-[#8b6b45]">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </p>

                                </td>


                                {{-- PAYMENT --}}
                                <td class="px-6 py-5">

                                    <p class="text-sm font-medium">
                                        {{ $order->payment_method }}
                                    </p>

                                    @if($order->payment_status === 'Dibayar')

                                        <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                            Dibayar
                                        </span>

                                    @elseif($order->payment_status === 'Menunggu Verifikasi')
                                        <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-bold">
                                            Menunggu Verifikasi
                                        </span>
                                    @elseif($order->payment_status === 'Menunggu Pembayaran')

                                        <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                            Menunggu Pembayaran
                                        </span>

                                    @else

                                        <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-bold">
                                            Belum Dibayar
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td class="px-6 py-5">

                                    @if($order->status === 'Pesanan Baru')

                                        <span class="inline-flex px-3 py-1 rounded-full bg-[#f5e7c7] text-[#8b6b45] text-xs font-bold">
                                            🔔 Pesanan Baru
                                        </span>

                                    @elseif($order->status === 'Diproses')

                                        <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                            Diproses
                                        </span>

                                    @elseif($order->status === 'Dikirim')

                                        <span class="inline-flex px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-bold">
                                            Dikirim
                                        </span>

                                    @elseif($order->status === 'Selesai')

                                        <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                            Selesai
                                        </span>

                                    @else

                                        <span class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                            Dibatalkan
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td class="px-6 py-5 text-right">

                                    <a
                                        href="{{ route('admin.orders.show', $order) }}"
                                        class="inline-flex items-center px-4 py-2 bg-[#29251f] text-white rounded-xl font-semibold hover:bg-[#8b6b45] hover:-translate-y-0.5 transition"
                                    >
                                        Detail →
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="text-5xl mb-4">
                                        🛍️
                                    </div>

                                    <h3 class="text-xl font-bold">
                                        Belum ada pesanan
                                    </h3>

                                    <p class="text-gray-500 mt-2">
                                        Pesanan pelanggan akan muncul di halaman ini.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if($orders->hasPages())

                <div class="px-6 py-5 border-t border-[#eee4d7]">
                    {{ $orders->links() }}
                </div>

            @endif

        </div>

    </main>

</body>
</html>