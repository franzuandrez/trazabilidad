<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LaminadoSopasEnc
 *
 * @property int $id_laminado_sopas_enc
 * @property int|null $id_control
 * @property string|null $id_turno
 * @property int|null $id_presentacion
 * @property string|null $id_usuario
 * @property string|null $fecha_hora
 * @property string|null $observaciones
 * @property int|null $id_producto
 * @property string|null $lote
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\LaminadoSopasDet[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc whereIdLaminadoSopasEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc whereIdPresentacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc whereIdTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasEnc whereObservaciones($value)
 * @mixin \Eloquent
 */
class LaminadoSopasEnc extends Model
{
    //

    protected $primaryKey = 'id_laminado_sopas_enc';
    protected $table = 'laminado_sopas_enc';
    public $timestamps = false;


    protected $with = ['detalle'];

    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

    public function detalle()
    {

        return $this->hasMany(LaminadoSopasDet::class, 'id_laminado_sopas_enc', 'id_laminado_sopas_enc');
    }

}
