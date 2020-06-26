<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impresion extends Model
{
    //

    public $timestamps = false;
    protected $primaryKey = 'CORRELATIVO';
    protected $table = 'tb_imprimir';

    protected $fillable = [
        'IP',
        'CODIGO_BARRAS',
        'DESCRIPCION_PRODUCTO',
        'LOTE',
        'FECHA_VENCIMIENTO',
        'COPIAS',
        'TIPO',
        'CODIGO_DUN',
        'ID_USUARIO',
        'REIMPRESION'
    ];

    protected $dates =[
        'FECHA_VENCIMIENTO'
    ];


    public function scopeNoReimpresion($query)
    {

        return $query->where('tb_imprimir.REIMPRESION', '0');
    }

}
