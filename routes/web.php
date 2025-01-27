<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsAdmin;

// Ruta de inicio
Route::get('/', function () {
    return view('welcome');
});



// Rutas protegidas para usuarios autenticados
Route::middleware('auth')->group(function () 
{
    Route::get('/dashboard', function () 
    {
        return view('dashboard'); // Vista para usuarios regulares

    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Incluir las rutas de autenticación generadas por Breeze
require __DIR__.'/auth.php';

use App\Models\User;
use App\Models\Question;

use App\Http\Controllers\UserController;
USE App\Http\Controllers\QuestionController;

Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
    Route::get('/admin-page', function () {
        // Obtener usuarios y preguntas
        $users = User::all();
        $questions = Question::all();

        
        
        // Pasar los datos a la vista
        return view('admin-page', compact('users', 'questions'));

    })->name('admin-page');
});

Route::resource('users', UserController::class);
Route::resource('questions', QuestionController::class);


    



