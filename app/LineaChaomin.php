<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineaChaomin extends Model
{
    //

    protected $table = 'chaomin';
    protected $primaryKey = 'id_chaomin';
    public $timestamps = false;


    protected $dates = [
        'fecha'
    ];
    protected $fillable = [
        'no_orden_produccion',
        'id_presentacion',
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
}
