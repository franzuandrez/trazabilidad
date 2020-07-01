<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FrituraSopasEnc
 *
 * @property int $id_frutura_sopas_enc
 * @property int|null $id_control
 * @property int|null $id_usuario
 * @property int|null $id_producto
 * @property int|null $id_presentacion
 * @property string|null $fecha_hora
 * @property string|null $observaciones
 * @property string|null $id_turno
 * @property string|null $lote
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FrituraSopasDet[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc whereIdFruturaSopasEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc whereIdPresentacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc whereIdTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasEnc whereObservaciones($value)
 * @mixin \Eloquent
 */
class FrituraSopasEnc extends Model
{
    //

    protected $table = 'fritura_sopas_enc';
    protected $primaryKey = 'id_frutura_sopas_enc';
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
        return $this->hasMany(FrituraSopasDet::class, 'id_fritura_sopas_enc', 'id_frutura_sopas_enc');
    }

}
