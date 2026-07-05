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

    @php
        $isUploadState = ($isRetry ?? false) || $errors->has('bukti_pembayaran');
    @endphp

    {{-- Card --}}
    <div class="w-full max-w-3xl bg-[#041233] rounded-3xl border border-slate-800 p-8 shadow-xl">

        {{-- ========== STATE 1 — PEMBAYARAN QRIS ========== --}}
        <div id="paymentStep" class="{{ $isUploadState ? 'hidden' : '' }}">

            <div class="text-center">

                <h2 class="text-4xl font-bold text-white mb-3">
                    Pembayaran QRIS
                </h2>

                <p class="text-slate-400 mb-10">
                    Scan QR code di bawah menggunakan e-wallet pilihanmu.
                </p>

                {{-- QRIS --}}
                <div class="inline-block bg-white p-4 rounded-2xl border-4 border-blue-500 shadow-[0_0_30px_rgba(59,130,246,0.3)]">

                    <img src="{{ asset($booking['cabang']->qris) }}"
                         alt="QRIS"
                         class="w-72 h-auto">

                </div>

                {{-- Total --}}
                <h3 class="text-5xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent mt-8 mb-10">
                    Rp {{ number_format($booking['total_harga'], 0, ',', '.') }}
                </h3>

            </div>

            <div class="mt-8 bg-[#08152D] border border-slate-700 rounded-2xl p-5 text-left">

                <h4 class="text-white font-semibold mb-3">
                    Detail Booking
                </h4>

                <div class="space-y-2 text-sm">

                    <div class="flex justify-between">
                        <span class="text-slate-400">Nama</span>
                        <span class="text-white">{{ $booking['nama'] }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Cabang</span>
                        <span class="text-white">{{ $booking['cabang']->nama_cabang }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Playbox</span>
                        <span class="text-white">{{ $booking['playbox']->nama_playbox }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Durasi Bermain</span>
                        <span class="text-white">{{ $booking['durasi'] }} Menit</span>
                    </div>

                </div>

                <div class="mt-6 rounded-2xl border border-yellow-500/30 bg-yellow-500/10 p-5">

                    <p class="text-yellow-300 text-sm leading-6">
                        Setelah melakukan pembayaran, klik tombol "Saya Sudah Bayar" untuk mengunggah bukti pembayaran.
                    </p>

                </div>

            </div>

            {{-- Footer --}}
            <div class="mt-8 border-t border-slate-800 pt-8 flex justify-between">

                <a href="{{ route('booking.session.flexible') }}"
                   class="px-8 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition flex items-center gap-2">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    Kembali
                </a>

                <button type="button" onclick="showUploadStep()"
                    class="px-8 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition flex items-center gap-2">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Saya Sudah Bayar
                </button>

            </div>
        </div>

        {{-- ========== STATE 2 — UPLOAD BUKTI PEMBAYARAN ========== --}}
        <div id="uploadStep" class="{{ $isUploadState ? '' : 'hidden' }}">

            <div class="text-center mb-8">
                <h2 class="text-4xl font-bold text-white mb-3">
                    @if($isRetry ?? false)
                        Upload Ulang Bukti Pembayaran
                    @else
                        Upload Bukti Pembayaran
                    @endif
                </h2>
                <p class="text-slate-400">
                    @if($isRetry ?? false)
                        Bukti pembayaran sebelumnya tidak dapat diverifikasi. Silakan unggah bukti pembayaran yang lebih jelas dan sesuai.
                    @else
                        Unggah bukti pembayaran untuk menyelesaikan proses pembayaran sesi Anda.
                    @endif
                </p>
            </div>

            @if($isRetry ?? false)
                {{-- Info Box — Bukti Sebelumnya Ditolak --}}
                <div class="mb-8 bg-amber-500/5 border border-amber-500/30 rounded-2xl p-5 flex gap-4 items-start">
                    <svg class="w-6 h-6 text-amber-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    <div>
                        <h4 class="text-amber-300 font-semibold text-sm mb-1">Bukti Sebelumnya Ditolak</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">
                            Pastikan nominal, waktu transaksi, dan informasi pembayaran terlihat dengan jelas pada gambar.
                        </p>
                    </div>
                </div>
            @endif

            <form id="uploadForm" method="POST" action="{{ route('booking.storePembayaranFlexible') }}" enctype="multipart/form-data">
                @csrf

                {{-- Upload Area --}}
                <label for="buktiInput"
                    id="uploadArea"
                    class="block w-full border-2 border-dashed border-slate-600 rounded-2xl p-10 text-center cursor-pointer
                           bg-[#08152D] hover:border-blue-500 hover:bg-[#0a1a3a] transition-all duration-300">

                    <div id="uploadPlaceholder">
                        <svg class="w-14 h-14 mx-auto text-slate-500 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="16 16 12 12 8 16"/>
                            <line x1="12" y1="12" x2="12" y2="21"/>
                            <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/>
                            <polyline points="16 16 12 12 8 16"/>
                        </svg>
                        <p class="text-white font-medium mb-1">Klik untuk pilih gambar</p>
                        <p class="text-slate-500 text-sm">PNG, JPG, JPEG, WEBP &bull; Maks. 5 MB</p>
                    </div>

                    <div id="uploadFileName" class="hidden">
                        <svg class="w-10 h-10 mx-auto text-green-400 mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <p class="text-green-400 font-medium mb-1" id="fileNameText"></p>
                        <p class="text-slate-500 text-sm">Klik untuk mengganti gambar</p>
                    </div>

                    <input type="file"
                        id="buktiInput"
                        name="bukti_pembayaran"
                        accept="image/png,image/jpeg,image/jpg,image/webp"
                        class="hidden"
                        required>
                </label>

                {{-- Upload Error --}}
                <div id="uploadError" class="hidden mt-3 text-red-400 text-sm text-center"></div>

                @error('bukti_pembayaran')
                    <div class="mt-3 text-red-400 text-sm text-center">{{ $message }}</div>
                @enderror

                {{-- Preview --}}
                <div class="mt-8">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Preview Bukti Pembayaran</p>

                    <div id="previewEmpty" class="bg-[#08152D] border border-slate-700 rounded-2xl p-8 flex flex-col items-center justify-center min-h-[200px]">
                        <svg class="w-12 h-12 text-slate-600 mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                        <p class="text-slate-600 text-sm">Belum ada gambar dipilih</p>
                    </div>

                    <div id="previewImage" class="hidden bg-[#08152D] border border-slate-700 rounded-2xl p-4 flex items-center justify-center">
                        <img id="previewImg" alt="Preview bukti pembayaran" class="max-w-full max-h-[400px] object-contain rounded-xl">
                    </div>
                </div>

                {{-- Info Verifikasi --}}
                <div class="mt-8 bg-blue-500/5 border border-blue-500/30 rounded-2xl p-5 flex gap-4 items-start">
                    <svg class="w-6 h-6 text-blue-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="16" x2="12" y2="12"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>
                    </svg>
                    <div>
                        <h4 class="text-white font-semibold text-sm mb-1">Verifikasi Pembayaran</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">
                            Bukti pembayaran akan diperiksa oleh Operator sebelum pembayaran disetujui.
                        </p>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="mt-8 border-t border-slate-800 pt-8 flex flex-col sm:flex-row justify-between gap-4">

                    @if($isRetry ?? false)
                        <a href="{{ route('booking.waiting-verification.flexible') }}"
                            class="px-8 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                            Kembali ke Status Verifikasi
                        </a>
                    @else
                        <button type="button" onclick="showPaymentStep()"
                            class="px-8 py-3 border border-slate-700 rounded-xl text-white hover:border-blue-500 transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                            Kembali ke QRIS
                        </button>
                    @endif

                    <button type="submit" id="submitBtn" disabled
                        class="px-8 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-lg transition flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 hover:scale-105">
                        <span id="submitText">
                            @if($isRetry ?? false)
                                Kirim Ulang Bukti Pembayaran
                            @else
                                Kirim Bukti Pembayaran
                            @endif
                        </span>
                        <svg id="submitArrow" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>

                </div>
            </form>
        </div>

    </div>

    <script>
        // State switching
        function showUploadStep() {
            document.getElementById('paymentStep').classList.add('hidden');
            document.getElementById('uploadStep').classList.remove('hidden');
        }

        function showPaymentStep() {
            document.getElementById('uploadStep').classList.add('hidden');
            document.getElementById('paymentStep').classList.remove('hidden');
        }

        // File validation & preview
        const buktiInput = document.getElementById('buktiInput');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const uploadFileName = document.getElementById('uploadFileName');
        const fileNameText = document.getElementById('fileNameText');
        const uploadError = document.getElementById('uploadError');
        const previewEmpty = document.getElementById('previewEmpty');
        const previewImage = document.getElementById('previewImage');
        const previewImg = document.getElementById('previewImg');
        const submitBtn = document.getElementById('submitBtn');

        const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
        const maxSize = 5 * 1024 * 1024; // 5 MB

        buktiInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            uploadError.classList.add('hidden');
            uploadError.textContent = '';

            if (!file) {
                resetPreview();
                return;
            }

            // Validate type
            if (!allowedTypes.includes(file.type)) {
                buktiInput.value = '';
                uploadError.textContent = 'Format file tidak didukung. Gunakan PNG, JPG, JPEG, atau WEBP.';
                uploadError.classList.remove('hidden');
                resetPreview();
                return;
            }

            // Validate size
            if (file.size > maxSize) {
                buktiInput.value = '';
                uploadError.textContent = 'Ukuran file maksimal 5 MB.';
                uploadError.classList.remove('hidden');
                resetPreview();
                return;
            }

            // Show file name in upload area
            uploadPlaceholder.classList.add('hidden');
            uploadFileName.classList.remove('hidden');
            fileNameText.textContent = file.name;

            // Show preview
            const reader = new FileReader();
            reader.onload = function(ev) {
                previewImg.src = ev.target.result;
                previewEmpty.classList.add('hidden');
                previewImage.classList.remove('hidden');
            };
            reader.readAsDataURL(file);

            // Enable submit
            submitBtn.disabled = false;
        });

        function resetPreview() {
            uploadPlaceholder.classList.remove('hidden');
            uploadFileName.classList.add('hidden');
            fileNameText.textContent = '';
            previewEmpty.classList.remove('hidden');
            previewImage.classList.add('hidden');
            previewImg.src = '';
            submitBtn.disabled = true;
        }

        // Prevent double submit
        document.getElementById('uploadForm').addEventListener('submit', function() {
            submitBtn.disabled = true;
            document.getElementById('submitText').textContent = 'Mengirim...';
            document.getElementById('submitArrow').classList.add('hidden');
        });
    </script>

</section>