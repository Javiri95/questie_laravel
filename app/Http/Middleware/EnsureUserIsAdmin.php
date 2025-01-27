<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa el facade de autenticación

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
     public function handle(Request $request, Closure $next)
     {
         if (Auth::check() && Auth::user()->role === 'admin') {
             return $next($request);
         }
 
         return redirect('/dashboard')->with('error', 'No tienes permiso para acceder a esta página.');
     }
}

