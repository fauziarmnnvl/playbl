<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cabang', function (Blueprint $table) {
            $table->string('foto_cabang')->nullable()->after('jam_operasional');
            $table->string('link_maps')->nullable()->after('foto_cabang');
            $table->boolean('status_buka')->default(true)->after('link_maps');
        });
    }

    public function down(): void
    {
        Schema::table('cabang', function (Blueprint $table) {
            $table->dropColumn([
                'foto_cabang',
                'link_maps',
                'status_buka'
            ]);
        });
    }
};