<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Tampilkan katalog game dalam card grid.
     * Mendukung pencarian & filter kategori.
     */
    public function index(Request $request)
    {
        $query = Game::query();

        // Filter pencarian judul
        if ($request->filled('search')) {
            $query->where('judul_game', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $gameList = $query->get();

        // Daftar kategori unik untuk dropdown filter
        $kategoriList = Game::select('kategori')
            ->distinct()
            ->whereNotNull('kategori')
            ->pluck('kategori');

        return view('admin.game.index', compact('gameList', 'kategoriList'));
    }

    /**
     * Tampilkan form tambah game baru.
     */
    public function create()
    {
        return view('admin.game.create');
    }

    /**
     * Simpan data game baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_game'  => 'required|string|max:100',
            'kategori'    => 'nullable|string|max:50',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images/games'), $filename);
            $validated['cover_image'] = 'images/games/'.$filename;
        }

        Game::create($validated);

        return redirect()
            ->route('admin.game.index')
            ->with('success', 'Game berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit game.
     */
    public function edit($id)
    {
        $game = Game::findOrFail($id);

        return view('admin.game.edit', compact('game'));
    }

    /**
     * Update data game di database.
     */
    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $validated = $request->validate([
            'judul_game'  => 'required|string|max:100',
            'kategori'    => 'nullable|string|max:50',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($game->cover_image && file_exists(public_path($game->cover_image))) {
                unlink(public_path($game->cover_image));
            }

            $file = $request->file('cover_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images/games'), $filename);
            $validated['cover_image'] = 'images/games/'.$filename;
        }

        $game->update($validated);

        return redirect()
            ->route('admin.game.index')
            ->with('success', 'Data game berhasil diperbarui.');
    }

    /**
     * Hapus game dari database.
     * BR-GM-02: Data game murni katalog, tidak ada pengecekan relasi transaksi.
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);

        // Hapus cover image dari storage
        if ($game->cover_image && file_exists(public_path($game->cover_image))) {
            unlink(public_path($game->cover_image));
        }

        $game->delete();

        return redirect()
            ->route('admin.game.index')
            ->with('success', 'Game berhasil dihapus.');
    }

    /**
     * Show — redirect ke index.
     */
    public function show($id)
    {
        return redirect()->route('admin.game.index');
    }

    public function publicGames(Request $request)
    {
        $query = Game::query();
        if ($request->filled('search')) {
            $query->where('judul_game', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $games = $query->orderBy('id_game', 'desc')->get();
        $kategoriList = Game::select('kategori')
            ->distinct()
            ->whereNotNull('kategori')
            ->pluck('kategori');
        return view('games', compact('games', 'kategoriList'));
    }
}
