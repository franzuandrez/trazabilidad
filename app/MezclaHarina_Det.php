<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MezclaHarina_Det extends Model
{
    protected $table ='det_mezclaharina';
    protected $primaryKey = 'id_det_mezclaharina';
    public $timestamps = false;

    protected $fillable = [
        'id_enc_mezclaharina',
        'id_producto',
        'codigo_producto',
        'lote',
        'hora_carga',
        'hora_descarga',
        'solucion_inicial',
        'solucion_final',
        'solucion_observacion',
        'ph_inicial',
        'ph_final',
        'ph_observacion'
    ];
    protected $with = [
        'producto'
    ];

    public function producto(){

        return $this->belongsTo(Producto::class,'id_producto','id_producto');
    }

}
