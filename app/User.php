<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','nombre'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $logAttributes = [
        'username','email','nombre','estado'
    ];
    protected static $logOnlyDirty = true;

    public function scopeActived($query){


        return $query->where('users.estado',1);

    }

    public function log_actividades(){

        return $this->hasMany('Spatie\Activitylog\Models\Activity','causer_id');
    }
}
