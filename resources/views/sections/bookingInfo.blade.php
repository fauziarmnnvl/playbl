<section class="min-h-screen flex flex-col items-center justify-center px-4 py-20">

    {{-- Title --}}
    <div class="text-center py-10 md:py-20">
        <h1 class="text-3xl md:text-5xl font-bold text-white">
            Book <span class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(139,92,246,0.5)]">Playbox</span>
        </h1>
    </div>

    {{-- Step Progress --}}
    <div class="w-full max-w-5xl mb-10 md:mb-14">
        <div class="flex items-center justify-between relative">

            <div class="absolute top-4 md:top-5 left-0 w-full h-[3px] bg-slate-800"></div>

            {{-- Step 1 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white flex items-center justify-center font-semibold shadow-lg text-sm md:text-base">
                    1
                </div>
                <span class="text-xs md:text-sm text-slate-400 mt-2 md:mt-3 hidden sm:block">Info</span>
            </div>

            {{-- Step 2 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    2
                </div>
                <span class="text-xs md:text-sm text-slate-400 mt-2 md:mt-3 hidden sm:block">Cabang</span>
            </div>

            {{-- Step 3 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    3
                </div>
                <span class="text-xs md:text-sm text-slate-400 mt-2 md:mt-3 hidden sm:block">Playbox</span>
            </div>

            {{-- Step 4 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    4
                </div>
                <span class="text-xs md:text-sm text-slate-400 mt-2 md:mt-3 hidden sm:block">Durasi</span>
            </div>

            {{-- Step 5 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    5
                </div>
                <span class="text-xs md:text-sm text-slate-400 mt-2 md:mt-3 hidden sm:block">Review</span>
            </div>

            {{-- Step 6 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold text-sm md:text-base">
                    6
                </div>
                <span class="text-xs md:text-sm text-slate-400 mt-2 md:mt-3 hidden sm:block">Bayar</span>
            </div>

        </div>
    </div>

    {{-- Form Card --}}
    <div
        class="w-full max-w-3xl bg-[#06153d] rounded-3xl border border-slate-800 shadow-xl p-6 md:p-10">

        <h2 class="text-2xl md:text-3xl font-bold text-white mb-8 md:mb-10 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-7 h-7 text-blue-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M16 14a4 4 0 10-8 0m8 0a4 4 0 11-8 0m8 0v1a2 2 0 002 2h1m-11-3v1a2 2 0 01-2 2H5"/>
            </svg>

            Informasi Pemain
        </h2>

        <form method="POST" action="{{ route('booking.storeInfo') }}" x-data="{nama: '{{ session('booking.nama') }}',no_hp: '{{ session('booking.no_hp') }}'}">
            @csrf
            {{-- Nama --}}
            <div class="mb-7">
                <label class="block text-white font-medium mb-2">
                    Nama Lengkap
                </label>
                <input type="text" name="nama" x-model="nama" value="{{ session('booking.nama') }}" placeholder="Masukkan nama kamu" class="w-full h-14 px-5 rounded-xl bg-slate-800/60 border border-slate-700 text-white placeholder-slate-500 hover:border-blue-400 focus:outline-none focus:border-blue-500">
                @error('nama')
                    <p class="text-red-400 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- WhatsApp --}}
            <div class="mb-10">
                <label class="block text-white font-medium mb-2">
                    Nomor WhatsApp
                </label>
                <input type="text" name="no_hp" x-model="no_hp" value="{{ session('booking.no_hp') }}" placeholder="081234567890" class="w-full h-14 px-5 rounded-xl bg-slate-800/60 border border-slate-700 text-white placeholder-slate-500 hover:border-blue-400 focus:outline-none focus:border-blue-500">
                @error('no_hp')
                <p class="text-red-400 text-sm mt-2">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="border-t border-slate-800 pt-8 flex justify-end">

                <button type="submit" :disabled="nama.trim()=='' || no_hp.trim()==''" :class="nama.trim()=='' || no_hp.trim()=='' ? 'opacity-50 cursor-not-allowed' : 'hover:scale-105'"
                    class="w-full sm:w-auto px-10 py-4 rounded-full text-white font-semibold bg-gradient-to-r from-purple-500 to-blue-500 transition-all duration-300 shadow-lg text-center">
                    Lanjut →
                </button>
            </div>
        </form>
    </div>
</section>