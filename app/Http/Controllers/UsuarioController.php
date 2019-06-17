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
use App\Orden;
use App\Compra;
use App\Comentario;

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
        $pedidos = Auth::user()->pedidos;

    	return view('user.pedidos' , compact('pedidos'));
    }

    public function pago($slug , Request $request)
    {
        $tienda = User::where('slug' , $slug)->first();
        $productos = $tienda->productos;
        $productosId = [];
        foreach ($productos as $key => $producto) {
            $productosId[$key] = $producto->id;
        }

        $carrito = Cart::content()->whereIn('id' , $productosId);

        $ordenRequest = $request->all();
        $ordenRequest['user_id'] = Auth::user()->id;
        $ordenRequest['negocio_id'] = $tienda->id;

        $total = 0;

        foreach ($carrito as $key => $producto){
            $total += $producto->price * $producto->qty;
        }

        if($tienda->negocio->costo_fijo == 1 && $tienda->negocio->costo_envio > 0 && $request->envio == 'Delivery')
        {
            $ordenRequest['total'] = $total + $tienda->negocio->costo_envio;
        }else{
            $ordenRequest['total'] = $total;
        }

        $orden = Orden::create($ordenRequest);


        foreach ($carrito as $key => $producto) {

            $productoRequest['user_id'] = Auth::user()->id;
            $productoRequest['orden_id'] = $orden->id;
            $productoRequest['producto_id'] = $producto->id;
            $productoRequest['cantidad'] = $producto->qty;

            if ($producto->options->count() > 0)
            {
                $productoRequest['opciones'] = [];

                foreach ($producto->options as $key => $opcion) {
                    $productoRequest['opciones'][$key] = $opcion;
                }

                $productoRequest['opciones'] = json_encode($productoRequest['opciones']);
            }

            $compra = Compra::create($productoRequest);
        }

        return redirect()->route('usuario.pedidos')->with('status' , 'Compra registrada');

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
        $total = 0;

        return view('ordenar' , compact('carrito' , 'slug' , 'tienda' , 'total'));
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
        $datos['slug'] = str_slug($request->nombre_negocio);

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

    public function comentar(Request $request)
    {
        $validatedData = $request->validate([
        'comentario' => 'required',
        'puntos' => 'required'
        ]);

        $orden = Orden::findOrFail($request->orden_id);
        $orden->estatus = 3;
        $orden->save();

        $data['comentario'] = $request->comentario;
        $data['puntos'] = $request->puntos;
        $data['user_id'] = $request->user_id;
        $data['negocio_id'] = $orden->negocio->id;

        $comentario = Comentario::create($data);

        return redirect()->back()->with('status' , 'Comentario publicado');
    }
}
