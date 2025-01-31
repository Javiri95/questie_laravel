<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    /**
     * Registra un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'birth_date' => 'nullable|date',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // 10 MB
        ], [
            'nickname.unique' => 'El nickname ya está en uso.',
            'email.unique' => 'El email ya está registrado.',
        ]);

        // Si la validación falla, devolver errores
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
            ], 422);
        }

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

        // Devolver una respuesta JSON
        return response()->json([
            'message' => 'Registro exitoso',
            'user' => $user,
        ], 201);
    }
}