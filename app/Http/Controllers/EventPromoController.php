<?php

namespace App\Http\Controllers;

use App\Models\EventPromo;
use Illuminate\Http\Request;

class EventPromoController extends Controller
{
    /**
     * Tampilkan daftar promo dengan filter tabs (Semua / Aktif / Nonaktif).
     */
    public function index(Request $request)
    {
        $query = EventPromo::query();

        // Filter tabs
        if ($request->status === 'aktif') {
            $query->where('tanggal_mulai', '<=', today())
                  ->where('tanggal_selesai', '>=', today());
        } elseif ($request->status === 'nonaktif') {
            $query->where(function ($q) {
                $q->where('tanggal_mulai', '>', today())
                  ->orWhere('tanggal_selesai', '<', today());
            });
        }

        $promoList = $query->get();

        return view('admin.promo.index', compact('promoList'));
    }

    /**
     * Tampilkan form tambah promo baru.
     */
    public function create()
    {
        return view('admin.promo.create');
    }

    /**
     * Simpan data promo baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_promo'       => 'required|string|max:100',
            'tipe_diskon'      => 'required|in:Nominal,Persentase',
            'nilai_diskon'     => 'required|numeric|min:0',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'banner_promo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Validasi tambahan: persentase max 100
        if ($request->tipe_diskon === 'Persentase' && $request->nilai_diskon > 100) {
            return back()->withErrors(['nilai_diskon' => 'Nilai diskon persentase maksimal 100%.'])->withInput();
        }

        if ($request->hasFile('banner_promo')) {
            $file = $request->file('banner_promo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images/event-promo'), $filename);
            $validated['banner_promo'] = 'images/event-promo/'.$filename;
        }

        EventPromo::create($validated);

        return redirect()
            ->route('admin.promo.index')
            ->with('success', 'Promo berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit promo.
     */
    public function edit($id)
    {
        $promo = EventPromo::findOrFail($id);

        return view('admin.promo.edit', compact('promo'));
    }

    /**
     * Update data promo di database.
     */
    public function update(Request $request, $id)
    {
        $promo = EventPromo::findOrFail($id);

        $validated = $request->validate([
            'nama_promo'       => 'required|string|max:100',
            'tipe_diskon'      => 'required|in:Nominal,Persentase',
            'nilai_diskon'     => 'required|numeric|min:0',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'banner_promo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Validasi tambahan: persentase max 100
        if ($request->tipe_diskon === 'Persentase' && $request->nilai_diskon > 100) {
            return back()->withErrors(['nilai_diskon' => 'Nilai diskon persentase maksimal 100%.'])->withInput();
        }

        if ($request->hasFile('banner_promo')) {
            if ($promo->banner_promo && file_exists(public_path($promo->banner_promo))) {
                unlink(public_path($promo->banner_promo));
            }

            $file = $request->file('banner_promo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images/event-promo'), $filename);
            $validated['banner_promo'] = 'images/event-promo/'.$filename;
        }

        $promo->update($validated);

        return redirect()
            ->route('admin.promo.index')
            ->with('success', 'Data promo berhasil diperbarui.');
    }

    /**
     * Hapus promo dari database.
     */
    public function destroy($id)
    {
        $promo = EventPromo::findOrFail($id);

        // Hapus banner
        if ($promo->banner_promo && file_exists(public_path($promo->banner_promo))) {
            unlink(public_path($promo->banner_promo));
        }

        $promo->delete();

        return redirect()
            ->route('admin.promo.index')
            ->with('success', 'Promo berhasil dihapus.');
    }

    /**
     * Show — redirect ke index.
     */
    public function show($id)
    {
        return redirect()->route('admin.promo.index');
    }

    public function publicPromo()
    {
        $promoList = EventPromo::where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now())
            ->orderBy('tanggal_selesai')
            ->get();

        return view('events-promos', compact('promoList'));
    }
}
