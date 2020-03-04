<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificacionMateriaEnc extends Model
{
    //


    protected $primaryKey = 'id_verificacion';
    protected $table = 'verificacion_materias_enc';
    public $timestamps = false;


    public function control_trazabilidad()
    {


        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

    public function detalle()
    {


        return $this->hasMany(VerificacionMateriaDet::class, 'id_verificacion_enc', 'id_verificacion');
    }


}
