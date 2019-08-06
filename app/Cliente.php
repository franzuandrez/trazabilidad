<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Cliente extends Model
{

    use LogsActivity;

    protected $table = 'clientes';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;
    protected $fillable = [
        'razon_social',
        'nit',
        'direccion',
        'telefono',
        'ruta',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo',
        'latitud',
        'longitud',
        'id_categoria'

    ];

    public static $logAttributes =[

        'razon_social',
        'nit',
        'direccion',
        'telefono',
        'ruta',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo',
        'latitud',
        'longitud',
        'id_categoria'

    ];

    protected static $logOnlyDirty = true;

    public function categoria(){

        return $this->belongsTo('App\CategoriaCliente','id_categoria');
    }


}
