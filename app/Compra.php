<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'user_id', 
        'orden_id',
        'producto_id',
        'cantidad',
        'opciones',
    ];

    public function producto()
    {
    	return $this->belongsTo(Producto::class , 'producto_id');
    }
}
