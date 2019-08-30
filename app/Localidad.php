<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Localidad extends Model
{
    //
    use LogsActivity;
    protected $table='localidades';
    protected $primaryKey = 'id_localidad';

     public $timestamps = false;

    protected $fillable = [
        'codigo_barras',
        'descripcion',
        'direccion',
        'id_encargado',
        'estado'
    ];

    public static $logAttributes = [
        'codigo_barras',
        'descripcion',
        'direccion',
        'id_encargado',
        'estado',
        'codigo_interno'
    ];

    protected $with = [
        'bodegas'
    ];
    protected static $logOnlyDirty = true;

    public function scopeActived($query){

        return $query->where('localidades.estado',1);
    }

    public function encargado(){

        return $this->belongsTo('App\User','id_encargado');
    }

    public function bodegas(){

        return $this->hasMany('App\Bodega','id_localidad');
    }

}
