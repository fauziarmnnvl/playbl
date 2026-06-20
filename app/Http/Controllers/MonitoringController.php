<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Tampilkan halaman monitoring Playbox (Admin — semua cabang).
     * Data di-load oleh Livewire component MonitoringPlaybox.
     */
    public function index()
    {
        return view('admin.monitoring');
    }
}
