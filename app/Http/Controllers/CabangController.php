<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CabangController extends Controller
{
    /**
     * Tampilkan daftar semua cabang dalam card grid.
     */
    public function index()
    {
        $cabangList = Cabang::withCount('playbox')->get();

        return view('admin.cabang.index', compact('cabangList'));
    }

    /**
     * Tampilkan form tambah cabang baru.
     */
    public function create()
    {
        return view('admin.cabang.create');
    }

    /**
     * Simpan data cabang baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_cabang'     => 'required|string|max:100',
            'alamat_cabang'   => 'nullable|string',
            'kontak_cabang'   => 'nullable|string|max:20',
            'jam_operasional' => 'nullable|string|max:50',
            'link_maps'       => 'nullable|url|max:255',
            'status_buka'     => 'required|boolean',
            'foto_cabang'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto_cabang')) {
            $validated['foto_cabang'] = $request
                ->file('foto_cabang')
                ->store('cabang', 'public');
        }

        Cabang::create($validated);

        return redirect()
            ->route('admin.cabang.index')
            ->with('success', 'Cabang berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit cabang.
     */
    public function edit($id)
    {
        $cabang = Cabang::findOrFail($id);

        return view('admin.cabang.edit', compact('cabang'));
    }

    /**
     * Update data cabang di database.
     */
    public function update(Request $request, $id)
    {
        $cabang = Cabang::findOrFail($id);

        $validated = $request->validate([
            'nama_cabang'     => 'required|string|max:100',
            'alamat_cabang'   => 'nullable|string',
            'kontak_cabang'   => 'nullable|string|max:20',
            'jam_operasional' => 'nullable|string|max:50',
            'link_maps'       => 'nullable|url|max:255',
            'status_buka'     => 'required|boolean',
            'foto_cabang'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto_cabang')) {

            if ($cabang->foto_cabang &&
                Storage::disk('public')->exists($cabang->foto_cabang)) {

                Storage::disk('public')->delete($cabang->foto_cabang);
            }

            $validated['foto_cabang'] = $request
                ->file('foto_cabang')
                ->store('cabang', 'public');
        }

        $cabang->update($validated);

        return redirect()
            ->route('admin.cabang.index')
            ->with('success', 'Data cabang berhasil diperbarui.');
    }

    /**
     * Hapus cabang dari database.
     * BR-CBG-01: Cabang tidak bisa dihapus jika masih ada playbox yang berelasi.
     */
    public function destroy($id)
    {
        $cabang = Cabang::findOrFail($id);

        // Business Rule BR-CBG-01
        if ($cabang->playbox()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cabang tidak dapat dihapus karena masih memiliki Playbox terdaftar.');
        }

        if ($cabang->foto_cabang && Storage::disk('public')->exists($cabang->foto_cabang)) {
            Storage::disk('public')->delete($cabang->foto_cabang);
        }

        $cabang->delete();

        return redirect()->route('admin.cabang.index')
            ->with('success', 'Cabang berhasil dihapus.');
    }

    /**
     * Tampilkan detail cabang (tidak digunakan, redirect ke index).
     */
    public function show($id)
    {
        return redirect()->route('admin.cabang.index');
    }
}
