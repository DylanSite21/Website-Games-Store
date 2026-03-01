<?php

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// primary home route (replaces former dashboard) and also serves as game catalog for users
Route::get('/home', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

// wishlist actions (regular users)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{game}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{game}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

// download game packages (accessible after auth for simplicity)
Route::get('/download/game/{game}', [GameController::class, 'download'])
    ->middleware(['auth', 'verified'])
    ->name('game.download');

// maintain old `/dashboard` URI for backwards compatibility
Route::redirect('/dashboard', '/home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // developer-specific dashboard (only accessible to users with the developer role)
    Route::middleware(['role:developer'])->prefix('developer')->name('developer.')->group(function () {
        Route::get('/dashboard', [DeveloperController::class, 'index'])->name('index');

        // game CRUD and category management
        Route::resource('games', GameController::class);
        Route::resource('categories', CategoryController::class);
    });

});

Route::get('unauthenticated', function () {
    return abort(401);
})->name('unauthenticated');

require __DIR__ . '/auth.php';
