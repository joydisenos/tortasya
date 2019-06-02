<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Legal;

class AdminController extends Controller
{
    public function configuraciones()
    {
    	$legales = Legal::all();

    	return view('admin.configuraciones' , compact('legales'));
    }

    public function usuarios()
    {
    	$usuarios = User::all();

    	return view('admin.usuarios' , compact('usuarios'));
    }

    public function seccion($pagina)
    {
        $legal = Legal::where('slug' , $pagina)->first();

        return view('admin.editarseccion' , compact('legal'));
    }

    public function actualizarSeccion(Request $request , $id)
    {
        $legal = Legal::findOrFail($id);
        $legal->texto = $request->texto;
        $legal->save();

        return redirect()->route('admin.configuraciones')->with('status' , 'Sección actualizada');
    }
}
