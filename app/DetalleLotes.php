<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleLotes extends Model
{
    //

    protected  $table = 'detalle_lotes';
    protected $primaryKey = 'id_detalle';
    public $timestamps = false;


    protected $fillable = [
        'cantidad',
        'no_lote',
        'fecha_vencimiento',
        'id_recepcion_enc',
        'id_producto'
    ];

    public function recepcion(){

        return $this->belongsTo('App\Recepcion','id_recepcion_enc');
    }
    public $dates= [
        'fecha_vencimiento'
    ];

}
