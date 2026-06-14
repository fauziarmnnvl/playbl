<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->string('username', 50)->unique()->nullable()->after('nama');
            $table->enum('role', ['admin', 'operator'])->default('admin')->after('password');
            $table->unsignedBigInteger('id_cabang')->nullable()->after('role');

            $table->foreign('id_cabang')
                  ->references('id_cabang')
                  ->on('cabang')
                  ->onDelete('set null');
        });

        // Set username dari nama untuk data existing
        DB::table('admin')->whereNull('username')->update([
            'username' => DB::raw("LOWER(REPLACE(nama, ' ', '_'))"),
        ]);
    }

    public function down(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->dropForeign(['id_cabang']);
            $table->dropColumn(['username', 'role', 'id_cabang']);
        });
    }
};
