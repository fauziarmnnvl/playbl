<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelanggans = [
            ['nama_pelanggan' => 'Budi Santoso', 'no_hp' => '081234567890'],
            ['nama_pelanggan' => 'Ahmad Rizki', 'no_hp' => '082198765432'],
            ['nama_pelanggan' => 'Siti Nurhaliza', 'no_hp' => '085678912345'],
            ['nama_pelanggan' => 'Dewi Lestari', 'no_hp' => '087812345678'],
            ['nama_pelanggan' => 'Rafi Pratama', 'no_hp' => '081345678901'],
            ['nama_pelanggan' => 'Andi Wijaya', 'no_hp' => '082256789012'],
            ['nama_pelanggan' => 'Putri Ayu', 'no_hp' => '085367890123'],
            ['nama_pelanggan' => 'Dimas Saputra', 'no_hp' => '087478901234'],
            ['nama_pelanggan' => 'Nur Fadilah', 'no_hp' => '081589012345'],
            ['nama_pelanggan' => 'Rizky Ramadhan', 'no_hp' => '082690123456'],
        ];

        foreach ($pelanggans as $pelanggan) {
            Pelanggan::create($pelanggan);
        }
    }
}
