<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPemilik
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        if (session('user_role') !== 'Pemilik') {
            abort(403, 'Akses ditolak! Anda bukan Pemilik.');
        }

        return $next($request);
    }
}
