<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\LineaSopa
 *
 * @property int $id_sopa
 * @property int|null $id_producto
 * @property int|null $id_presentacion
 * @property int|null $id_control
 * @property string|null $identificacion_cartucho
 * @property string|null $identificacion_cartucho_observaciones
 * @property string|null $presion_vapor
 * @property string|null $presion_vapor_observaciones
 * @property string|null $temperatura_del_aceite_set
 * @property string|null $temperatura_del_aceite_set_observaciones
 * @property string|null $ph_solucion
 * @property string|null $ph_solucion_observaciones
 * @property string|null $compuestos_polares_libres_frio
 * @property string|null $compuestos_polares_libres_antes
 * @property string|null $compuestos_polares_libres_durante
 * @property string|null $compuestos_polares_libres_despues
 * @property string|null $compuestos_polares_libres_observaciones
 * @property string|null $indice_acidez_frio
 * @property string|null $indice_acidez_antes
 * @property string|null $indice_acidez_durante
 * @property string|null $indice_acidez_despues
 * @property string|null $indice_acidez_observaciones
 * @property string|null $temperatura_aceite_frio
 * @property string|null $temperatura_aceite_antes
 * @property string|null $temperatura_aceite_durante
 * @property string|null $temperatura_aceite_despues
 * @property string|null $temperatura_aceite_obsevaciones
 * @property string|null $porcentaje_solucion
 * @property string|null $porcentaje_solucion_observaciones
 * @property string|null $verificacion_codificado_lote
 * @property string|null $verificacion_codificado_vence
 * @property string|null $medidas_molde_superior
 * @property string|null $medidas_molde_inferior
 * @property string|null $medidas_molde_altura
 * @property string|null $medidas_nido_superior
 * @property string|null $medidas_nido_inferior
 * @property string|null $medidas_nido_altura
 * @property string|null $tiempos_mezcla_seco
 * @property string|null $tiempos_mezcla_alta
 * @property string|null $tiempos_mezcla_baja
 * @property string|null $verificacion_material
 * @property string|null $verificacion_material_observaciones
 * @property int|null $id_usuario
 * @property string|null $id_turno
 * @property \Illuminate\Support\Carbon|null $fecha_hora
 * @property string|null $observaciones
 * @property string|null $estado
 * @property string|null $lote
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \App\Presentacion|null $presentacion
 * @property-read \App\Producto|null $producto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereCompuestosPolaresLibresAntes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereCompuestosPolaresLibresDespues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereCompuestosPolaresLibresDurante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereCompuestosPolaresLibresFrio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereCompuestosPolaresLibresObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIdPresentacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIdSopa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIdTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIdentificacionCartucho($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIdentificacionCartuchoObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIndiceAcidezAntes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIndiceAcidezDespues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIndiceAcidezDurante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIndiceAcidezFrio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereIndiceAcidezObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereMedidasMoldeAltura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereMedidasMoldeInferior($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereMedidasMoldeSuperior($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereMedidasNidoAltura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereMedidasNidoInferior($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereMedidasNidoSuperior($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa wherePhSolucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa wherePhSolucionObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa wherePorcentajeSolucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa wherePorcentajeSolucionObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa wherePresionVapor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa wherePresionVaporObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereTemperaturaAceiteAntes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereTemperaturaAceiteDespues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereTemperaturaAceiteDurante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereTemperaturaAceiteFrio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereTemperaturaAceiteObsevaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereTemperaturaDelAceiteSet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereTemperaturaDelAceiteSetObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereTiemposMezclaAlta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereTiemposMezclaBaja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereTiemposMezclaSeco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereVerificacionCodificadoLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereVerificacionCodificadoVence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereVerificacionMaterial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LineaSopa whereVerificacionMaterialObservaciones($value)
 * @mixin \Eloquent
 */
class LineaSopa extends Model
{
    //
    use LogsActivity;
    protected $table = 'sopas';
    protected $primaryKey = 'id_sopa';
    public $timestamps = false;

    protected $dates = [
        'fecha_hora'
    ];

    protected $with = [
        'presentacion'
    ];

    public static $logAttributes = [
        '*'
    ];
    protected static $logOnlyDirty = true;
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
