<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SecadoDet
 *
 * @property int $id_secado_det
 * @property int|null $id_secado_enc
 * @property string|null $hora
 * @property string|null $principal_set
 * @property string|null $principal_real
 * @property string|null $inicial_ar
 * @property string|null $inicial_ab
 * @property string|null $central_ar
 * @property string|null $central_ab
 * @property string|null $final_ar
 * @property string|null $final_ab
 * @property string|null $velocidad
 * @property string|null $tasa_salida
 * @property string|null $humedad_secadora
 * @property string|null $humedad_pasta
 * @property string|null $ambiente_humedad
 * @property string|null $ambiente_temperatura
 * @property string|null $observaciones
 * @property int|null $id_usuario
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereAmbienteHumedad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereAmbienteTemperatura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereCentralAb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereCentralAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereFinalAb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereFinalAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereHumedadPasta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereHumedadSecadora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereIdSecadoDet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereIdSecadoEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereInicialAb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereInicialAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet wherePrincipalReal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet wherePrincipalSet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereTasaSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecadoDet whereVelocidad($value)
 * @mixin \Eloquent
 */
class SecadoDet extends Model
{
    //


    protected $table = 'secado_det';
    protected $primaryKey = 'id_secado_det';

    public $timestamps = false;
}
