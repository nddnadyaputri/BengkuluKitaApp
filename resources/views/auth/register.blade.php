<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Daftar - BengkuluKita</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="min-h-screen bg-[#f7f0e4] text-[#29251f]">

    <div class="min-h-screen flex items-center justify-center px-5 py-10">

        <div class="w-full max-w-md">


            {{-- BRAND --}}
            <div class="text-center mb-8">

                {{-- LOGO BENGKULUKITA --}}
                <div class="text-center mb-8">

    <div
        class="inline-flex
               items-center
               justify-center
               w-16 h-16
               rounded-2xl
               bg-[#f5e7c7]
               border border-[#dfcfb8]
               shadow-md
               overflow-hidden"
    >

        <img
            src="{{ asset('images/logo-kue.png') }}"
            alt="Logo BengkuluKita"
            class="w-[78%] h-[78%] object-contain"
        >

    </div>

    <h1
        class="mt-4
               text-3xl
               font-extrabold
               tracking-tight
               text-[#29251f]"
    >
        BengkuluKita
    </h1>

    <p
        class="text-sm
               text-[#8b6b45]
               mt-1"
    >
        Pusatnya Oleh-Oleh Bengkulu
    </p>

</div>


                <h1 class="text-3xl font-extrabold tracking-tight text-[#29251f]">
                    BengkuluKita
                </h1>

                <p class="text-sm text-[#8b6b45] mt-1">
                    Pusatnya Oleh-Oleh Bengkulu
                </p>

            </div>


            {{-- REGISTER CARD --}}
            <div class="bg-white rounded-[2rem] border border-[#e2d5c3] shadow-[0_15px_45px_rgba(70,50,30,0.10)] p-7 sm:p-8">


                {{-- HEADER --}}
                <div class="mb-7">

                    <h2 class="text-2xl font-bold text-[#29251f]">
                        Buat Akun
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">
                        Daftar untuk mulai menjelajahi dan membeli produk Bengkulu.
                    </p>

                </div>


                {{-- VALIDATION ERROR --}}
                @if ($errors->any())

                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

                        <div class="flex gap-3">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-red-500 shrink-0 mt-0.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 8v4"/>
                                <path d="M12 16h.01"/>
                            </svg>

                            <div>

                                <p class="text-sm font-bold text-red-700">
                                    Periksa kembali data kamu
                                </p>

                                <ul class="mt-2 text-sm text-red-600 space-y-1">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            • {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- REGISTER FORM --}}
                <form
                    method="POST"
                    action="{{ route('register') }}"
                    class="space-y-5"
                >

                    @csrf


                    {{-- NAMA --}}
                    <div>

                        <label
                            for="name"
                            class="block text-sm font-semibold text-[#29251f] mb-2"
                        >
                            Nama Lengkap
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-[#a28d73]"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <path d="M20 21a8 8 0 0 0-16 0"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>

                            </div>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Masukkan nama lengkap"
                                class="w-full rounded-xl border-[#d8cbbb] bg-[#fffdf9] py-3.5 pl-12 pr-4 text-[#29251f] placeholder:text-gray-400 focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                            >

                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div>

                        <label
                            for="email"
                            class="block text-sm font-semibold text-[#29251f] mb-2"
                        >
                            Email
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-[#a28d73]"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <rect
                                        width="20"
                                        height="16"
                                        x="2"
                                        y="4"
                                        rx="2"
                                    />

                                    <path d="m22 7-8.97 5.7a2 2 0 0 1-2.06 0L2 7"/>
                                </svg>

                            </div>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                placeholder="nama@email.com"
                                class="w-full rounded-xl border-[#d8cbbb] bg-[#fffdf9] py-3.5 pl-12 pr-4 text-[#29251f] placeholder:text-gray-400 focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                            >

                        </div>

                    </div>


                    {{-- PASSWORD --}}
                    <div>

                        <label
                            for="password"
                            class="block text-sm font-semibold text-[#29251f] mb-2"
                        >
                            Password
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-[#a28d73]"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <rect
                                        width="18"
                                        height="11"
                                        x="3"
                                        y="11"
                                        rx="2"
                                    />

                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>

                            </div>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Minimal 8 karakter"
                                class="w-full rounded-xl border-[#d8cbbb] bg-[#fffdf9] py-3.5 pl-12 pr-4 text-[#29251f] placeholder:text-gray-400 focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                            >

                        </div>

                    </div>


                    {{-- KONFIRMASI PASSWORD --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="block text-sm font-semibold text-[#29251f] mb-2"
                        >
                            Konfirmasi Password
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-[#a28d73]"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <path d="M9 12l2 2 4-4"/>
                                    <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>

                            </div>

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Masukkan ulang password"
                                class="w-full rounded-xl border-[#d8cbbb] bg-[#fffdf9] py-3.5 pl-12 pr-4 text-[#29251f] placeholder:text-gray-400 focus:border-[#8b6b45] focus:ring-[#8b6b45]"
                            >

                        </div>

                    </div>


                    {{-- REGISTER BUTTON --}}
                    <button
                        type="submit"
                        class="w-full mt-2 inline-flex items-center justify-center gap-2 rounded-xl bg-[#29251f] px-5 py-3.5 text-white font-bold shadow-sm hover:bg-[#8b6b45] hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#8b6b45] focus:ring-offset-2"
                    >

                        Buat Akun

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>
                        </svg>

                    </button>

                </form>


                {{-- LOGIN --}}
                <div class="mt-7 pt-6 border-t border-[#eee4d7] text-center">

                    <p class="text-sm text-gray-500">
                        Sudah punya akun?
                    </p>

                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center justify-center mt-2 font-bold text-[#8b6b45] hover:text-[#29251f] transition"
                    >
                        Masuk ke akun
                        <span class="ml-1">
                            →
                        </span>
                    </a>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="text-center mt-6">

                <a
                    href="{{ route('home') }}"
                    class="text-sm text-gray-500 hover:text-[#8b6b45] transition"
                >
                    ← Kembali ke BengkuluKita
                </a>

            </div>

        </div>

    </div>

</body>

</html>