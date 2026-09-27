<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk - BengkuluKita</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="min-h-screen bg-[#f7f0e4]">

<div class="min-h-screen grid lg:grid-cols-2">


    {{-- =====================================================
        LEFT - VISUAL BENGKULU
    ====================================================== --}}
    <div
        class="relative
               hidden lg:flex
               min-h-screen
               overflow-hidden
               items-end"
    >

        {{-- FOTO BAY TAT --}}
        <img
            src="{{ asset('images/bay-tat.jpg') }}"
            alt="Kue khas Bengkulu"
            class="absolute inset-0
                   w-full h-full
                   object-cover"
        >

        {{-- FOTO ANAK TAT --}}
        <div
            class="absolute
                   top-0
                   right-0
                   w-[45%]
                   h-[48%]
                   overflow-hidden
                   rounded-bl-[4rem]
                   opacity-80"
        >

            <img
                src="{{ asset('images/anak-tat.jpg') }}"
                alt="Anak Tat Bengkulu"
                class="w-full h-full object-cover"
            >

        </div>


        {{-- FOTO LEMPUK --}}
        <div
            class="absolute
                   bottom-0
                   right-[8%]
                   w-[35%]
                   h-[32%]
                   overflow-hidden
                   rounded-t-3xl
                   border-4
                   border-[#f7f0e4]/30
                   shadow-2xl"
        >

            <img
                src="{{ asset('images/lempuk-durian.jpg') }}"
                alt="Lempuk Durian Bengkulu"
                class="w-full h-full object-cover"
            >

        </div>


        {{-- OVERLAY --}}
        <div
            class="absolute inset-0
                   bg-gradient-to-t
                   from-[#29251f]/95
                   via-[#29251f]/55
                   to-[#29251f]/25"
        ></div>


        {{-- TEXT --}}
        <div
            class="relative z-10
                   p-10 xl:p-14
                   text-white
                   max-w-2xl"
        >

            <div
                class="w-14 h-14
                       rounded-2xl
                       bg-[#f5e7c7]
                       flex items-center justify-center
                       overflow-hidden
                       mb-6"
            >

                <img
                    src="{{ asset('images/logo-kue.png') }}"
                    alt="Logo BengkuluKita"
                    class="w-[78%] h-[78%] object-contain"
                >

            </div>


            <p
                class="text-xs
                       uppercase
                       tracking-[0.3em]
                       font-extrabold
                       text-[#f5e7c7]"
            >
                BENGKULUKITA
            </p>


            <h1
                class="mt-3
                       text-4xl
                       xl:text-5xl
                       font-extrabold
                       leading-tight"
            >
                Kenali Bengkulu,
                <br>
                cintai produknya.
            </h1>


            <p
                class="mt-5
                       text-base
                       leading-relaxed
                       text-white/70
                       max-w-lg"
            >
                Temukan berbagai makanan khas, oleh-oleh,
                kerajinan, minuman, dan camilan khas Bengkulu
                dalam satu tempat.
            </p>

        </div>

    </div>



    {{-- =====================================================
        RIGHT - LOGIN
    ====================================================== --}}
    <div
        class="min-h-screen
               flex items-center justify-center
               px-5 py-10
               bg-[#f7f0e4]"
    >

        <div class="w-full max-w-md">

            {{-- LOGO --}}
            <div class="text-center mb-8">

                <div
                    class="inline-flex
                           w-16 h-16
                           rounded-2xl
                           bg-[#f5e7c7]
                           border border-[#dfcfb8]
                           items-center justify-center
                           overflow-hidden
                           shadow-md"
                >

                    <img
                        src="{{ asset('images/logo-kue.png') }}"
                        alt="Logo BengkuluKita"
                        class="w-[78%] h-[78%] object-contain"
                    >

                </div>


                <h2
                    class="mt-4
                           text-3xl
                           font-extrabold"
                >
                    BengkuluKita
                </h2>

                <p
                    class="mt-1
                           text-sm
                           text-[#8b6b45]"
                >
                    Pusatnya Oleh-Oleh Bengkulu
                </p>

            </div>



            {{-- CARD --}}
            <div
                class="bg-white
                       rounded-[2rem]
                       border border-[#e3d8c9]
                       shadow-[0_20px_60px_rgba(70,50,30,0.10)]
                       p-7 sm:p-8"
            >

                <div class="mb-7">

                    <h3
                        class="text-2xl
                               font-extrabold"
                    >
                        Masuk
                    </h3>

                    <p
                        class="mt-2
                               text-sm
                               text-gray-500"
                    >
                        Masuk untuk melanjutkan belanja di BengkuluKita.
                    </p>

                </div>


                @if ($errors->any())

                    <div
                        class="mb-6
                               rounded-2xl
                               border border-red-200
                               bg-red-50
                               p-4"
                    >

                        <p
                            class="text-sm
                                   font-bold
                                   text-red-700"
                        >
                            Periksa kembali data kamu
                        </p>

                        <ul
                            class="mt-2
                                   text-sm
                                   text-red-600
                                   space-y-1"
                        >

                            @foreach ($errors->all() as $error)

                                <li>
                                    • {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="space-y-5"
                >

                    @csrf


                    {{-- EMAIL --}}
                    <div>

                        <label
                            for="email"
                            class="block
                                   text-sm
                                   font-bold
                                   mb-2"
                        >
                            Email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="nama@email.com"
                            class="w-full
                                   rounded-xl
                                   border border-[#ddd0bd]
                                   bg-[#fffaf3]
                                   px-4 py-3
                                   text-sm
                                   focus:border-[#8b6b45]
                                   focus:ring-[#8b6b45]
                                   transition"
                        >

                    </div>


                    {{-- PASSWORD --}}
                    <div>

                        <label
                            for="password"
                            class="block
                                   text-sm
                                   font-bold
                                   mb-2"
                        >
                            Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan password"
                            class="w-full
                                   rounded-xl
                                   border border-[#ddd0bd]
                                   bg-[#fffaf3]
                                   px-4 py-3
                                   text-sm
                                   focus:border-[#8b6b45]
                                   focus:ring-[#8b6b45]
                                   transition"
                        >

                    </div>


                    <button
                        type="submit"
                        class="w-full
                               rounded-xl
                               bg-[#29251f]
                               text-white
                               py-3.5
                               font-extrabold
                               hover:bg-[#8b6b45]
                               hover:-translate-y-0.5
                               hover:shadow-lg
                               transition-all duration-200"
                    >
                        Masuk
                    </button>

                </form>


                <div
                    class="mt-7
                           pt-6
                           border-t border-[#eee4d7]
                           text-center"
                >

                    <p
                        class="text-sm
                               text-gray-500"
                    >
                        Belum punya akun?
                    </p>

                    <a
                        href="{{ route('register') }}"
                        class="inline-block
                               mt-2
                               font-extrabold
                               text-[#8b6b45]
                               hover:text-[#29251f]
                               transition"
                    >
                        Buat akun →
                    </a>

                </div>

            </div>


            <div class="text-center mt-6">

                <a
                    href="{{ route('home') }}"
                    class="text-sm
                           text-gray-500
                           hover:text-[#8b6b45]
                           transition"
                >
                    ← Kembali ke BengkuluKita
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>