<?php

namespace App\Http\Controllers;

use App\Models\Playbox;
use App\Models\SesiBermain;
use App\Models\RiwayatPenggunaan;
use App\Models\Transaksi;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin dengan ringkasan KPI.
     */
    public function index()
    {
        $totalPlayboxTersedia = Playbox::where('status_unit', 'Tersedia')->count();

        $totalSesiAktif = SesiBermain::where('status_sesi', 'Berjalan')
            ->whereDate('waktu_mulai', today())->count();

        $pendapatanHariIni = RiwayatPenggunaan::whereDate('tanggal_main', today())
            ->sum('pendapatan');

        $totalPlaybox = Playbox::count();

        $totalPlayboxAktif =
            Playbox::where('status_unit', 'Digunakan')
            ->count();

        $pendingVerifikasi = 0;
        $activities = Activity::latest()->take(5)->get();

        $usageData = Transaksi::select(
            DB::raw('DATE(tgl_transaksi) as tanggal'),
            DB::raw('COUNT(*) as total')
        )
            ->whereDate('tgl_transaksi', '>=', now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i);
            $labels[] = $tanggal->translatedFormat('d M');
            $jumlah = $usageData->firstWhere('tanggal', $tanggal->toDateString());
            $data[] = $jumlah ? $jumlah->total : 0;
        }

        $playboxUsage = Transaksi::select('id_playbox',DB::raw('COUNT(*) as total'))->with('playbox')->groupBy('id_playbox')->get();

        $donutLabels = [];
        $donutData = [];

        foreach ($playboxUsage as $item) {

            $donutLabels[] = $item->playbox->nama_playbox;
            $donutData[] = $item->total;
        }

        return view('admin.dashboard', compact(
            'totalPlaybox',
            'totalPlayboxAktif',
            'totalPlayboxTersedia',
            'totalSesiAktif',
            'pendapatanHariIni',
            'pendingVerifikasi',
            'activities',
            'labels',
            'data',
            'donutLabels',
            'donutData'
        ));
    }
}
