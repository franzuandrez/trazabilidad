<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correlativo extends Model
{
    //


    protected  $table = 'correlativos';
    protected $primaryKey = 'id_correlativo';

    protected $fillable = [
        'prefijo',
        'correlativo',
        'id_empresa',
        'modulo'
    ];

    public $timestamps = false;
}
