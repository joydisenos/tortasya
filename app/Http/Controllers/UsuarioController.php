<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\User;
use App\Producto;
use App\Direccion;

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

    public function agregarCarrito($id)
    {
        $producto = Producto::findOrFail($id);

        $cart = Cart::add($id, $producto->nombre, 1, $producto->precio);

        return redirect()->back()->with('status' , 'Producto agregado');
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

    public function actualizarDatos(Request $request)
    {
        if($request->password != null)
        {
            $validatedData = $request->validate([
            'password' => 'required|min:6|confirmed|string',
            ]);
        }

        if( $request->hasFile('foto_perfil') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto_perfil');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto_perfil')->storeAs($rutaFoto, $nombreFoto, 'public');
        }

        $user = Auth::user();
        if( $request->password != null )
        {
            $user->password =  Hash::make($request->password);
        }
        if ( $request->hasFile('foto_perfil') )
        {
            $user->foto_perfil = $nombreFoto;
        }
        $user->save();

        return redirect()->back()->with('status' , 'Datos Actualizados');
    }

    public function agregarDireccion(Request $request)
    {
        $validatedData = $request->validate([
            'direccion' => 'required',
            'ciudad' => 'required',
            ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $direccion = Direccion::create($data);

        return redirect()->back()->with( 'status' , 'Dirección agregada');
    }

    public function sugerir(Request $request)
    {
        return redirect('/');
    }
}
