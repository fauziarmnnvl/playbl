<?php

namespace App\Http\Controllers;

use App\Models\Playbox;
use App\Models\SesiBermain;
use App\Models\RiwayatPenggunaan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin dengan ringkasan KPI.
     */
    public function index()
    {
        $totalPlayboxTersedia = Playbox::where('status_mesin', 'Tersedia')->count();

        $totalSesiAktif = SesiBermain::where('status_sesi', 'Berjalan')
            ->whereDate('waktu_mulai', today())->count();

        $pendapatanHariIni = RiwayatPenggunaan::whereDate('tanggal_main', today())
            ->sum('pendapatan');

        $totalPlaybox = Playbox::count();

        $totalPlayboxAktif =
            Playbox::where('status_mesin', 'Aktif')
            ->count();

        $pendingVerifikasi = 0;

        return view('admin.dashboard', compact(
            'totalPlaybox',
            'totalPlayboxAktif',
            'totalPlayboxTersedia',
            'totalSesiAktif',
            'pendapatanHariIni',
            'pendingVerifikasi'
        ));
    }
}
