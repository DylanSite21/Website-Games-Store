<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DeveloperController extends Controller
{
    #[Middleware('auth')]
    #[Middleware('role:developer')]
    public function index()
    {
        return view('developer.index');
    }
}
