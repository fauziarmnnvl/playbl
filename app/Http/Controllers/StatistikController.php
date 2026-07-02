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

        // CHART 1: Pendapatan Berdasarkan Periode (Bar Chart)
        $pendapatanData = Transaksi::select(
                DB::raw('DATE(tgl_transaksi) as date'),
                DB::raw('SUM(total_harga) as total')
            )
            ->whereBetween('tgl_transaksi', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(tgl_transaksi)'))
            ->orderBy('date', 'asc')
            ->get();
            
        $pendapatanChart = [
            'labels' => $pendapatanData->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray(),
            'values' => $pendapatanData->pluck('total')->toArray(),
        ];

        // CHART 2: Tren Penggunaan Sesi (Line Chart)
        $sesiData = SesiBermain::select(
                DB::raw('DATE(waktu_mulai) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->whereBetween('waktu_mulai', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(waktu_mulai)'))
            ->orderBy('date', 'asc')
            ->get();

        $sesiChart = [
            'labels' => $sesiData->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray(),
            'values' => $sesiData->pluck('total')->toArray(),
        ];

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

        $totalPendapatan = Transaksi::whereBetween('tgl_transaksi', [$startDate, $endDate])->sum('total_harga');
        $totalTransaksi = Transaksi::whereBetween('tgl_transaksi', [$startDate, $endDate])->count();
        $totalSesi = SesiBermain::whereBetween('waktu_mulai', [$startDate, $endDate])->count();
        $playboxPalingAktif = Transaksi::select('id_playbox', DB::raw('COUNT(*) as total'))
            ->whereBetween('tgl_transaksi', [$startDate, $endDate])
            ->groupBy('id_playbox')
            ->orderByDesc('total')
            ->with('playbox')
            ->first();

        $pdf = Pdf::loadView('admin.statistik-pdf', compact(
            'startDate',
            'endDate',
            'totalPendapatan',
            'totalTransaksi',
            'totalSesi',
            'playboxPalingAktif'
        ));

        // Format nama file seperti Laporan_Statistik_BoxPlay_01_Jun_2026.pdf
        $filename = 'Laporan_Statistik_BoxPlay_' . $startDate->format('Y-m-d') . '_sd_' . $endDate->format('Y-m-d') . '.pdf';

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
