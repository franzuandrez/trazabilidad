<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'debidamente_legible',
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
