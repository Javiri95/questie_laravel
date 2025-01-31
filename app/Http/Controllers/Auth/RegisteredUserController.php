<?php
// filepath: /c:/Users/Javier Irigoyen/Desktop/Questie/questie_laravel/app/Http/Controllers/Auth/RegisteredUserController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255|unique:users', // Asegurar que el nickname sea único
            'email' => 'required|string|email|max:255|unique:users', // Asegurar que el email sea único
            'password' => 'required|string|min:8|confirmed',
            'birth_date' => 'nullable|date',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // 10 MB
        ]);

        // Subir la imagen y guardar la ruta
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . $request->avatar->extension(); // Nombre único para la imagen
            $request->avatar->move(public_path('avatars'), $avatarName); // Mover la imagen a public/avatars
            $avatarPath = 'avatars/' . $avatarName; // Ruta relativa de la imagen
        }

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'avatar' => $avatarPath, // Guardar la ruta de la imagen
        ]);

        event(new Registered($user));

        // Redirigir al usuario después del registro
        return redirect()->route('dashboard')->with('success', 'Registro exitoso');
    }
}


return redirect()->route('dashboard')->with('success', 'Registro exitoso');