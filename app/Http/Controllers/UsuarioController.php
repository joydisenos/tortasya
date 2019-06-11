<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use Gloudemans\Shoppingcart\CartItem;
use App\User;
use App\Producto;
use App\Direccion;
use App\Favorito;

class UsuarioController extends Controller
{
    public function favoritos()
    {
        $favoritos = Auth::user()->favoritos;

    	return view('user.favoritos' , compact('favoritos'));
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

    public function ordenar($slug)
    {
        $tienda = User::where('slug' , $slug)->first();
        $productos = $tienda->productos;
        $productosId = [];
        foreach ($productos as $key => $producto) {
            $productosId[$key] = $producto->id;
        }

        $carrito = Cart::content()->whereIn('id' , $productosId);

        return view('ordenar' , compact('carrito'));
    }

    public function agregarCarrito($id ,Request $request)
    {
        $producto = Producto::findOrFail($id);

        if($request->has('sabor'))
        {
            $cart = Cart::add($id, $producto->nombre, 1, $producto->precio , 0 ,['sabor' => $request->sabor]);
        }else{
            $cart = Cart::add($id, $producto->nombre, 1, $producto->precio);
        }

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

        $datos = $request->except(['password_confirmation' , 'password' , 'ciudad' , 'region']);
        $datos['password'] = Hash::make($request->password);
        $datos['ciudad'] = str_slug($request->ciudad);
        $datos['region'] = str_slug($request->region);

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

    public function marcarFavorito($id)
    {
        $favorito = Favorito::where('user_id' ,  Auth::user()->id)
                                ->where('negocio_id' , $id)
                                ->first();

        if($favorito == null)
        {
            Favorito::create([
            "user_id" => Auth::user()->id,
            "negocio_id" => $id
            ]);

            $mensaje = 'Agregado a Favorito';
        }else{
            $favorito->delete();

            $mensaje = 'Favorito eliminado';
        }
        

        return redirect()->back()->with('status' , $mensaje);
    }
}
