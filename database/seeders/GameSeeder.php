<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            [
                'judul_game'  => 'A Way Out',
                'kategori'    => 'Aksi & Petualangan',
                'deskripsi'   => null,
                'cover_image' => 'images/games/A-WAY-OUT.jpeg',
            ],
            [
                'judul_game'  => 'eFootball Mourinho Edition 2026',
                'kategori'    => 'Olahraga',
                'deskripsi'   => null,
                'cover_image' => 'images/games/E-FOOTBALL.jpeg',
            ],
            [
                'judul_game'  => 'FC26',
                'kategori'    => 'Olahraga',
                'deskripsi'   => null,
                'cover_image' => 'images/games/FC26.jpeg',
            ],
            [
                'judul_game'  => 'It Takes Two',
                'kategori'    => 'Aksi & Petualangan',
                'deskripsi'   => null,
                'cover_image' => 'images/games/IT-TAKES-TWO.png',
            ],
            [
                'judul_game'  => 'Moto GP 24',
                'kategori'    => 'Olahraga',
                'deskripsi'   => null,
                'cover_image' => 'images/games/MOTO-GP.png',
            ],
            [
                'judul_game'  => 'Naruto Storm Connections',
                'kategori'    => 'Aksi & Petualangan',
                'deskripsi'   => null,
                'cover_image' => 'images/games/NARUTO-CONNEC.png',
            ],
            [
                'judul_game'  => 'Spider-Man 2',
                'kategori'    => 'Aksi & Petualangan',
                'deskripsi'   => null,
                'cover_image' => 'images/games/SPIDER-MAN.jpeg',
            ],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}