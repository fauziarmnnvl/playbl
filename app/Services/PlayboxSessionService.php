<?php

namespace App\Services;

use App\Models\Playbox;
use App\Models\Transaksi;
use App\Models\SesiBermain;
use Illuminate\Support\Facades\DB;

class PlayboxSessionService
{
    public function startSession(int $idPlaybox): void
    {

        $transaksi = $this->findPendingTransaction($idPlaybox);

        if (!$transaksi) {
            return;
        }

        $playbox = $transaksi->playbox;

        if ($playbox === null) {
            return;
        }

        $sesi = $transaksi->sesiBermain;

        if ($sesi === null) {
            return;
        }

        $now = now();
        DB::transaction(function () use ($sesi, $playbox, $transaksi, $now) {
            
            $sesi->update([
                'waktu_mulai' => $now,
                'waktu_selesai' => $now->copy()->addMinutes($transaksi->durasi),
                'sisa_waktu' => $transaksi->durasi,
                'status_sesi' => SesiBermain::STATUS_BERJALAN,
                'is_notified_5_minutes' => false,
                'is_notified_finished' => false,
            ]);

            $playbox->update(['status_unit' => Playbox::STATUS_DIGUNAKAN]);

        });
    }

    private function findPendingTransaction(int $idPlaybox): ?Transaksi
    {
        return Transaksi::with([
            'sesiBermain',
            'playbox',
        ])
            ->where('id_playbox', $idPlaybox)
            ->tetap()
            ->whereHas('sesiBermain', function ($query) {
                $query->belumMulai();
            })
            ->latest('tgl_transaksi')
            ->first();
    }

}