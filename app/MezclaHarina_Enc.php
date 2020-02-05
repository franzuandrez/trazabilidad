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
        'puesto',
        'id_control'
    ];

    protected $with = [
      'detalle'
    ];
    public function detalle()
    {

        return $this->hasMany(MezclaHarina_Det::class,'id_Enc_mezclaharina','id_Enc_mezclaharina');
    }
}
