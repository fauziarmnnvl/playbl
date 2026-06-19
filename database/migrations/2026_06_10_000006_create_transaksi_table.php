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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('kode_transaksi', 30)->unique();
            $table->foreignId('id_pelanggan')
                ->constrained('pelanggan', 'id_pelanggan')
                ->onDelete('cascade');
            $table->foreignId('id_cabang')
                ->constrained('cabang', 'id_cabang')
                ->onDelete('cascade');
            $table->foreignId('id_playbox')
                ->constrained('playbox', 'id_playbox')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_promo')->nullable();
            $table->foreign('id_promo')
                ->references('id_promo')
                ->on('event_promo')
                ->onDelete('set null');
            $table->integer('durasi')->default(60);
            $table->decimal('total_harga', 15, 2)->default(0.00);
            $table->dateTime('tgl_transaksi')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
