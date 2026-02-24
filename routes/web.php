<?php

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    // developers should not be allowed on the main dashboard
    if ($user && $user->role === 'developer') {
        return redirect()->route('developer.index');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
