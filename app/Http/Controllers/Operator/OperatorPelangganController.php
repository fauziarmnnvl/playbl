<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;

class OperatorPelangganController extends Controller
{
    public function index()
    {
        $cabangId = Auth::user()->id_cabang;
        $search = request('search');

        $pelangganList = Pelanggan::whereHas('transaksi', function ($query) use ($cabangId) {
                $query->where('id_cabang', $cabangId);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_pelanggan', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%");
                });
            })
            ->withCount([
                'transaksi as total_booking' => function ($query) use ($cabangId) {
                    $query->where('id_cabang', $cabangId);
                }
            ])
            ->withMax([
                'transaksi as terakhir_bermain' => function ($query) use ($cabangId) {
                    $query->where('id_cabang', $cabangId);
                }
            ], 'tgl_transaksi')
            ->orderByDesc('terakhir_bermain')
            ->paginate(15)
            ->withQueryString();

        return view('operator.pelanggan.index', compact('pelangganList'));
    }
}