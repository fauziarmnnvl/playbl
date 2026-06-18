<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Playbox;
use App\Models\Cabang;

class PlayboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cabangNud = Cabang::where('nama_cabang', 'NUD HOUSE')->first();
        $cabangPalio = Cabang::where('nama_cabang', 'Palióspíti Coffee & Roastery')->first();
        $cabangPirzy = Cabang::where('nama_cabang', 'Pirzycoffee & Eatery')->first();
        $cabangWaroeng = Cabang::where('nama_cabang', 'Waroeng Raden')->first();

        $playboxData = [
            // NUD HOUSE
            ['id_cabang' => $cabangNud->id_cabang, 'nama_playbox' => 'PB-N1', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangNud->id_cabang, 'nama_playbox' => 'PB-N2', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangNud->id_cabang, 'nama_playbox' => 'PB-N3', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangNud->id_cabang, 'nama_playbox' => 'PB-N4', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangNud->id_cabang, 'nama_playbox' => 'PB-N5', 'status_mesin' => 'Maintenance'],
            ['id_cabang' => $cabangNud->id_cabang, 'nama_playbox' => 'PB-N6', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangNud->id_cabang, 'nama_playbox' => 'PB-N7', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangNud->id_cabang, 'nama_playbox' => 'PB-N8', 'status_mesin' => 'Tersedia'],

            // Palióspíti Coffee & Roastery
            ['id_cabang' => $cabangPalio->id_cabang, 'nama_playbox' => 'PB-P1', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPalio->id_cabang, 'nama_playbox' => 'PB-P2', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPalio->id_cabang, 'nama_playbox' => 'PB-P3', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPalio->id_cabang, 'nama_playbox' => 'PB-P4', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPalio->id_cabang, 'nama_playbox' => 'PB-P5', 'status_mesin' => 'Maintenance'],
            ['id_cabang' => $cabangPalio->id_cabang, 'nama_playbox' => 'PB-P6', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPalio->id_cabang, 'nama_playbox' => 'PB-P7', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPalio->id_cabang, 'nama_playbox' => 'PB-P8', 'status_mesin' => 'Tersedia'],

            // Pirzycoffee & Eatery
            ['id_cabang' => $cabangPirzy->id_cabang, 'nama_playbox' => 'PB-E1', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPirzy->id_cabang, 'nama_playbox' => 'PB-E2', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPirzy->id_cabang, 'nama_playbox' => 'PB-E3', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPirzy->id_cabang, 'nama_playbox' => 'PB-E4', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPirzy->id_cabang, 'nama_playbox' => 'PB-E5', 'status_mesin' => 'Maintenance'],
            ['id_cabang' => $cabangPirzy->id_cabang, 'nama_playbox' => 'PB-E6', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPirzy->id_cabang, 'nama_playbox' => 'PB-E7', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangPirzy->id_cabang, 'nama_playbox' => 'PB-E8', 'status_mesin' => 'Tersedia'],

            // Waroeng Raden
            ['id_cabang' => $cabangWaroeng->id_cabang, 'nama_playbox' => 'PB-W1', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangWaroeng->id_cabang, 'nama_playbox' => 'PB-W2', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangWaroeng->id_cabang, 'nama_playbox' => 'PB-W3', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangWaroeng->id_cabang, 'nama_playbox' => 'PB-W4', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangWaroeng->id_cabang, 'nama_playbox' => 'PB-W5', 'status_mesin' => 'Maintenance'],
            ['id_cabang' => $cabangWaroeng->id_cabang, 'nama_playbox' => 'PB-W6', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangWaroeng->id_cabang, 'nama_playbox' => 'PB-W7', 'status_mesin' => 'Tersedia'],
            ['id_cabang' => $cabangWaroeng->id_cabang, 'nama_playbox' => 'PB-W8', 'status_mesin' => 'Tersedia'],
        ];

        foreach ($playboxData as $playbox) {
            Playbox::create($playbox);
        }
    }
}
