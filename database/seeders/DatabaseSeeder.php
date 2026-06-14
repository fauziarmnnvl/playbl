<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CabangSeeder::class,
            PlayboxSeeder::class,
            GameSeeder::class,
            EventPromoSeeder::class,
            PelangganSeeder::class,
            TransaksiSeeder::class,
            SesiBermainSeeder::class,
            RiwayatPenggunaanSeeder::class,
        ]);
    }
}
