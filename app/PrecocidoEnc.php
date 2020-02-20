<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecocidoEnc extends Model
{
    //

    protected $primaryKey = 'id_precocido_enc';
    protected $table = 'precocido_enc';
    public $timestamps = false;

    protected $fillable = [
        'turno',
        'fecha_ingreso',
        'id_usuario',
        'observaciones',
        'no_orden'
    ];

    protected $with = [
        'detalle'
    ];

    public function detalle()
    {

        return $this->hasMany(PrecocidoDet::class, 'id_precocido_enc', 'id_precocido_enc');
    }


    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

}
