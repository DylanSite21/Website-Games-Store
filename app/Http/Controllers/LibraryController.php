<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Show user's game library (purchased games).
     */
    public function index()
    {
        $user = auth()->user();

        // Get all games user has purchased via transactions
        $purchasedGames = $user->transactions()
            ->where('status', 'paid')
            ->with('items.game')
            ->orderBy('created_at', 'desc')
            ->get()
            ->pluck('items')
            ->flatten()
            ->pluck('game')
            ->unique('id');

        return view('library.index', compact('purchasedGames'));
    }
}
