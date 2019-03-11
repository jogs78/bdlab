<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Lugar extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    	//RELACION DE UNO A MUCHOS CON REVISION
	public function revisions()
    {
        return $this->hasMany('App\Revision');
    }

	//relacion de uno a uno con plantilla
	public function plantilla()
    {
		//obtengo la plantilla asocida a un lugar
        return $this->hasOne('App\Plantilla');
    }

	//relacion de muchos a muchos con la table lugar e item
	public function items()
    {
        return $this->belongsToMany('App\Item')->withTimestamps();
    }
}
