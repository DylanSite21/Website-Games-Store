<?php

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\SalesController;
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

    // Shopping cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{game}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{game}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Payment & checkout
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/success/{transaction}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/history', [PaymentController::class, 'history'])->name('payment.history');

    // Game library (purchased games)
    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
});

// download game packages (accessible after auth for simplicity)
Route::get('/download/game/{game}', [GameController::class, 'download'])
    ->middleware(['auth', 'verified'])
    ->name('game.download');

// Public game details page
Route::get('/game/{game}', [GameController::class, 'show'])->name('game.show');

// maintain old `/dashboard` URI for backwards compatibility
// send developers to their new home, others to regular home
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'developer') {
        return redirect()->route('developer.home');
    }
    return redirect()->route('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // developer-specific dashboard (only accessible to users with the developer role)
    Route::middleware(['role:developer'])->prefix('developer')->name('developer.')->group(function () {
        Route::get('/home', [DeveloperController::class, 'index'])->name('home');
        Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');

        // game CRUD and category management
        Route::resource('games', GameController::class);
        Route::resource('categories', CategoryController::class);
    });

});

Route::get('unauthenticated', function () {
    return abort(401);
})->name('unauthenticated');

require __DIR__ . '/auth.php';
