<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NegocioController extends Controller
{
    public function productos()
    {
    	return view('negocio.productos');
    }

    public function crearProducto()
    {
    	return view('negocio.crearproducto');
    }
}
