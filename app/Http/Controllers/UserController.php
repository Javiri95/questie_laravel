<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Usa paginación para obtener los usuarios
        $users = User::paginate(25);

        // Pasa los usuarios a la vista admin-page
        return view('admin-page', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'nickname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'birth_date' => 'required|date',
        'role' => 'required|string|max:255',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $user->name = $request->name;
    $user->nickname = $request->nickname;
    $user->email = $request->email;
    $user->birth_date = $request->birth_date;
    $user->role = $request->role;

    if ($request->hasFile('avatar')) {
        $avatarName = time().'.'.$request->avatar->extension();
        $request->avatar->move(public_path('avatars'), $avatarName);
        $user->avatar = 'avatars/'.$avatarName;
    }

    $user->save();

    return redirect()->route('admin-page')->with('success', 'Usuario actualizado correctamente');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin-page')->with('success', 'Usuario eliminado correctamente');
    }
}

