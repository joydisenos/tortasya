<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sugerencia extends Model
{
     protected $fillable = [
        'nombre', 
        'apellido' , 
        'telefono', 
        'nombre_negocio',
        'direccion', 
        'ciudad', 
        'region', 
        'email', 
    ];

    public function sugerencias()
    {
        return $this->where('estatus' , '>' , 0)->get();
    }

    public function verEstatus($int)
    {
        switch ($int) {
            case 1:
                $estatus = 'Por Contactar';
                break;

            case 2:
                $estatus = 'Contactado';
                break;
            
            default:
                $estatus = 'No definido';
                break;

        }

        return $estatus;
    }
}
