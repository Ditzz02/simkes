<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckKepalaProdi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('kaprodi')->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai Kepala Prodi.');
        }

        return $next($request);
    }
}
