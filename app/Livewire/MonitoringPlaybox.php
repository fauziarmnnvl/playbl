<?php

namespace App\Livewire;

use App\Models\Playbox;
use App\Models\Transaksi;
use App\Models\SesiBermain;
use Livewire\Component;

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

    public function mulaiSesi($idPlaybox)
    {
        $playbox = Playbox::findOrFail($idPlaybox);

        $transaksi = Transaksi::where('id_playbox', $idPlaybox)
        ->where('jenis_sesi', 'Tetap')
        ->whereHas('sesiBermain', function ($q) { $q->where('status_sesi', 'Belum Mulai'); })
        ->latest('tgl_transaksi')
        ->first();

        if (!$transaksi) {
            return;
        }

        $sesi = SesiBermain::where('id_transaksi', $transaksi->id_transaksi)
            ->first();

        if (!$sesi) {
            return;
        }

       $sesi->update([
            'waktu_mulai' => now(),
            'waktu_selesai' => now()->addMinutes($transaksi->durasi),
            'sisa_waktu' => $transaksi->durasi,
            'status_sesi' => 'Berjalan',
        ]);

        $playbox->update([
            'status_unit' => 'Digunakan',
        ]);

        $this->loadPlayboxes();
    }

    public function render()
    {
        return view('livewire.monitoring-playbox');
    }
}
