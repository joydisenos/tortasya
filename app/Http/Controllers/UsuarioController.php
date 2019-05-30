<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
