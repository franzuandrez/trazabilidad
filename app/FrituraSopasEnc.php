<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrituraSopasEnc extends Model
{
    //

    protected $table = 'fritura_sopas_enc';
    protected $primaryKey = 'id_frutura_sopas_enc';
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
        return $this->hasMany(FrituraSopasDet::class, 'id_fritura_sopas_enc', 'id_frutura_sopas_enc');
    }

}
