<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $fillable = [
        'user_id', 
        'negocio_id',
        'direccion_id',
        'envio',
        'pago',
        'total',
        'estatus',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class , 'user_id');
    }

    public function negocio()
    {
    	return $this->belongsTo(User::class , 'negocio_id');
    }

    public function productos()
    {
    	return $this->hasMany(Compra::class , 'orden_id');
    }

    public function verEstatus($estatus)
    {
    	switch ($estatus) {
    		case 1:
    			$respuesta = 'Pendiente';
    			break;

    		case 2:
    			$respuesta = 'Enviado';
    			break;
    		
    		default:
    			$respuesta = 'Por Revision';
    			break;
    	}

    	return $respuesta;
    }
}
