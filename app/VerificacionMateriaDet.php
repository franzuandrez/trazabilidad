<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VerificacionMateriaDet
 *
 * @property int $id_verificacion_det
 * @property string|null $hora
 * @property string|null $batch_no
 * @property string|null $harina
 * @property string|null $cantidad_solucion
 * @property string|null $observaciones
 * @property string|null $fecha_hora
 * @property int|null $id_usuario
 * @property int|null $id_verificacion_enc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet whereBatchNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet whereCantidadSolucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet whereHarina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet whereIdVerificacionDet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet whereIdVerificacionEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaDet whereObservaciones($value)
 * @mixin \Eloquent
 */
class VerificacionMateriaDet extends Model
{
    //

    public $timestamps = false;
    protected $table = 'verificacion_materias_det';
    protected $primaryKey = 'id_verificacion_det';



}
