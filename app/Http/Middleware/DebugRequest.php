<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DebugRequest
{
    public function handle(Request $request, Closure $next)
    {
        // Log sebelum request diteruskan ke controller
        Log::info('Request Parameters Before Middleware', $request->route()->parameters());

        $response = $next($request);

        // Log setelah request diproses
        Log::info('Request Parameters After Middleware', $request->route()->parameters());

        return $response;
    }
}
