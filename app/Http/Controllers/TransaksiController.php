<?php

namespace App\Http\Controllers;

use App\Models\EventPromo;
use App\Models\Pelanggan;
use App\Models\Playbox;
use App\Models\RiwayatPenggunaan;
use App\Models\SesiBermain;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * TransaksiController — Service controller internal.
 *
 * Controller ini TIDAK memiliki halaman/view sendiri.
 * Method-method ini dipanggil oleh modul lain (Monitoring, Booking, dll)
 * untuk mengelola data transaksi dan sesi bermain.
 */
class TransaksiController extends Controller
{
    /**
     * Buat transaksi baru.
     * Dipanggil oleh modul booking atau form monitoring.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'no_hp'          => 'required|string|max:20',
            'id_cabang'      => 'required|exists:cabang,id_cabang',
            'id_playbox'     => 'required|exists:playbox,id_playbox',
            'durasi'         => 'required|integer|min:15|max:720',
            'id_promo'       => 'nullable|exists:event_promo,id_promo',
        ]);

        DB::beginTransaction();

        try {
            // 1. Buat / cari pelanggan berdasarkan no_hp
            $pelanggan = Pelanggan::firstOrCreate(
                ['no_hp' => $request->no_hp],
                [
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'waktu_daftar'   => now(),
                ]
            );

            // 2. Hitung total harga
            $tarifPerMenit = 500;
            $totalHarga    = $request->durasi * $tarifPerMenit;

            // 3. Terapkan diskon jika ada promo
            if ($request->id_promo) {
                $promo = EventPromo::find($request->id_promo);
                if ($promo && $promo->is_aktif) {
                    if ($promo->tipe_diskon === 'Nominal') {
                        $totalHarga -= $promo->nilai_diskon;
                    } else {
                        // Persentase
                        $totalHarga -= ($totalHarga * $promo->nilai_diskon / 100);
                    }
                    $totalHarga = max(0, $totalHarga);
                }
            }

            // 4. Buat transaksi
            $transaksi = Transaksi::create([
                'kode_transaksi' => Transaksi::generateKodeTransaksi(),
                'id_pelanggan'   => $pelanggan->id_pelanggan,
                'id_cabang'      => $request->id_cabang,
                'id_playbox'     => $request->id_playbox,
                'id_promo'       => $request->id_promo,
                'durasi'          => $request->durasi,
                'total_harga'     => $totalHarga,
                'tgl_transaksi'   => now(),
            ]);

            // 5. Buat sesi bermain (status: Belum Mulai)
            SesiBermain::create([
                'id_transaksi'    => $transaksi->id_transaksi,
                'sisa_waktu'      => $request->durasi,
                'status_sesi'     => 'Belum Mulai',
            ]);

            // 6. Update status playbox → Digunakan
            Playbox::where('id_playbox', $request->id_playbox)
                ->update(['status_unit' => 'Digunakan']);

            // 7. Log aktivitas via Spatie
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['kode' => $transaksi->kode_transaksi])
                ->log("Membuat transaksi baru: {$transaksi->kode_transaksi}");

            DB::commit();

            return redirect()
                ->back()
                ->with('success', "Transaksi {$transaksi->kode_transaksi} berhasil dibuat.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Mulai sesi bermain — set waktu_mulai & waktu_selesai.
     * Dipanggil dari halaman Monitoring Playbox.
     */
    public function mulaiSesi($id)
    {
        $transaksi = Transaksi::with('sesiBermain')->findOrFail($id);
        $sesi      = $transaksi->sesiBermain;

        if (!$sesi || $sesi->status_sesi !== 'Belum Mulai') {
            return redirect()->back()->with('error', 'Sesi tidak dapat dimulai.');
        }

        $sesi->update([
            'waktu_mulai'      => now(),
            'waktu_selesai'    => now()->addMinutes($transaksi->durasi),
            'sisa_waktu'       => $transaksi->durasi,
            'status_sesi'      => 'Berjalan',
        ]);

        // Log aktivitas
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['kode' => $transaksi->kode_transaksi])
            ->log("Memulai sesi bermain: {$transaksi->kode_transaksi}");

        return redirect()
            ->back()
            ->with('success', "Sesi bermain {$transaksi->kode_transaksi} telah dimulai.");
    }

    /**
     * Selesaikan sesi bermain manual.
     * Dipanggil dari halaman Monitoring Playbox.
     */
    public function selesaikanSesi($id)
    {
        $transaksi = Transaksi::with(['sesiBermain', 'playbox'])->findOrFail($id);
        $sesi      = $transaksi->sesiBermain;

        if (!$sesi || $sesi->status_sesi === 'Selesai') {
            return redirect()->back()->with('error', 'Sesi sudah selesai atau tidak ditemukan.');
        }

        DB::beginTransaction();

        try {
            // 1. Update sesi → Selesai
            $sesi->update([
                'sisa_waktu'       => 0,
                'status_sesi'      => 'Selesai',
            ]);

            // 2. Kembalikan status playbox → Tersedia
            $transaksi->playbox->update(['status_unit' => 'Tersedia']);

            // 3. Buat riwayat penggunaan
            RiwayatPenggunaan::firstOrCreate(
                ['id_transaksi' => $transaksi->id_transaksi],
                [
                    'tanggal_main' => today(),
                    'pendapatan'   => $transaksi->total_harga,
                ]
            );

            // 4. Log aktivitas
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['kode' => $transaksi->kode_transaksi])
                ->log("Sesi bermain selesai: {$transaksi->kode_transaksi}");

            DB::commit();

            return redirect()
                ->back()
                ->with('success', "Sesi bermain {$transaksi->kode_transaksi} telah diselesaikan.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Gagal menyelesaikan sesi: ' . $e->getMessage());
        }
    }
}
