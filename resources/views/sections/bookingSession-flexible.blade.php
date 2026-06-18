<section class="flex flex-col items-center pt-40 pb-8 px-4">

    {{-- Player Info --}}
    <div class="w-full max-w-xl bg-[#041233] rounded-3xl px-8 py-6 mb-8 shadow-xl">

        <div class="flex justify-between items-center ">

            <div>
                <p class="text-slate-400 text-sm mb-2">
                    Pemain
                </p>

                <h3 class="text-white text-2xl font-bold">
                    PlayBL
                </h3>
            </div>

            <div class="text-right">

                <p class="text-slate-400 text-sm mb-2">
                    Playbox
                </p>

                <span class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-900/40 text-blue-400 font-semibold">

                    Playbox 04

                </span>

            </div>

        </div>

    </div>

    {{-- Timer Card --}}
    <div class="w-full max-w-xl bg-[#041233] rounded-3xl p-10 text-center shadow-[0_0_80px_rgba(37,99,235,0.15)] mb-8">

        <div class="flex items-center justify-center gap-2 text-blue-400 text-xl mb-8">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/>

            </svg>

            Waktu Bermain

        </div>

        {{-- Timer --}}
        <h1 id="timer"
            class="text-7xl md:text-8xl font-bold text-white tracking-tight mb-10">

            01:00:21

        </h1>

        {{-- Billing --}}
        <div class="bg-slate-800/30 border border-slate-700 rounded-3xl py-8 px-6">

            <p class="text-slate-400 text-lg mb-3">
                Estimasi Tagihan Sementara
            </p>

            <h2 class="text-5xl font-bold text-white mb-4">
                Rp 23.700
            </h2>

            <p class="text-slate-500">
                Tarif : Rp 395/menit
            </p>

        </div>

    </div>

    {{-- End Session Button --}}
    <form 
    action="{{ route('booking.pembayaran.flexible') }}"
    class="mt-6 mb-12 w-full max-w-xl flex justify-center">

        <button
            type="submit"
            onclick="return confirm('Yakin ingin mengakhiri sesi bermain?')"
            class="w-[90%] py-2 rounded-2xl
            border border-red-500/40
            bg-red-900/10
            text-red-400
            font-semibold text-xl
            cursor-pointer
            transition-all duration-300 ease-out

            hover:bg-red-500
            hover:text-white
            hover:border-red-400
            hover:scale-[1.02]

            active:scale-95">

            ⦿ Akhiri Sesi

        </button>

    </form>

</section>

<script>
let seconds = 3621;

function updateTimer() {

    let h = String(Math.floor(seconds / 3600)).padStart(2, '0');
    let m = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
    let s = String(seconds % 60).padStart(2, '0');

    document.getElementById('timer').innerText =
        `${h}:${m}:${s}`;

    seconds++;
}

setInterval(updateTimer, 1000);
</script>