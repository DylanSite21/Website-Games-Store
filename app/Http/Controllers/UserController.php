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

        // start query for published games
        $query = Game::with('categories')
            ->where('status', 'published');

        // apply search filter if provided
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $games = $query->orderBy('created_at', 'desc')->get();

        // if user is logged-in (should be via middleware) gather wishlist ids
        $wishlistGameIds = [];
        if ($user) {
            $wishlistGameIds = $user->wishlists()->pluck('game_id')->toArray();
        }

        return view('home', compact('games', 'wishlistGameIds'));
    }
}
