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
            ],
            [
                'nama_cabang' => 'Palióspíti Coffee & Roastery',
                'alamat_cabang' => 'Jl. Kamang, Jati Baru, Kota Padang',
                'kontak_cabang' => '08198765432',
                'jam_operasional' => '10:00 - 04:00',
            ],
            [
                'nama_cabang' => 'Pirzycoffee & Eatery',
                'alamat_cabang' => 'Jl. Pulai, Simpang Haru, Kota Padang',
                'kontak_cabang' => '08567891234',
                'jam_operasional' => '24 Hours',
            ],
            [
                'nama_cabang' => 'Waroeng Raden',
                'alamat_cabang' => 'Jl. Jaksa Agung R. Soeprapto No.7, Kota Padang',
                'kontak_cabang' => '082112223333',
                'jam_operasional' => '10:00 - 06:00',
            ],
        ];

        foreach ($cabangs as $cabang) {
            Cabang::create($cabang);
        }
    }
}
