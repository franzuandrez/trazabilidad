<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PesoSecoEnc
 *
 * @property int $id_peso_seco
 * @property string|null $turno
 * @property string|null $fecha_ingreso
 * @property int|null $id_usuario
 * @property string|null $puesto
 * @property string|null $observaciones
 * @property string|null $no_orden
 * @property int|null $id_control
 * @property string|null $lote
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PesoSecoDet[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc whereIdPesoSeco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc whereNoOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoSecoEnc whereTurno($value)
 * @mixin \Eloquent
 */
class PesoSecoEnc extends Model
{
    //

    protected $primaryKey = 'id_peso_seco';
    protected $table = 'peso_seco_enc';
    public $timestamps = false;

    protected $fillable = [
        'turno',
        'fecha_ingreso',
        'id_usuario',
        'observaciones',
        'no_orden'
    ];

    protected $with = [
        'detalle'
    ];

    public function detalle()
    {

        return $this->hasMany(PesoSecoDet::class, 'id_peso_seco_enc', 'id_peso_seco');
    }

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

}
