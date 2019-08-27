<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MezclaHarina_Enc extends Model
{
    protected $table ='enc_mezclaharina';
    protected $primaryKey = 'id_Enc_mezclaharina';
    public $timestamps = false;

    protected $fillable = [
        'no_orden',
        'id_responsable_maquina',
        'observaciones',
        'id_usuario',
        'puesto'
    ];
    public function Detalle()
    {

        return $this->hasMany('APP\MezclaHarina_Det','id_enc_mezclaharina');
    }
}
