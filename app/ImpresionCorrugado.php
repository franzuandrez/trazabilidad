<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImpresionCorrugado extends Model
{
    //


    protected $table = 'tb_imprimir_corrugado';
    public $timestamps = false;
    protected $primaryKey = 'correlativo';

    protected $fillable = [
        'identificador_aplicacion',
        'digito_indicador',
        'prefijo_compania',
        'numerio_serial',
        'fecha_hora',
        'impreso',
        'ip',
        'id_tb_imprimir'
    ];
}
