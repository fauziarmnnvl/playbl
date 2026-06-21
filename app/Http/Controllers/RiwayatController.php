<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Playbox;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{

    public function index(Request $request)
    {
        $query = Transaksi::with([
            'pelanggan',
            'playbox.cabang',
            'cabang',
            'sesiBermain',
        ])->whereHas('sesiBermain', function ($q) {
            $q->where('status_sesi', 'Selesai');
        });

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tgl_transaksi', $request->tanggal);
        }

        // Filter playbox
        if ($request->filled('playbox')) {
            $query->where('id_playbox', $request->playbox);
        }

        // Filter nama pelanggan (search)
        if ($request->filled('search')) {
            $query->whereHas('pelanggan', function ($q) use ($request) {
                $q->where('nama_pelanggan', 'like', '%' . $request->search . '%');
            });
        }

        // BR-RWT-04: Terbaru dulu, pagination 20 per halaman
        $riwayatList = $query
            ->orderBy('tgl_transaksi', 'desc')
            ->paginate(20)
            ->withQueryString(); // agar filter tetap di URL saat ganti halaman

        // Data dropdown playbox untuk filter
        $playboxList = Playbox::orderBy('nama_playbox')->get();

        return view('admin.riwayat', compact(
            'riwayatList',
            'playboxList'
        ));
    }
}