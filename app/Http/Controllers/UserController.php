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

        if ($user && $user->role === 'developer') {
            return redirect()->route('developer.home');
        }

        // ✅ 1. DATA COROSEL (pakai nama 'corousel' konsisten)
        $corousel = Game::where('status', 'published')
            ->latest()
            ->take(5)
            ->get(); // <- Pastikan ->get()

        // ✅ 2. DATA KATALOG (bisa kena search)
        $query = Game::with('categories')
            ->where('status', 'published');

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $games = $query->orderBy('created_at', 'desc')->get();

        // Wishlist
        $wishlistGameIds = [];
        if ($user) {
            $wishlistGameIds = $user->wishlists()->pluck('game_id')->toArray();
        }

        // ✅ 3. Kirim $corousel (bukan $carouselGames) ke view
        return view('home', compact('games', 'wishlistGameIds', 'corousel'));
    }
}
