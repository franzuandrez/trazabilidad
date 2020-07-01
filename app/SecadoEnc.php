<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SecadoEnc
 *
 * @property int $id_secado_enc
 * @property int|null $id_control
 * @property string|null $id_turno
 * @property int|null $id_usuario
 * @property string|null $fecha_ingreso
 * @property string|null $observaciones
 * @property int|null $id_producto
 * @property string|null $lote
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SecadoDet[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc whereIdSecadoEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc whereIdTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoEnc whereObservaciones($value)
 * @mixin \Eloquent
 */
class SecadoEnc extends Model
{
    //


    protected $primaryKey = 'id_secado_enc';
    protected $table = 'secado_enc';
    public $timestamps = false;


    public function detalle()
    {
        return $this->hasMany(SecadoDet::class, 'id_secado_enc', 'id_secado_enc');
    }

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');

    }
}
