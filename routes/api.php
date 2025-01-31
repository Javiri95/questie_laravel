<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\VotoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AnswerController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('perfil', [AuthController::class, 'perfil']);   
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');  

use App\Http\Controllers\Api\ApiAuthController;

Route::post('api/register', [ApiAuthController::class, 'register']);


// Agrupar rutas relacionadas con "obra"
Route::middleware('auth:sanctum')->group(function () 
{
     Route::get('/preguntas', [QuestionController::class, 'indexReact']); // Listar obras (con filtros opcionales)

     Route::get('/preguntas/random/10', [QuestionController::class, 'getRandomQuestions']);

     Route::post('/games', [GameController::class, 'store']);
     Route::post('/answers', [AnswerController::class, 'store']);

    
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json(['user' => $request->user()]);
});










