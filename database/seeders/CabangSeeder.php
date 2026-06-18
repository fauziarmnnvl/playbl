<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabang;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cabangs = [
            [
                'nama_cabang' => 'NUD HOUSE',
                'alamat_cabang' => 'Jl. Purus IV No.5, Purus, Kota Padang',
                'kontak_cabang' => '08123456789',
                'jam_operasional' => '24 Hours',
                'foto_cabang' => 'images/branch/nud.jpg',
                'link_maps' => 'https://maps.app.goo.gl/rrPX2J77NUhnEpwi9',
            ],
            [
                'nama_cabang' => 'Palióspíti Coffee & Roastery',
                'alamat_cabang' => 'Jl. Kamang, Jati Baru, Kota Padang',
                'kontak_cabang' => '08198765432',
                'jam_operasional' => '10:00 - 04:00',
                'foto_cabang' => 'images/branch/paliospiti.jpg',
                'link_maps' => 'https://maps.app.goo.gl/eEoY2MsrfTPyKeYL7',
            ],
            [
                'nama_cabang' => 'Pirzycoffee & Eatery',
                'alamat_cabang' => 'Jl. Pulai, Simpang Haru, Kota Padang',
                'kontak_cabang' => '08567891234',
                'jam_operasional' => '24 Hours',
                'foto_cabang' => 'images/branch/pirzy.jpg',
                'link_maps' => 'https://maps.app.goo.gl/cngQEeep1DmWCSmF7',
            ],
            [
                'nama_cabang' => 'Waroeng Raden',
                'alamat_cabang' => 'Jl. Jaksa Agung R. Soeprapto No.7, Kota Padang',
                'kontak_cabang' => '082112223333',
                'jam_operasional' => '10:00 - 06:00',
                'foto_cabang' => 'images/branch/raden.png',
                'link_maps' => 'https://maps.app.goo.gl/q8emUyhMMwCXLVP78',
            ],
        ];

        foreach ($cabangs as $cabang) {
            Cabang::create($cabang);
        }
    }
}
