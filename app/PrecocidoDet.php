<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PrecocidoDet
 *
 * @property int $id_precocido_det
 * @property string|null $hora_inicio
 * @property string|null $hora_salida
 * @property string|null $tiempo_efectivo
 * @property string|null $alcance_presion
 * @property string|null $temperatura
 * @property string|null $id_producto
 * @property string|null $lote
 * @property string|null $responsable
 * @property string|null $observaciones
 * @property int|null $id_precocido_enc
 * @property int|null $id_usuario
 * @property-read \App\Producto|null $producto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereAlcancePresion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereHoraInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereHoraSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereIdPrecocidoDet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereIdPrecocidoEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereTemperatura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoDet whereTiempoEfectivo($value)
 * @mixin \Eloquent
 */
class PrecocidoDet extends Model
{
    //

    protected $primaryKey = 'id_precocido_det';
    protected $table = 'precocido_det';
    public $timestamps = false;

    protected $fillable = [
        'hora_inicio',
        'hora_salida',
        'tiempo_efectivo',
        'alcance_presion',
        'temperatura',
        'observaciones',
        'id_producto',
        'lote',
        'id_precocido_enc',
    ];

    protected $with = [
        'producto'
    ];

    public function producto()
    {

        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
