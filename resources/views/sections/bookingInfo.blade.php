<section class="min-h-screen flex flex-col items-center justify-center px-4 py-20">

    {{-- Title --}}
    <div class="text-center py-20">
        <h1 class="text-5xl font-bold text-white">
            Book <span class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(139,92,246,0.5)]">Playbox</span>
        </h1>
    </div>

    {{-- Step Progress --}}
    <div class="w-full max-w-5xl mb-14">
        <div class="flex items-center justify-between relative">

            <div class="absolute top-5 left-0 w-full h-[3px] bg-slate-800"></div>

            {{-- Step 1 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white flex items-center justify-center font-semibold shadow-lg">
                    1
                </div>
                <span class="text-sm text-slate-400 mt-3">Info</span>
            </div>

            {{-- Step 2 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold">
                    2
                </div>
                <span class="text-sm text-slate-400 mt-3">Cabang</span>
            </div>

            {{-- Step 3 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold">
                    3
                </div>
                <span class="text-sm text-slate-400 mt-3">Playbox</span>
            </div>

            {{-- Step 4 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold">
                    4
                </div>
                <span class="text-sm text-slate-400 mt-3">Durasi</span>
            </div>

            {{-- Step 5 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold">
                    5
                </div>
                <span class="text-sm text-slate-400 mt-3">Review</span>
            </div>

            {{-- Step 6 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold">
                    6
                </div>
                <span class="text-sm text-slate-400 mt-3">Bayar</span>
            </div>

        </div>
    </div>

    {{-- Form Card --}}
    <div
        class="w-full max-w-3xl bg-[#06153d] rounded-3xl border border-slate-800 shadow-xl p-10">

        <h2 class="text-3xl font-bold text-white mb-10 flex items-center gap-3">
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

        <form>

            {{-- Nama --}}
            <div class="mb-6">
                <label class="block text-slate-300 mb-3">
                    Nama Lengkap
                </label>

                <input type="text"
                    placeholder="Masukkan nama kamu"
                    class="w-full h-14 px-5 rounded-xl bg-slate-800/60 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500">
            </div>

            {{-- WhatsApp --}}
            <div class="mb-10">
                <label class="block text-slate-300 mb-3">
                    Nomor WhatsApp
                </label>

                <input type="text"
                    placeholder="081234567890"
                    class="w-full h-14 px-5 rounded-xl bg-slate-800/60 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500">
            </div>

            <div class="border-t border-slate-800 pt-8 flex justify-end">

                <a href="{{ route('booking.cabang') }}"
                    class="px-10 py-4 rounded-full text-white font-semibold bg-gradient-to-r from-purple-500 to-blue-500 hover:scale-105 transition-all duration-300 shadow-lg">
                    Lanjut →
                </a>

            </div>

        </form>

    </div>

</section>