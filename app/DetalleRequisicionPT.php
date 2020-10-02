<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleRequisicionPT extends Model
{
    //

    protected $table = 'detalle_requisicion_pt';
    protected $primaryKey = 'id';


    protected $with = [
        'cliente'
    ];

    public function cliente()
    {

        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
