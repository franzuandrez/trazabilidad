<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Actividad extends Model
{
    //
    use LogsActivity;
    protected $primaryKey = 'id_actividad';
    protected $table = 'actividades';
    public $timestamps = false;


    protected $fillable = [
        'descripcion',
        'estado',
        'id_producto'
    ];

    public static $logAttributes = [
        'descripcion',
        'estado',
        'id_producto'
    ];

    protected static $logOnlyDirty = true;

    public function scopeActived( $query ){

        return $query->where('actividades.estado',1);

    }


}
