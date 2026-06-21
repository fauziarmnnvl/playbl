@extends('layouts.admin')

@section('title', 'Laporan & Statistik — BoxPlay.id')
@section('page_title', 'Laporan & Statistik')
@section('page_description', 'Ringkasan performa operasional dan pendapatan BoxPlay.')
@section('breadcrumb', 'Laporan / Laporan & Statistik')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="page-header" style="display:flex; justify-content:flex-end; margin-bottom:24px;">
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('admin.statistik.export-pdf', request()->all()) }}" class="btn btn-secondary" style="display: flex; align-items: center; gap: 6px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Export PDF
            </a>
            <a href="{{ route('admin.statistik.export-excel', request()->all()) }}" class="btn" style="background: #10b981; color: white; display: flex; align-items: center; gap: 6px; border: none;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                Export Excel
            </a>
        </div>
    </div>

    {{-- FILTER PERIODE --}}
    <div class="table-card" style="margin-bottom: 24px; padding: 20px;">
        <form method="GET" action="{{ route('admin.statistik') }}">
            <div style="display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-end;">
                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem; color: #475569;">Tanggal Awal</label>
                    <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" style="width: 100%; height: 42px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0 12px; outline: none; font-family: inherit;">
                </div>
                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem; color: #475569;">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" style="width: 100%; height: 42px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0 12px; outline: none; font-family: inherit;">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" style="height: 42px; padding: 0 24px;">Tampilkan</button>
                </div>
            </div>
        </form>
    </div>


    {{-- KPI CARDS --}}
    <div class="stats-grid">
        {{-- Total Pendapatan --}}
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-title">Total Pendapatan</span>

                <h2 class="stat-value">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h2>

                <div class="stat-subtitle">
                    Periode aktif
                </div>
            </div>
            <div class="stat-icon stat-green">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
            </div>
        </div>
        {{-- Total Transaksi --}}
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-title">Total Transaksi</span>
                <h2 class="stat-value">
                    {{ $totalTransaksi }}
                </h2>
                <div class="stat-subtitle">
                    Transaksi
                </div>
            </div>
            <div class="stat-icon stat-blue">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39A2 2 0 0 0 9.64 16H19a2 2 0 0 0 2-1.64L23 6H6"></path>
                </svg>
            </div>
        </div>
        {{-- Total Sesi --}}
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-title">Total Sesi</span>
                <h2 class="stat-value">
                    {{ $totalSesi }}
                </h2>
                <div class="stat-subtitle">
                    Sesi Bermain
                </div>
            </div>
           <div class="stat-icon stat-purple">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                    <line x1="6" y1="12" x2="10" y2="12"></line>
                    <line x1="8" y1="10" x2="8" y2="14"></line>
                    <circle cx="16" cy="10" r="1"></circle>
                    <circle cx="18" cy="14" r="1"></circle>
                </svg>
            </div>
        </div>
        {{-- Playbox Teraktif --}}
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-title">Playbox Teraktif</span>
                <h2 class="stat-value" style="font-size:24px;">
                    {{ $playboxPalingAktif?->playbox?->nama_playbox ?? '-' }}
                </h2>
                <div class="stat-subtitle">
                    {{ $playboxPalingAktif?->total ?? 0 }} penggunaan
                </div>
            </div>
           <div class="stat-icon stat-orange">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                    <line x1="6" y1="12" x2="10" y2="12"></line>
                    <line x1="8" y1="10" x2="8" y2="14"></line>
                    <circle cx="16" cy="10" r="1"></circle>
                    <circle cx="18" cy="14" r="1"></circle>
                </svg>
            </div>
        </div>
    </div>

    {{-- CHART SECTION --}}
    {{-- BARIS 1 --}}
    <div class="chart-row" style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:24px;">
        <div class="table-card" style="padding:20px;">
            <h3 style="margin-bottom:16px;">
                Pendapatan Berdasarkan Periode
            </h3>
            <div style="height:350px;">
                <canvas id="pendapatanChart"></canvas>
            </div>
        </div>

        <div class="table-card" style="padding:20px;">
            <h3 style="margin-bottom:16px;">
                Tren Penggunaan Sesi
            </h3>
            <div style="height:350px;">
                <canvas id="sesiChart"></canvas>
            </div>
        </div>

    </div>

    {{-- BARIS 2 --}}
    <div class="table-card" style="padding:20px;">
        <h3 style="margin-bottom:16px;">
            Distribusi Penggunaan Playbox
        </h3>
        <div style="display:flex; align-items:center; justify-content:center; height:420px;">
            <canvas id="distribusiChart"></canvas>
        </div>
    </div>

    {{-- CHART SCRIPTS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Pendapatan Chart (Bar Chart)
            const ctxPendapatan = document.getElementById('pendapatanChart').getContext('2d');
            new Chart(ctxPendapatan, {
                type: 'bar',
                data: {
                    labels: @json($pendapatanChart['labels']),
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: @json($pendapatanChart['values']),
                        backgroundColor: '#10b981',
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    }
                }
            });

            // 2. Tren Penggunaan Sesi (Line Chart)
            const ctxSesi = document.getElementById('sesiChart').getContext('2d');
            new Chart(ctxSesi, {
                type: 'line',
                data: {
                    labels: @json($sesiChart['labels']),
                    datasets: [{
                        label: 'Jumlah Sesi',
                        data: @json($sesiChart['values']),
                        borderColor: '#8b5cf6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks:{stepSize: 1} }
                    }
                }
            });

            // 3. Distribusi Penggunaan Playbox (Doughnut Chart)
            const ctxDistribusi = document.getElementById('distribusiChart').getContext('2d');
            new Chart(ctxDistribusi, {
                type: 'doughnut',
                data: {
                    labels: @json($distribusiPlaybox['labels']),
                    datasets: [{
                        data: @json($distribusiPlaybox['values']),
                        backgroundColor: [
                            '#3b82f6', '#10b981', '#f59e0b', '#ef4444', 
                            '#8b5cf6', '#06b6d4', '#f97316', '#64748b'
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { position: 'right', labels: {padding: 20, boxWidth: 18} }
                    }
                }
            });

        });
    </script>
@endsection
