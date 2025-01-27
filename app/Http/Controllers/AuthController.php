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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Crear y devolver el token
        return response()->json(['token' => $user->createToken('token_name')->plainTextToken]);
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

