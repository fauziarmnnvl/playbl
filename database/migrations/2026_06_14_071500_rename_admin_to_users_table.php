<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop foreign key dari tabel lain yang reference id_admin sebelum rename
        // (id_cabang FK di admin table sendiri — perlu drop dulu)
        Schema::table('admin', function (Blueprint $table) {
            $table->dropForeign(['id_cabang']);
        });

        // Rename tabel admin → users
        Schema::rename('admin', 'users');

        // Rename primary key id_admin → id
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('id_admin', 'id');
        });

        // Re-add foreign key setelah rename
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id_cabang')
                  ->references('id_cabang')
                  ->on('cabang')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_cabang']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('id', 'id_admin');
        });

        Schema::rename('users', 'admin');

        Schema::table('admin', function (Blueprint $table) {
            $table->foreign('id_cabang')
                  ->references('id_cabang')
                  ->on('cabang')
                  ->onDelete('set null');
        });
    }
};
