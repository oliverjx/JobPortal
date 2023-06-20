<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MelnyController extends Controller
{


    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);



        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->rol = '2'; // Asignación corregida
        $user->password = bcrypt($validatedData['password']);
        $user->save();


        // Realizar cualquier otra acción adicional, como enviar un correo de confirmación, etc.

        // Redirigir a una página de éxito o realizar cualquier otra acción necesaria
        return redirect()->route('login')->with('success', 'User registered successfully');
    }
}
