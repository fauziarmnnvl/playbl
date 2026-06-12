<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatistikController extends Controller
{
    /**
     * Tampilkan halaman laporan & statistik.
     */
    public function index()
    {
        return view('admin.statistik');
    }

    /**
     * Export laporan dalam format PDF.
     */
    public function exportPdf()
    {
        //
    }

    /**
     * Export laporan dalam format Excel.
     */
    public function exportExcel()
    {
        //
    }
}
