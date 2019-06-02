<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legal extends Model
{
    protected $fillable = [
        'nombre', 
        'slug', 
        'texto'
    ];
}
