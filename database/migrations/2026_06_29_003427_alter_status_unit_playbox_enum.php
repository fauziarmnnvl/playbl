<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("
            ALTER TABLE playbox
            MODIFY status_unit
            ENUM(
                'Tersedia',
                'Dipesan',
                'Digunakan',
                'Maintenance',
                'Rusak'
            )
            DEFAULT 'Tersedia'
        ");
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("
            ALTER TABLE playbox
            MODIFY status_unit
            ENUM(
                'Tersedia',
                'Digunakan',
                'Maintenance',
                'Rusak'
            )
            DEFAULT 'Tersedia'
        ");
    }
};