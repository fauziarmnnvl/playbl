<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\SesiBermain;
use App\Models\Playbox;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class StatistikController extends Controller
{
    /**
     * Helper untuk mendapatkan startDate dan endDate berdasarkan request.
     */
    private function getFilterDates(Request $request)
    {
        $periodMode = $request->input('period_mode', 'harian');

        if ($periodMode === 'bulanan') {
            $startDate = $request->start_month
                ? Carbon::createFromFormat('Y-m', $request->start_month)->startOfMonth()->startOfDay()
                : now()->startOfMonth()->startOfDay();

            $endDate = $request->end_month
                ? Carbon::createFromFormat('Y-m', $request->end_month)->endOfMonth()->endOfDay()
                : now()->endOfMonth()->endOfDay();

            return [$startDate, $endDate];
        }

        $startDate = $request->start_date
            ? Carbon::parse($request->start_date)->startOfDay()
            : now()->subDays(30)->startOfDay();

        $endDate = $request->end_date
            ? Carbon::parse($request->end_date)->endOfDay()
            : now()->endOfDay();

        return [$startDate, $endDate];
    }

    /**
     * Tampilkan halaman laporan & statistik.
     */
    public function index(Request $request)
    {
        list($startDate, $endDate) = $this->getFilterDates($request);
        $periodMode = $request->input('period_mode', 'harian');

        // KPI 1: Total Pendapatan
        $totalPendapatan = Transaksi::whereBetween('tgl_transaksi', [$startDate, $endDate])
            ->sum('total_harga');

        // KPI 2: Total Transaksi
        $totalTransaksi = Transaksi::whereBetween('tgl_transaksi', [$startDate, $endDate])
            ->count();

        // KPI 3: Total Sesi
        $totalSesi = SesiBermain::whereBetween('waktu_mulai', [$startDate, $endDate])
            ->count();

        // KPI 4: Playbox Teraktif
        $playboxPalingAktif = Transaksi::select('id_playbox', DB::raw('COUNT(*) as total'))
            ->whereBetween('tgl_transaksi', [$startDate, $endDate])
            ->groupBy('id_playbox')
            ->orderByDesc('total')
            ->with('playbox')
            ->first();

        // CHART 1 & 2: Data berdasarkan mode periode
        if ($periodMode === 'bulanan') {
            $pendapatanData = Transaksi::select(
                    DB::raw("DATE_FORMAT(tgl_transaksi, '%Y-%m') as periode"),
                    DB::raw('SUM(total_harga) as total')
                )
                ->whereBetween('tgl_transaksi', [$startDate, $endDate])
                ->groupBy(DB::raw("DATE_FORMAT(tgl_transaksi, '%Y-%m')"))
                ->orderBy('periode', 'asc')
                ->get();

            $pendapatanChart = [
                'labels' => $pendapatanData->pluck('periode')
                    ->map(fn($periode) => Carbon::createFromFormat('Y-m', $periode)->translatedFormat('M Y'))
                    ->toArray(),
                'values' => $pendapatanData->pluck('total')->toArray(),
            ];

            $sesiData = SesiBermain::select(
                    DB::raw("DATE_FORMAT(waktu_mulai, '%Y-%m') as periode"),
                    DB::raw('COUNT(*) as total')
                )
                ->whereBetween('waktu_mulai', [$startDate, $endDate])
                ->groupBy(DB::raw("DATE_FORMAT(waktu_mulai, '%Y-%m')"))
                ->orderBy('periode', 'asc')
                ->get();

            $sesiChart = [
                'labels' => $sesiData->pluck('periode')
                    ->map(fn($periode) => Carbon::createFromFormat('Y-m', $periode)->translatedFormat('M Y'))
                    ->toArray(),
                'values' => $sesiData->pluck('total')->toArray(),
            ];
        } else {
            $pendapatanData = Transaksi::select(
                    DB::raw('DATE(tgl_transaksi) as periode'),
                    DB::raw('SUM(total_harga) as total')
                )
                ->whereBetween('tgl_transaksi', [$startDate, $endDate])
                ->groupBy(DB::raw('DATE(tgl_transaksi)'))
                ->orderBy('periode', 'asc')
                ->get();

            $pendapatanChart = [
                'labels' => $pendapatanData->pluck('periode')
                    ->map(fn($periode) => Carbon::parse($periode)->format('d M'))
                    ->toArray(),
                'values' => $pendapatanData->pluck('total')->toArray(),
            ];

            $sesiData = SesiBermain::select(
                    DB::raw('DATE(waktu_mulai) as periode'),
                    DB::raw('COUNT(*) as total')
                )
                ->whereBetween('waktu_mulai', [$startDate, $endDate])
                ->groupBy(DB::raw('DATE(waktu_mulai)'))
                ->orderBy('periode', 'asc')
                ->get();

            $sesiChart = [
                'labels' => $sesiData->pluck('periode')
                    ->map(fn($periode) => Carbon::parse($periode)->format('d M'))
                    ->toArray(),
                'values' => $sesiData->pluck('total')->toArray(),
            ];
        }

        // CHART 3: Distribusi Penggunaan Playbox (Doughnut Chart)
        $distribusiData = Transaksi::select('id_playbox', DB::raw('COUNT(*) as total'))
            ->whereBetween('tgl_transaksi', [$startDate, $endDate])
            ->groupBy('id_playbox')
            ->with('playbox')
            ->get();

        $distribusiPlaybox = [
            'labels' => $distribusiData->map(fn($d) => $d->playbox->nama_playbox ?? 'Unknown')->toArray(),
            'values' => $distribusiData->pluck('total')->toArray(),
        ];

        return view('admin.statistik', compact(
            'startDate',
            'endDate',
            'periodMode',
            'totalPendapatan',
            'totalTransaksi',
            'totalSesi',
            'playboxPalingAktif',
            'pendapatanChart',
            'sesiChart',
            'distribusiPlaybox'
        ));
    }

    /**
     * Export laporan dalam format PDF.
     */
    public function exportPdf(Request $request)
    {
        list($startDate, $endDate) = $this->getFilterDates($request);

        $transaksi = Transaksi::with([
            'pelanggan', 
            'playbox.cabang', 
            'cabang',
            'eventPromo'
        ])
            ->whereBetween('tgl_transaksi', [$startDate, $endDate])
            ->orderBy('tgl_transaksi', 'desc')
            ->get();

        $totalPendapatan = $transaksi->sum('total_harga');
        $totalTransaksi = $transaksi->count();
        $totalDiskon = $transaksi->sum('nilai_potongan');

        $totalSesi = SesiBermain::whereBetween('waktu_mulai', [$startDate, $endDate])
            ->count();

        $rataRataTransaksi = $totalTransaksi > 0
            ? $totalPendapatan / $totalTransaksi
            : 0;

        $playboxPalingAktif = $transaksi
            ->groupBy('id_playbox')
            ->map(function ($items) {
                return [
                    'nama' => $items->first()->playbox->nama_playbox ?? 'Unknown',
                    'total' => $items->count(),
                ];
            })
            ->sortByDesc('total')
            ->first();

        $jenisSesiTerpopuler = $transaksi
            ->groupBy('jenis_sesi')
            ->map(fn($items) => $items->count())
            ->sortDesc()
            ->keys()
            ->first();

        $ringkasanCabang = $transaksi
            ->groupBy(function ($item) {
                return $item->cabang->nama_cabang
                    ?? $item->playbox->cabang->nama_cabang
                    ?? 'Tidak Diketahui';
            })
            ->map(function ($items, $namaCabang) {
                return [
                    'nama_cabang' => $namaCabang,
                    'total_transaksi' => $items->count(),
                    'total_pendapatan' => $items->sum('total_harga'),
                ];
            })
            ->sortByDesc('total_pendapatan')
            ->values();

        $cabangTerlaris = $ringkasanCabang->first();

        $pdf = Pdf::loadView('admin.statistik-pdf', compact(
            'startDate',
            'endDate',
            'totalPendapatan',
            'totalTransaksi',
            'totalSesi',
            'rataRataTransaksi',
            'playboxPalingAktif',
            'jenisSesiTerpopuler',
            'ringkasanCabang',
            'cabangTerlaris',
            'totalDiskon',
            'transaksi'
        ));

        $pdf->setPaper('a4', 'portrait');

        $filename = 'Laporan_Statistik_BoxPlay_' .
            $startDate->format('Y-m-d') . '_sd_' .
            $endDate->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export laporan dalam format Excel.
     */
    public function exportExcel(Request $request)
    {
        list($startDate, $endDate) = $this->getFilterDates($request);

        $filename = 'Laporan_Statistik_BoxPlay_' . $startDate->format('Y-m-d') . '_sd_' . $endDate->format('Y-m-d') . '.xlsx';

        return Excel::download(new LaporanExport($startDate, $endDate), $filename);
    }
}
