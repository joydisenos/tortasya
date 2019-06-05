<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Legal;
use App\User;

class HomeController extends Controller
{
   
    public function index()
    {
        $user = new User();
        $tiendas = $user->tiendas();

        return view('home' , compact('tiendas'));
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

        $productos = $tienda->productos;

        $destacados = $tienda->productos->where('foto' , '!=' , null);

        return view('tienda' , compact('tienda' , 'productos' , 'destacados'));
    }
}
