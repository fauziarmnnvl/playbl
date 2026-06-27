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

        <form method="POST" action="{{ route('booking.storeDurasi') }}" x-data="{ session:'{{ old('jenis_sesi',session('booking.jenis_sesi')) }}',duration:'{{ old('durasi',session('booking.durasi')) }}'}">
            @csrf
            <input type="hidden" name="jenis_sesi" :value="session">
            <input type="hidden" name="durasi" :value="duration">

            {{-- SESI WAKTU TETAP --}}
            <div
                @click="session='tetap'"
                :class="session === 'tetap'
                    ? 'border-blue-500 bg-blue-900/20 shadow-[0_0_25px_rgba(59,130,246,0.35)]'
                    : 'border-slate-700 bg-slate-800/30'"
                class="rounded-3xl border p-6 mb-5 cursor-pointer
                transition-all duration-300

                hover:border-blue-500
                hover:bg-blue-900/10
                hover:shadow-[0_0_25px_rgba(59,130,246,0.25)]
                hover:-translate-y-1">

                <div class="flex items-start gap-4">

                    <div class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center text-white">

                        <i class="bi bi-clock-history text-2xl"></i>

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

                        <p class="text-slate-400">
                            Pilih durasi pasti. Cocok untuk yang sudah punya rencana waktu.
                        </p>

                        <div
                            x-show="session === 'tetap'"
                            x-transition
                            class="mt-5">

                            <div class="grid grid-cols-2 gap-4">
                                {{-- 1 Jam --}}
                                <label class="cursor-pointer relative">

                                    <input
                                        type="radio"
                                        value="60"
                                        x-model="duration"
                                        @click.stop
                                        class="hidden">

                                    <div
                                        :class="duration === '60'
                                            ? 'border-blue-500 bg-blue-900/30'
                                            : 'border-slate-700'"
                                        class="border rounded-2xl p-5 text-center hover:border-blue-500 transition">

                                        <h4 class="text-xl font-bold text-white">
                                            1 Jam
                                        </h4>

                                        <p class="text-slate-400 mt-2">
                                            Rp 15.000
                                        </p>

                                    </div>
                                </label>

                                {{-- 2 Jam --}}
                                <label class="cursor-pointer relative">

                                    <input
                                        type="radio"
                                        value="120"
                                        x-model="duration"
                                        @click.stop
                                        class="hidden">

                                    <div
                                        :class="duration === '120'
                                            ? 'border-blue-500 bg-blue-900/30'
                                            : 'border-slate-700'"
                                        class="border rounded-2xl p-5 text-center hover:border-blue-500 transition">

                                        <h4 class="text-xl font-bold text-white">
                                            2 Jam
                                        </h4>

                                        <p class="text-slate-400 mt-2">
                                            Rp 30.000
                                        </p>

                                    </div>
                                </label>

                                {{-- 3 Jam --}}
                                <label class="cursor-pointer relative">

                                    <input
                                        type="radio"
                                        value="180"
                                        x-model="duration"
                                        @click.stop
                                        class="hidden">

                                    <div
                                        :class="duration === '180'
                                            ? 'border-blue-500 bg-blue-900/30'
                                            : 'border-slate-700'"
                                        class="border rounded-2xl p-5 text-center hover:border-blue-500 transition">

                                        <h4 class="text-xl font-bold text-white">
                                            3 Jam
                                        </h4>

                                        <p class="text-slate-400 mt-2">
                                            Rp 45.000
                                        </p>

                                    </div>
                                </label>

                                {{-- 4 Jam --}}
                                <label class="cursor-pointer relative">

                                    <input
                                        type="radio"
                                        value="240"
                                        x-model="duration"
                                        @click.stop
                                        class="hidden">

                                    <div
                                        :class="duration === '240'
                                            ? 'border-blue-500 bg-blue-900/30'
                                            : 'border-slate-700'"
                                        class="border rounded-2xl p-5 text-center hover:border-blue-500 transition">

                                        <h4 class="text-xl font-bold text-white">
                                            4 Jam
                                        </h4>

                                        <p class="text-slate-400 mt-2">
                                            Rp 60.000
                                        </p>

                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SESI FLEKSIBEL --}}
            <div
                @click="session='fleksibel'"
                :class="session === 'fleksibel'
                    ? 'border-purple-500 bg-purple-900/20 shadow-[0_0_25px_rgba(168,85,247,0.35)]'
                    : 'border-slate-700 bg-slate-800/30'"
                class="rounded-3xl border p-6 cursor-pointer

                transition-all duration-300 ease-out

                hover:border-purple-500
                hover:bg-purple-900/10
                hover:shadow-[0_0_25px_rgba(168,85,247,0.25)]
                hover:-translate-y-1">

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-purple-600 flex items-center justify-center text-white">
                        <i class="bi bi-lightning-charge-fill text-2xl"></i>
                    </div>

                    <div class="flex-1">

                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-2xl font-bold text-white">
                                Sesi Fleksibel
                            </h3>
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-600 text-white">
                                Bayar di Akhir
                            </span>
                        </div>

                        <p class="text-slate-400 mb-4">
                            Main tanpa batas waktu. Biaya dihitung otomatis berdasarkan lama bermain.
                        </p>

                        <div
                            x-show="session === 'fleksibel'"
                            x-transition
                            class="mt-4">

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
            </div>

            @error('jenis_sesi')
            <p class="text-red-400 text-sm mt-3">
                {{ $message }}
            </p>
            @enderror

            @error('durasi')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
            @enderror

            {{-- Footer --}}
            <div class="border-t border-slate-800 mt-8 pt-8 flex justify-between">

                <a href="{{ route('booking.playbox') }}"
                    class="px-6 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition">
                    ← Kembali
                </a>

                <button type="submit" :disabled="!session || (session=='tetap' && !duration)"
                    :class="!session || (session=='tetap' && !duration)? 'opacity-50 cursor-not-allowed' : 'hover:scale-105'"
                    class="px-10 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg transition-all duration-300">
                    Lanjut →
                </button>
            </div>
        </form>
    </div>
</section>