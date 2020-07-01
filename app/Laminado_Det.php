<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Laminado_Det
 *
 * @property int $id_det_laminado
 * @property int|null $id_enc_laminado
 * @property float|null $temperatura_inicio
 * @property string|null $temperatura_observaciones
 * @property float|null $espesor_inicio
 * @property string|null $espesor_observaciones
 * @property string|null $lote_producto
 * @property string|null $hora
 * @property int|null $id_producto
 * @property int|null $id_usuario
 * @property-read \App\Producto|null $producto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det whereEspesorInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det whereEspesorObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det whereIdDetLaminado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det whereIdEncLaminado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det whereLoteProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det whereTemperaturaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Det whereTemperaturaObservaciones($value)
 * @mixin \Eloquent
 */
class Laminado_Det extends Model
{
    protected $table ='laminado_det';
    protected $primaryKey = 'id_det_laminado';
    public $timestamps = false;

    protected $fillable = [
        'id_enc_laminado',
        'temperatura_inicio',
        'temperatura_final',
        'temperatura_observaciones',
        'espesor_inicio',
        'espesor_observaciones',
        'lote_producto',
        'hora'
    ];


    protected $with =[
        'producto'
    ];
    public function producto()
    {
        return $this->belongsTo(Producto::class,'id_producto','id_producto');
    }
}
