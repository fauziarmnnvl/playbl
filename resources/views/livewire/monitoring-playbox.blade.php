<div wire:poll.5s="loadPlayboxes">

    {{-- Card Grid --}}
    <div class="mon-grid">
        @foreach ($playboxes as $pb)
            @php
                $status = $pb->status_unit;
                $trxAktif = $pb->transaksiAktif;
                $sesi = $trxAktif?->sesiBermain;
                $pelanggan = $trxAktif?->pelanggan;
                $jenisSesi = $trxAktif?->jenis_sesi ?? 'Tetap';
                $isBerjalan = $sesi && $sesi->status_sesi === 'Berjalan';

                // Card color class
                $cardClass = match($status) {
                    'Digunakan' => $jenisSesi === 'Fleksibel'
                        ? 'mon-card--fleksibel'
                        : 'mon-card--digunakan',
                    'Dipesan' => 'mon-card--digunakan',
                    'Maintenance' => 'mon-card--maintenance',
                    'Rusak' => 'mon-card--rusak',
                    default => 'mon-card--tersedia',
                };

                // Badge
                $badgeClass = match($status) {
                    'Tersedia' => 'badge-green',
                    'Dipesan' => 'badge-amber',
                    'Digunakan' => 'badge-amber',
                    'Maintenance' => 'badge-amber',
                    'Rusak' => 'badge-red',
                    default => 'badge-default',
                };
                $badgeText = match($status) {
                    'Digunakan' => 'Sedang Digunakan',
                    'Dipesan' => 'Menunggu Dimulai',
                    default => $status,
                };
            @endphp

            <div class="mon-card {{ $cardClass }}">
                {{-- Header --}}
               <div class="mon-card__header">
                    <div class="playbox-head">
                        <div class="playbox-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="4" width="18" height="12" rx="2"/>
                                <line x1="8" y1="20" x2="16" y2="20"/>
                                <line x1="12" y1="16" x2="12" y2="20"/>
                            </svg>
                        </div>

                        <div>
                            <h3>{{ $pb->nama_playbox }}</h3>
                            @if($pb->cabang)
                                <p class="playbox-cabang">
                                    {{ $pb->cabang->nama_cabang }}
                                </p>
                            @endif
                            @if($status == 'Digunakan')
                            <span class="playbox-badge {{ $jenisSesi === 'Fleksibel' ? 'playbox-badge--flex' : '' }}">
                                Sedang Digunakan
                            </span>
                        @endif
                        </div>
                    </div>

                    @if($status !== 'Digunakan')
                        <span class="badge {{ $badgeClass }}">
                            {{ $badgeText }}
                        </span>
                    @endif
                </div>

                {{-- Body --}}
                <div class="mon-card__body">
                    @if ($status === 'Digunakan' && $isBerjalan)
                        {{-- Pelanggan --}}
                        <div class="mon-card__info-row">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px; height:14px; flex-shrink:0;">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span>{{ $pelanggan->nama_pelanggan ?? 'Tanpa Nama' }}</span>
                        </div>

                        @if ($jenisSesi === 'Tetap')
                            {{-- === SESI TETAP === --}}
                            @php
                                $durasiTotal = $trxAktif->durasi;
                                $waktuSelesai = $sesi->waktu_selesai;
                                $totalDetik = $waktuSelesai ? max(0, now()->diffInSeconds($waktuSelesai, false)) : 0;
                                $totalDurasiDetik = $durasiTotal * 60;
                            @endphp

                            <div class="mon-card__info-row">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>

                                <span>
                                    {{ $sesi->waktu_mulai ? $sesi->waktu_mulai->format('H:i') : '--:--' }}
                                </span>
                            </div>

                            {{-- Countdown --}}
                            <div class="mon-card__timer"
                                 data-countdown="{{ $waktuSelesai ? $waktuSelesai->timestamp : 0 }}">
                              <div class="timer-header">
                                    <span>Sisa Waktu</span>
                                    <span>
                                        @if($durasiTotal >= 60)
                                            {{ floor($durasiTotal / 60) }} Jam
                                            @if($durasiTotal % 60)
                                                {{ $durasiTotal % 60 }} Menit
                                            @endif
                                        @else
                                            {{ $durasiTotal }} Menit
                                        @endif
                                    </span>
                                </div>
                                <div class="mon-card__timer-display">
                                    <span class="timer-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/>
                                            <polyline points="12 6 12 12 16 14"/>
                                        </svg>
                                    </span>
                                    <span class="timer-value" id="timer-{{ $pb->id_playbox }}">
                                        @if ($totalDetik > 0)
                                            {{ sprintf('%02d:%02d:%02d', floor($totalDetik/3600), floor(($totalDetik%3600)/60), $totalDetik%60) }}
                                        @else
                                            00:00:00
                                        @endif
                                    </span>
                                </div>
                            </div>


                            {{-- Estimasi Biaya --}}
                            <div class="mon-card__cost">
                                <span>Estimasi Biaya</span>
                                <strong>Rp {{ number_format($trxAktif->total_harga, 0, ',', '.') }}</strong>
                            </div>

                        @else
                            {{-- === SESI FLEKSIBEL === --}}
                            @php
                                $menitBerjalan = $sesi->waktu_mulai ? max(0, now()->diffInMinutes($sesi->waktu_mulai)) : 0;
                                $biayaRealtime = $menitBerjalan * 395;
                            @endphp
                            <div class="mon-card__info-row">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M12 6v6l4 2"/>
                                </svg>
                                <span>Sesi Fleksibel</span>
                            </div>

                            {{-- Timer count-up --}}
                            <div class="mon-card__timer mon-card__timer--flex"
                                 data-countup="{{ $sesi->waktu_mulai ? $sesi->waktu_mulai->timestamp : 0 }}">
                                <div class="mon-card__timer-display">
                                   <span class="timer-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M6 2h12"/>
                                            <path d="M6 22h12"/>
                                            <path d="M8 2v6a4 4 0 0 0 1.17 2.83L12 13.66l2.83-2.83A4 4 0 0 0 16 8V2"/>
                                            <path d="M16 22v-6a4 4 0 0 0-1.17-2.83L12 10.34l-2.83 2.83A4 4 0 0 0 8 16v6"/>
                                        </svg>
                                    </span>
                                    <span class="timer-value" id="timer-{{ $pb->id_playbox }}">
                                        {{ sprintf('%02d:%02d:%02d', floor($menitBerjalan/60), $menitBerjalan%60, 0) }}
                                    </span>
                                </div>
                            </div>

                            {{-- Biaya realtime --}}
                            <div class="mon-card__cost mon-card__cost--flex">
                                <span>Biaya Saat Ini</span>
                                <strong id="cost-{{ $pb->id_playbox }}"
                                        data-start="{{ $sesi->waktu_mulai ? $sesi->waktu_mulai->timestamp : 0 }}"
                                        data-rate="395">
                                    Rp {{ number_format($biayaRealtime, 0, ',', '.') }}
                                </strong>
                            </div>
                        @endif

                    @elseif ($status === 'Dipesan')
                        <div class="playbox-available">

                            @if(auth()->user()->role === 'operator')
                                <button wire:click="mulaiSesi({{ $pb->id_playbox }})" class="btn btn-primary">
                                    ▶ Mulai Sesi
                                </button>
                            @endif
                        </div>

                   @elseif ($status === 'Maintenance')
                        <div class="playbox-available">
                        <div class="playbox-available-icon" style="background:#fff7ed;color:#f59e0b;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                            </svg>
                        </div>
                        <h2>{{ $pb->nama_playbox }}</h2>
                        <div class="available-badge" style="background:#fef3c7;color:#d97706;">
                            Maintenance
                        </div>
                        </div>

                   @elseif ($status === 'Rusak')
                    <div class="playbox-available">
                        <div class="playbox-available-icon" style="background:#fee2e2;color:#ef4444;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                                <line x1="12" y1="9" x2="12" y2="13"/>
                                <line x1="12" y1="17" x2="12.01" y2="17"/>
                            </svg>
                        </div>
                        <h2>{{ $pb->nama_playbox }}</h2>
                        <div class="available-badge" style="background:#fee2e2;color:#dc2626;">
                            Rusak
                        </div>
                    </div>

                    @else
                        {{-- Tersedia --}}
                        <div class="playbox-available">
                           <div class="playbox-available-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="3" y="4" width="18" height="12" rx="2"/>
                                    <line x1="8" y1="20" x2="16" y2="20"/>
                                    <line x1="12" y1="16" x2="12" y2="20"/>
                                </svg>
                            </div>
                            <h2>{{ $pb->nama_playbox }}</h2>
                            <div class="available-badge">
                                Tersedia
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- JavaScript Countdown & Count-Up Timer --}}
    <script>
        (function () {
            function updateTimers() {
                const now = Math.floor(Date.now() / 1000);

                // Countdown timers (Sesi Tetap)
                document.querySelectorAll('[data-countdown]').forEach(el => {
                    const end = parseInt(el.dataset.countdown);
                    if (!end) return;
                    let diff = Math.max(0, end - now);
                    const h = Math.floor(diff / 3600);
                    const m = Math.floor((diff % 3600) / 60);
                    const s = diff % 60;
                    const display = el.querySelector('.timer-value');
                    if (display) {
                        display.textContent = String(h).padStart(2, '0') + ':' + String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
                    }

                    // Update progress bar
                    const card = el.closest('.mon-card');
                    if (card) {
                        const progBar = card.querySelector('.mon-card__progress-bar');
                        if (progBar) {
                            const durasiText = card.querySelector('.mon-card__info-row span');
                            const totalMins = parseInt(durasiText?.textContent?.match(/\d+/)?.[0]) || 60;
                            const totalSec = totalMins * 60;
                            const pct = Math.min(100, Math.max(0, ((totalSec - diff) / totalSec) * 100));
                            progBar.style.width = pct + '%';
                        }
                    }
                });

                // Count-up timers (Sesi Fleksibel)
                document.querySelectorAll('[data-countup]').forEach(el => {
                    const start = parseInt(el.dataset.countup);
                    if (!start) return;
                    let diff = Math.max(0, now - start);
                    const h = Math.floor(diff / 3600);
                    const m = Math.floor((diff % 3600) / 60);
                    const s = diff % 60;
                    const display = el.querySelector('.timer-value');
                    if (display) {
                        display.textContent = String(h).padStart(2, '0') + ':' + String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
                    }
                });

                // Real-time cost for flexible sessions
                document.querySelectorAll('[data-rate]').forEach(el => {
                    const start = parseInt(el.dataset.start);
                    const rate = parseInt(el.dataset.rate);
                    if (!start || !rate) return;
                    const menitBerjalan = Math.floor((now - start) / 60);
                    const cost = menitBerjalan * rate;
                    el.textContent = 'Rp ' + cost.toLocaleString('id-ID');
                });
            }

            // Run every second
            setInterval(updateTimers, 1000);
            updateTimers();
        })();
    </script>
</div>
