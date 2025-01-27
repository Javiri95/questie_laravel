<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\VotoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
//Route::post('logout', [AuthController::class, 'logout']);
Route::get('perfil', [AuthController::class, 'perfil']);   
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');  


// Agrupar rutas relacionadas con "obra"
Route::middleware('auth:sanctum')->group(function () 
{
     Route::get('/preguntas', [QuestionController::class, 'indexReact']); // Listar obras (con filtros opcionales)
    // Route::post('/obras', [ObraController::class, 'store']); // Crear una obra
    // Route::get('/obras/{id}', [ObraController::class, 'show']); // Mostrar detalles de una obra específica
    // Route::delete('/obras/{id}', [ObraController::class, 'destroy']); // Eliminar una obra
    // Route::put('/obras/{id}', [ObraController::class, 'update']);
});

// Route::post('votos/{id}', [VotoController::class, 'store'])->middleware('auth:sanctum'); 
// Route::post('/obras/{id}/votar', [VotoController::class, 'store'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});










