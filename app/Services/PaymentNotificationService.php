<?php

namespace App\Services;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class PaymentNotificationService
{
    private const APP_NAME = 'BoxPlay.id';

    public function __construct(
        protected TelegramService $telegram
    ) {}

    /**
     * Kirim notifikasi Telegram ke operator cabang saat bukti pembayaran baru diunggah.
     */
    public function notifyNewPayment(Transaksi $transaksi): void
    {
        try {
            // Load relasi yang dibutuhkan
            $transaksi->loadMissing(['playbox.cabang', 'pelanggan']);

            // Validasi data transaksi
            if (!$transaksi->playbox || !$transaksi->pelanggan) {
                Log::warning('Payment notification skipped: Missing playbox or pelanggan relation.', [
                    'id_transaksi' => $transaksi->id_transaksi
                ]);
                return;
            }

            // Cari operator cabang
            $operator = $this->findOperator($transaksi->playbox->id_cabang);

            if (!$this->canNotify($operator)) {
                Log::info('Payment notification skipped: No eligible operator found for branch.', [
                    'id_cabang' => $transaksi->playbox->id_cabang
                ]);
                return;
            }

            $message = $this->buildMessage($transaksi);

            // Kirim notifikasi
            if (!$this->telegram->send($operator->telegram_id, $message)) {
                Log::warning('Failed to send payment verification notification to Telegram.', [
                    'id_transaksi' => $transaksi->id_transaksi,
                    'operator_id' => $operator->id_user
                ]);
            }
        } catch (\Throwable $e) {
            // Jangan gagalkan alur pembayaran jika notifikasi error
            Log::error('Error sending payment notification.', [
                'id_transaksi' => $transaksi->id_transaksi,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Cari operator yang bertanggung jawab di cabang tersebut.
     */
    private function findOperator(int $idCabang): ?User
    {
        return User::where('role', User::ROLE_OPERATOR)
            ->where('id_cabang', $idCabang)
            ->first();
    }

    /**
     * Cek apakah operator valid dan memiliki telegram_id.
     */
    private function canNotify(?User $operator): bool
    {
        return $operator !== null && filled($operator->telegram_id);
    }

    /**
     * Bangun pesan HTML untuk Telegram.
     */
    private function buildMessage(Transaksi $transaksi): string
    {
        $namaCabang = $transaksi->playbox->cabang->nama_cabang ?? '-';
        $namaPlaybox = $transaksi->playbox->nama_playbox ?? '-';
        $namaPelanggan = $transaksi->pelanggan->nama_pelanggan ?? '-';
        $totalPembayaran = 'Rp ' . number_format($transaksi->total_harga, 0, ',', '.');

        return "💳 <b>" . self::APP_NAME . "</b>\n\n" .
               "🔔 <b>Verifikasi Pembayaran Baru</b>\n\n" .
               "📍 Cabang : {$namaCabang}\n" .
               "🎮 Playbox : {$namaPlaybox}\n" .
               "👤 Pelanggan : {$namaPelanggan}\n" .
               "💰 Total : {$totalPembayaran}\n\n" .
               "Bukti pembayaran telah diunggah.\n" .
               "Silakan periksa dan lakukan verifikasi pembayaran.";
    }
}
