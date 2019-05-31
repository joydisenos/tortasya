<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Producto;

class NegocioController extends Controller
{
    public function productos()
    {
    	$productos = Auth::user()->productos;

    	return view('negocio.productos' , compact('productos'));
    }

    public function crearProducto()
    {
    	return view('negocio.crearproducto');
    }

    public function guardarProducto(Request $request)
    {
    	$validatedData = $request->validate([
        'nombre' => 'required|max:255',
        'precio' => 'required',
        'descripcion' => 'required',
        ]);

        $data = $request->except(['foto']);
        $data['user_id'] = Auth::user()->id;

    	if( $request->hasFile('foto') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto')->storeAs($rutaFoto, $nombreFoto, 'public');
            $data['foto'] = $nombreFoto;
        }

        $producto = Producto::create($data);

        return redirect()->route('negocio.productos')->with('status' , 'Producto Creado');
    }

    public function modificarProducto($id)
    {
    	$producto = Producto::findOrFail($id);
    	
    	if($producto->user_id != Auth::user()->id)
    	{
    		return redirect()->back();
    	}

    	return view('negocio.editarproducto' , compact('producto'));
    }
}
