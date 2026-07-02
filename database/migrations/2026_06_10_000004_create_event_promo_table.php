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
        Schema::create('event_promo', function (Blueprint $table) {
            $table->id('id_promo');
            $table->string('nama_promo', 100);
            $table->enum('tipe_diskon', ['Nominal', 'Persentase'])->default('Nominal');
            $table->decimal('nilai_diskon', 10, 2)->default(0.00);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('banner_promo', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_promo');
    }
};
