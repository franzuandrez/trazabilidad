<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RMIDetalle extends Model
{
    //

    protected $table = 'rmi_detalle';
    protected $primaryKey = 'id_rmi_detalle';
    public $timestamps = false;

    protected $fillable = [
        'id_rmi_encabezado',
        'id_producto',
        'lote',
        'fecha_vencimiento',
        'cantidad',
        'estado'
    ];

    protected $dates = [
        'fecha_vencimiento'
    ];
}
