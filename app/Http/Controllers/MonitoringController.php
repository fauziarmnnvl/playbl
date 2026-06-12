<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Tampilkan halaman monitoring Playbox.
     */
    public function index()
    {
        return view('admin.monitoring');
    }
}
