<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Game;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display user's wishlist.
     */
    public function index()
    {
        $user = auth()->user();
        $wishlistGames = $user->wishlistGames()->get();
        return view('wishlist.index', compact('wishlistGames'));
    }

    /**
     * Add a game to user's wishlist.
     */
    public function store(Game $game)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('unauthenticated');
        }

        // avoid duplicates due to unique constraint
        Wishlist::firstOrCreate([
            'user_id' => $user->id,
            'game_id' => $game->id,
        ]);

        return back()->with('success', 'Game ditambahkan ke wishlist.');
    }

    public function destroy(Game $game)
    {
        $user = auth()->user();
        if ($user) {
            Wishlist::where('user_id', $user->id)->where('game_id', $game->id)->delete();
        }
        return back()->with('success', 'Game dihapus dari wishlist.');
    }
}
