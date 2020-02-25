<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaminadoSopasEnc extends Model
{
    //

    protected $primaryKey = 'id_laminado_sopas_enc';
    protected $table = 'laminado_sopas_enc';
    public $timestamps = false;


    protected $with = ['detalle'];

    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

    public function detalle()
    {

        return $this->hasMany(LaminadoSopasDet::class, 'id_laminado_sopas_enc', 'id_laminado_sopas_enc');
    }

}
