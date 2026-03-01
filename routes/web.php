<?php

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// primary home route (replaces former dashboard)
use App\Http\Controllers\UserController;

Route::get('/home', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

// maintain old `/dashboard` URI for backwards compatibility
Route::redirect('/dashboard', '/home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // developer-specific dashboard (only accessible to users with the developer role)
    Route::middleware(['role:developer'])->prefix('developer')->group(function () {
        Route::get('/dashboard', [DeveloperController::class, 'index'])->name('developer.index');

        Route::post('/upload', [FileController::class, 'store'])->name('file.upload');
        Route::get('/download/{id}', [FileController::class, 'download'])->name('file.download');
    });

});

Route::get('unauthenticated', function () {
    return abort(401);
})->name('unauthenticated');

require __DIR__ . '/auth.php';
