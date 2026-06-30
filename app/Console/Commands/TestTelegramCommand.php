<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\TelegramService;
use Illuminate\Console\Command;

class TestTelegramCommand extends Command
{
    protected $signature = 'telegram:test';
    protected $description = 'Test Telegram Bot notification';
    public function handle(TelegramService $telegram)
    {
        $operator = User::whereNotNull('telegram_id')->first();

        if (!$operator) {
            $this->error('Tidak ada operator yang memiliki Telegram ID.');

            return Command::FAILURE;
        }

        $success = $telegram->send(
            $operator->telegram_id,
            "🤖 <b>BoxPlay.id</b>\n\nTelegram Bot berhasil terhubung.\n\nIni adalah pesan percobaan dari sistem."
        );

        if ($success) {
            $this->info('Notifikasi Telegram berhasil dikirim.');
            return Command::SUCCESS;
        }

        $this->error('Gagal mengirim notifikasi Telegram.');

        return Command::FAILURE;
    }
}