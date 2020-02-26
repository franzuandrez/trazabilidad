<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LineaSopa extends Model
{
    //
    use LogsActivity;
    protected $table = 'sopas';
    protected $primaryKey = 'id_sopa';
    public $timestamps = false;

    protected $dates = [
        'fecha_hora'
    ];

    protected $with = [
        'presentacion'
    ];

    public static $logAttributes = [
        '*'
    ];
    protected static $logOnlyDirty = true;
    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }


    public function presentacion()
    {
        return $this->belongsTo(Presentacion::class, 'id_presentacion', 'id_presentacion');
    }

    public function producto()
    {

        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
