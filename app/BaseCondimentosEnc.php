<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseCondimentosEnc extends Model
{
    //

    protected $primaryKey = 'id_base_enc';
    protected $table = 'base_condimentos_enc';
    public $timestamps = false;

    protected $fillable = [
        'turno',
        'fecha_ingreso',
        'id_usuario',
        'observaciones',
        'id_control'
    ];


    public function detalle()
    {
        return $this->hasMany(BaseCondimentosDet::class, 'id_base_enc', 'id_base_enc');
    }

    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }
}
