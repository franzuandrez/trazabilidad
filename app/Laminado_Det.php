<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laminado_Det extends Model
{
    protected $table ='laminado_det';
    protected $primaryKey = 'id_det_laminado';
    public $timestamps = false;

    protected $fillable = [
        'id_enc_laminado',
        'temperatura_inicio',
        'temperatura_final',
        'temperatura_observaciones',
        'espesor_inicio',
        'espesor_observaciones',
        'lote_producto',
        'hora'
    ];

    public function Encabezado()
    {
        return $this->belongsTo('APP\Laminado_Enc','id_enc_laminado');
    }
}
