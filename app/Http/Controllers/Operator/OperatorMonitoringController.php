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
        $cabangId = auth()->user()->id_cabang;

        $playboxList = Playbox::with('cabang')
            ->where('id_cabang', $cabangId)
            ->get();

        return view('operator.monitoring.index', compact('playboxList'));
    }
}
