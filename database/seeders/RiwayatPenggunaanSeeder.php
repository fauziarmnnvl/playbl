<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiwayatPenggunaan;
use App\Models\SesiBermain;
use Carbon\Carbon;

class RiwayatPenggunaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sesiSelesai = SesiBermain::where('status_sesi', 'Selesai')
            ->with('transaksi')
            ->get();

        foreach ($sesiSelesai as $sesi) {
            $transaksi = $sesi->transaksi;

            RiwayatPenggunaan::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'tanggal_main' => Carbon::parse($transaksi->waktu_transaksi)->toDateString(),
                'pendapatan' => $transaksi->total_biaya,
                'keterangan' => 'Sesi selesai - ' . $transaksi->kode_transaksi,
            ]);
        }
    }
}
