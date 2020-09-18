<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseCondimentosDet extends Model
{
    //

    protected $primaryKey = 'id';
    protected $table = 'base_condimentos_det';
    public $timestamps = false;

    protected $fillable = [
        'no_carga',
        'hora_carga',
        'hora_descarga',
        'observaciones',
        'id_usuario'
    ];
}
