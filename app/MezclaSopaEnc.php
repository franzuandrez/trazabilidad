<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MezclaSopaEnc extends Model
{
    //

    protected $table = 'mezclado_sopas_enc';
    protected $primaryKey = 'id_mezclado';
    public $timestamps = false;
    protected $with = [
        'detalle'
    ];


    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

    public function detalle()
    {
        return $this->hasMany(MezclaSopaDet::class, 'id_mezclado_sopas_enc', 'id_mezclado');
    }
}
