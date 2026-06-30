<?php

namespace App\Console\Commands;


use App\Services\SessionNotificationService;
use Illuminate\Console\Command;

class MonitorSessionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:monitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor seluruh sesi bermain';

    /**
     * Execute the console command.
     */
    public function handle(SessionNotificationService $sessionNotification): int
    {
        $sessionNotification->sendFiveMinuteNotifications();
        $sessionNotification->finishExpiredSessions();

        return self::SUCCESS;
    }
}