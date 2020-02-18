<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laminado_Enc extends Model
{
    protected $table = 'laminado_enc';
    protected $primaryKey = 'id_enc_laminado';
    public $timestamps = false;

    protected $fillable = [
        'id_responsable',
        'turno',
        'fecha_ingreso',
        'id_usuario',
        'puesto',
        'observaciones',
        'no_orden'
    ];

    protected $with = [
        'detalle'
    ];

    public function detalle()
    {

        return $this->hasMany(Laminado_Det::class, 'id_enc_laminado', 'id_enc_laminado');
    }

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }
}
