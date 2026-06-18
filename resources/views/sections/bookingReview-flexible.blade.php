<section class="min-h-screen flex flex-col items-center py-20 px-4">

    {{-- Title --}}
    <div class="text-center py-12">
        <h1 class="text-5xl font-bold text-white">
            Book
            <span class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(139,92,246,0.5)]">
                Playbox
            </span>
        </h1>
    </div>

    {{-- Progress --}}
    <div class="w-full max-w-5xl mb-12">
        <div class="relative flex justify-between items-center">

            <div class="absolute top-5 left-0 w-full h-[3px] bg-[#08152D]"></div>

            <div class="absolute top-5 left-0 w-[80%] h-[3px] bg-gradient-to-r from-purple-500 to-blue-500"></div>

            @for($i = 1; $i <= 6; $i++)
                <div class="relative z-10 flex flex-col items-center">

                    <div class="w-11 h-11 rounded-full {{ $i <= 5 ? 'bg-gradient-to-r from-purple-500 to-blue-500' : 'bg-[#08152D]' }} text-white flex items-center justify-center font-semibold">
                        {{ $i }}
                    </div>

                    <span class="mt-3 text-sm text-slate-400">
                        @switch($i)
                            @case(1) Info @break
                            @case(2) Cabang @break
                            @case(3) Playbox @break
                            @case(4) Durasi @break
                            @case(5) Review @break
                            @case(6) Bayar @break
                        @endswitch
                    </span>

                </div>
            @endfor

        </div>
    </div>

    {{-- Card --}}
    <div class="w-full max-w-3xl bg-[#041233] rounded-3xl border border-slate-800 p-10 shadow-xl">

        {{-- Header --}}
        <h2 class="text-3xl font-bold text-white mb-8 flex items-center gap-3">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-7 h-7 text-blue-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
            </svg>

            Review Booking
        </h2>

        {{-- Detail --}}
        <div class="bg-[#101B35] border border-slate-700 rounded-2xl p-4 mb-8">

            <div class="flex justify-between items-center px-4 py-4 border-b border-slate-700">
                <span class="text-slate-400 text-lg">
                    Playbox
                </span>

                <span class="text-white font-semibold">
                    Playbox 04
                </span>
            </div>

            <div class="flex justify-between items-center px-4 py-4 border-b border-slate-700">
                <span class="text-slate-400 text-lg">
                    Tipe Sesi
                </span>

                <span class="text-white font-semibold">
                    Fleksibel
                </span>
            </div>

            <div class="flex justify-between items-center px-4 py-5">
                <span class="text-slate-400 text-lg">
                    Total Pembayaran
                </span>

                <span class="text-blue-400 font-bold text-2xl">
                    Bayar Nanti
                </span>
            </div>

        </div>

        {{-- Flexible Box --}}
        <div class="border border-blue-500/50 bg-blue-900/20 rounded-2xl p-10 text-center mb-8">

            <div class="text-5xl text-blue-400 mb-5">
                ∞
            </div>

            <h3 class="text-white text-2xl font-bold mb-3">
                Mulai Sesi Fleksibel
            </h3>

            <p class="text-slate-400 max-w-lg mx-auto">
                Kamu tidak perlu membayar sekarang.
                Tagihan akan berjalan otomatis saat kamu mulai bermain.
            </p>

        </div>

        {{-- Footer --}}
        <div class="border-t border-slate-800 pt-8 flex justify-between">

            <a href="{{ route('booking.durasi') }}"
                class="px-8 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition">

                ← Kembali

            </a>

            <a href="{{ route('booking.session.flexible') }}"
                class="px-10 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition">

                Lanjut →

            </a>

        </div>

    </div>

</section>