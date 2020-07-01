<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InspeccionVehiculo
 *
 * @property int $id_inspeccion_documentos
 * @property int|null $id_recepcion_enc
 * @property string|null $proveedor_aprobado
 * @property string|null $producto_acorde_compra
 * @property string|null $cantidad_acorde_compra
 * @property string|null $certificado_existente
 * @property string|null $certificado_correspondiente_lote
 * @property string|null $certificado_correspondiente_especificacion
 * @property string|null $sin_polvo
 * @property string|null $sin_material_ajeno
 * @property string|null $ausencia_plagas
 * @property string|null $sin_humedad
 * @property string|null $sin_oxido
 * @property string|null $ausencia_olores_extranios
 * @property string|null $ausencia_material_extranio
 * @property string|null $cerrado
 * @property string|null $sin_agujeros
 * @property string|null $observaciones
 * @property-read \App\Recepcion|null $recepcion
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereAusenciaMaterialExtranio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereAusenciaOloresExtranios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereAusenciaPlagas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereCantidadAcordeCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereCerrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereCertificadoCorrespondienteEspecificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereCertificadoCorrespondienteLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereCertificadoExistente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereIdInspeccionDocumentos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereIdRecepcionEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereProductoAcordeCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereProveedorAprobado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereSinAgujeros($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereSinHumedad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereSinMaterialAjeno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereSinOxido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InspeccionVehiculo whereSinPolvo($value)
 * @mixin \Eloquent
 */
class InspeccionVehiculo extends Model
{
    //

    protected $table = 'inspeccion_documentos_vehiculos';
    protected $primaryKey = 'id_inspeccion_documentos';
    public $timestamps = false;

    protected $fillable = [
        'id_recepcion_enc',
        'proveedor_aprobado',
        'producto_acorde_compra',
        'cantidad_acorde_compra',
        'certificado_existente',
        'certificado_correspondiente_lote',
        'certificado_correspondiente_especificacion',
        'sin_polvo',
        'sin_material_ajeno',
        'ausencia_plagas',
        'sin_humedad',
        'sin_oxido',
        'ausencia_olores_extranios',
        'ausencia_material_extranio',
        'cerrado',
        'sin_agujeros',
        'observaciones'
    ];

    public function recepcion(){

        return $this->belongsTo('App\Recepcion','id_recepcion_enc');
    }




}
