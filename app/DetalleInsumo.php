<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleInsumo extends Model
{
    //

    protected $table = 'detalle_insumos';
    protected $primaryKey = 'id_detalle_insumo';

    public $timestamps = false;
    protected $fillable =
        [
            'id_control',
            'id_producto',
            'color',
            'impresion',
            'ausencia_material_extranio',
            'lote',
            'fecha_vencimiento',
            'cantidad'
        ];
}
