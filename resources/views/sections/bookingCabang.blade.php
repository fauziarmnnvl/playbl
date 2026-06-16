<section class="min-h-screen flex flex-col items-center py-20 px-4">

    {{-- Title --}}
    <div class="py-10">
        <h1 class="text-5xl font-bold text-white">
            Book <span class="text-indigo-500">Playbox</span>
        </h1>
    </div>

    {{-- Progress Step --}}
    <div class="w-full max-w-4xl mb-12">
        <div class="relative flex justify-between items-center">

            <div class="absolute top-5 left-0 w-full h-[3px] bg-[#0A1733]">
                <div class="w-1/5 h-full bg-gradient-to-r from-purple-500 to-blue-500"></div>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white flex items-center justify-center font-semibold">
                    1
                </div>
                <span class="mt-3 text-sm text-slate-400">Info</span>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white flex items-center justify-center font-semibold">
                    2
                </div>
                <span class="mt-3 text-sm text-slate-400">Cabang</span>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-[#09152F] text-white flex items-center justify-center font-semibold">
                    3
                </div>
                <span class="mt-3 text-sm text-slate-400">Playbox</span>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-[#09152F] text-white flex items-center justify-center font-semibold">
                    4
                </div>
                <span class="mt-3 text-sm text-slate-400">Durasi</span>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-[#09152F] text-white flex items-center justify-center font-semibold">
                    5
                </div>
                <span class="mt-3 text-sm text-slate-400">Review</span>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <div class="w-11 h-11 rounded-full bg-[#09152F] text-white flex items-center justify-center font-semibold">
                    6
                </div>
                <span class="mt-3 text-sm text-slate-400">Bayar</span>
            </div>

        </div>
    </div>

    {{-- Card --}}
    <div class="w-full max-w-3xl bg-[#041233] rounded-3xl p-8 shadow-xl">

        <h2 class="text-3xl font-bold text-white mb-8 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6 text-blue-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7" />
            </svg>

            Pilih Cabang
        </h2>

        <form method="GET"
            action="{{ route('booking.playbox') }}"
            x-data="{ branch: '' }">

            <div class="space-y-5">

                {{-- NUD HOUSE --}}
                <label
                    @click="branch='nud-house'"
                    :class="branch === 'nud-house'
                        ? 'border-blue-500 bg-blue-900/40 shadow-[0_0_20px_rgba(59,130,246,0.35)]'
                        : 'border-slate-700'"
                    class="block cursor-pointer rounded-2xl border p-8 text-white font-semibold text-xl transition-all duration-300">

                    <input
                        type="radio"
                        name="branch"
                        value="nud-house"
                        x-model="branch"
                        class="hidden">

                    NUD HOUSE
                </label>

                {{-- PALIOSPITI --}}
                <label
                    @click="branch='paliospiti'"
                    :class="branch === 'paliospiti'
                        ? 'border-blue-500 bg-blue-900/40 shadow-[0_0_20px_rgba(59,130,246,0.35)]'
                        : 'border-slate-700'"
                    class="block cursor-pointer rounded-2xl border p-8 text-white font-semibold text-xl transition-all duration-300">

                    <input
                        type="radio"
                        name="branch"
                        value="paliospiti"
                        x-model="branch"
                        class="hidden">

                    Palióspíti Coffee & Roastery
                </label>

                {{-- PIRZY --}}
                <label
                    @click="branch='pirzy'"
                    :class="branch === 'pirzy'
                        ? 'border-blue-500 bg-blue-900/40 shadow-[0_0_20px_rgba(59,130,246,0.35)]'
                        : 'border-slate-700'"
                    class="block cursor-pointer rounded-2xl border p-8 text-white font-semibold text-xl transition-all duration-300">

                    <input
                        type="radio"
                        name="branch"
                        value="pirzy"
                        x-model="branch"
                        class="hidden">

                    Pirzy Coffee
                </label>

                {{-- WAROENG RADEN --}}
                <label
                    @click="branch='waroeng-raden'"
                    :class="branch === 'waroeng-raden'
                        ? 'border-blue-500 bg-blue-900/40 shadow-[0_0_20px_rgba(59,130,246,0.35)]'
                        : 'border-slate-700'"
                    class="block cursor-pointer rounded-2xl border p-8 text-white font-semibold text-xl transition-all duration-300">

                    <input
                        type="radio"
                        name="branch"
                        value="waroeng-raden"
                        x-model="branch"
                        class="hidden">

                    Waroeng Raden
                </label>

            </div>

            {{-- Footer --}}
            <div class="border-t border-slate-800 mt-10 pt-8 flex justify-between">

                <a href="{{ route('booking.info') }}"
                    class="px-6 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition">
                    ← Kembali
                </a>

                <button
                    type="submit"
                    :disabled="!branch"
                    :class="!branch
                        ? 'opacity-50 cursor-not-allowed'
                        : 'hover:scale-105'"
                    class="px-10 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg transition-all duration-300">

                    Lanjut →
                </button>

            </div>

        </form>

    </div>

</section>