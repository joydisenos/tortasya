<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'user_id', 
        'foto', 
        'precio', 
        'nombre',
        'descripcion',
    ];

    public function negocio()
    {
    	return $this->belongsTo(User::class , 'user_id');
    }

    public function estatusProducto($int)
    {
        switch ($int) {
            case 1:
                $estatus = "Activo";
                break;

            case 0:
                $estatus = "Inactivo";
                break;
            
            default:
                $estatus = "No definido";
                break;
        }

        return $estatus;
    }
}
