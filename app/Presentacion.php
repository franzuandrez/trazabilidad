<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Presentacion extends Model
{
    //

    use LogsActivity;

    protected $table = 'presentaciones';
    protected $primaryKey = 'id_presentacion';

    protected $fillable = [
        'codigo_barras',
        'descripcion',
        'estado',
        'creado_por',
    ];

    protected static $logAttributes = [
        'codigo_barras',
        'descripcion',
        'estado'
    ];

    protected static $logOnlyDirty = true;

    protected function scopeActived($query){

        return $query->where('presentaciones.estado',1);
    }


}
