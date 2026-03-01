<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DeveloperController extends Controller
{
    /**
     * Show the developer dashboard, including a list of games they've created.
     */
    public function index()
    {
        $games = Game::where('developer_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('developer.index', compact('games'));
    }
}
