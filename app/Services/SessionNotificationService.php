<?php

namespace App\Services;

use App\Models\SesiBermain;
use App\Models\User;
use App\Models\Playbox;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class SessionNotificationService
{
    private const APP_NAME = 'BoxPlay.id';
    public function __construct(
        protected TelegramService $telegram
    ) {
    }
    
    public function sendFiveMinuteNotifications(): void
    {
        foreach ($this->warningSessions() as $sesi) {
            $this->notifyFiveMinute($sesi);
        }
    }

    public function finishExpiredSessions(): void
    {
        foreach ($this->expiredSessions() as $sesi) {
            $this->finishSession($sesi);
        }
    }
    
    /**
     * Mengirim notifikasi lima menit sebelum sesi berakhir.
     */
    private function notifyFiveMinute(SesiBermain $sesi): void
    {
        $operator = $this->getNotifiableOperator($sesi);
        if (!$operator) {
            return;
        }

        if (!$this->telegram->send(
            $operator->telegram_id,
            $this->buildWarningMessage($sesi)
        )) {
            Log::warning('Failed to send five minute notification.', [
                'session_id' => $sesi->id_sesi,
                'operator_id' => $operator->id_user,
            ]);
            return;
        }
        
        $sesi->update([
            'is_notified_5_minutes' => true,
        ]);
    }
    
    /**
     * Menyelesaikan sesi yang telah melewati waktu selesai.
     */
    private function finishSession(SesiBermain $sesi): void
    {
        $operator = $this->getNotifiableOperator($sesi);
        if (!$operator) {
            return;
        }

        if (!$this->telegram->send(
            $operator->telegram_id,
            $this->buildFinishedMessage($sesi)
        )) {
            Log::warning('Failed to send finished notification.', [
                'session_id' => $sesi->id_sesi,
                'operator_id' => $operator->id_user,
            ]);

            return;
        }

        DB::transaction(function () use ($sesi, $operator) {

            $sesi->update([
                'status_sesi' => SesiBermain::STATUS_SELESAI,
                'sisa_waktu' => 0,
                'is_notified_finished' => true,
            ]);

            $sesi->transaksi->playbox->update([
                'status_unit' => Playbox::STATUS_TERSEDIA,
            ]);

        });
    }

    /**
     * Mengambil operator sesuai cabang playbox.
     */
    private function findOperator(SesiBermain $sesi): ?User 
    {
        return User::query()
            ->where('role', User::ROLE_OPERATOR)
            ->where('id_cabang', $sesi->transaksi->playbox->id_cabang)
            ->first();
    }

    /**
     * Membangun pesan Telegram untuk notifikasi lima menit.
     */
    private function buildWarningMessage(SesiBermain $sesi): string
    {
        $data = $this->sessionData($sesi);

        return
           "🎮 <b>" . self::APP_NAME . "</b>\n\n".
            "⏰ <b>Peringatan Sesi Bermain</b>\n\n".
            "📍 Cabang : {$data['cabang']}\n".
            "🎮 Playbox : {$data['playbox']}\n".
            "👤 Pelanggan : {$data['pelanggan']}\n".
            "⏳ Sisa Waktu : 5 Menit\n\n".
            "Mohon bersiap untuk pergantian sesi.";
    }

    /**
     * Membangun pesan Telegram untuk notifikasi sesi selesai.
     */
    private function buildFinishedMessage(SesiBermain $sesi): string
    {
        $data = $this->sessionData($sesi);

        return
            "🎮 <b>" . self::APP_NAME . "</b>\n\n".
            "🛑 <b>Sesi Bermain Selesai</b>\n\n".
            "📍 Cabang : {$data['cabang']}\n".
            "🎮 Playbox : {$data['playbox']}\n".
            "👤 Pelanggan : {$data['pelanggan']}\n".
            "Sesi bermain telah berakhir.\n".
            "Silakan lakukan pengecekan unit sebelum menerima pelanggan berikutnya.";
    }

    private function canNotify(?User $operator): bool
    {
        return $operator !== null && filled($operator->telegram_id);
    }


    private function sessionQuery(): Builder
    {
        return SesiBermain::with([
            'transaksi.playbox.cabang',
            'transaksi.pelanggan',
        ])->running();
    }

    /**
     * @return array{
     *     playbox:string,
     *     cabang:string,
     *     pelanggan:string
     * }
     */
    private function sessionData(SesiBermain $sesi): array
    {
        return [
            'playbox' => $sesi->transaksi->playbox->nama_playbox ?? 'Playbox',
            'cabang' => $sesi->transaksi->playbox->cabang->nama_cabang ?? '-',
            'pelanggan' => $sesi->transaksi->pelanggan->nama_pelanggan ?? '-',
        ];
    }

    private function getNotifiableOperator(SesiBermain $sesi): ?User
    {
        if (!$sesi->transaksi || !$sesi->transaksi->playbox) {
            return null;
        }

        $operator = $this->findOperator($sesi);

        return $this->canNotify($operator)
            ? $operator
            : null;
    }

    private function warningSessions(): Collection
    {
        $now = now();

        return $this->sessionQuery()
            ->where('is_notified_5_minutes', false)
            ->where('waktu_selesai', '<=', $now->copy()->addMinutes(5))
            ->where('waktu_selesai', '>', $now)
            ->get();
    }

    private function expiredSessions(): Collection
    {
        $now = now();

        return $this->sessionQuery()
            ->where('is_notified_finished', false)
            ->where('waktu_selesai', '<=', $now)
            ->get();
    }

}