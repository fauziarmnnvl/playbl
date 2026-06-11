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
                'judul_game' => 'EA SPORTS FC 24',
                'kategori' => 'Sports',
                'deskripsi' => 'Game sepakbola dari EA Sports',
                'cover_image' => null,
            ],
            [
                'judul_game' => 'GTA V',
                'kategori' => 'Action',
                'deskripsi' => 'Open world action-adventure game',
                'cover_image' => null,
            ],
            [
                'judul_game' => 'NBA 2K24',
                'kategori' => 'Sports',
                'deskripsi' => 'Game basket simulasi terbaik',
                'cover_image' => null,
            ],
            [
                'judul_game' => 'Tekken 8',
                'kategori' => 'Fighting',
                'deskripsi' => 'Game fighting 3D legendaris',
                'cover_image' => null,
            ],
            [
                'judul_game' => 'Gran Turismo 7',
                'kategori' => 'Racing',
                'deskripsi' => 'Racing simulator premium',
                'cover_image' => null,
            ],
            [
                'judul_game' => 'It Takes Two',
                'kategori' => 'Co-op',
                'deskripsi' => 'Game co-op petualangan',
                'cover_image' => null,
            ],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
