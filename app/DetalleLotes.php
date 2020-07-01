<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DetalleLotes
 *
 * @property int $id_detalle
 * @property int|null $cantidad
 * @property string|null $no_lote
 * @property \Illuminate\Support\Carbon|null $fecha_vencimiento
 * @property int|null $id_recepcion_enc
 * @property int|null $id_producto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Producto|null $producto
 * @property-read \App\Recepcion|null $recepcion
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes whereIdDetalle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes whereIdRecepcionEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes whereNoLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DetalleLotes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DetalleLotes extends Model
{
    //

    protected  $table = 'detalle_lotes';
    protected $primaryKey = 'id_detalle';
    public $timestamps = true;


    protected $fillable = [
        'cantidad',
        'no_lote',
        'fecha_vencimiento',
        'id_recepcion_enc',
        'id_producto'
    ];

    public function recepcion(){

        return $this->belongsTo('App\Recepcion','id_recepcion_enc');
    }
    public function producto(){
        return $this->belongsTo('App\Producto','id_producto');
    }
    public $dates= [
        'fecha_vencimiento'
    ];

}
