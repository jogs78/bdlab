<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'nombre','apellido','telefono','horas_cubrir','tipo_usuario','numcontrol','email','password',

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    	'password', 'telefono', 'horas_cubrir', 'tipo_usuario', 'email', 'created_at', 'updated_at', 'remember_token', 'deleted_at','path',
    ];

    //RELACION DE UNO A MUCHOS CON LOG
	public function logs()
    {
        return $this->hasMany('App\Log');
    }

	//RELACION DE UNO A MUCHOS CON REVISON
	public function revisions()
    {
        return $this->hasMany('App\Revision');
    }
}
