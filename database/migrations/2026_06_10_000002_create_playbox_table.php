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
        Schema::create('playbox', function (Blueprint $table) {
            $table->id('id_playbox');
            $table->foreignId('id_cabang')->constrained('cabang', 'id_cabang')->onDelete('cascade');
            $table->string('nama_playbox', 50);
            $table->enum('status_mesin', ['Tersedia', 'Digunakan', 'Selesai', 'Maintenance'])->default('Tersedia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playbox');
    }
};
