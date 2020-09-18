<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolucionSopasEnc extends Model
{
    //


    public $timestamps = false;
    protected $table = 'solucion_sopas_enc';
    protected $primaryKey = 'id_solucion_enc';


    public function detalle()
    {
        return $this->hasMany(SolucionSopasDet::class, 'id_solucion_enc', 'id_solucion_enc');
    }

    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }
}
