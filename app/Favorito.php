<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $fillable = [
        'user_id', 
        'negocio_id'
    ];

    public function tienda()
    {
        return $this->belongsTo(User::class , 'negocio_id');
    }
}
