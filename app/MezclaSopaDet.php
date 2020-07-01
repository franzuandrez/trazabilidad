<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MezclaSopaDet
 *
 * @property int $id_mezclado_sopas_det
 * @property int|null $id_mezclado_sopas_enc
 * @property string|null $id_usuario
 * @property string|null $fecha_hora
 * @property string|null $no_batch
 * @property string|null $hora_inicio_mezcla
 * @property string|null $hora_fin_mezcla
 * @property string|null $tiempo_velocidad_alta
 * @property string|null $tiempo_velocidad_baja
 * @property string|null $observaciones
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet whereHoraFinMezcla($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet whereHoraInicioMezcla($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet whereIdMezcladoSopasDet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet whereIdMezcladoSopasEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet whereNoBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet whereTiempoVelocidadAlta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaSopaDet whereTiempoVelocidadBaja($value)
 * @mixin \Eloquent
 */
class MezclaSopaDet extends Model
{
    //

    protected $table = 'mezclado_sopas_det';
    protected $primaryKey = 'id_mezclado_sopas_det';
    public $timestamps = false;

}
