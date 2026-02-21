<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\Authenticate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // when the "auth" middleware needs to redirect unauthenticated
        // requests, send them to our custom 402 page instead of the
        // default login route.

        Authenticate::redirectUsing(fn($request) => route('unauthenticated'));
    }
}
