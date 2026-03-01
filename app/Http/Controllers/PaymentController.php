<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Show checkout page (review cart before payment).
     */
    public function checkout()
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('game')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('warning', 'Cart Anda kosong.');
        }

        $total = $cartItems->sum(fn($item) => $item->game->price);

        return view('payment.checkout', compact('cartItems', 'total'));
    }

    /**
     * Process payment (create transaction and clear cart).
     */
    public function process(Request $request)
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('game')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart Anda kosong.');
        }

        // Calculate total
        $total = $cartItems->sum(fn($item) => $item->game->price);

        // Create transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'transaction_code' => 'TRX-' . strtoupper(Str::random(10)),
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        // Create transaction items
        foreach ($cartItems as $cartItem) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'game_id' => $cartItem->game->id,
                'price_at_purchase' => $cartItem->game->price,
            ]);
        }

        // Simulating payment success (in production, use payment gateway like Midtrans)
        $transaction->update(['status' => 'paid']);

        // Clear user's cart
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('payment.success', $transaction)->with('success', 'Pembayaran berhasil!');
    }

    /**
     * Show payment success page.
     */
    public function success(Transaction $transaction)
    {
        // Verify user owns this transaction
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $items = $transaction->items()->with('game')->get();

        return view('payment.success', compact('transaction', 'items'));
    }

    /**
     * Show transaction history for user.
     */
    public function history()
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->with('items.game')
            ->paginate(10);

        return view('payment.history', compact('transactions'));
    }
}
