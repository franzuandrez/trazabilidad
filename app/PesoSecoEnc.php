<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesoSecoEnc extends Model
{
    //

    protected $primaryKey = 'id_peso_seco';
    protected $table = 'peso_seco_enc';
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

        return $this->hasMany(PesoSecoDet::class, 'id_peso_seco_enc', 'id_peso_seco');
    }

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

}
