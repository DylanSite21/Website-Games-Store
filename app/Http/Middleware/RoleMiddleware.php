<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth()->check()) {
            abort(401, 'Anda Harus Login Terlebih Dahulu.');
        }
        if (Auth()->user()->role != $role) {
            abort(403, 'Ga Bisa Masuk Khusus Developer.');
        }

        return $next($request);
    }
}
