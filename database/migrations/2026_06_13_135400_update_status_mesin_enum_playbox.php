<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update data lama SEBELUM mengubah ENUM
        DB::table('playbox')->where('status_mesin', 'Digunakan')->update(['status_mesin' => 'Tersedia']);
        DB::table('playbox')->where('status_mesin', 'Selesai')->update(['status_mesin' => 'Tersedia']);

        // Baru ubah ENUM
        DB::statement("ALTER TABLE playbox MODIFY COLUMN status_mesin ENUM('Tersedia', 'Maintenance', 'Rusak') DEFAULT 'Tersedia'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE playbox MODIFY COLUMN status_mesin ENUM('Tersedia', 'Digunakan', 'Selesai', 'Maintenance') DEFAULT 'Tersedia'");
    }
};
