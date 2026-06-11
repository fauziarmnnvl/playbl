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
        $transaksis = Transaksi::where('status_bayar', 'Berhasil')->get();

        foreach ($transaksis as $index => $transaksi) {
            $waktuTransaksi = Carbon::parse($transaksi->waktu_transaksi);
            $durasiMenit = $transaksi->durasi_menit;

            // Variasi status sesi
            if ($index < 7) {
                // 7 transaksi pertama: Selesai
                $waktuMulai = $waktuTransaksi->copy()->addMinutes(5);
                $waktuSelesai = $durasiMenit > 0
                    ? $waktuMulai->copy()->addMinutes($durasiMenit)
                    : $waktuMulai->copy()->addHours(3);

                SesiBermain::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'waktu_mulai' => $waktuMulai,
                    'waktu_selesai' => $waktuSelesai,
                    'sisa_waktu_menit' => 0,
                    'status_sesi' => 'Selesai',
                ]);
            } elseif ($index < 10) {
                // 3 transaksi: Berjalan
                $waktuMulai = $waktuTransaksi->copy()->addMinutes(5);
                $sisaWaktu = $durasiMenit > 0 ? intval($durasiMenit * 0.6) : 120;

                SesiBermain::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'waktu_mulai' => $waktuMulai,
                    'waktu_selesai' => $durasiMenit > 0
                        ? $waktuMulai->copy()->addMinutes($durasiMenit)
                        : null,
                    'sisa_waktu_menit' => $sisaWaktu,
                    'status_sesi' => 'Berjalan',
                ]);
            } else {
                // Sisanya: Belum Mulai
                SesiBermain::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'waktu_mulai' => null,
                    'waktu_selesai' => null,
                    'sisa_waktu_menit' => $durasiMenit,
                    'status_sesi' => 'Belum Mulai',
                ]);
            }
        }
    }
}
