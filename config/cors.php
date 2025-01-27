<?php

return [
    'paths' => ['api/*','sanctum/csrf-cookie',], // Rutas donde se aplica CORS
    'allowed_methods' => ['*'], // Métodos HTTP permitidos (GET, POST, etc.)
    'allowed_origins' => ['*'], // Dominios permitidos
    'allowed_origins_patterns' => [], // Patrones de dominios permitidos
    'allowed_headers' => ['*'], // Cabeceras permitidas
    'exposed_headers' => [], // Cabeceras expuestas
    'max_age' => 0, // Tiempo máximo de cacheo de preflight
    'supports_credentials' => true, // Si se permite enviar cookies o credenciales
    'hosts' => [],
];

