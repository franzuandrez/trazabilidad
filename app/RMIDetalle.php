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
        'estado',
        'rampa',
        'control',
        'mp',
    ];

    protected $dates = [
        'fecha_vencimiento'
    ];

    public $with = [
        'producto'
    ];

    /**
     * ----------------------------------------RELATIONSHIPS-------------------------
     */

    public function rmi_encabezado(){

        return $this->belongsTo('App\RMIEncabezado','id_rmi_encabezado');
    }

    public function producto(){

        return $this->belongsTo('App\Producto','id_producto');
    }

}
