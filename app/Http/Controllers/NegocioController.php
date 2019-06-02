<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Producto;
use App\Negocio;

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

    public function actualizarProducto(Request $request , $id)
    {
        $validatedData = $request->validate([
        'nombre' => 'required|max:255',
        'precio' => 'required',
        'descripcion' => 'required',
        ]);

        $data = $request->except(['foto']);

        if( $request->hasFile('foto') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto')->storeAs($rutaFoto, $nombreFoto, 'public');
            $data['foto'] = $nombreFoto;
        }

        $producto = Producto::findOrFail($id)->update($data);

        return redirect()->route('negocio.productos')->with('status' , 'Producto Actualizado');
    }

    public function datos()
    {
        $negocio = Negocio::firstOrCreate(['user_id' => Auth::user()->id]);

        return view('negocio.datos');
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

        if( $request->hasFile('foto_local') )
        {
            $rutaLocal = 'archivos/'. Auth::user()->id;
            $fotoLocal = $request->file('foto_local');
            $nombreFotoLocal = $fotoLocal->getClientOriginalName();
            $request->file('foto_local')->storeAs($rutaLocal, $nombreFotoLocal, 'public');
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

        $negocio = Negocio::firstOrCreate(['user_id' => Auth::user()->id]);
        $negocio->descripcion = $request->descripcion_negocio;
        if( $request->hasFile('foto_local') )
        {
            $negocio->foto_local = $nombreFotoLocal;
        }
        $negocio->save();

        return redirect()->back()->with('status' , 'Datos Actualizados');


    }

    public function ventas()
    {
        return view('negocio.ventas');
    }
}
