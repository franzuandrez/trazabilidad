<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntregaEnc extends Model
{
    //

    protected $table = 'entrega_pt_enc';
    public $timestamps = false;


    protected $dates = [
        'fecha_hora'
    ];

    protected $with = [
        'detalle'
    ];

    public function creado_por()
    {

        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function detalle()
    {
        return $this->hasMany(EntregaDet::class, 'id_enc', 'id');
    }


}
