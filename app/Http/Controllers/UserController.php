<?php

namespace App\Http\Controllers;

use App\Models\File;

class UserController extends Controller
{
    /**
     * Show the application home page for non-developers.
     *
     * All the logic originally located inside the route closure has been
     * moved here so the route definition can be concise.  The middleware
     * is still applied on the route itself.
     */
    public function index()
    {
        $user = auth()->user();

        // developers get redirected to their own dashboard
        if ($user && $user->role === 'developer') {
            return redirect()->route('developer.index');
        }

        // regular users see the list of uploaded files
        $files = File::orderBy('created_at', 'desc')->get();

        return view('home', compact('files')); // passes $files to view
    }
}
