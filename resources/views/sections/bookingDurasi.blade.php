<section class="min-h-screen flex flex-col items-center py-20 px-4">

    {{-- Title --}}
    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold text-white">
            Book
            <span class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                Playbox
            </span>
        </h1>
    </div>

    {{-- Progress --}}
    <div class="w-full max-w-5xl mb-12">
        <div class="relative flex justify-between items-center">

            <div class="absolute top-5 left-0 w-full h-[3px] bg-[#08152D]"></div>
            <div class="absolute top-5 left-0 w-[60%] h-[3px] bg-gradient-to-r from-purple-500 to-blue-500"></div>

            @for($i = 1; $i <= 6; $i++)
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-11 h-11 rounded-full {{ $i <= 4 ? 'bg-gradient-to-r from-purple-500 to-blue-500' : 'bg-[#08152D]' }} text-white flex items-center justify-center font-semibold">
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
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            Pilih Durasi
        </h2>

        <form>

            {{-- SESI WAKTU TETAP --}}
            <div class="rounded-3xl border border-blue-500 bg-blue-900/20 p-6 shadow-[0_0_25px_rgba(59,130,246,0.35)] mb-5">

                <div class="flex items-start gap-4">

                    <div class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center text-white">
                        ⏰
                    </div>

                    <div class="flex-1">

                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-2xl font-bold text-white">
                                Sesi Waktu Tetap
                            </h3>

                            <span class="px-3 py-1 text-xs rounded-full bg-blue-600 text-white">
                                Bayar di Awal
                            </span>
                        </div>

                        <p class="text-slate-400 mb-5">
                            Pilih durasi pasti. Cocok untuk yang sudah punya rencana waktu.
                        </p>

                        <div class="grid grid-cols-2 gap-4">

                            {{-- 1 Jam --}}
                            <label class="cursor-pointer">
                                <input type="radio"
                                    name="duration"
                                    value="1-jam"
                                    class="hidden">

                                <div class="border border-slate-700 rounded-2xl p-5 text-center hover:border-blue-500 transition">

                                    <h4 class="text-xl font-bold text-white">
                                        1 Jam
                                    </h4>

                                    <p class="text-slate-400 mt-2">
                                        Rp 25.000
                                    </p>

                                </div>
                            </label>

                            {{-- 2 Jam --}}
                            <label class="cursor-pointer relative">

                                <span class="absolute -top-3 right-4 bg-yellow-500 text-black text-xs px-3 py-1 rounded-full font-semibold">
                                    Populer
                                </span>

                                <input type="radio"
                                    name="duration"
                                    value="2-jam"
                                    class="hidden">

                                <div class="border border-slate-700 rounded-2xl p-5 text-center hover:border-blue-500 transition">

                                    <h4 class="text-xl font-bold text-white">
                                        2 Jam
                                    </h4>

                                    <p class="text-slate-400 mt-2">
                                        Rp 45.000
                                    </p>

                                </div>
                            </label>

                        </div>

                    </div>

                </div>

            </div>

            {{-- SESI FLEKSIBEL --}}
            <div class="rounded-3xl border border-slate-700 bg-slate-800/30 p-6">

                <div class="flex items-start gap-4">

                    <div class="w-12 h-12 rounded-xl bg-slate-700 flex items-center justify-center text-white text-xl">
                        ∞
                    </div>

                    <div class="flex-1">

                        <div class="flex items-center gap-3 mb-2">

                            <h3 class="text-2xl font-bold text-white">
                                Sesi Fleksibel
                            </h3>

                            <span class="px-3 py-1 text-xs rounded-full bg-purple-600 text-white">
                                Bayar di Akhir
                            </span>

                        </div>

                        <p class="text-slate-400 mb-4">
                            Main tanpa batas waktu. Biaya dihitung otomatis berdasarkan lama bermain.
                        </p>

                        <div class="bg-[#09152D] rounded-2xl p-4">

                            <div class="text-white font-semibold mb-3">
                                Tarif: Rp 395 / menit
                            </div>

                            <div class="flex justify-between text-sm text-slate-400">

                                <span>30m = Rp 11.850</span>
                                <span>1j = Rp 23.700</span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div class="border-t border-slate-800 mt-8 pt-8 flex justify-between">

                <a href="{{ route('booking.playbox') }}"
                    class="px-6 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition">
                    ← Kembali
                </a>

                <a href="{{ route('booking.review') }}"
                    class="px-10 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition">
                    Lanjut →
                </a>

            </div>

        </form>

    </div>

</section>