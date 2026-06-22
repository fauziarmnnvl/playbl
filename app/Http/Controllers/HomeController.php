<?php

namespace App\Http\Controllers;

use App\Models\Game;

class HomeController extends Controller
{
    public function index()
    {
        $featuredGames = Game::whereNotNull('cover_image')
            ->inRandomOrder()
            ->take(7)
            ->get();

        return view('welcome', compact('featuredGames'));
    }
}