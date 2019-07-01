<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Gloudemans\Shoppingcart\CartItem;
use App\Legal;
use App\User;
use App\Region;
use App\Comentario;

class HomeController extends Controller
{
   
    public function index()
    {
        $user = new User();
        $tiendas = $user->destacados();
        $refRegiones = new Region();
        $regiones = $refRegiones->regiones();
        $regiones = $regiones;
        $logoRestaurant = $user->whereHas('negocio' , function ($query) {
            $query->where('logo_local', '!=', 'null');
        })->take(6)->get();
        $comentarios = Comentario::take(6)->get();

        return view('home' , compact('tiendas' , 'regiones' ,'logoRestaurant' ,'comentarios'));
    }

    public function buscarNegocios($ciudad , $region)
    {
        $tiendas = User::whereHas('negocio')
                        ->where('ciudad' , $ciudad)
                        ->where('region' , $region)
                        ->get();
        $region = str_replace('-', ' ', $region);

        return view('negocios' , compact('tiendas' , 'region'));
    }

    public function busquedaNegocios(Request $request)
    {
        $validatedData = $request->validate([
        'region' => 'required',
        'ciudad' => 'required'
        ]);

        $ciudad = str_slug($request->ciudad);
        $region = str_slug($request->region);

        return redirect('negocios/' . $ciudad . '/' . $region);
    }

    public function nosotros($pagina = null)
    {
        if($pagina == null)
        {
            $legal = Legal::where('slug' , 'nosotros')->first();
        }else{
            $legal = Legal::where('slug' , $pagina)->first();
        }

        return view('legales' , compact('legal'));
    }

    public function tienda($slug)
    {
        $tienda = User::where('slug' , $slug)->first();
        $productos = $tienda->productosDisponibles;
        $destacados = $tienda->productos->where('foto' , '!=' , null)->where('estatus' , 1);
        $horario = json_decode($tienda->negocio->horario);

        $productosId = [];
        foreach ($productos as $key => $producto) {
            $productosId[$key] = $producto->id;
        }

        $comentarios = new Comentario();
        $comentariosEstadisticas = $comentarios->estadisticas($tienda->id);
        

        $carrito = Cart::content()->whereIn('id' , $productosId);
        $total = 0;
        $totalMobile = 0;

        return view('tienda' , compact('tienda' , 'productos' , 'destacados' , 'carrito' , 'total' , 'totalMobile' , 'horario','comentariosEstadisticas'));
    }

    public function bienvenido()
    {
        return view('bienvenido');
    }
}
