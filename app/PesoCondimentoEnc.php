<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesoCondimentoEnc extends Model
{
    //


    protected $table = 'peso_condimentos_enc';
    public $timestamps = false;
    protected $primaryKey = 'id_peso_enc';


    public function detalle()
    {


        return $this->hasMany(PesoCondimentoDet::class,
            'id_peso_enc',
            'id_peso_enc');
    }

    public function control_trazabilidad()
    {


        return $this
            ->belongsTo(Operacion::class,
                'id_control',
                'id_control');
    }


}
