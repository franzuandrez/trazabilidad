<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FrituraSopasDet
 *
 * @property int $id_fritura_sopas_det
 * @property int|null $id_fritura_sopas_enc
 * @property string|null $fecha_hora
 * @property string|null $hora
 * @property string|null $temperatura_inicial
 * @property string|null $temperatura_final
 * @property string|null $temperatura_general
 * @property string|null $temperatura_set
 * @property string|null $tiempo_fritura
 * @property string|null $observaciones
 * @property int|null $id_usuario
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereIdFrituraSopasDet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereIdFrituraSopasEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereTemperaturaFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereTemperaturaGeneral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereTemperaturaInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereTemperaturaSet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrituraSopasDet whereTiempoFritura($value)
 * @mixin \Eloquent
 */
class FrituraSopasDet extends Model
{
    //

    protected $primaryKey = 'id_fritura_sopas_det';
    public $timestamps = false;
    protected $table = 'fritura_sopas_det';
}
