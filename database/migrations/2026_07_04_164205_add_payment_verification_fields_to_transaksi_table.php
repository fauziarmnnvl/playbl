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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable()->after('jenis_sesi');
            $table->enum('status_pembayaran', [
                'Belum Bayar',
                'Menunggu Verifikasi',
                'Disetujui',
                'Ditolak',
            ])->default('Belum Bayar')->after('bukti_pembayaran');
            $table->dateTime('waktu_pembayaran')->nullable()->after('status_pembayaran');
            $table->dateTime('waktu_verifikasi')->nullable()->after('waktu_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn([
                'bukti_pembayaran',
                'status_pembayaran',
                'waktu_pembayaran',
                'waktu_verifikasi',
            ]);
        });
    }
};
