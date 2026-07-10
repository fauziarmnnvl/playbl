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
                $isExpired = $isBerjalan && $sesi->waktu_selesai && now()->greaterThanOrEqualTo($sesi->waktu_selesai);

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
                                @if($isExpired)
                                    <span class="playbox-badge" style="background-color: #fee2e2; color: #dc2626; border: 1px solid #f87171;">
                                        Sesi Berakhir
                                    </span>
                                @else
                                    <span class="playbox-badge {{ $jenisSesi === 'Fleksibel' ? 'playbox-badge--flex' : '' }}">
                                        Sedang Digunakan
                                    </span>
                                @endif
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
                            
                            @if($isExpired)
                            <p style="font-size: 12px; color: #6b7280; margin-top: 8px;">
                                Menunggu proses otomatis...
                            </p>
                            @endif


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

                        {{-- AREA PROMO --}}
                        @if ($trxAktif->id_promo === null)
                            <div class="mon-card__promo-action" style="margin-top:12px; border-top:1px dashed #e2e8f0; padding-top:12px;">
                                <button wire:click="openPromoModal({{ $trxAktif->id_transaksi }})" wire:loading.attr="disabled" style="width:100%; display:flex; align-items:center; justify-content:center; gap:6px; font-size:13px; padding:6px 12px; color:#475569; border:1px solid #cbd5e1; background:#f8fafc; border-radius:6px; cursor:pointer;">
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                    </svg>
                                    Terapkan Promo
                                </button>
                            </div>
                        @else
                            <div class="mon-card__promo-info" style="margin-top:12px; border-top:1px dashed #e2e8f0; padding-top:12px; font-size:13px;">
                                <div style="display:flex; justify-content:space-between; margin-bottom:4px;">
                                    <span style="color:#64748b;">Promo</span>
                                    <strong style="color:#0f172a;">{{ $trxAktif->eventPromo?->nama_promo ?? '-' }}</strong>
                                </div>
                                <div style="display:flex; justify-content:space-between;">
                                    <span style="color:#64748b;">Potongan</span>
                                    <strong style="color:#10b981;">
                                        @if ($jenisSesi === 'Fleksibel' && $trxAktif->nilai_potongan == 0)
                                            Dihitung saat sesi selesai
                                        @else
                                            - Rp{{ number_format($trxAktif->nilai_potongan, 0, ',', '.') }}
                                        @endif
                                    </strong>
                                </div>
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

    {{-- MODAL PROMO --}}
    @if ($showPromoModal)
    <div class="promo-modal-overlay" style="position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.6); z-index:9999; display:flex; align-items:center; justify-content:center; padding:20px;">
        <div class="promo-modal-content" style="background:#fff; border-radius:12px; width:100%; max-width:450px; max-height:90vh; display:flex; flex-direction:column; box-shadow:0 10px 25px rgba(0,0,0,0.1);" role="dialog" aria-modal="true">
            {{-- Header --}}
            <div style="padding:16px 20px; border-bottom:1px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center;">
                <h3 style="margin:0; font-size:16px; font-weight:600; color:#0f172a;">Terapkan Promo</h3>
                <button wire:click="closePromoModal" style="background:none; border:none; cursor:pointer; color:#64748b; padding:4px;">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            
            {{-- Body --}}
            <div style="padding:20px; overflow-y:auto; flex:1;">
                <p style="margin:0 0 16px 0; font-size:14px; color:#475569; line-height:1.5;">
                    Pilih promo setelah memastikan pelanggan telah memenuhi syarat atau challenge.
                    <br><br>
                    <span style="font-size:13px; color:#64748b;">
                        * Promo akan diterapkan setelah operator memverifikasi syarat promo.
                    </span>
                </p>

                <div style="display:flex; flex-direction:column; gap:12px;">
                    @foreach ($promoAktif as $promo)
                        <label style="display:flex; gap:12px; padding:16px; border:2px solid {{ $selectedPromoId === $promo['id_promo'] ? '#3b82f6' : '#e2e8f0' }}; border-radius:8px; cursor:pointer; transition:all 0.2s; background:{{ $selectedPromoId === $promo['id_promo'] ? '#eff6ff' : '#fff' }};">
                            <input type="radio" wire:model="selectedPromoId" value="{{ $promo['id_promo'] }}" style="margin-top:2px;">
                            <div style="flex:1;">
                                <div style="display:flex; justify-content:space-between; margin-bottom:4px;">
                                    <strong style="color:#0f172a; font-size:15px;">{{ $promo['nama_promo'] }}</strong>
                                    <span style="color:#10b981; font-weight:600; font-size:14px;">
                                        @if ($promo['tipe_diskon'] === 'Nominal')
                                            Rp{{ number_format($promo['nilai_diskon'], 0, ',', '.') }}
                                        @else
                                            {{ floatval($promo['nilai_diskon']) }}%
                                        @endif
                                    </span>
                                </div>
                                <div style="font-size:12px; color:#64748b; margin-bottom:8px;">
                                    Berlaku: {{ \Carbon\Carbon::parse($promo['tanggal_mulai'])->format('d M Y') }} - {{ \Carbon\Carbon::parse($promo['tanggal_selesai'])->format('d M Y') }}
                                </div>
                                @if (!empty($promo['deskripsi']))
                                    <div style="font-size:13px; color:#475569; line-height:1.4; background:#f8fafc; padding:8px; border-radius:6px;">
                                        {{ $promo['deskripsi'] }}
                                    </div>
                                @endif
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Footer --}}
            <div style="padding:16px 20px; border-top:1px solid #e2e8f0; display:flex; justify-content:flex-end; gap:12px; background:#f8fafc; border-bottom-left-radius:12px; border-bottom-right-radius:12px;">
                <button wire:click="closePromoModal" class="btn" style="padding:8px 16px; border:1px solid #cbd5e1; background:#fff; color:#475569; border-radius:6px; cursor:pointer;">
                    Batal
                </button>
                <button wire:click="applyPromo" wire:loading.attr="disabled" wire:target="applyPromo" class="btn btn-primary" style="padding:8px 16px; cursor:pointer;" @disabled(!$selectedPromoId)>
                    <span wire:loading.remove wire:target="applyPromo">Terapkan Promo</span>
                    <span wire:loading wire:target="applyPromo">Memproses...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

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
