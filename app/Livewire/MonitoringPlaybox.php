<?php

namespace App\Livewire;

use App\Models\Playbox;
use App\Models\User;
use App\Services\PlayboxSessionService;
use Livewire\Component;

class MonitoringPlaybox extends Component
{
    public $playboxes;

    public function mount(): void
    {
        $this->loadPlayboxes();
    }

    public function loadPlayboxes(): void
    {
        $user = auth()->user();

        $query = Playbox::with([
            'cabang',
            'transaksiAktif.pelanggan',
            'transaksiAktif.sesiBermain',
        ]);

        // Operator hanya melihat playbox cabangnya
        if ($user->role === User::ROLE_OPERATOR && $user->id_cabang) {
            $query->where('id_cabang', $user->id_cabang);
        }

        $this->playboxes = $query->orderBy('nama_playbox')->get();
    }

    public function mulaiSesi(int $idPlaybox, PlayboxSessionService $playboxSession): void 
    {
        $playboxSession->startSession($idPlaybox);
        $this->loadPlayboxes();
    }

    public function render()
    {
        return view('livewire.monitoring-playbox');
    }
}
