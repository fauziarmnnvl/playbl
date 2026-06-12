@extends('layouts.admin')

@section('title', 'Dashboard — BoxPlay.id')
@section('page_title', 'Dashboard')
@section('page_description', 'Ringkasan sistem dan operasional')
@section('breadcrumb', 'Dashboard')

@section('content')
    <div class="kpi-grid">
        {{-- Total Playbox --}}
        <div class="kpi-card">
            <div class="kpi-icon indigo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="6" width="20" height="12" rx="2"/>
                </svg>
            </div>

            <div class="kpi-info">
                <h3>Total Playbox</h3>
                <div class="kpi-value">{{ $totalPlaybox }}</div>
                <div class="kpi-subtitle">Seluruh unit playbox</div>
            </div>
        </div>

        {{-- Playbox Aktif --}}
        <div class="kpi-card">
            <div class="kpi-icon blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="10 8 16 12 10 16 10 8"/>
                    <circle cx="12" cy="12" r="10"/>
                </svg>
            </div>

            <div class="kpi-info">
                <h3>Playbox Aktif</h3>
                <div class="kpi-value">{{ $totalPlayboxAktif }}</div>
                <div class="kpi-subtitle">Sedang digunakan</div>
            </div>
        </div>

        {{-- Playbox Tersedia --}}
        <div class="kpi-card">
            <div class="kpi-icon green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="6" width="20" height="12" rx="2"/>
                    <circle cx="8" cy="12" r="1.5"/>
                    <circle cx="16" cy="12" r="1.5"/>
                </svg>
            </div>

            <div class="kpi-info">
                <h3>Playbox Tersedia</h3>
                <div class="kpi-value">{{ $totalPlayboxTersedia }}</div>
                <div class="kpi-subtitle">Siap digunakan</div>
            </div>
        </div>

        {{-- Sesi Aktif --}}
        <div class="kpi-card">
            <div class="kpi-icon amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>

            <div class="kpi-info">
                <h3>Sesi Aktif</h3>
                <div class="kpi-value">{{ $totalSesiAktif }}</div>
                <div class="kpi-subtitle">Hari ini</div>
            </div>
        </div>

        {{-- Pendapatan --}}
        <div class="kpi-card">
            <div class="kpi-icon green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>

            <div class="kpi-info">
                <h3>Pendapatan Hari Ini</h3>
                <div class="kpi-value">
                    Rp {{ number_format($pendapatanHariIni,0,',','.') }}
                </div>
                <div class="kpi-subtitle">Pendapatan harian</div>
            </div>
        </div>
    </div>
    <div class="dashboard-grid">
        <div class="dashboard-panel">
            <div class="panel-header">
                <h2>Penggunaan Playbox (7 Hari Terakhir)</h2>
            </div>

            <div class="panel-body chart-placeholder">
                Grafik akan ditampilkan di sini
            </div>
        </div>

        <div class="dashboard-panel">
            <div class="panel-header">
                <h2>Distribusi Penggunaan</h2>
            </div>

            <div class="panel-body chart-placeholder">
                Donut Chart
            </div>
        </div>
    </div>
    <div class="dashboard-panel activity-panel">
        <div class="panel-header">
            <h2>Aktivitas Terbaru</h2>
        </div>
        <div class="activity-list">
            <div class="activity-item">
                <span class="activity-dot blue"></span>
                <div>
                    <strong>Playbox berhasil ditambahkan</strong>
                    <p>Baru saja</p>
                </div>
            </div>
            <div class="activity-item">
                <span class="activity-dot green"></span>
                <div>
                    <strong>Sesi bermain selesai</strong>
                    <p>Hari ini</p>
                </div>
            </div>
            <div class="activity-item">
                <span class="activity-dot amber"></span>
                <div>
                    <strong>Pendapatan diperbarui</strong>
                    <p>Hari ini</p>
                </div>
            </div>
        </div>
    </div>
@endsection
