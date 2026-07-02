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

           <div class="panel-body" style="height:350px;">
                <canvas id="usageChart"></canvas>
           </div>
        </div>

        <div class="dashboard-panel">
            <div class="panel-header">
                <h2>Distribusi Penggunaan</h2>
            </div>

            <div class="panel-body" style="height:350px;">
                <canvas id="donutChart"></canvas>
            </div>
        </div>
    </div>
    <div class="dashboard-panel activity-panel">
        <div class="panel-header">
            <h2>Aktivitas Terbaru</h2>
        </div>
        <div class="activity-list">
            @forelse($activities as $activity)
                <div class="activity-item">
                    <span class="activity-dot blue"></span>
                    <div>
                        <strong>{{ $activity->description }}</strong>
                        <p>{{ $activity->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty

                <p class="text-gray-500">
                    Belum ada aktivitas.
                </p>
            @endforelse

        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// ================= BAR CHART =================
const ctx = document.getElementById('usageChart');

new Chart(ctx, {
    type: 'bar',

    data: {
        labels: @json($labels),

        datasets: [{
            label: 'Jumlah Booking',
            data: @json($data),
            backgroundColor: '#2563eb',
            borderColor: '#2563eb',
            borderWidth: 0,
            borderRadius: 6,
            borderSkipped: false,
            barPercentage: 0.7,
            categoryPercentage: 0.8
        }]
    },

    options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                display: false
            }
        },

        scales: {
            x: {
                grid: {
                    color: '#e5e7eb'
                },

                ticks: {
                    color: '#6b7280',
                    font: {
                        size: 13
                    }
                }
            },

            y: {
                beginAtZero: true,
                grid: {
                    color: '#e5e7eb'
                },
                ticks: {
                    precision: 0,
                    color: '#6b7280'
                }
            }
        }
    }
});

// ================= DONUT CHART =================

const donutCtx = document.getElementById('donutChart');
new Chart(donutCtx, {
    type: 'doughnut',
    data: {
        labels: @json($donutLabels),
        datasets: [{
            data: @json($donutData),
            backgroundColor: [
                '#3b82f6',
                '#10b981',
                '#f59e0b',
                '#8b5cf6',
                '#ef4444',
                '#06b6d4',
                '#ec4899',
                '#84cc16',
            ],

            borderWidth: 0,
            hoverOffset: 10
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '68%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                    padding: 20,

                    font: {
                        size: 13
                    }
                }
            }
        }
    }
});

</script>
@endpush
