<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laminado_Enc extends Model
{
    protected $table ='laminado_enc';
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
    public function Detalle()
    {

        return $this->hasMany('APP\Laminado_Det','id_enc_laminado');
    }
}
