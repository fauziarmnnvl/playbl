<?php

namespace App\Livewire;

use App\Models\Playbox;
use Livewire\Component;
use App\Models\SesiBermain;

class MonitoringPlaybox extends Component
{
    public $playboxes;

    public function mount()
    {
        $this->loadPlayboxes();
    }

    public function loadPlayboxes()
    {
        SesiBermain::where('status_sesi', 'Berjalan')
        ->whereNotNull('waktu_selesai')
        ->where('waktu_selesai', '<=', now())
        ->get()
        ->each(function ($sesi) {

            $sesi->update([
                'status_sesi' => 'Selesai',
                'sisa_waktu' => 0,
            ]);

            if ($sesi->transaksi && $sesi->transaksi->playbox) {
                $sesi->transaksi->playbox->update([
                    'status_unit' => 'Tersedia',
                ]);
            }
        });

        $user = auth()->user();

        $query = Playbox::with([
            'cabang',
            'transaksiAktif.pelanggan',
            'transaksiAktif.sesiBermain',
        ]);

        // Operator hanya melihat playbox cabangnya
        if ($user->role === 'operator' && $user->id_cabang) {
            $query->where('id_cabang', $user->id_cabang);
        }

        $this->playboxes = $query->orderBy('nama_playbox')->get();
    }

    public function render()
    {
        return view('livewire.monitoring-playbox');
    }
}
