<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sesi_bermain', function (Blueprint $table) {
            $table->boolean('is_notified_5_minutes')
                ->default(false)
                ->after('status_sesi');

            $table->boolean('is_notified_finished')
                ->default(false)
                ->after('is_notified_5_minutes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sesi_bermain', function (Blueprint $table) {
            $table->dropColumn([
                'is_notified_5_minutes',
                'is_notified_finished',
            ]);
        });
    }
};