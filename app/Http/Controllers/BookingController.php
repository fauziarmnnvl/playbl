<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Playbox;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function cabang()
    {
        $cabangs = Cabang::all();
        return view('bookings.cabang', compact('cabangs'));
    }

    public function playbox(Request $request)
    {
        $playboxes = Playbox::where('id_cabang', $request->branch)
            ->orderBy('nama_playbox')
            ->get();

        return view('bookings.playbox', compact('playboxes'));
    }
}