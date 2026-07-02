<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class AktivitasController extends Controller
{
    /**
     * Tampilkan halaman riwayat aktivitas / audit trail.
     */
    public function index(Request $request)
    {
        $query = Activity::with('causer')->latest();

        // Filter User
        if ($request->filled('user_filter') && $request->user_filter !== 'semua') {
            if ($request->user_filter === 'sistem') {
                $query->whereNull('causer_id');
            } else {
                $query->where('causer_id', $request->user_filter);
            }
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        // Pagination
        $aktivitasList = $query->paginate(25)->withQueryString();

        // User List untuk Dropdown
        $userList = User::orderBy('nama')->get();

        return view('admin.aktivitas', compact('aktivitasList', 'userList'));
    }
}
