<?php

namespace App\Livewire;

use App\Models\Playbox;
use App\Models\User;
use App\Models\EventPromo;
use App\Models\Transaksi;
use App\Services\PlayboxSessionService;
use App\Services\PromoCalculationService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonitoringPlaybox extends Component
{
    public $playboxes;
    public bool $showPromoModal = false;
    public ?int $selectedTransaksiId = null;
    public ?int $selectedPromoId = null;
    public array $promoAktif = [];

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
            'transaksiAktif.eventPromo',
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

    public function openPromoModal($transaksiId): void
    {
        $user = auth()->user();

        $transaksi = Transaksi::with('sesiBermain')->find($transaksiId);

        if (!$transaksi || ($user->role === User::ROLE_OPERATOR && $transaksi->id_cabang !== $user->id_cabang)) {
            session()->flash('error', 'Transaksi tidak ditemukan atau Anda tidak memiliki akses.');
            return;
        }

        if (!$transaksi->sesiBermain || $transaksi->sesiBermain->status_sesi !== 'Berjalan') {
            session()->flash('error', 'Sesi bermain tidak aktif atau sudah selesai.');
            return;
        }

        if ($transaksi->id_promo !== null) {
            session()->flash('error', 'Transaksi ini sudah menggunakan promo.');
            return;
        }

        $this->promoAktif = EventPromo::where('tanggal_mulai', '<=', today())
            ->where('tanggal_selesai', '>=', today())
            ->orderBy('tanggal_selesai', 'asc')
            ->get()
            ->toArray();

        if (empty($this->promoAktif)) {
            session()->flash('error', 'Tidak ada promo aktif saat ini.');
            return;
        }

        $this->selectedTransaksiId = $transaksiId;
        $this->selectedPromoId = null;
        $this->showPromoModal = true;
    }

    public function closePromoModal(): void
    {
        $this->showPromoModal = false;
        $this->selectedTransaksiId = null;
        $this->selectedPromoId = null;
    }

    public function applyPromo(PromoCalculationService $promoCalculationService): void
    {
        if (!$this->selectedTransaksiId || !$this->selectedPromoId) {
            session()->flash('error', 'Pilih transaksi dan promo terlebih dahulu.');
            return;
        }

        $user = auth()->user();
        $pesanSukses = '';

        try {
            DB::transaction(function () use ($user, $promoCalculationService, &$pesanSukses) {
                $transaksi = Transaksi::lockForUpdate()->find($this->selectedTransaksiId);

                if (!$transaksi || ($user->role === User::ROLE_OPERATOR && $transaksi->id_cabang !== $user->id_cabang)) {
                    throw new \Exception('Transaksi tidak valid atau akses ditolak.');
                }
                if ($transaksi->id_promo !== null) {
                    throw new \Exception('Transaksi ini sudah menggunakan promo.');
                }
                
                $sesi = \App\Models\SesiBermain::where('id_transaksi', $transaksi->id_transaksi)->first();
                if (!$sesi || $sesi->status_sesi !== 'Berjalan') {
                    throw new \Exception('Sesi bermain tidak aktif.');
                }

                $promo = EventPromo::find($this->selectedPromoId);
                if (!$promo) {
                    throw new \Exception('Promo tidak ditemukan.');
                }

                if ($promo->tanggal_mulai > today() || $promo->tanggal_selesai < today()) {
                    throw new \Exception('Promo belum dimulai atau sudah kedaluwarsa.');
                }

                if ($transaksi->jenis_sesi === Transaksi::JENIS_SESI_TETAP) {
                    $hasil = $promoCalculationService->calculate((float) $transaksi->total_harga, $promo);
                    
                    $transaksi->update([
                        'id_promo' => $promo->id_promo,
                        'nilai_potongan' => $hasil['nilai_potongan'],
                        'total_harga' => $hasil['total_harga']
                    ]);

                    activity()
                        ->causedBy($user)
                        ->performedOn($transaksi)
                        ->withProperties([
                            'kode_transaksi' => $transaksi->kode_transaksi,
                            'id_promo' => $promo->id_promo,
                            'nama_promo' => $promo->nama_promo,
                            'nilai_potongan' => $hasil['nilai_potongan'],
                            'total_harga_akhir' => $hasil['total_harga'],
                        ])
                        ->log("Menerapkan promo {$promo->nama_promo} pada transaksi {$transaksi->kode_transaksi}");

                    $pesanSukses = "Promo {$promo->nama_promo} berhasil diterapkan.";
                } elseif ($transaksi->jenis_sesi === Transaksi::JENIS_SESI_FLEKSIBEL) {
                    $transaksi->update([
                        'id_promo' => $promo->id_promo,
                        'nilai_potongan' => 0
                    ]);

                    activity()
                        ->causedBy($user)
                        ->performedOn($transaksi)
                        ->withProperties([
                            'kode_transaksi' => $transaksi->kode_transaksi,
                            'id_promo' => $promo->id_promo,
                            'nama_promo' => $promo->nama_promo,
                            'jenis_sesi' => Transaksi::JENIS_SESI_FLEKSIBEL,
                        ])
                        ->log("Mengaitkan promo {$promo->nama_promo} pada transaksi fleksibel {$transaksi->kode_transaksi}");

                    $pesanSukses = "Promo {$promo->nama_promo} berhasil dikaitkan pada sesi fleksibel.";
                } else {
                    throw new \Exception('Jenis sesi tidak valid.');
                }
            });

            $this->closePromoModal();
            $this->loadPlayboxes();
            session()->flash('success', $pesanSukses);
            
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.monitoring-playbox');
    }
}
