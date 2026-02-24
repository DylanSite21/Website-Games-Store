<?php

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// primary home route (replaces former dashboard)
Route::get('/home', function () {
    $user = auth()->user();

    // developers should not be allowed on the main home page
    if ($user && $user->role === 'developer') {
        return redirect()->route('developer.index');
    }

    return view('home');
})->middleware(['auth', 'verified'])->name('home');

// maintain old `/dashboard` URI for backwards compatibility
Route::redirect('/dashboard', '/home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // developer-specific dashboard (only accessible to users with the developer role)
    Route::middleware(['role:developer'])->prefix('developer')->group(function () {
        Route::get('/dashboard', [DeveloperController::class, 'index'])->name('developer.index');
    });

});

Route::get('unauthenticated', function () {
    return abort(401);
})->name('unauthenticated');

require __DIR__ . '/auth.php';
