<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
