<?php

namespace Illuminate\Foundation\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventRequestsFromBeingStale
{
    public function handle(Request $request, \Closure $next)
    {
        // Implement any logic to prevent stale requests
        return $next($request);
    }
}

