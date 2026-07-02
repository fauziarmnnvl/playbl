<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    private readonly string $token;
    private const API_URL = 'https://api.telegram.org/bot';

    public function __construct()
    {
        $this->token = config('services.telegram.bot_token');
    }

    /**
     * Mengirim pesan Telegram ke Chat ID tertentu.
     */
    public function send(string $chatId, string $message): bool
    {
        try {
            $response = Http::timeout(10)
            ->post(
                self::API_URL . "{$this->token}/sendMessage",
                [
                    'chat_id' => $chatId,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                ]
            );

            if (!$response->successful()) {
                Log::warning('Telegram API returned an error.', [
                    'chat_id' => $chatId,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
                return false;
            }
            return true;

        } catch (\Throwable $e) {
            Log::error('Telegram send failed.', [
                'chat_id' => $chatId,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return false;
        }
    }
}