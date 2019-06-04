<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsuarioController extends Controller
{
    public function favoritos()
    {
    	return view('user.favoritos');
    }

    public function direcciones()
    {
    	return view('user.direcciones');
    }

    public function datos()
    {
    	return view('user.datos');
    }

    public function pedidos()
    {
    	return view('user.pedidos');
    }

    public function alta(Request $request)
    {
        $validatedData = $request->validate([
        'nombre' => 'required|max:255',
        'apellido' => 'required|max:255',
        'email' => 'required|unique:users|email|max:255',
        'telefono' => 'required|max:255',
        'nombre_negocio' => 'required|max:255|unique:users',
        'direccion' => 'required|max:255',
        'ciudad' => 'required|max:255',
        'password' => 'required|min:6|confirmed|string',
        ]);

        $datos = $request->except(['password_confirmation' , 'password']);
        $datos['password'] = Hash::make($request->password);

        $user = User::create($datos);
        $user->assignRole('negocio');

        Auth::login($user);

        return redirect('/');
    }

    public function sugerir(Request $request)
    {
        return redirect('/');
    }
}
