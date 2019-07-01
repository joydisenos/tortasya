<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Preparar as PrepararMail;
use App\Producto;
use App\Negocio;
use App\Orden;

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

    public function horario()
    {
        $negocio = Negocio::firstOrCreate(['user_id' => Auth::user()->id]);
        if($negocio->horario != null)
        {
            $horario = json_decode($negocio->horario);
        }else{
            $horario = null;
        }

        return view('negocio.horarios' ,compact('negocio' ,'horario'));
    }

    public function actualizarHorario(Request $request)
    {
        $horario = [
            "Mon" =>[
                $request->d_lunes,
                $request->h_lunes
            ],
            "Tue" =>[
                $request->d_martes,
                $request->h_martes
            ],
            "Wed" =>[
                $request->d_miercoles,
                $request->h_miercoles
            ],
            "Thu" =>[
                $request->d_jueves,
                $request->h_jueves
            ],
            "Fri" =>[
                $request->d_viernes,
                $request->h_viernes
            ],
            "Sat" =>[
                $request->d_sabado,
                $request->h_sabado
            ],
            "Sun" =>[
                $request->d_domingo,
                $request->h_domingo
            ],
        ];

        $horarioString = json_encode($horario);

        $negocio = Negocio::firstOrCreate(['user_id' => Auth::user()->id]);
        $negocio->horario = $horarioString;
        $negocio->entrega_domicilio = $request->has('entrega_domicilio') ? 1 : 0;
        $negocio->entrega_local = $request->has('entrega_local') ? 1 : 0;
        $negocio->envio_convenir = $request->has('envio_convenir') ? 1 : 0;
        $negocio->tarjeta_delivery = $request->has('tarjeta_delivery') ? 1 : 0;
        $negocio->deposito_banco = $request->has('deposito_banco') ? 1 : 0;
        $negocio->red_compra = $request->has('red_compra') ? 1 : 0;
        $negocio->envio_entrega = $request->has('envio_entrega') ? 1 : 0;
        $negocio->envio_gratis = $request->has('envio_gratis') ? 1 : 0;
        $negocio->variable = $request->has('variable') ? 1 : 0;
        $negocio->costo_fijo = $request->has('costo_fijo') ? 1 : 0;
        $negocio->costo_envio = $request->costo_envio;
        $negocio->save();

        return redirect()->back()->with('status' , 'Datos actualizados');

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

        if( $request->hasFile('logo_local') )
        {
            $rutaLogo = 'archivos/'. Auth::user()->id;
            $fotoLogo = $request->file('logo_local');
            $nombreLogoLocal = $fotoLogo->getClientOriginalName();
            $request->file('logo_local')->storeAs($rutaLogo, $nombreLogoLocal, 'public');
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
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion_negocio;
        $user->ciudad = str_slug($request->ciudad);
        $user->region = str_slug($request->region);
        $user->latitud = $request->latitud;
        $user->longitud = $request->longitud;
        $user->save();

        $negocio = Negocio::firstOrCreate(['user_id' => Auth::user()->id]);
        $negocio->descripcion = $request->descripcion_negocio;
        if( $request->hasFile('foto_local') )
        {
            $negocio->foto_local = $nombreFotoLocal;
        }

        if( $request->hasFile('logo_local') )
        {
            $negocio->logo_local = $nombreLogoLocal;
        }
        $negocio->save();

        return redirect()->back()->with('status' , 'Datos Actualizados');


    }

    public function ventas()
    {
        $ventas = Auth::user()->ventas;

        return view('negocio.ventas' , compact('ventas'));
    }

    public function verVenta($id)
    {
        $orden = Orden::findOrFail($id);

        if($orden->negocio_id != Auth::user()->id){
            return redirect()->back();
        }else{
            return view('negocio.orden' , compact('orden'));
        }
        
    }

    public function estatusProducto($id , $estatus)
    {
        $producto = Producto::findOrFail($id);
        $producto->estatus = $estatus;
        $producto->save();

        return redirect()->back()->with('status' , 'Estatus actualizado');
    }

    public function estatusOrden($id , $estatus)
    {
        $orden = Orden::findOrFail($id);
        $orden->estatus = $estatus;
        $orden->save();

        if($estatus == 2)
        {
            Mail::to($orden->user->email)
                ->send(new PrepararMail($orden));
        }

        return redirect()->back()->with('status' , 'Estatus actualizado');
    }
}
