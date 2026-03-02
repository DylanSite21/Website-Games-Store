<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function index()
    {
        // developer view of own games
        $games = Game::where('developer_id', auth()->id())->with('categories')->get();
        return view('developer.games.index', compact('games'));
    }

    /**
     * Show game details (public facing page).
     */
    public function show(Game $game)
    {
        // Check if game is published or user is developer
        if ($game->status !== 'published' && (!auth()->check() || $game->developer_id !== auth()->id())) {
            abort(403);
        }

        return view('games.show', compact('game'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('developer.games.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|max:10240',
            'video_trailer' => 'nullable|url',
            'package' => 'nullable|file|mimes:zip,exe,mp4|max:102400',
            'status' => 'required|in:draft,published,rejected',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        $data['developer_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        if ($request->hasFile('package')) {
            $data['package'] = $request->file('package')->store('packages', 'public');
        }

        $game = Game::create($data);

        if (!empty($data['categories'])) {
            $game->categories()->sync($data['categories']);
        }

        return redirect()->route('developer.games.index')->with('success', 'Game berhasil dibuat.');
    }

    public function edit(Game $game)
    {
        if ($game->developer_id !== auth()->id()) {
            abort(403);
        }
        $categories = Category::all();
        return view('developer.games.edit', compact('game', 'categories'));
    }

    public function update(Request $request, Game $game)
    {
        if ($game->developer_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|max:10240',
            'video_trailer' => 'nullable|url',
            'package' => 'nullable|file|mimes:zip,exe|max:102400',
            'status' => 'required|in:draft,published,rejected',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($request->hasFile('cover_image')) {
            Storage::disk('public')->delete($game->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        if ($request->hasFile('package')) {
            Storage::disk('public')->delete($game->package);
            $data['package'] = $request->file('package')->store('packages', 'public');
        }

        $data['slug'] = Str::slug($data['title']);
        $game->update($data);

        $game->categories()->sync($data['categories'] ?? []);

        return redirect()->route('developer.games.index')->with('success', 'Game berhasil diupdate.');
    }

    public function destroy(Game $game)
    {
        if ($game->developer_id !== auth()->id()) {
            abort(403);
        }
        $game->delete();
        return redirect()->route('developer.games.index')->with('success', 'Game berhasil dihapus.');
    }

    /**
     * Allow users to download game package if present and they have purchased it.
     */
    public function download(Game $game)
    {
        if (!$game->package) {
            abort(404, 'Game ini tidak memiliki paket untuk diunduh.');
        }

        // Check if game is published
        if ($game->status !== 'published') {
            abort(403, 'Game ini belum tersedia untuk diunduh.');
        }

        $user = auth()->user();

        // Check if user has purchased this game (or is the developer)
        $hasPurchased = \App\Models\TransactionItem::whereHas('transaction', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('status', 'paid');
        })->where('game_id', $game->id)->exists();

        if (!$hasPurchased && $game->developer_id !== $user->id) {
            abort(403, 'Anda harus membeli game ini terlebih dahulu untuk mengunduhnya.');
        }

        return response()->download(
            storage_path('app/public/' . $game->package)
        );
    }
}
