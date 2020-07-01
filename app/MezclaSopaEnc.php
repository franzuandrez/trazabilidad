<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MezclaSopaEnc
 *
 * @property int $id_mezclado
 * @property string|null $id_control
 * @property string|null $fecha_hora
 * @property int|null $id_usuario
 * @property int|null $id_producto
 * @property int|null $id_presentacion
 * @property string|null $observaciones
 * @property string|null $id_turno
 * @property string|null $lote
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MezclaSopaDet[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc whereIdMezclado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc whereIdPresentacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc whereIdTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaEnc whereObservaciones($value)
 * @mixin \Eloquent
 */
class MezclaSopaEnc extends Model
{
    //

    protected $table = 'mezclado_sopas_enc';
    protected $primaryKey = 'id_mezclado';
    public $timestamps = false;
    protected $with = [
        'detalle'
    ];


    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }

    public function detalle()
    {
        return $this->hasMany(MezclaSopaDet::class, 'id_mezclado_sopas_enc', 'id_mezclado');
    }
}
