<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the application home page for non-developers (game catalog).
     *
     * Developers are redirected to their dashboard; regular users see
     * published games and a short list of wishlist IDs so the view can
     * mark which titles they have already added.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        // developers get redirected to their own dashboard
        if ($user && $user->role === 'developer') {
            return redirect()->route('developer.home');
        }

        // published games only
        $games = Game::with('categories')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get();

        // if user is logged-in (should be via middleware) gather wishlist ids
        $wishlistGameIds = [];
        if ($user) {
            $wishlistGameIds = $user->wishlists()->pluck('game_id')->toArray();
        }

        return view('home', compact('games', 'wishlistGameIds'));
    }
}
