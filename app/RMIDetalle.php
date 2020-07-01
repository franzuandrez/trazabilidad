<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RMIDetalle
 *
 * @property int $id_rmi_detalle
 * @property int|null $id_rmi_encabezado
 * @property int|null $id_producto
 * @property string|null $lote
 * @property \Illuminate\Support\Carbon|null $fecha_vencimiento
 * @property float|null $cantidad
 * @property float|null $cantidad_entrante
 * @property string|null $estado
 * @property string|null $rampa
 * @property string|null $control
 * @property string|null $mp Mp -> Materia prima
 * @property-read \App\Producto|null $producto
 * @property-read \App\RMIEncabezado|null $rmi_encabezado
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle estaEnControl()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle estaEnRampa()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereCantidadEntrante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereIdRmiDetalle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereIdRmiEncabezado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereMp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIDetalle whereRampa($value)
 * @mixin \Eloquent
 */
class RMIDetalle extends Model
{
    //

    protected $table = 'rmi_detalle';
    protected $primaryKey = 'id_rmi_detalle';
    public $timestamps = false;

    protected $fillable = [
        'id_rmi_encabezado',
        'id_producto',
        'lote',
        'fecha_vencimiento',
        'cantidad',
        'estado',
        'rampa',
        'control',
        'mp',
    ];

    protected $dates = [
        'fecha_vencimiento'
    ];

    public $with = [
        'producto',
    ];

    /**
     * ----------------------------------------RELATIONSHIPS-------------------------
     */

    public function rmi_encabezado(){

        return $this->belongsTo('App\RMIEncabezado','id_rmi_encabezado');
    }

    public function producto(){

        return $this->belongsTo('App\Producto','id_producto');
    }
    /**
     * -----------------------------SCOPES---------------------------------
     */

    public function scopeEstaEnRampa( $query ){

        return $query->where("rmi_detalle.rampa",1);

    }

    public function scopeEstaEnControl( $query ){

        return $query->where('rmi_detalle.control',1);
    }
}
