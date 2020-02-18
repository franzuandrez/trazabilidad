<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesoHumedoEnc extends Model
{
    //

    protected $primaryKey = 'id_peso_humedo';
    protected $table = 'peso_humedo_enc';
    public $timestamps = false;

    protected $fillable = [
        'cortador_no',
        'turno',
        'fecha_ingreso',
        'id_usuario',
        'puesto',
        'observaciones',
        'no_orden',

    ];
    protected $with = [
        'detalle'
    ];

    public function detalle()
    {

        return $this->hasMany(PesoHumedoDet::class, 'id_peso_humedo_enc', 'id_peso_humedo');
    }

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

}
