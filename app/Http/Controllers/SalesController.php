<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Show developer sales dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        // Get all paid transactions for games created by this developer
        $sales = \App\Models\TransactionItem::whereHas('game', function ($query) use ($user) {
            $query->where('developer_id', $user->id);
        })
            ->whereHas('transaction', function ($query) {
                $query->where('status', 'paid');
            })
            ->with('game', 'transaction')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Calculate statistics
        $totalRevenue = $sales->sum('price_at_purchase');
        $totalSales = $sales->count();

        // Revenue by game
        $gameRevenue = \App\Models\TransactionItem::whereHas('game', function ($query) use ($user) {
            $query->where('developer_id', $user->id);
        })
            ->whereHas('transaction', function ($query) {
                $query->where('status', 'paid');
            })
            ->with('game')
            ->get()
            ->groupBy('game_id')
            ->map(function ($items) {
                return [
                    'game' => $items->first()->game,
                    'count' => $items->count(),
                    'revenue' => $items->sum('price_at_purchase'),
                ];
            });

        return view('developer.sales.index', compact('sales', 'totalRevenue', 'totalSales', 'gameRevenue'));
    }
}
