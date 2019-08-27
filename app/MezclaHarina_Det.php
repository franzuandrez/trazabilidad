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

    public function Encabezado()
    {
        return $this->belongsTo('APP\MezclaHarina_Enc','id_enc_mezclaharina');
    }
}
