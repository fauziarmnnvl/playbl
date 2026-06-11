<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Playbox;
use App\Models\EventPromo;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelangganIds = Pelanggan::pluck('id_pelanggan')->toArray();
        $playboxIds = Playbox::pluck('id_playbox')->toArray();
        $promoAktif = EventPromo::where('tanggal_selesai', '>=', now()->toDateString())->pluck('id_promo')->toArray();

        $transaksiData = [
            // 7 hari lalu - Berhasil
            [
                'id_pelanggan' => $pelangganIds[0],
                'id_playbox' => $playboxIds[0],
                'id_promo' => $promoAktif[0] ?? null,
                'durasi_menit' => 60,
                'total_biaya' => 40000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subDays(7)->setHour(10)->setMinute(0),
            ],
            // 6 hari lalu - Berhasil
            [
                'id_pelanggan' => $pelangganIds[1],
                'id_playbox' => $playboxIds[1],
                'id_promo' => null,
                'durasi_menit' => 120,
                'total_biaya' => 100000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subDays(6)->setHour(14)->setMinute(30),
            ],
            // 6 hari lalu - Berhasil
            [
                'id_pelanggan' => $pelangganIds[2],
                'id_playbox' => $playboxIds[8],
                'id_promo' => $promoAktif[1] ?? null,
                'durasi_menit' => 30,
                'total_biaya' => 20000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subDays(6)->setHour(16)->setMinute(0),
            ],
            // 5 hari lalu - Berhasil
            [
                'id_pelanggan' => $pelangganIds[3],
                'id_playbox' => $playboxIds[16],
                'id_promo' => null,
                'durasi_menit' => 60,
                'total_biaya' => 50000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subDays(5)->setHour(11)->setMinute(0),
            ],
            // 5 hari lalu - Gagal
            [
                'id_pelanggan' => $pelangganIds[4],
                'id_playbox' => $playboxIds[9],
                'id_promo' => null,
                'durasi_menit' => 60,
                'total_biaya' => 50000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Gagal',
                'waktu_transaksi' => Carbon::now()->subDays(5)->setHour(13)->setMinute(0),
            ],
            // 4 hari lalu - Berhasil
            [
                'id_pelanggan' => $pelangganIds[5],
                'id_playbox' => $playboxIds[24],
                'id_promo' => $promoAktif[0] ?? null,
                'durasi_menit' => 0,
                'total_biaya' => 75000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subDays(4)->setHour(15)->setMinute(0),
            ],
            // 4 hari lalu - Berhasil
            [
                'id_pelanggan' => $pelangganIds[6],
                'id_playbox' => $playboxIds[3],
                'id_promo' => null,
                'durasi_menit' => 120,
                'total_biaya' => 100000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subDays(4)->setHour(17)->setMinute(30),
            ],
            // 3 hari lalu - Berhasil
            [
                'id_pelanggan' => $pelangganIds[7],
                'id_playbox' => $playboxIds[10],
                'id_promo' => null,
                'durasi_menit' => 30,
                'total_biaya' => 25000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subDays(3)->setHour(10)->setMinute(0),
            ],
            // 3 hari lalu - Berhasil
            [
                'id_pelanggan' => $pelangganIds[8],
                'id_playbox' => $playboxIds[17],
                'id_promo' => $promoAktif[1] ?? null,
                'durasi_menit' => 60,
                'total_biaya' => 45000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subDays(3)->setHour(14)->setMinute(0),
            ],
            // 2 hari lalu - Berhasil
            [
                'id_pelanggan' => $pelangganIds[9],
                'id_playbox' => $playboxIds[25],
                'id_promo' => null,
                'durasi_menit' => 60,
                'total_biaya' => 50000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subDays(2)->setHour(12)->setMinute(0),
            ],
            // 2 hari lalu - Menunggu Verifikasi
            [
                'id_pelanggan' => $pelangganIds[0],
                'id_playbox' => $playboxIds[5],
                'id_promo' => null,
                'durasi_menit' => 60,
                'total_biaya' => 50000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Menunggu Verifikasi',
                'waktu_transaksi' => Carbon::now()->subDays(2)->setHour(16)->setMinute(0),
            ],
            // 1 hari lalu - Berhasil
            [
                'id_pelanggan' => $pelangganIds[1],
                'id_playbox' => $playboxIds[2],
                'id_promo' => $promoAktif[0] ?? null,
                'durasi_menit' => 60,
                'total_biaya' => 40000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subDays(1)->setHour(11)->setMinute(0),
            ],
            // Hari ini - Berhasil (sesi berjalan)
            [
                'id_pelanggan' => $pelangganIds[3],
                'id_playbox' => $playboxIds[2],
                'id_promo' => null,
                'durasi_menit' => 120,
                'total_biaya' => 100000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subHours(2),
            ],
            // Hari ini - Menunggu Verifikasi
            [
                'id_pelanggan' => $pelangganIds[5],
                'id_playbox' => $playboxIds[10],
                'id_promo' => null,
                'durasi_menit' => 60,
                'total_biaya' => 50000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Menunggu Verifikasi',
                'waktu_transaksi' => Carbon::now()->subMinutes(30),
            ],
            // Hari ini - Berhasil (belum mulai)
            [
                'id_pelanggan' => $pelangganIds[7],
                'id_playbox' => $playboxIds[18],
                'id_promo' => $promoAktif[1] ?? null,
                'durasi_menit' => 60,
                'total_biaya' => 45000.00,
                'metode_bayar' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'waktu_transaksi' => Carbon::now()->subMinutes(10),
            ],
        ];

        foreach ($transaksiData as $index => $data) {
            $kode = sprintf("TRX-%s-%02d", $data['waktu_transaksi']->format('Ymd'), $index + 1);
            $data['kode_transaksi'] = $kode;
            Transaksi::create($data);
        }
    }
}
