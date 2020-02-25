<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesoPastaSopasEnc extends Model
{
    //

    protected $table = 'peso_pasta_enc';
    protected $primaryKey = 'id_peso_pasta_enc';
    public $timestamps = false;

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');

    }

    public function detalle()
    {
        return $this->hasMany(PesoPastaSopasDet::class, 'id_peso_pasta_enc', 'id_peso_pasta_enc');
    }


}
