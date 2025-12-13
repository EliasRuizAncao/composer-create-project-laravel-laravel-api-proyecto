<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Listar usuarios
    public function index()
    {
        return response()->json(User::latest()->get());
    }

    // Guardar nuevo usuario (CREATE)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            // Nuevos campos
            'phone' => 'required',
            'birth_year' => 'required|integer',
            'gender' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'birth_year' => $request->birth_year,
            'gender' => $request->gender
        ]);

        return response()->json($user, 201);
    }

    // Mostrar uno solo (para editar)
    public function show($id)
    {
        return User::find($id);
    }

    // Actualizar usuario (UPDATE)
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'No encontrado'], 404);

        // Actualizamos los datos
        $user->update($request->only(['name', 'email', 'phone', 'birth_year', 'gender']));
        
        // Solo actualizamos password si escribieron una nueva
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return response()->json($user);
    }

    // Eliminar usuario (DELETE)
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'No encontrado'], 404);
        
        $user->delete();
        
        return response()->json(['message' => 'Eliminado']);
    }
}