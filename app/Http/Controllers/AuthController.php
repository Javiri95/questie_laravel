<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255', 'unique:users,nickname'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => 'required|string|min:6|confirmed',
            'birth_date' => ['nullable', 'date'],
            'avatar' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'avatar' => $request->avatar,
            'role' => 'user', // Asignar el rol por defecto
        ]);

        // Crear y devolver el token
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Verificar las credenciales
        if (Auth::attempt($request->only('email', 'password'))) {
            
             $user = Auth::user();
    
            // // Crear el token
            // $token = $user->createToken('token_name')->plainTextToken;

           $token = $request->user()->createToken($user->email . '_Token')->plainTextToken;
    
            // Devolver el token en la respuesta
           return response()->json(['token' => $token]);
        }
    
        // Si las credenciales no son correctas
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }
    
    public function logout(Request $request)
{
    try {
        // Revocar el token del usuario autenticado
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al cerrar sesión'], 500);
    }
}


    public function perfil(Request $request)
    {
        return response()->json($request->user());
    }
}

