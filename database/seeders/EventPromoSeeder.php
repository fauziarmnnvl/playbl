<?php

namespace Database\Seeders;

use App\Models\EventPromo;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventPromoSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'nama_promo' => 'Diskon Akhir Pekan',
                'deskripsi' => 'Diskon spesial untuk penyewaan minimal 3 jam di akhir pekan. Ajak teman-temanmu mabar sekarang!',
                'tipe_diskon' => 'Persentase',
                'nilai_diskon' => 20.00,
                'tanggal_mulai' => Carbon::now()->startOfMonth()->toDateString(),
                'tanggal_selesai' => Carbon::now()->endOfMonth()->toDateString(),
                'banner_promo' => null,
            ],
            [
                'nama_promo' => 'Happy Hour Siang',
                'deskripsi' => 'Siang hari bukan berarti sepi. Nikmati promo Happy Hour dan mabar dengan harga lebih hemat!',
                'tipe_diskon' => 'Nominal',
                'nilai_diskon' => 5000.00,
                'tanggal_mulai' => Carbon::now()->startOfMonth()->toDateString(),
                'tanggal_selesai' => Carbon::now()->endOfMonth()->toDateString(),
                'banner_promo' => null,
            ],
            [
                'nama_promo' => 'Promo Grand Opening',
                'deskripsi' => 'Rayakan pembukaan cabang bersama kami dan nikmati diskon spesial untuk pengalaman bermain yang lebih seru!',
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