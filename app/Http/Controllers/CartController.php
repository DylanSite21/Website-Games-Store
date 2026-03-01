<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Game;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Show user's shopping cart.
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('game')
            ->get();

        $total = $cartItems->sum(fn($item) => $item->game->price);

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add a game to cart.
     */
    public function add(Game $game)
    {
        // Check if game already in cart
        $exists = Cart::where('user_id', auth()->id())
            ->where('game_id', $game->id)
            ->exists();

        if ($exists) {
            return back()->with('warning', 'Game sudah ada di cart.');
        }

        Cart::create([
            'user_id' => auth()->id(),
            'game_id' => $game->id,
        ]);

        return back()->with('success', 'Game ditambahkan ke cart!');
    }

    /**
     * Remove game from cart.
     */
    public function remove(Game $game)
    {
        Cart::where('user_id', auth()->id())
            ->where('game_id', $game->id)
            ->delete();

        return back()->with('success', 'Game dihapus dari cart.');
    }

    /**
     * Clear user's entire cart.
     */
    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();
        return back()->with('success', 'Cart dikosongkan.');
    }
}
