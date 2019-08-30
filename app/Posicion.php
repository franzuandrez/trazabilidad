<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Posicion extends Model
{
    //
    use LogsActivity;

    protected $table = 'posiciones';
    protected $primaryKey = 'id_posicion';
    public $timestamps = false;

    protected $fillable = [

        'id_nivel',
        'codigo_barras',
        'descripcion',
        'estado'
    ];

    public static $logAttributes = [
        'id_nivel',
        'codigo_barras',
        'descripcion',
        'estado'
    ];

    public static $logOnlyDirty = true;



    public function scopeActived($query)
    {
        return $query->where('posiciones.estado', 1);

    }

    public function nivel()
    {

        return $this->belongsTo('App\Nivel', 'id_nivel');
    }

    public function bines(){

        return $this->hasMany('App\Posicion','id_posicion');
    }
}
