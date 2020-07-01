<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PesoSecoDet
 *
 * @property int $id_peso_seco_det
 * @property string|null $hora
 * @property string|null $muestra_no1
 * @property string|null $muestra_no2
 * @property string|null $muestra_no3
 * @property string|null $muestra_no4
 * @property string|null $muestra_no5
 * @property \App\Producto|null $producto
 * @property string|null $lote
 * @property string|null $observaciones
 * @property int|null $id_peso_seco_enc
 * @property int|null $id_usuario
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereIdPesoSecoDet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereIdPesoSecoEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereMuestraNo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereMuestraNo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereMuestraNo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereMuestraNo4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereMuestraNo5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoDet whereProducto($value)
 * @mixin \Eloquent
 */
class PesoSecoDet extends Model
{
    //

    protected $primaryKey = 'id_peso_seco_det';
    protected $table = 'peso_seco_det';
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
        'id_peso_seco_enc'
    ];

    protected $with = [
        'producto'
    ];

    public function producto()
    {

        return $this->belongsTo(Producto::class, 'producto', 'id_producto');
    }

}
