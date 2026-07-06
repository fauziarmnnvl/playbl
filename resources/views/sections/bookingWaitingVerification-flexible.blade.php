<section class="min-h-screen flex flex-col items-center pt-40 pb-20 px-4">

    <div class="w-full max-w-xl bg-[#041233]
                rounded-3xl
                p-6 md:p-10
                text-center
                shadow-[0_0_60px_rgba(37,99,235,0.15)]
                border border-slate-800">

        {{-- ========== WAITING STATE ========== --}}
        <div id="waitingState">

            {{-- Animated Waiting Icon --}}
            <div class="flex justify-center mb-8">
                <div class="relative">
                    {{-- Outer glow ring --}}
                    <div class="absolute inset-0 w-24 h-24 rounded-full bg-gradient-to-r from-purple-500/20 to-blue-500/20 animate-ping" style="animation-duration: 2s;"></div>

                    {{-- Main circle --}}
                    <div class="relative w-24 h-24 rounded-full bg-gradient-to-r from-purple-500/10 to-blue-500/10 border border-purple-500/30 flex items-center justify-center">
                        {{-- Inner circle --}}
                        <div class="w-14 h-14 rounded-full bg-gradient-to-r from-purple-500/20 to-blue-500/20 border border-blue-400/40 flex items-center justify-center">
                            {{-- Receipt/Payment SVG --}}
                            <svg class="w-7 h-7 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="9" y1="13" x2="15" y2="13"/>
                                <line x1="9" y1="17" x2="13" y2="17"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Title --}}
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">
                Menunggu Verifikasi Pembayaran
            </h1>

            {{-- Description --}}
            <p class="text-slate-400 text-base leading-relaxed mb-2">
                Bukti pembayaranmu telah berhasil dikirim dan sedang diperiksa oleh operator.
            </p>
            <p class="text-slate-500 text-sm mb-10">
                Halaman ini akan diperbarui secara otomatis setelah proses verifikasi selesai.
            </p>

            {{-- Detail Transaksi --}}
            <div class="bg-[#08152D] border border-slate-700 rounded-2xl p-5 text-left mb-8">

                <h4 class="text-white font-semibold mb-3">
                    Detail Transaksi
                </h4>

                <div class="space-y-2 text-sm">

                    <div class="flex justify-between">
                        <span class="text-slate-400">Kode Transaksi</span>
                        <span class="text-white font-medium">{{ $booking['kode_transaksi'] }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Playbox</span>
                        <span class="text-white">{{ $booking['playbox']->nama_playbox }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Durasi Bermain</span>
                        <span class="text-white">{{ $booking['durasi'] }} Menit</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Total Pembayaran</span>
                        <span class="text-purple-400 font-semibold">
                            Rp {{ number_format($booking['total_harga'], 0, ',', '.') }}
                        </span>
                    </div>

                </div>
            </div>

            {{-- Status Badge --}}
            <div class="bg-[#08152D] border border-slate-700 rounded-2xl p-5 mb-8">
                <div class="flex flex-col sm:flex-row items-center sm:justify-between gap-3 sm:gap-0">
                    <span class="text-slate-400 text-sm">Status Pembayaran</span>
                    <span id="statusBadge" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-sm font-medium">
                        <svg class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="2" x2="12" y2="6"/>
                            <line x1="12" y1="18" x2="12" y2="22"/>
                            <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/>
                            <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/>
                            <line x1="2" y1="12" x2="6" y2="12"/>
                            <line x1="18" y1="12" x2="22" y2="12"/>
                            <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"/>
                            <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"/>
                        </svg>
                        Menunggu Verifikasi
                    </span>
                </div>
            </div>

            {{-- Estimasi --}}
            <div class="flex items-center justify-center gap-2 text-slate-400 text-sm mb-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
                <span>Estimasi verifikasi 5–15 menit</span>
            </div>

            <p class="text-slate-600 text-xs">
                Tidak perlu memuat ulang halaman. Status akan diperbarui secara otomatis.
            </p>

        </div>

        {{-- ========== REJECTED STATE ========== --}}
        <div id="rejectedState" class="hidden">

            {{-- Rejected Icon --}}
            <div class="flex justify-center mb-8">
                <div class="w-20 h-20 rounded-full bg-red-500/10 flex items-center justify-center">
                    <div class="w-12 h-12 rounded-full border-2 border-red-400 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Title --}}
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">
                Bukti Pembayaran Ditolak
            </h1>

            {{-- Description --}}
            <p class="text-slate-400 text-base leading-relaxed mb-10">
                Bukti pembayaran tidak dapat diverifikasi oleh operator. Silakan periksa kembali bukti pembayaran dan unggah ulang.
            </p>

            {{-- Status Badge --}}
            <div class="bg-[#08152D] border border-slate-700 rounded-2xl p-5 mb-10">
                <div class="flex flex-col sm:flex-row items-center sm:justify-between gap-3 sm:gap-0">
                    <span class="text-slate-400 text-sm">Status Pembayaran</span>
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-500/10 border border-red-500/30 text-red-400 text-sm font-medium">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="15" y1="9" x2="9" y2="15"/>
                            <line x1="9" y1="9" x2="15" y2="15"/>
                        </svg>
                        Ditolak
                    </span>
                </div>
            </div>

            {{-- Upload Ulang Button --}}
            <div class="flex justify-center">
                <a href="{{ route('booking.pembayaran.flexible', ['retry' => 1]) }}"
                   class="w-full max-w-md text-center py-4 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition inline-flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 16 12 12 8 16"/>
                        <line x1="12" y1="12" x2="12" y2="21"/>
                        <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/>
                        <polyline points="16 16 12 12 8 16"/>
                    </svg>
                    Upload Ulang Bukti Pembayaran
                </a>
            </div>

        </div>

    </div>

    <script>
        let pollingInterval = null;

        function startPolling() {
            pollingInterval = setInterval(checkStatus, 5000);
        }

        function stopPolling() {
            if (pollingInterval) {
                clearInterval(pollingInterval);
                pollingInterval = null;
            }
        }

        function checkStatus() {
            fetch('{{ route("booking.check-payment-status.flexible") }}')
                .then(response => response.json())
                .then(data => {

                    if (data.status === 'Disetujui') {
                        stopPolling();
                        window.location.href = data.redirect_url;
                    }

                    if (data.status === 'Ditolak') {
                        stopPolling();
                        document.getElementById('waitingState').classList.add('hidden');
                        document.getElementById('rejectedState').classList.remove('hidden');
                    }

                })
                .catch(() => {
                    // Silently ignore network errors, polling will retry
                });
        }

        // Start polling on page load
        startPolling();
    </script>

</section>
