<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntregaDet extends Model
{
    //
    protected $table = 'entrega_pt_det';
    public $timestamps = false;


    protected $with = [
        'control_trazabilidad'
    ];

    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

    public function entrega_pt_enc()
    {
        return $this->belongsTo(EntregaEnc::class,'id_enc','id');
    }
}
