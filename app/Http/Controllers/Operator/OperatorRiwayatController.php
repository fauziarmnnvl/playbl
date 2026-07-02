<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class OperatorRiwayatController extends Controller
{
    /**
     * Tampilkan riwayat bermain — hanya transaksi yang berelasi dengan cabang operator.
     * Relasi: Transaksi -> Playbox -> Cabang (filter by cabang_id operator).
     */
    public function index()
    {
        $cabangId = auth()->user()->id_cabang;

        $riwayat = Transaksi::with(['pelanggan', 'playbox.cabang', 'sesiBermain'])
            ->whereHas('playbox', function ($q) use ($cabangId) {
                $q->where('id_cabang', $cabangId);
            })
            ->orderByDesc('tgl_transaksi')
            ->get();

        return view('operator.riwayat.index', compact('riwayat'));
    }
}
