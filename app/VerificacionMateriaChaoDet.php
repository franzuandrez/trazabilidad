<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VerificacionMateriaChaoDet
 *
 * @property int $id_verificacion_det
 * @property int|null $id_producto
 * @property string|null $lote
 * @property float|null $cantidad
 * @property string|null $fecha
 * @property string|null $hora
 * @property string|null $batch_no
 * @property string|null $equipo
 * @property string|null $observaciones
 * @property int|null $id_usuario
 * @property int|null $id_verificacion
 * @property \App\Producto|null $producto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereBatchNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereEquipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereIdVerificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereIdVerificacionDet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoDet whereProducto($value)
 * @mixin \Eloquent
 */
class VerificacionMateriaChaoDet extends Model
{
    //


    protected $primaryKey = 'id_verificacion_det';
    protected $table = 'verificacion_materias_chao_det';
    public $timestamps = false;

    protected $with = ['producto'];

    public function producto()
    {

        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
