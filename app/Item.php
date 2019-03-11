<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Item extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clasificacion', 'descripcion', 'modelo', 'estado', 'marca','numero_inventario','numero_serie', 

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'path',
    ];

    //relacion de muchos a muchos con la tabla lugar
	public function lugares()
   {
	   return $this->belongsToMany('App\Lugar')->withTimestamps();
   }
}
