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
}
