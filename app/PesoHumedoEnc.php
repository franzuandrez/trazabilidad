<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PesoHumedoEnc
 *
 * @property int $id_peso_humedo
 * @property string|null $cortador_no
 * @property string|null $turno
 * @property string|null $fecha_ingreso
 * @property int|null $id_usuario
 * @property string|null $puesto
 * @property string|null $observaciones
 * @property string|null $no_orden
 * @property int|null $id_control
 * @property string|null $lote
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PesoHumedoDet[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc whereCortadorNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc whereIdPesoHumedo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc whereNoOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoHumedoEnc whereTurno($value)
 * @mixin \Eloquent
 */
class PesoHumedoEnc extends Model
{
    //

    protected $primaryKey = 'id_peso_humedo';
    protected $table = 'peso_humedo_enc';
    public $timestamps = false;

    protected $fillable = [
        'cortador_no',
        'turno',
        'fecha_ingreso',
        'id_usuario',
        'puesto',
        'observaciones',
        'no_orden',

    ];
    protected $with = [
        'detalle'
    ];

    public function detalle()
    {

        return $this->hasMany(PesoHumedoDet::class, 'id_peso_humedo_enc', 'id_peso_humedo');
    }

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

}
