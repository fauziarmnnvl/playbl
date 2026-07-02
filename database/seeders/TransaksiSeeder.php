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
        $playboxes = Playbox::with('cabang')->get()->keyBy('id_playbox');

        $transaksiData = [
            // 7 hari lalu - Tetap
            [
            'id_pelanggan' => $pelangganIds[0],
            'id_playbox' => $playboxIds[0],
            'id_promo' => $promoAktif[0] ?? null,
            'jenis_sesi' => 'Tetap',
            'durasi' => 60,
            'total_harga' => 40000.00,
            'tgl_transaksi' => Carbon::now()->subDays(7)->setHour(10)->setMinute(0),
            ],

            // 6 hari lalu - Tetap
            [
                'id_pelanggan' => $pelangganIds[1],
                'id_playbox' => $playboxIds[1],
                'id_promo' => null,
                'jenis_sesi' => 'Tetap',
                'durasi' => 120,
                'total_harga' => 100000.00,
                'tgl_transaksi' => Carbon::now()->subDays(6)->setHour(14)->setMinute(30),
            ],

            // 6 hari lalu - Fleksibel
            [
                'id_pelanggan' => $pelangganIds[2],
                'id_playbox' => $playboxIds[8],
                'id_promo' => $promoAktif[1] ?? null,
                'jenis_sesi' => 'Fleksibel',
                'durasi' => 0,
                'total_harga' => 35550.00,
                'tgl_transaksi' => Carbon::now()->subDays(6)->setHour(16)->setMinute(0),
            ],

            // 5 hari lalu - Tetap
            [
                'id_pelanggan' => $pelangganIds[3],
                'id_playbox' => $playboxIds[16],
                'id_promo' => null,
                'jenis_sesi' => 'Tetap',
                'durasi' => 60,
                'total_harga' => 50000.00,
                'tgl_transaksi' => Carbon::now()->subDays(5)->setHour(11)->setMinute(0),
            ],

            // 5 hari lalu - Fleksibel
            [
                'id_pelanggan' => $pelangganIds[4],
                'id_playbox' => $playboxIds[9],
                'id_promo' => null,
                'jenis_sesi' => 'Fleksibel',
                'durasi' => 0,
                'total_harga' => 47400.00,
                'tgl_transaksi' => Carbon::now()->subDays(5)->setHour(13)->setMinute(0),
            ],

            // 4 hari lalu - Fleksibel
            [
                'id_pelanggan' => $pelangganIds[5],
                'id_playbox' => $playboxIds[24],
                'id_promo' => $promoAktif[0] ?? null,
                'jenis_sesi' => 'Fleksibel',
                'durasi' => 0,
                'total_harga' => 75000.00,
                'tgl_transaksi' => Carbon::now()->subDays(4)->setHour(15)->setMinute(0),
            ],

            // 4 hari lalu - Tetap
            [
                'id_pelanggan' => $pelangganIds[6],
                'id_playbox' => $playboxIds[3],
                'id_promo' => null,
                'jenis_sesi' => 'Tetap',
                'durasi' => 120,
                'total_harga' => 100000.00,
                'tgl_transaksi' => Carbon::now()->subDays(4)->setHour(17)->setMinute(30),
            ],

            // 3 hari lalu - Tetap
            [
                'id_pelanggan' => $pelangganIds[7],
                'id_playbox' => $playboxIds[10],
                'id_promo' => null,
                'jenis_sesi' => 'Tetap',
                'durasi' => 30,
                'total_harga' => 25000.00,
                'tgl_transaksi' => Carbon::now()->subDays(3)->setHour(10)->setMinute(0),
            ],

            // 3 hari lalu - Fleksibel
            [
                'id_pelanggan' => $pelangganIds[8],
                'id_playbox' => $playboxIds[17],
                'id_promo' => $promoAktif[1] ?? null,
                'jenis_sesi' => 'Fleksibel',
                'durasi' => 0,
                'total_harga' => 45000.00,
                'tgl_transaksi' => Carbon::now()->subDays(3)->setHour(14)->setMinute(0),
            ],

            // 2 hari lalu - Tetap
            [
                'id_pelanggan' => $pelangganIds[9],
                'id_playbox' => $playboxIds[25],
                'id_promo' => null,
                'jenis_sesi' => 'Tetap',
                'durasi' => 60,
                'total_harga' => 50000.00,
                'tgl_transaksi' => Carbon::now()->subDays(2)->setHour(12)->setMinute(0),
            ],

            // Hari ini - Tetap (berjalan)
            [
                'id_pelanggan' => $pelangganIds[3],
                'id_playbox' => $playboxIds[2],
                'id_promo' => null,
                'jenis_sesi' => 'Tetap',
                'durasi' => 120,
                'total_harga' => 100000.00,
                'tgl_transaksi' => Carbon::now()->subHours(2),
            ],

            // Hari ini - Fleksibel (berjalan)
            [
                'id_pelanggan' => $pelangganIds[5],
                'id_playbox' => $playboxIds[10],
                'id_promo' => null,
                'jenis_sesi' => 'Fleksibel',
                'durasi' => 0,
                'total_harga' => 0,
                'tgl_transaksi' => Carbon::now()->subMinutes(30),
            ],

            // Hari ini - Fleksibel (belum selesai)
            [
                'id_pelanggan' => $pelangganIds[7],
                'id_playbox' => $playboxIds[18],
                'id_promo' => $promoAktif[1] ?? null,
                'jenis_sesi' => 'Fleksibel',
                'durasi' => 0,
                'total_harga' => 0,
                'tgl_transaksi' => Carbon::now()->subMinutes(10),
            ],

        ];

        foreach ($transaksiData as $index => $data) {
            $data['id_cabang'] = $playboxes[$data['id_playbox']]->id_cabang;
            $kode = sprintf("TRX-%s-%02d", $data['tgl_transaksi']->format('Ymd'), $index + 1);
            $data['kode_transaksi'] = $kode;

            Transaksi::create($data);
        }
    }
}
