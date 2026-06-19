<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SesiBermain;
use App\Models\Transaksi;
use Carbon\Carbon;

class SesiBermainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaksis = Transaksi::orderBy('tgl_transaksi')->get();

        foreach ($transaksis as $index => $transaksi) {

            $waktuTransaksi = Carbon::parse($transaksi->tgl_transaksi);
            $durasi = $transaksi->durasi;

            if ($index < 7) {

                // Sesi selesai
                $waktuMulai = $waktuTransaksi->copy()->addMinutes(5);

                $waktuSelesai = $durasi > 0
                    ? $waktuMulai->copy()->addMinutes($durasi)
                    : $waktuMulai->copy()->addHours(3);

                SesiBermain::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'waktu_mulai' => $waktuMulai,
                    'waktu_selesai' => $waktuSelesai,
                    'sisa_waktu' => 0,
                    'status_sesi' => 'Selesai',
                ]);

            } elseif ($index < 10) {

                // Sesi sedang berjalan
                $waktuMulai = $waktuTransaksi->copy()->addMinutes(5);

                $sisaWaktu = $durasi > 0
                    ? intval($durasi * 0.6)
                    : 120;

                SesiBermain::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'waktu_mulai' => $waktuMulai,
                    'waktu_selesai' => $durasi > 0
                        ? $waktuMulai->copy()->addMinutes($durasi)
                        : null,
                    'sisa_waktu' => $sisaWaktu,
                    'status_sesi' => 'Berjalan',
                ]);

            } else {

                // Belum mulai
                SesiBermain::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'waktu_mulai' => null,
                    'waktu_selesai' => null,
                    'sisa_waktu' => $durasi,
                    'status_sesi' => 'Belum Mulai',
                ]);
            }
        }
    }
}