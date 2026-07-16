<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\RiwayatPenggunaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function check()
    {
        $operator = Auth::user();

        // Cari transaksi Menunggu Verifikasi paling baru (berdasarkan waktu pembayaran)
        $latest = Transaksi::where('id_cabang', $operator->id_cabang)
            ->where('jenis_sesi', Transaksi::JENIS_SESI_FLEKSIBEL)
            ->where('status_pembayaran', Transaksi::STATUS_MENUNGGU_VERIFIKASI)
            ->orderByDesc('waktu_pembayaran')
            ->first();

        // Hitung total menunggu verifikasi
        $count = Transaksi::where('id_cabang', $operator->id_cabang)
            ->where('jenis_sesi', Transaksi::JENIS_SESI_FLEKSIBEL)
            ->where('status_pembayaran', Transaksi::STATUS_MENUNGGU_VERIFIKASI)
            ->count();

        return response()->json([
            'count' => $count,
            'latest_id' => $latest ? $latest->id_transaksi : null,
            'latest_payment_at' => $latest ? $latest->waktu_pembayaran : null
        ]);
    }

    public function table()
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

        return view('operator.verifikasi-pembayaran.table', compact('transaksiList'));
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

        DB::transaction(function () use ($transaksi) {
            $transaksi->update([
                'status_pembayaran' => Transaksi::STATUS_DISETUJUI,
                'waktu_verifikasi' => now(),
            ]);

            RiwayatPenggunaan::firstOrCreate(
                ['id_transaksi' => $transaksi->id_transaksi],
                [
                    'tanggal_main' => today(),
                    'pendapatan'   => $transaksi->total_harga,
                ]
            );
        });

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