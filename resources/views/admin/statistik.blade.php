@extends('layouts.admin')

@section('title', 'Laporan & Statistik — BoxPlay.id')
@section('page_title', 'Laporan & Statistik')
@section('page_description', 'Ringkasan performa operasional dan pendapatan BoxPlay.')
@section('breadcrumb', 'Laporan / Laporan & Statistik')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="page-header page-header-statistik" style="margin-bottom:24px;">
        <div class="page-header-actions" style="display: flex; gap: 8px;">
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
    <div class="table-card filter-card-statistik" style="margin-bottom:24px;padding:20px;">
        <form method="GET" action="{{ route('admin.statistik') }}">
            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:500;font-size:.875rem;color:#475569;">
                    Mode Periode
                </label>

                <div style="display:inline-flex;padding:4px;background:#f1f5f9;border-radius:10px;">
                    <button type="button" class="period-mode-btn" data-mode="harian">
                        Harian
                    </button>
                    <button type="button" class="period-mode-btn" data-mode="bulanan">
                        Bulanan
                    </button>
                </div>
            </div>

            <input type="hidden" name="period_mode" id="periodMode"
                value="{{ request('period_mode','harian') }}">

            <div id="filterHarian" class="filter-statistik-grid">
                <div class="filter-statistik-group">
                    <label style="display:block;margin-bottom:8px;font-weight:500;font-size:.875rem;color:#475569;">
                        Tanggal Awal
                    </label>
                    <input type="date" name="start_date"
                        value="{{ request('start_date',$startDate->format('Y-m-d')) }}"
                        class="period-input">
                </div>

                <div class="filter-statistik-group">
                    <label style="display:block;margin-bottom:8px;font-weight:500;font-size:.875rem;color:#475569;">
                        Tanggal Akhir
                    </label>
                    <input type="date" name="end_date"
                        value="{{ request('end_date',$endDate->format('Y-m-d')) }}"
                        class="period-input">
                </div>

                <div class="filter-statistik-action">
                    <button type="submit" class="btn btn-primary"
                        style="height:42px;width:100%;justify-content:center;">
                        Tampilkan
                    </button>
                </div>
            </div>

            <div id="filterBulanan" class="filter-statistik-grid" style="display:none;">
                <div class="filter-statistik-group">
                    <label style="display:block;margin-bottom:8px;font-weight:500;font-size:.875rem;color:#475569;">
                        Bulan Awal
                    </label>
                    <input type="month" name="start_month"
                        value="{{ request('start_month',$startDate->format('Y-m')) }}"
                        class="period-input">
                </div>

                <div class="filter-statistik-group">
                    <label style="display:block;margin-bottom:8px;font-weight:500;font-size:.875rem;color:#475569;">
                        Bulan Akhir
                    </label>
                    <input type="month" name="end_month"
                        value="{{ request('end_month',$endDate->format('Y-m')) }}"
                        class="period-input">
                </div>

                <div class="filter-statistik-action">
                    <button type="submit" class="btn btn-primary"
                        style="height:42px;width:100%;justify-content:center;">
                        Tampilkan
                    </button>
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
    <div class="chart-row-grid">
        <div class="table-card" style="padding:20px;">
            <h3 style="margin-bottom:16px;">
                Pendapatan Berdasarkan Periode
            </h3>
            <div class="chart-container-box">
                <canvas id="pendapatanChart"></canvas>
            </div>
        </div>

        <div class="table-card" style="padding:20px;">
            <h3 style="margin-bottom:16px;">
                Tren Penggunaan Sesi
            </h3>
            <div class="chart-container-box">
                <canvas id="sesiChart"></canvas>
            </div>
        </div>

    </div>

    {{-- BARIS 2 --}}
    <div class="table-card" style="padding:20px;">
        <h3 style="margin-bottom:16px;">
            Distribusi Penggunaan Playbox
        </h3>
        <div class="chart-container-box donut-box">
            <canvas id="distribusiChart"></canvas>
        </div>
    </div>

    {{-- CHART SCRIPTS --}}
    <script>
    document.addEventListener('DOMContentLoaded',function(){
        // FILTER PERIODE
        const modeInput=document.getElementById('periodMode');
        const harianFilter=document.getElementById('filterHarian');
        const bulananFilter=document.getElementById('filterBulanan');
        const buttons=document.querySelectorAll('.period-mode-btn');
        const harianInputs=harianFilter.querySelectorAll('input');
        const bulananInputs=bulananFilter.querySelectorAll('input');

        function setPeriodMode(mode){
            const isHarian=mode==='harian';

            modeInput.value=mode;
            harianFilter.style.display=isHarian?'grid':'none';
            bulananFilter.style.display=isHarian?'none':'grid';

            harianInputs.forEach(input=>input.disabled=!isHarian);
            bulananInputs.forEach(input=>input.disabled=isHarian);

            buttons.forEach(button=>{
                button.classList.toggle('active',button.dataset.mode===mode);
            });
        }

        buttons.forEach(button=>{
            button.addEventListener('click',function(){
                setPeriodMode(this.dataset.mode);
            });
        });

        setPeriodMode(modeInput.value);

        // MODE CHART
        const isBulanan=@json($periodMode === 'bulanan');

        // PENDAPATAN CHART
        const ctxPendapatan=document.getElementById('pendapatanChart').getContext('2d');

        new Chart(ctxPendapatan,{
            type:'bar',
            data:{
                labels:@json($pendapatanChart['labels']),
                datasets:[{
                    label:'Pendapatan (Rp)',
                    data:@json($pendapatanChart['values']),
                    backgroundColor:'#10b981',
                    borderRadius:isBulanan?8:6,
                    borderSkipped:false,
                    maxBarThickness:isBulanan?90:undefined,
                    categoryPercentage:isBulanan?.65:.8,
                    barPercentage:isBulanan?.75:.9
                }]
            },
            options:{
                responsive:true,
                maintainAspectRatio:false,
                plugins:{
                    legend:{display:false}
                },
                scales:{
                    y:{
                        beginAtZero:true,
                        ticks:{
                            callback:function(value){
                                return 'Rp '+new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                }
            }
        });

        // TREN PENGGUNAAN SESI
        const ctxSesi=document.getElementById('sesiChart').getContext('2d');

        new Chart(ctxSesi,{
            type:isBulanan?'bar':'line',
            data:{
                labels:@json($sesiChart['labels']),
                datasets:[{
                    label:'Jumlah Sesi',
                    data:@json($sesiChart['values']),
                    borderColor:'#8b5cf6',
                    backgroundColor:isBulanan?'#8b5cf6':'rgba(139,92,246,.1)',
                    borderWidth:isBulanan?0:2,
                    borderRadius:isBulanan?8:0,
                    borderSkipped:false,
                    maxBarThickness:isBulanan?90:undefined,
                    categoryPercentage:isBulanan?.65:undefined,
                    barPercentage:isBulanan?.75:undefined,
                    tension:.3,
                    fill:!isBulanan
                }]
            },
            options:{
                responsive:true,
                maintainAspectRatio:false,
                plugins:{
                    legend:{display:false}
                },
                scales:{
                    y:{
                        beginAtZero:true,
                        ticks:{
                            stepSize:1,
                            precision:0
                        }
                    }
                }
            }
        });

        // DISTRIBUSI PENGGUNAAN PLAYBOX
        const ctxDistribusi=document.getElementById('distribusiChart').getContext('2d');

        new Chart(ctxDistribusi,{
            type:'doughnut',
            data:{
                labels:@json($distribusiPlaybox['labels']),
                datasets:[{
                    data:@json($distribusiPlaybox['values']),
                    backgroundColor:[
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6',
                        '#06b6d4',
                        '#f97316',
                        '#64748b'
                    ],
                    borderWidth:1
                }]
            },
            options:{
                responsive:true,
                maintainAspectRatio:false,
                cutout:'70%',
                plugins:{
                    legend:{
                        position:window.innerWidth<768?'bottom':'right',
                        labels:{
                            padding:window.innerWidth<768?12:20,
                            boxWidth:window.innerWidth<768?12:18,
                            boxHeight:window.innerWidth<768?12:18,
                            usePointStyle:false,
                            font:{
                                size:window.innerWidth<768?11:12
                            }
                        }
                    }
                }
            }
        });
    });
    </script>
@endsection
