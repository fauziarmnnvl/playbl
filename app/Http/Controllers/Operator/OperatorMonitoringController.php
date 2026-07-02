<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Playbox;
use Illuminate\Http\Request;

class OperatorMonitoringController extends Controller
{
    /**
     * Tampilkan monitoring Playbox — hanya cabang milik operator yang login.
     */
    public function index()
    {
        return view('operator.monitoring.index');
    }
}
