<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Bodega extends Model
{
    //
    use LogsActivity;
    protected $table = 'bodegas';
    protected $primaryKey = 'id_bodega';
    public $timestamps =false;

    protected $fillable = [
        'id_localidad',
        'codigo_barras',
        'descripcion',
        'id_encargado',
        'largo',
        'ancho',
        'alto',
        'telefono',
        'estado'
    ];
    public static $logAttributes = [
        'id_localidad',
        'codigo_barras',
        'descripcion',
        'id_encargado',
        'largo',
        'ancho',
        'alto',
        'telefono',
        'estado'
    ];

    protected $logOnlyDirty = true;

    public function scopeActived($query){

        return $query->where('bodegas.estado',1);

    }

    public function localidad(){

        return $this->belongsTo('App\Localidad','id_localidad');
    }
}
