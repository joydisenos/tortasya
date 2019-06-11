<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'apellido' , 
        'email', 
        'telefono', 
        'nombre_negocio', 
        'direccion', 
        'ciudad', 
        'region', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class , 'user_id');
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class , 'user_id');
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class , 'user_id');
    }

    public function negocio()
    {
        return $this->hasOne(Negocio::class , 'user_id');
    }

    public function tiendas()
    {
        return $this->where('nombre_negocio' , '!=' , null)
                    ->whereHas('negocio')
                    ->get();
    }

    public function comentarios()
    {
        $this->hasMany(Comentario::class , 'negocio_id');
    }

    public function horarioDisponible()
    {
        $horario = json_decode($this->negocio->horario);
       
        foreach ($horario as $key => $horas) {
            $dia[$key] = $horas;
        }

        $dia = $dia[date('D')];

        $hora = Carbon::now();
        $desde = Carbon::parse($dia[0]);
        $hasta = Carbon::parse($dia[1]);

        if($hora >= $desde && $hora < $hasta)
        {
            $estatus = 'Abierto';
        }else{
            $estatus = 'Cerrado';
        }

        return $estatus;
    }
}
