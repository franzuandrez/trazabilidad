<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PrecocidoEnc
 *
 * @property int $id_precocido_enc
 * @property string|null $turno
 * @property string|null $fecha_ingreso
 * @property int|null $id_usuario
 * @property string|null $observaciones
 * @property string|null $no_orden
 * @property int|null $id_control
 * @property string|null $lote
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PrecocidoDet[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc whereIdPrecocidoEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc whereNoOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PrecocidoEnc whereTurno($value)
 * @mixin \Eloquent
 */
class PrecocidoEnc extends Model
{
    //

    protected $primaryKey = 'id_precocido_enc';
    protected $table = 'precocido_enc';
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

        return $this->hasMany(PrecocidoDet::class, 'id_precocido_enc', 'id_precocido_enc');
    }


    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

}
