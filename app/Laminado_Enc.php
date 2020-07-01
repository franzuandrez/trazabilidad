<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Laminado_Enc
 *
 * @property int $id_enc_laminado
 * @property int|null $id_responsable
 * @property string|null $turno
 * @property string|null $fecha_ingreso
 * @property string|null $id_usuario
 * @property string|null $puesto
 * @property string|null $observaciones
 * @property string|null $no_orden
 * @property int|null $id_control
 * @property string|null $lote
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Laminado_Det[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc whereIdEncLaminado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc whereIdResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc whereNoOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Laminado_Enc whereTurno($value)
 * @mixin \Eloquent
 */
class Laminado_Enc extends Model
{
    protected $table = 'laminado_enc';
    protected $primaryKey = 'id_enc_laminado';
    public $timestamps = false;

    protected $fillable = [
        'id_responsable',
        'turno',
        'fecha_ingreso',
        'id_usuario',
        'puesto',
        'observaciones',
        'no_orden'
    ];

    protected $with = [
        'detalle'
    ];

    public function detalle()
    {

        return $this->hasMany(Laminado_Det::class, 'id_enc_laminado', 'id_enc_laminado');
    }

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }
}
