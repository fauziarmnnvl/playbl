<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventPromo;
use Carbon\Carbon;

class EventPromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promos = [
            [
                'nama_promo' => 'Diskon Akhir Pekan',
                'tipe_diskon' => 'Persentase',
                'nilai_diskon' => 20.00,
                'tanggal_mulai' => Carbon::now()->startOfMonth()->toDateString(),
                'tanggal_selesai' => Carbon::now()->endOfMonth()->toDateString(),
                'banner_promo' => null,
            ],
            [
                'nama_promo' => 'Happy Hour Siang',
                'tipe_diskon' => 'Nominal',
                'nilai_diskon' => 5000.00,
                'tanggal_mulai' => Carbon::now()->startOfMonth()->toDateString(),
                'tanggal_selesai' => Carbon::now()->endOfMonth()->toDateString(),
                'banner_promo' => null,
            ],
            [
                'nama_promo' => 'Promo Grand Opening',
                'tipe_diskon' => 'Persentase',
                'nilai_diskon' => 50.00,
                'tanggal_mulai' => Carbon::now()->subMonth()->startOfMonth()->toDateString(),
                'tanggal_selesai' => Carbon::now()->subMonth()->endOfMonth()->toDateString(),
                'banner_promo' => null,
            ],
        ];

        foreach ($promos as $promo) {
            EventPromo::create($promo);
        }
    }
}
