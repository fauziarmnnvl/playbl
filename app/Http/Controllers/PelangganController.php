<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Tampilkan halaman data pelanggan (read-only).
     */
    public function index(Request $request)
    {
        $query = Pelanggan::withCount('transaksi')
            ->withMax('transaksi', 'waktu_transaksi');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pelanggan', 'like', '%' . $request->search . '%')
                  ->orWhere('no_hp', 'like', '%' . $request->search . '%');
            });
        }

        $pelangganList = $query->paginate(15)->withQueryString();

        return view('admin.pelanggan', compact('pelangganList'));
    }
}
