<section class="min-h-screen flex flex-col items-center py-20 px-4">

    {{-- Title --}}
    <div class="text-center py-10">
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

            {{-- Base Line --}}
            <div class="absolute top-5 left-0 w-full h-[3px] bg-[#08152D]"></div>

            {{-- Active Line --}}
            <div class="absolute top-5 left-0 w-[40%] h-[3px] bg-gradient-to-r from-purple-500 to-blue-500"></div>

            {{-- Step 1 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white flex items-center justify-center font-semibold">
                    1
                </div>
                <span class="mt-3 text-sm text-slate-400">Info</span>
            </div>

            {{-- Step 2 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white flex items-center justify-center font-semibold">
                    2
                </div>
                <span class="mt-3 text-sm text-slate-400">Cabang</span>
            </div>

            {{-- Step 3 Active --}}
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white flex items-center justify-center font-semibold shadow-lg">
                    3
                </div>
                <span class="mt-3 text-sm text-slate-400">Playbox</span>
            </div>

            {{-- Step 4 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-[#08152D] text-white flex items-center justify-center font-semibold">
                    4
                </div>
                <span class="mt-3 text-sm text-slate-400">Durasi</span>
            </div>

            {{-- Step 5 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-[#08152D] text-white flex items-center justify-center font-semibold">
                    5
                </div>
                <span class="mt-3 text-sm text-slate-400">Review</span>
            </div>

            {{-- Step 6 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-[#08152D] text-white flex items-center justify-center font-semibold">
                    6
                </div>
                <span class="mt-3 text-sm text-slate-400">Bayar</span>
            </div>

        </div>
    </div>

    {{-- Card --}}
    <div class="w-full max-w-3xl bg-[#041233] rounded-3xl p-8 shadow-xl border border-slate-800">

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
                    d="M9.75 17L9 20l-1.5-3H4a1 1 0 01-1-1V5a1 1 0 011-1h16a1 1 0 011 1v11a1 1 0 01-1 1H9.75z"/>
            </svg>

            Pilih Playbox
        </h2>

        <form>

            <div class="grid grid-cols-4 gap-4">

                {{-- PB1 --}}
                <label class="cursor-pointer">
                    <input type="radio" name="playbox" class="hidden">

                    <div class="border border-slate-700 rounded-2xl h-32 flex flex-col items-center justify-center text-white hover:border-blue-500 transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10 text-slate-400 mb-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9.75 17L9 20h6l-.75-3M5 4h14a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"/>
                        </svg>

                        <span class="font-semibold">PB1</span>
                    </div>
                </label>

                {{-- PB2 --}}
                <label class="cursor-pointer">
                    <input type="radio" name="playbox" class="hidden">

                    <div class="border border-slate-700 rounded-2xl h-32 flex flex-col items-center justify-center text-white hover:border-blue-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10 text-slate-400 mb-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9.75 17L9 20h6l-.75-3M5 4h14a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"/>
                        </svg>
                        <span class="font-semibold">PB2</span>
                    </div>
                </label>

                {{-- PB3 Used --}}
                <div class="relative opacity-50">

                    <span class="absolute top-2 right-2 text-xs px-2 py-1 bg-red-900 text-red-300 rounded-full">
                        Used
                    </span>

                    <div class="border border-slate-700 rounded-2xl h-32 flex flex-col items-center justify-center text-white">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10 text-slate-500 mb-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9.75 17L9 20h6l-.75-3M5 4h14a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"/>
                        </svg>

                        <span class="font-semibold">PB3</span>
                    </div>
                </div>

                {{-- PB4 Active --}}
                <label class="cursor-pointer">

                    <input type="radio"
                        name="playbox"
                        checked
                        class="hidden">

                    <div class="border border-blue-500 bg-blue-900/30 shadow-[0_0_20px_rgba(59,130,246,0.4)] rounded-2xl h-32 flex flex-col items-center justify-center text-white">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10 text-blue-400 mb-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9.75 17L9 20h6l-.75-3M5 4h14a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"/>
                        </svg>

                        <span class="font-semibold">PB4</span>
                    </div>
                </label>

                {{-- Baris 2 --}}
                @for ($i = 5; $i <= 8; $i++)
                    <label class="cursor-pointer">
                        <input type="radio" name="playbox" class="hidden">

                        <div class="border border-slate-700 rounded-2xl h-32 flex flex-col items-center justify-center text-white hover:border-blue-500 transition">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-10 h-10 text-slate-400 mb-2"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9.75 17L9 20h6l-.75-3M5 4h14a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"/>
                            </svg>

                            <span class="font-semibold">PB{{ $i }}</span>

                        </div>
                    </label>
                @endfor

            </div>

            {{-- Footer --}}
            <div class="border-t border-slate-800 mt-8 pt-8 flex justify-between">

                <a href="{{ route('booking.cabang') }}"
                    class="px-6 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition">
                    ← Kembali
                </a>

                <a href="{{ route('booking.durasi') }}"
                    class="px-10 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition">
                    Lanjut →
                </a>

            </div>

        </form>

    </div>

</section>