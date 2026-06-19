<section class="min-h-screen flex items-center justify-center px-4 py-24">

    <div class="w-full max-w-md bg-[#041233]
                rounded-3xl
                p-10
                text-center
                shadow-[0_0_60px_rgba(37,99,235,0.15)]">

        {{-- Success Icon --}}
        <div class="flex justify-center mb-8">

            <div class="w-20 h-20 rounded-full bg-green-500/10 flex items-center justify-center">

                <div class="w-12 h-12 rounded-full border-2 border-green-400 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-green-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="3"
                            d="M5 13l4 4L19 7" />

                    </svg>

                </div>

            </div>

        </div>

        {{-- Title --}}
        <h1 class="text-4xl font-bold text-white mb-4">
            Pembayaran Selesai
        </h1>

        {{-- Description --}}
        <p class="text-slate-400 text-lg leading-relaxed mb-10">
            Terima kasih telah bermain!
        </p>

        {{-- Button --}}
        <div class="flex justify-center">

            <a href="{{ route('home') }}"
                class="w-full max-w-md text-center py-4 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition">

                Kembali ke Beranda

            </a>

        </div>

    </div>

</section>