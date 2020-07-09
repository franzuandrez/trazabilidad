<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Impresion
 *
 * @property int $CORRELATIVO
 * @property string|null $IP
 * @property string|null $CODIGO_BARRAS
 * @property string|null $DESCRIPCION_PRODUCTO
 * @property string|null $LOTE
 * @property \Illuminate\Support\Carbon|null $FECHA_VENCIMIENTO
 * @property string|null $IMPRESO
 * @property int|null $COPIAS
 * @property string|null $TIPO PT - Producto terminado.
 * D - Despacho
 * R - Recepcion
 * @property string|null $CODIGO_DUN
 * @property int|null $ID_USUARIO
 * @property string|null $REIMPRESION
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion noReimpresion()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereCODIGOBARRAS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereCODIGODUN($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereCOPIAS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereCORRELATIVO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereDESCRIPCIONPRODUCTO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereFECHAVENCIMIENTO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereIDUSUARIO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereIMPRESO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereIP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereLOTE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereREIMPRESION($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impresion whereTIPO($value)
 * @mixin \Eloquent
 */
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

    protected $dates = [
        'FECHA_VENCIMIENTO'
    ];


    public function scopeNoReimpresion($query)
    {

        return $query->where('tb_imprimir.REIMPRESION', '0');
    }

    public function scopeEsRecepcion($query)
    {
        return $query->where('tb_imprimir.tipo', 'R');
    }

}
