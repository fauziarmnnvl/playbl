<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class OperatorVerifikasiPembayaranController extends Controller
{
    public function index()
    {
        $operator = Auth::user();

        $transaksiList = Transaksi::with([
            'pelanggan',
            'playbox',
            'sesiBermain',
        ])
            ->where('id_cabang', $operator->id_cabang)
            ->where('jenis_sesi', Transaksi::JENIS_SESI_FLEKSIBEL)
            ->where('status_pembayaran', Transaksi::STATUS_MENUNGGU_VERIFIKASI)
            ->orderByDesc('waktu_pembayaran')
            ->get();

        return view('operator.verifikasi-pembayaran.index', compact('transaksiList'));
    }

    public function approve(Transaksi $transaksi)
    {
        $operator = auth()->user();

        abort_if(
            $transaksi->playbox->id_cabang !== $operator->id_cabang ||
            $transaksi->jenis_sesi !== Transaksi::JENIS_SESI_FLEKSIBEL ||
            $transaksi->status_pembayaran !== Transaksi::STATUS_MENUNGGU_VERIFIKASI,
            403
        );

        $transaksi->update([
            'status_pembayaran' => Transaksi::STATUS_DISETUJUI,
            'waktu_verifikasi' => now(),
        ]);

        return redirect()
            ->route('operator.verifikasi-pembayaran')
            ->with('success', 'Pembayaran berhasil disetujui.');
    }

    public function reject(Transaksi $transaksi)
    {
        $operator = auth()->user();

        abort_if(
            $transaksi->playbox->id_cabang !== $operator->id_cabang ||
            $transaksi->jenis_sesi !== 'Fleksibel' ||
            $transaksi->status_pembayaran !== 'Menunggu Verifikasi',
            403
        );

        $transaksi->update([
            'status_pembayaran' => 'Ditolak',
            'waktu_verifikasi' => now(),
        ]);

        return redirect()
            ->route('operator.verifikasi-pembayaran')
            ->with('success', 'Pembayaran berhasil ditolak.');
    }
}