<a
    href="{{ route('home') }}"
    class="inline-flex items-center gap-3 group"
>
    {{-- Logo --}}
    <div
        class="w-11 h-11
               rounded-2xl
               bg-[#f5e7c7]
               border border-[#e2d5c3]
               flex items-center justify-center
               overflow-hidden
               shadow-sm
               group-hover:-translate-y-1
               group-hover:shadow-md
               transition-all duration-200"
    >
        <img
            src="{{ asset('images/logo-kue.png') }}"
            alt="Logo BengkuluKita"
            class="w-8 h-8 object-contain"
        >
    </div>

    {{-- Nama brand --}}
    <div class="leading-tight">
        <div
            class="text-xl font-extrabold
                   tracking-tight
                   text-[#29251f]
                   group-hover:text-[#8b6b45]
                   transition"
        >
            BengkuluKita
        </div>

        <div
            class="text-[10px]
                   uppercase
                   tracking-[0.18em]
                   font-semibold
                   text-[#8b6b45]"
        >
            Oleh-Oleh Bengkulu
        </div>
    </div>
</a>