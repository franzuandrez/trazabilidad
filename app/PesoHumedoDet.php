<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PesoHumedoDet
 *
 * @property int $id_peso_humedo_det
 * @property string|null $hora
 * @property string|null $muestra_no1
 * @property string|null $muestra_no2
 * @property string|null $muestra_no3
 * @property string|null $muestra_no4
 * @property string|null $muestra_no5
 * @property \App\Producto|null $producto
 * @property string|null $lote
 * @property string|null $observaciones
 * @property int|null $id_peso_humedo_enc
 * @property int|null $id_usuario
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereIdPesoHumedoDet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereIdPesoHumedoEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereMuestraNo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereMuestraNo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereMuestraNo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereMuestraNo4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereMuestraNo5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoDet whereProducto($value)
 * @mixin \Eloquent
 */
class PesoHumedoDet extends Model
{
    //

    protected $primaryKey = 'id_peso_humedo_det';
    protected $table = 'peso_humedo_det';
    public $timestamps = false;
    protected $fillable = [
        'hora',
        'muestra_no1',
        'muestra_no2',
        'muestra_no3',
        'muestra_no4',
        'muestra_no5',
        'producto',
        'lote',
        'observaciones',
        'id_peso_humedo_enc'

    ];
    protected $with = [
        'producto'
    ];

    public function producto()
    {

        return $this->belongsTo(Producto::class, 'producto', 'id_producto');

    }
}
