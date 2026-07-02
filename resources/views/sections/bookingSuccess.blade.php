<section class="min-h-screen flex items-start justify-center px-4 pt-40 pb-20">

    <div class="w-full max-w-3xl bg-[#041233] rounded-3xl border border-slate-800 shadow-xl p-10">

        {{-- Success Icon --}}
        <div class="flex justify-center mb-8">

            <div class="relative">

                <div class="absolute inset-0 bg-green-500 rounded-full blur-3xl opacity-40"></div>

                <div class="relative w-20 h-20 rounded-full border-2 border-green-500 flex items-center justify-center bg-green-500/10">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-10 h-10 text-green-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="3"
                            d="M5 13l4 4L19 7"/>

                    </svg>

                </div>

            </div>

        </div>

        {{-- Title --}}
        <div class="text-center mb-8">

            <h1 class="text-5xl font-bold text-white mb-4">
                Booking Berhasil!
            </h1>

            <p class="text-slate-400 text-lg max-w-md mx-auto">
                Booking berhasil dibuat. Silakan tunjukkan bukti pembayaran kepada operator saat tiba di lokasi.
            </p>

        </div>

        {{-- Next Step --}}
        <div class="max-w-md mx-auto mb-6">

            <div class="bg-gradient-to-r from-purple-900/40 to-blue-900/40 border border-blue-500/40 rounded-2xl p-5">

                <div class="flex items-start gap-4">

                    <div>

                        <h3 class="text-white font-bold text-lg mb-1">
                            Langkah Selanjutnya
                        </h3>

                        <p class="text-slate-300 text-sm">
                           Silakan tunjukkan bukti pembayaran kepada operator untuk memulai sesi bermain Anda.
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- Booking Detail --}}
        <div class="max-w-md mx-auto mb-8">

            <div class="bg-slate-800/40 rounded-2xl p-6 border border-slate-700">
                <div class="flex justify-between py-3">
    <span class="text-slate-400">Kode Booking</span>
    <span class="text-green-400 font-semibold">
        {{ $booking['kode_transaksi'] }}
    </span>
</div>

                <div class="flex justify-between py-3">
                    <span class="text-slate-400">Nama</span>
                    <span class="text-white font-semibold">{{ $booking['nama'] }}</span>
                </div>

                <div class="flex justify-between py-3">
                    <span class="text-slate-400">Playbox</span>
                    <span class="text-blue-400 font-semibold">{{ $booking['playbox']->nama_playbox }}</span>
                </div>

                <div class="flex justify-between py-3">
                    <span class="text-slate-400">Cabang</span>
                    <span class="text-white font-semibold">{{ $booking['cabang']->nama_cabang }}</span>
                </div>

                <div class="flex justify-between py-3">
                    <span class="text-slate-400">Durasi</span>
                    <span class="text-white font-semibold">{{ $booking['durasi']/60 }} Jam</span>
                </div>

                <div class="flex justify-between py-3">
                    <span class="text-slate-400">Total</span>
                    <span class="text-green-400 font-semibold">Rp {{ number_format($booking['total_harga'],0,',','.') }}</span>
                </div>
            </div>
        </div>

        {{-- Button --}}
        <div class="flex justify-center">

           <form method="POST" action="{{ route('booking.selesai') }}" class="w-full flex justify-center">
                @csrf
                <button type="submit" class="w-full max-w-md py-4 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition">
                    Kembali ke Beranda
                </button>
            </form>
        </div>
    </div>
</section>