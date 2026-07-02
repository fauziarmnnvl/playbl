<?php

namespace App\Http\Controllers;

use App\Models\Playbox;
use App\Models\Cabang;
use Illuminate\Http\Request;

class PlayboxController extends Controller
{
    /**
     * Tampilkan daftar semua Playbox dalam tabel.
     */
    public function index()
    {
        $playboxList = Playbox::with('cabang')
            ->join('cabang', 'playbox.id_cabang', '=', 'cabang.id_cabang')
            ->orderBy('cabang.nama_cabang')
            ->orderBy('playbox.nama_playbox')
            ->select('playbox.*')
            ->paginate(10);

        return view('admin.playbox.index', compact('playboxList'));
    }

    /**
     * Tampilkan form tambah Playbox baru.
     */
    public function create()
    {
        $cabangList = Cabang::orderBy('nama_cabang')->get();

        return view('admin.playbox.create', compact('cabangList'));
    }

    /**
     * Simpan data Playbox baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cabang'     => 'required|exists:cabang,id_cabang',
            'nama_playbox'  => 'required|string|max:50',
            'status_unit'   => 'required|in:Tersedia,Maintenance,Rusak',
        ]);

        $cabang = Cabang::findOrFail($validated['id_cabang']);

        if (!$cabang->status_buka) {
            return back()
                ->withInput()
                ->with('error', 'Cabang yang dipilih sedang nonaktif.');
        }

        Playbox::create($validated);

        return redirect()
            ->route('admin.playbox.index')
            ->with('success', 'Playbox berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit Playbox.
     */
    public function edit($id)
    {
        $playbox = Playbox::findOrFail($id);
        $cabangList = Cabang::all();

        return view('admin.playbox.edit', compact('playbox', 'cabangList'));
    }

    /**
     * Update data Playbox di database.
     */
    public function update(Request $request, $id)
    {
        $playbox = Playbox::findOrFail($id);

        $validated = $request->validate([
            'id_cabang'     => 'required|exists:cabang,id_cabang',
            'nama_playbox'  => 'required|string|max:50',
            'status_unit'   => 'required|in:Tersedia,Maintenance,Rusak',
        ]);

        $cabang = Cabang::findOrFail($validated['id_cabang']);

        if (!$cabang->status_buka) {
            return back()
                ->withInput()
                ->with('error', 'Cabang yang dipilih sedang nonaktif.');
        }

        $playbox->update($validated);

        return redirect()
            ->route('admin.playbox.index')
            ->with('success', 'Data Playbox berhasil diperbarui.');
    }

    /**
     * Hapus Playbox dari database.
     * Cek apakah ada transaksi aktif sebelum menghapus.
     */
    public function destroy($id)
    {
        $playbox = Playbox::findOrFail($id);

        // Cek apakah ada sesi bermain yang masih berjalan
        $hasActiveTransaction = $playbox->transaksi()
            ->whereHas('sesiBermain', function ($sq) {
                $sq->where('status_sesi', 'Berjalan');
            })->exists();

        if ($hasActiveTransaction) {
            return redirect()->back()
                ->with('error', 'Playbox tidak dapat dihapus karena masih memiliki transaksi atau sesi aktif.');
        }

        $playbox->delete();

        return redirect()
            ->route('admin.playbox.index')
            ->with('success', 'Playbox berhasil dihapus.');
    }

    /**
     * Show — redirect ke index.
     */
    public function show($id)
    {
        return redirect()->route('admin.playbox.index');
    }
}
