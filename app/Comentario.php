<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

	protected $fillable = [
        'user_id', 
        'negocio_id', 
        'comentario',
        'puntos'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class , 'user_id');
    }

    public function estadisticas($tiendaId)
    {
        $ex = $this->where('negocio_id' , $tiendaId)->where('puntos' , 5)->count();
        $mb = $this->where('negocio_id' , $tiendaId)->where('puntos' , 4)->count();
        $bu = $this->where('negocio_id' , $tiendaId)->where('puntos' , 3)->count();
        $re = $this->where('negocio_id' , $tiendaId)->where('puntos' , 2)->count();
        $ma = $this->where('negocio_id' , $tiendaId)->where('puntos' , 1)->count();

        $arrayEst = [ $ex , $mb , $bu , $re , $ma ];
        $estadistica = implode(',', $arrayEst); // Resultado en string para Chart.js

        return $estadistica;
    }
}
