<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DetalleInsumo
 *
 * @property int $id_detalle_insumo
 * @property int|null $id_control
 * @property int|null $id_producto
 * @property string|null $color
 * @property string|null $olor
 * @property string|null $impresion
 * @property string|null $ausencia_material_extranio
 * @property string|null $lote
 * @property \Illuminate\Support\Carbon|null $fecha_vencimiento
 * @property float|null $cantidad
 * @property string|null $no_orden_produccion
 * @property float|null $cantidad_utilizada
 * @property-read \App\Producto|null $producto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereAusenciaMaterialExtranio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereCantidadUtilizada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereIdDetalleInsumo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereImpresion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereNoOrdenProduccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleInsumo whereOlor($value)
 * @mixin \Eloquent
 */
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
