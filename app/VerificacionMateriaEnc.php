<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VerificacionMateriaEnc
 *
 * @property int $id_verificacion
 * @property int|null $id_control
 * @property int|null $id_producto
 * @property string|null $fecha
 * @property int|null $id_usuario
 * @property string|null $id_turno
 * @property string|null $observaciones
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\VerificacionMateriaDet[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaEnc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaEnc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaEnc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaEnc whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaEnc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaEnc whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaEnc whereIdTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaEnc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaEnc whereIdVerificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaEnc whereObservaciones($value)
 * @mixin \Eloquent
 */
class VerificacionMateriaEnc extends Model
{
    //


    protected $primaryKey = 'id_verificacion';
    protected $table = 'verificacion_materias_enc';
    public $timestamps = false;


    public function control_trazabilidad()
    {


        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

    public function detalle()
    {


        return $this->hasMany(VerificacionMateriaDet::class, 'id_verificacion_enc', 'id_verificacion');
    }


}
