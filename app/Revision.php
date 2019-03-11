<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Revision extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'lugar_id','tipo','momento', 'observaciones'


    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
    //RELACION DE UNO A MUCHOS CON REVISOM
	public function user()
    {
        return $this->belongsTo('App\User');
    }

	//RELACION DE UNO A MUCHOS CON LUGAR
	public function lugar()
    {
        return $this->belongsTo('App\Lugar');
    }

	//relacion de uno a uno con REVISION_RAPIDA
	public function revision_rapida()
    {
		//obtengo la REVISION_RAPIDA asocida a una REVISON
        return $this->hasMany('App\Revision_Rapida');
    }
	//relacion de uno a uno con REVISION_DETALLADA
	public function revision_detallada()
    {
		//obtengo la REVISION_RAPIDA asocida a una REVISON
        return $this->hasOne('App\Revision_Detallada');
    }
    
}
