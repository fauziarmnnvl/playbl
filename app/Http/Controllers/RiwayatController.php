<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    /**
     * Tampilkan halaman riwayat bermain (read-only).
     */
    public function index()
    {
        return view('admin.riwayat');
    }
}
