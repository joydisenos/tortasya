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

    public function direccion()
    {
        return $this->belongsTo(Direccion::class , 'direccion_id');
    }

    public function productos()
    {
    	return $this->hasMany(Compra::class , 'orden_id');
    }

    public function verEstatus($estatus)
    {
    	switch ($estatus) {

            case 0:
                $respuesta = 'Fallido';
                break;

    		case 1:
    			$respuesta = 'Pendiente de entrega';
    			break;

    		case 2:
    			$respuesta = 'Entregado o Recepcionado';
    			break;

            case 3:
                $respuesta = 'Comentado';
                break;

            case 4:
                $respuesta = 'En espera de contacto';
                break;

            case 5:
                $respuesta = 'Trabajando';
                break;
    		
    		default:
    			$respuesta = 'Por Revision';
    			break;
    	}

    	return $respuesta;
    }

    public function verDireccion($id)
    {
        $direccionRef = Direccion::findOrFail($id);
        $direccion = json_decode($direccionRef->direccion);
        
        if($direccion == null){
            $direccion = json_decode('{
                            "alias":null,
                            "comuna":null,
                            "calle":null,
                            "numero":null,
                            "departamento":null,
                            "referencia":null}');
        }

        return $direccion;
    }
}
