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

            {{-- Base Line --}}
            <div class="absolute top-5 left-0 w-full h-[3px] bg-[#08152D]"></div>

            {{-- Active Line --}}
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
    <div class="w-full max-w-3xl bg-[#041233] rounded-3xl border border-slate-800 p-8 shadow-xl">

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

        {{-- Review Box --}}
        <div class="bg-slate-800/40 rounded-3xl p-6 border border-slate-700">

            {{-- Nama --}}
            <div class="flex justify-between py-4 border-b border-slate-700">
                <span class="text-slate-400">Nama</span>
                <span class="text-white font-medium">{{ $booking['nama'] }}</span>
            </div>

            {{-- No. WhatsApp --}}
            <div class="flex justify-between py-4 border-b border-slate-700">
                <span class="text-slate-400">No. WhatsApp</span>
                <span class="text-white font-medium">{{ $booking['no_hp'] }}</span>
            </div>

            {{-- Cabang --}}
            <div class="flex justify-between py-4 border-b border-slate-700">
                <span class="text-slate-400">Cabang</span>
                <span class="text-white font-medium">{{ $booking['cabang']->nama_cabang }}</span>
            </div>

            {{-- Playbox --}}
            <div class="flex justify-between py-4 border-b border-slate-700">
                <span class="text-slate-400">Playbox</span>
                <span class="text-white font-medium">{{ $booking['playbox']->nama_playbox }}</span>
            </div>

            {{-- Durasi --}}
            <div class="flex justify-between py-4 border-b border-slate-700">
                <span class="text-slate-400">Durasi</span>
                <span class="text-white font-medium">{{ $booking['durasi']/60 }} Jam</span>
            </div>

            {{-- Total --}}
            <div class="pt-8">

                <p class="text-slate-400 mb-2">
                    Total Pembayaran
                </p>

                <h3 class="text-5xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                    Rp {{ number_format($booking['total_harga'],0,',','.') }}
                </h3>

            </div>

        </div>

        {{-- Footer --}}
        <div class="border-t border-slate-800 mt-8 pt-8 flex justify-between">

            <a href="{{ route('booking.durasi') }}"
                class="px-6 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition">
                ← Kembali
            </a>

            <a href="{{ route('booking.pembayaran') }}"
                class="px-10 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition">
                Lanjut →
            </a>

        </div>

    </div>

</section>