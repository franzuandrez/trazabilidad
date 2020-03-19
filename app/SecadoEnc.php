<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecadoEnc extends Model
{
    //


    protected $primaryKey = 'id_secado_enc';
    protected $table = 'secado_enc';
    public $timestamps = false;


    public function detalle()
    {
        return $this->hasMany(SecadoDet::class, 'id_secado_enc', 'id_secado_enc');
    }

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');

    }
}
