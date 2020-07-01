<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\RequisicionDetalle
 *
 * @property int $id
 * @property int $id_requisicion_encabezado
 * @property string|null $orden_requisicion
 * @property string|null $orden_produccion
 * @property int|null $id_producto
 * @property float|null $cantidad
 * @property string|null $estado
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Producto|null $producto
 * @property-read \App\Requisicion $requision_encabezado
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle despachado()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle proceso()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle reservado()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle whereIdRequisicionEncabezado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle whereOrdenProduccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RequisicionDetalle whereOrdenRequisicion($value)
 * @mixin \Eloquent
 */
class RequisicionDetalle extends Model
{
    //
    use LogsActivity;
    public static $logAttributes = [
        '*'
    ];
    protected static $logOnlyDirty = true;

    protected  $table = 'requisicion_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $with = ['producto'];

    protected $fillable = [
        'id_requisicion_encabezado',
        'orden_requisicion',
        'orden_produccion',
        'id_producto',
        'cantidad',
        'estado',
    ];

    public function producto(){
        return $this->belongsTo('App\Producto','id_producto');
    }

    public  function requision_encabezado(){
        return $this->belongsTo('App\Requisicion','id_requisicion_encabezado');
    }

    public function scopeProceso($query){

        return $query->where('estado','P');
    }

    public function scopeReservado( $query ){
        return $query->where('estado','R');
    }

    public function scopeDespachado($query){

        return $query->where('estado','D');

    }


}
