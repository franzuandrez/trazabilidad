<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificacionMateriaChaoEnc extends Model
{
    //

    protected $primaryKey = 'id_verificacion';
    protected $table = 'verificacion_materias_chao_enc';
    public $timestamps = false;


    public function detalle()
    {


        return $this->hasMany(VerificacionMateriaChaoDet::class, 'id_verificacion', 'id_verificacion');

    }


    public function control_trazabilidad()
    {


        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }


}
