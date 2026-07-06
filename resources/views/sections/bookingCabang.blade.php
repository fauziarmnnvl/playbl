<section class="min-h-screen flex flex-col items-center py-20 px-4">

    {{-- Title --}}
    <div class="py-10 md:py-20 text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-white">
            Book <span
                class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(139,92,246,0.5)]">Playbox</span>
        </h1>
    </div>

    {{-- Progress Step --}}
    <div class="w-full max-w-4xl mb-10 md:mb-12">
        <div class="relative flex justify-between items-center">

            <div class="absolute top-4 md:top-5 left-0 w-full h-[3px] bg-[#0A1733]">
                <div class="w-1/5 h-full bg-gradient-to-r from-purple-500 to-blue-500"></div>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-11 md:h-11 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    1
                </div>
                <span class="mt-2 md:mt-3 text-xs md:text-sm text-slate-400 hidden sm:block">Info</span>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-11 md:h-11 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    2
                </div>
                <span class="mt-2 md:mt-3 text-xs md:text-sm text-slate-400 hidden sm:block">Cabang</span>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-11 md:h-11 rounded-full bg-[#09152F] text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    3
                </div>
                <span class="mt-2 md:mt-3 text-xs md:text-sm text-slate-400 hidden sm:block">Playbox</span>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-11 md:h-11 rounded-full bg-[#09152F] text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    4
                </div>
                <span class="mt-2 md:mt-3 text-xs md:text-sm text-slate-400 hidden sm:block">Durasi</span>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-11 md:h-11 rounded-full bg-[#09152F] text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    5
                </div>
                <span class="mt-2 md:mt-3 text-xs md:text-sm text-slate-400 hidden sm:block">Review</span>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-11 md:h-11 rounded-full bg-[#09152F] text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    6
                </div>
                <span class="mt-2 md:mt-3 text-xs md:text-sm text-slate-400 hidden sm:block">Bayar</span>
            </div>      
        </div>
    </div>

    {{-- Card --}}
    <div class="w-full max-w-3xl bg-[#041233] rounded-3xl p-6 md:p-8 shadow-xl">

        <h2 class="text-2xl md:text-3xl font-bold text-white mb-6 md:mb-8 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7" />
            </svg>

            Pilih Cabang
        </h2>

        <form method="POST" action="{{ route('booking.storeCabang') }}" x-data="{ branch: '{{ old('branch', session('booking.id_cabang')) }}'}">
            @csrf

            <div class="space-y-5">
                @foreach($cabangs as $cabang)
                            <label @if(!$cabang->status_buka) style="opacity:0.5; cursor:not-allowed;" @endif
                                @click="{{ $cabang->status_buka ? "branch='" . $cabang->id_cabang . "'" : '' }}" :class="branch === '{{ $cabang->id_cabang }}'
                                    ? 'border-blue-500 bg-blue-900/40 shadow-[0_0_20px_rgba(59,130,246,0.35)]'
                                    : '{{ $cabang->status_buka
                    ? 'border-slate-700 hover:border-blue-400 hover:bg-blue-900/20 hover:shadow-[0_0_12px_rgba(59,130,246,0.25)]'
                    : 'border-slate-700'
                                        }}'"
                                class="block rounded-2xl border p-5 md:p-8 text-white font-semibold text-lg md:text-xl transition-all duration-300 {{ $cabang->status_buka ? 'cursor-pointer' : '' }}">

                                <input type="radio" name="branch" value="{{ $cabang->id_cabang }}" x-model="branch" class="hidden"
                                    {{ !$cabang->status_buka ? 'disabled' : '' }}>

                                <div class="flex justify-between items-center">

                                    <span>
                                        {{ $cabang->nama_cabang }}
                                    </span>

                                    @if(!$cabang->status_buka)
                                        <span class="text-red-400 text-sm">
                                            Nonaktif
                                        </span>
                                    @endif
                                </div>
                            </label>
                @endforeach
            </div>
            @error('branch')
                <p class="text-red-400 text-sm mt-3">
                    {{ $message }}
                </p>
            @enderror

            {{-- Footer --}}
            <div class="border-t border-slate-800 mt-8 md:mt-10 pt-6 md:pt-8 flex flex-col-reverse sm:flex-row justify-between gap-4">
                <a href="{{ route('booking.info') }}"
                    class="w-full sm:w-auto text-center px-6 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition">
                    ← Kembali
                </a>

                <button type="submit" :disabled="!branch" :class="!branch
                        ? 'opacity-50 cursor-not-allowed'
                        : 'hover:scale-105'"
                    class="w-full sm:w-auto text-center px-10 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg transition-all duration-300">

                    Lanjut →
                </button>
            </div>
        </form>
    </div>
</section>