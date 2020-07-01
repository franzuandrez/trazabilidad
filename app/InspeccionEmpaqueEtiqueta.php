<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InspeccionEmpaqueEtiqueta
 *
 * @property int $id_inspeccion_empaque
 * @property int|null $id_recepcion_enc
 * @property string|null $no_golpeado
 * @property string|null $sin_roturas
 * @property string|null $cerrado
 * @property string|null $seco_limpio
 * @property string|null $sin_material_extranio
 * @property string|null $debidamente_identificado
 * @property string|null $identificacion_legible
 * @property string|null $no_lote_presente
 * @property string|null $no_lote_legible
 * @property string|null $fecha_vencimiento_legible
 * @property string|null $fecha_vencimiento_vigente
 * @property string|null $contenido_neto_declarado
 * @property string|null $observaciones
 * @property-read \App\Recepcion|null $recepcion
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereCerrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereContenidoNetoDeclarado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereDebidamenteIdentificado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereFechaVencimientoLegible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereFechaVencimientoVigente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereIdInspeccionEmpaque($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereIdRecepcionEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereIdentificacionLegible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereNoGolpeado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereNoLoteLegible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereNoLotePresente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereSecoLimpio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereSinMaterialExtranio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionEmpaqueEtiqueta whereSinRoturas($value)
 * @mixin \Eloquent
 */
class InspeccionEmpaqueEtiqueta extends Model
{
    //

    protected $table = 'inspeccion_empaque_etiqueta';
    protected $primaryKey = 'id_inspeccion_empaque';
    public $timestamps = false;

    protected $fillable = [
        'id_recepcion_enc',
        'no_golpeado',
        'sin_roturas',
        'cerrado',
        'seco_limpio',
        'sin_material_extranio',
        'debidamente_identificado',
        'identificacion_legible',
        'no_lote_presente',
        'no_lote_legible',
        'fecha_vencimiento_legible',
        'fecha_vencimiento_vigente',
        'contenido_neto_declarado',
        'observaciones'
    ];

    public function recepcion(){

        return $this->belongsTo('App\Recepcion','id_recepcion_enc');
    }


}
