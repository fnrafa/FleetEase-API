<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckJsonRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->expectsJson()) {
            abort(404);
        }
        return $next($request);
    }
}
