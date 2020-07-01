<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PesoPastaSopasEnc
 *
 * @property int $id_peso_pasta_enc
 * @property int|null $id_control
 * @property string|null $fecha_hora
 * @property int|null $id_producto
 * @property int|null $id_presentacion
 * @property string|null $id_turno
 * @property int|null $id_usuario
 * @property string|null $observaciones
 * @property string|null $lote
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PesoPastaSopasDet[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc whereIdPesoPastaEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc whereIdPresentacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc whereIdTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasEnc whereObservaciones($value)
 * @mixin \Eloquent
 */
class PesoPastaSopasEnc extends Model
{
    //

    protected $table = 'peso_pasta_enc';
    protected $primaryKey = 'id_peso_pasta_enc';
    public $timestamps = false;

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');

    }

    public function detalle()
    {
        return $this->hasMany(PesoPastaSopasDet::class, 'id_peso_pasta_enc', 'id_peso_pasta_enc');
    }


}
