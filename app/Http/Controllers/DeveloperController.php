<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DeveloperController extends Controller
{
    /**
     * Show the developer dashboard, including a list of uploaded files.
     */
    public function index()
    {
        // fetch all uploaded files; if you later want to scope by user,
        // add a user_id column and filter here.
        $files = File::orderBy('created_at', 'desc')->get();

        return view('developer.index', compact('files'));
    }
}
