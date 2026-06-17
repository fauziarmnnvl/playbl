<?php

namespace App\Http\Controllers;

use App\Models\Cabang;

class BookingController extends Controller
{
    public function cabang()
    {
        $cabangs = Cabang::all();
        return view('bookings.cabang', compact('cabangs'));
    }
}