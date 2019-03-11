<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Pc extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'item_id', 'num_maquina','tiene_camara','tiene_bocinas', 'num_serie_cpu', 'ram', 'disco_duro', 'sistema_operativo', 
    	'sistema_operativo_activado', 'cable_vga', 'tiene_monitor', 'num_serie_monitor', 'tiene_teclado', 'tiene_raton', 'controlador_red',
    	'paq_office_version', 'paq_office_activado', 'observaciones',

        ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    //relacion de uno a uno con respecto a la revsion_detallada de una pc.
	public function revision_detallada()
    {
        return $this->hasOne('App\Revision_Detallada');
    }
}
