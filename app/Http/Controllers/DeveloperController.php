<?php

namespace App\Http\Controllers;

use App\Models\Game;
class DeveloperController extends Controller
{
    /**
     * Show the developer dashboard, including a list of games they've created.
     */
    public function index()
    {
        $games = Game::where('developer_id', auth()->id())->orderBy('created_at', 'asc')->get();
        return view('developer.index', compact('games'));
    }
}
