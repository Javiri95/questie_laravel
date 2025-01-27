<?php

namespace Illuminate\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleCors
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
        $response = $next($request);

        // Si la solicitud es OPTIONS, no hace falta continuar con el procesamiento
        if ($request->getMethod() == 'OPTIONS') {
            return response()->json([], 200);
        }

        // Añadir cabeceras CORS
        $response->headers->set('Access-Control-Allow-Origin', '*'); // O un dominio específico
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->headers->set('Access-Control-Allow-Credentials', 'true'); // Si usas cookies

        return $response;
    }
}
