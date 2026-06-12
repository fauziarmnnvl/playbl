<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    /**
     * Tampilkan halaman riwayat aktivitas / audit trail.
     */
    public function index()
    {
        return view('admin.aktivitas');
    }
}
