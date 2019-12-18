<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleInsumo extends Model
{
    //

    protected $table = 'detalle_insumos';
    protected $primaryKey = 'id_detalle_insumo';

    public $timestamps = false;

    public $with = [
        'producto'
    ];
    public $dates = [
        'fecha_vencimiento'
    ];
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

    public function producto(){

        return $this->belongsTo(Producto::class,'id_producto','id_producto');
    }
}
