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
            <div class="absolute top-5 left-0 w-full h-[3px] bg-gradient-to-r from-purple-500 to-blue-500"></div>

            @for($i = 1; $i <= 6; $i++)
                <div class="relative z-10 flex flex-col items-center">

                    <div class="w-11 h-11 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white flex items-center justify-center font-semibold">
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

    {{-- Payment Card --}}
    <div class="w-full max-w-3xl bg-[#041233] rounded-3xl border border-slate-800 p-8 shadow-xl">

        <div class="text-center">

            {{-- Title --}}
            <h2 class="text-4xl font-bold text-white mb-3">
                Pembayaran QRIS
            </h2>

            <p class="text-slate-400 mb-10">
                Scan QR code di bawah menggunakan e-wallet pilihanmu.
            </p>

            {{-- QR Code --}}
            <div class="flex justify-center mb-8">

                <div class="bg-white p-4 rounded-2xl border-4 border-blue-500 shadow-[0_0_25px_rgba(59,130,246,0.4)]">

                    <img src="{{ asset($booking['cabang']->qris) }}"
                        alt="QRIS"
                        class="w-72 h-auto">
                        
                </div>

            </div>

            {{-- Total --}}
            <h3 class="text-5xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent mb-10">
                Rp {{ number_format($booking['total_harga'],0,',','.') }}
            </h3>

            <div class="mt-8 rounded-2xl border border-yellow-500/30 bg-yellow-500/10 p-5 text-left">

                <h4 class="text-yellow-300 font-semibold mb-3">
                    Perhatian
                </h4>

                <p class="text-yellow-200 text-sm leading-6">
                    Silakan lakukan pembayaran menggunakan QRIS di atas. Setelah pembayaran berhasil,
                    datang ke lokasi dan tunjukkan bukti pembayaran kepada operator sebelum
                    sesi bermain dimulai.
                </p>

            </div>
        </div>

        {{-- Footer --}}
        <div class="border-t border-slate-800 pt-8 flex justify-between">

            <a href="{{ route('booking.review') }}"
                class="px-6 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition">
                ← Kembali
            </a>

            <form method="POST" action="{{ route('booking.storePembayaran') }}">
                @csrf
                <button
                    type="submit"
                    class="px-8 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition flex items-center gap-2">
                    Saya Sudah Bayar
                </button>
            </form>
        </div>
    </div>
</section>