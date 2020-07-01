<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LaminadoSopasDet
 *
 * @property int $id_laminado_sopas_det
 * @property int|null $id_laminado_sopas_enc
 * @property int|null $id_usuario
 * @property string|null $fecha_hora
 * @property string|null $hora
 * @property string|null $velocidad_laminado
 * @property string|null $espesor_lamina
 * @property string|null $presion_regulador_vapor
 * @property string|null $indice_precoccion
 * @property string|null $temperatura_precoccion_inicio
 * @property string|null $temperatura_precoccion_salida
 * @property string|null $tiempo_precoccion
 * @property string|null $velocidad
 * @property string|null $observaciones
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereEspesorLamina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereIdLaminadoSopasDet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereIdLaminadoSopasEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereIndicePrecoccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet wherePresionReguladorVapor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereTemperaturaPrecoccionInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereTemperaturaPrecoccionSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereTiempoPrecoccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereVelocidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LaminadoSopasDet whereVelocidadLaminado($value)
 * @mixin \Eloquent
 */
class LaminadoSopasDet extends Model
{
    //

    protected $primaryKey = 'id_laminado_sopas_det';
    protected $table = 'laminado_sopas_det';
    public $timestamps = false;

}
