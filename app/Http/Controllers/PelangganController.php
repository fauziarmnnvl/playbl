<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Tampilkan halaman data pelanggan (read-only).
     */
    public function index()
    {
        return view('admin.pelanggan');
    }
}
