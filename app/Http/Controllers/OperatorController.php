<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    /**
     * Tampilkan daftar semua operator.
     */
    public function index()
    {
        $operators = User::with('cabang')
            ->where('role', 'operator')
            ->get();

        return view('admin.operator.index', compact('operators'));
    }

    /**
     * Tampilkan form tambah operator baru.
     */
    public function create()
    {
        $cabangs = Cabang::all();

        return view('admin.operator.create', compact('cabangs'));
    }

    /**
     * Simpan data operator baru.
     * BR-02: Username unik. BR-03: Force role operator. BR-04: Wajib cabang.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:100',
            'username'  => 'required|string|max:50|unique:users,username',
            'email'     => 'required|email|max:100|unique:users,email',
            'password'  => 'required|string|min:8',
            'id_cabang' => 'required|exists:cabang,id_cabang',
        ]);

        User::create([
            'nama'      => $validated['nama'],
            'username'  => $validated['username'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role'      => 'operator', // BR-03: Force role
            'id_cabang' => $validated['id_cabang'],
        ]);

        return redirect()
            ->route('admin.operator.index')
            ->with('success', 'Operator berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit operator.
     */
    public function edit($id)
    {
        $operator = User::findOrFail($id);
        $cabangs = Cabang::all();

        return view('admin.operator.edit', compact('operator', 'cabangs'));
    }

    /**
     * Update data operator.
     * Password hanya diupdate jika field diisi.
     */
    public function update(Request $request, $id)
    {
        $operator = User::findOrFail($id);

        $validated = $request->validate([
            'nama'      => 'required|string|max:100',
            'username'  => 'required|string|max:50|unique:users,username,' . $operator->id,
            'email'     => 'required|email|max:100|unique:users,email,' . $operator->id,
            'password'  => 'nullable|string|min:8',
            'id_cabang' => 'required|exists:cabang,id_cabang',
        ]);

        $data = [
            'nama'      => $validated['nama'],
            'username'  => $validated['username'],
            'email'     => $validated['email'],
            'id_cabang' => $validated['id_cabang'],
        ];

        // Update password hanya jika diisi
        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $operator->update($data);

        return redirect()
            ->route('admin.operator.index')
            ->with('success', 'Data operator berhasil diperbarui.');
    }

    /**
     * Hapus operator.
     */
    public function destroy($id)
    {
        $operator = User::findOrFail($id);

        $operator->delete();

        return redirect()
            ->route('admin.operator.index')
            ->with('success', 'Operator berhasil dihapus.');
    }

    /**
     * Show — redirect ke index.
     */
    public function show($id)
    {
        return redirect()->route('admin.operator.index');
    }
}
