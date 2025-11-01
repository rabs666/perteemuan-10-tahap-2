<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPerawat
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        if (session('user_role') !== 'Perawat') {
            abort(403, 'Akses ditolak! Anda bukan Perawat.');
        }

        return $next($request);
    }
}
