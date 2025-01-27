<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class ConvertEmptyStringsToNull
{
    public function handle(Request $request, \Closure $next)
    {
        foreach ($request->all() as $key => $value) {
            if (is_string($value) && $value === '') {
                $request->merge([$key => null]);
            }
        }

        return $next($request);
    }
}
