<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\LineaChaomin
 *
 * @property int $id_chaomin
 * @property int|null $id_control
 * @property int|null $id_producto
 * @property string|null $no_orden_produccion
 * @property string|null $id_presentacion
 * @property string|null $id_turno
 * @property string|null $cant_solucion_carga
 * @property string|null $cantidad_solucion_observacion
 * @property string|null $ph_solucion_inicial
 * @property string|null $ph_solucion_observacion
 * @property string|null $mezcla_seca_inicial
 * @property string|null $mezcla_seca_observacion
 * @property string|null $mezcla_alta_inicial
 * @property string|null $mezcla_alta_observacion
 * @property string|null $mezcla_baja_inicial
 * @property string|null $mezcla_baja_observacion
 * @property string|null $temperatura_reposo_inicial
 * @property string|null $temperatura_reposo_observacion
 * @property string|null $ancho_cartucho_inicial
 * @property string|null $ancho_cartucho_observacion
 * @property string|null $temperatura_precocedora_1_inicial
 * @property string|null $temperatura_precocedora_1_observacion
 * @property string|null $tiempo_precocedora_1_inicial
 * @property string|null $tiempo_precocedora_1_observacion
 * @property string|null $temperatura_precocedora_2_inicial
 * @property string|null $temperatura_precocedora_2_observacion
 * @property string|null $tiempo_precocedora_2_inicial
 * @property string|null $tiempo_precocedora_2_observacion
 * @property string|null $temperatura_central_inicial
 * @property string|null $temperatura_central_observaciones
 * @property string|null $velocidad_pass200_inicial
 * @property string|null $velocidad_pass200_observaciones
 * @property string|null $velocidad_pasc180_inicial
 * @property string|null $velocidad_pasc180_observaciones
 * @property string|null $velocidad_pask180_inicial
 * @property string|null $velocidad_pask180_observaciones
 * @property string|null $velocidad_pasi180_inicial
 * @property string|null $velocidad_pasi180_observaciones
 * @property string|null $velocidad_pasm160_inicial
 * @property string|null $velocidad_pasm160_observaciones
 * @property string|null $extractor_activo_inicial
 * @property string|null $extractor_activo_observaciones
 * @property string|null $ventilacion_inicial
 * @property string|null $verificacion_codificacion_lote
 * @property string|null $verificacion_codificacion_vence
 * @property string|null $verificacion_codificacion_obs
 * @property string|null $ventilacion_observacion
 * @property \Illuminate\Support\Carbon|null $fecha
 * @property string|null $responsable
 * @property string|null $maquina_inicial_1
 * @property string|null $sellos_observaciones
 * @property string|null $maquina_inicial_2
 * @property string|null $sellos_observaciones_2
 * @property string|null $estado
 * @property string|null $observaciones_acciones
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \App\Presentacion|null $presentacion
 * @property-read \App\Producto|null $producto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereAnchoCartuchoInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereAnchoCartuchoObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereCantSolucionCarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereCantidadSolucionObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereExtractorActivoInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereExtractorActivoObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereIdChaomin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereIdPresentacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereIdTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereMaquinaInicial1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereMaquinaInicial2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereMezclaAltaInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereMezclaAltaObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereMezclaBajaInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereMezclaBajaObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereMezclaSecaInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereMezclaSecaObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereNoOrdenProduccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereObservacionesAcciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin wherePhSolucionInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin wherePhSolucionObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereSellosObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereSellosObservaciones2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTemperaturaCentralInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTemperaturaCentralObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTemperaturaPrecocedora1Inicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTemperaturaPrecocedora1Observacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTemperaturaPrecocedora2Inicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTemperaturaPrecocedora2Observacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTemperaturaReposoInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTemperaturaReposoObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTiempoPrecocedora1Inicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTiempoPrecocedora1Observacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTiempoPrecocedora2Inicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereTiempoPrecocedora2Observacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVelocidadPasc180Inicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVelocidadPasc180Observaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVelocidadPasi180Inicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVelocidadPasi180Observaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVelocidadPask180Inicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVelocidadPask180Observaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVelocidadPasm160Inicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVelocidadPasm160Observaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVelocidadPass200Inicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVelocidadPass200Observaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVentilacionInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVentilacionObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVerificacionCodificacionLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVerificacionCodificacionObs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaChaomin whereVerificacionCodificacionVence($value)
 * @mixin \Eloquent
 */
class LineaChaomin extends Model
{
    //
    use LogsActivity;
    protected $table = 'chaomin';
    protected $primaryKey = 'id_chaomin';
    public $timestamps = false;


    public static $logAttributes = [
        '*'
    ];
    protected static $logOnlyDirty = true;
    protected $dates = [
        'fecha'
    ];
    protected $fillable = [
        'no_orden_produccion',
        'id_presentacion',
        'id_producto',
        'id_turno',
        'cant_solucion_carga',
        'cant_carga_salida',
        'cant_solucion_carga',
        'cantidad_solucion_observacion',
        'ph_solucion_inicial',
        'ph_solucion_final',
        'ph_solucion_observacion',
        'mezcla_seca_inicial',
        'mezcla_seca_final',
        'mezcla_seca_observacion',
        'mezcla_alta_inicial',
        'mezcla_alta_final',
        'mezcla_alta_observacion',
        'mezcla_baja_inicial',
        'mezcla_baja_final',
        'mezcla_baja_observacion',
        'temperatura_reposo_inicial',
        'temperatura_reposo_final',
        'temperatura_reposo_observacion',
        'ancho_cartucho_inicial',
        'ancho_cartucho_final',
        'ancho_cartucho_observacion',
        'temperatura_precocedora_1_inicial',
        'temperatura_precocedora_1_final',
        'temperatura_precocedora_1_observacion',
        'tiempo_precocedora_1_inicial',
        'tiempo_precocedora_1_final',
        'tiempo_precocedora_1_observacion',
        'temperatura_precocedora_2_inicial',
        'temperatura_precocedora_2_final',
        'temperatura_precocedora_2_observacion',
        'tiempo_precocedora_2_inicial',
        'tiempo_precocedora_2_final',
        'tiempo_precocedora_2_observacion',
        'temperatura_central_inicial',
        'temperatura_central_final',
        'temperatura_central_observaciones',
        'velocidad_pass200_inicial',
        'velocidad_pass200_final',
        'velocidad_pass200_observaciones',
        'velocidad_pasc180_inicial',
        'velocidad_pasc180_final',
        'velocidad_pasc180_observaciones',
        'velocidad_pask180_inicial',
        'velocidad_pask180_final',
        'velocidad_pask180_observaciones',
        'velocidad_pasi180_inicial',
        'velocidad_pasi180_final',
        'velocidad_pasi180_observaciones',
        'velocidad_pasm160_inicial',
        'velocidad_pasm160_final',
        'velocidad_pasm160_observaciones',
        'extractor_activo_inicial',
        'extractor_activo_final',
        'extractor_activo_observaciones',
        'ventilacion_inicial',
        'ventilacion_final',
        'ventilacion_observacion',
        'verificacion_codificacion_lote',
        'verificacion_codificacion_vence',
        'verificacion_codificacion_obs',
        'id_maquina',
        'maquina_inicial',
        'maquina_final',
        'observaciones_acciones',
        'responsable'
    ];

    protected $with = [
        'control_trazabilidad',
        'presentacion'
    ];

    public function control_trazabilidad()
    {

        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');

    }

    public function presentacion()
    {

        return $this->belongsTo(Presentacion::class, 'id_presentacion', 'id_presentacion');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
