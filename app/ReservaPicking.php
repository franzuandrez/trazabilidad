<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ReservaPicking
 *
 * @property int $id_reserva
 * @property int|null $id_producto
 * @property string|null $lote
 * @property \Illuminate\Support\Carbon|null $fecha_vencimiento
 * @property float|null $cantidad
 * @property int|null $id_requisicion
 * @property int|null $id_bodega
 * @property string|null $estado P -> Proceso
 * R -> Reservado
 * D ->Despachado
 * @property string|null $leido
 * @property \Illuminate\Support\Carbon|null $fecha_lectura
 * @property \App\Sector|null $ubicacion
 * @property int|null $id_ubicacion
 * @property int|null $id_usuario_picking
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Bodega|null $bodega
 * @property-read \App\Producto|null $producto
 * @property-read \App\Requisicion|null $requisicion
 * @property-read \App\User|null $usuario_picking
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking enProceso()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking enReserva()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereFechaLectura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereIdBodega($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereIdRequisicion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereIdReserva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereIdUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereIdUsuarioPicking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereLeido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReservaPicking whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReservaPicking extends Model
{
    //

    protected $table = 'reserva_lotes';
    protected $primaryKey = 'id_reserva';
    public $timestamps = true;

    protected $fillable = [
        'id_producto',
        'lote',
        'cantidad',
        'id_requisicion',
        'id_bodega',
        'id_ubicacion',
        'ubicacion',
        'id_usuario_picking'
    ];

    protected $dates = [
        'fecha_lectura',
        'created_at',
        'updated_at',
        'fecha_vencimiento'
    ];

    public $with = [
        'producto', 'bodega', 'usuario_picking','ubicacion'
    ];

    public function requisicion()
    {


        return $this->belongsTo('App\Requisicion', 'id_requisicion');
    }

    public function producto()
    {
        return $this->belongsTo('App\Producto', 'id_producto');
    }

    public function bodega()
    {
        return $this->belongsTo('App\Bodega', 'id_bodega');

    }

    public function ubicacion()
    {

        return $this->belongsTo('App\Sector', 'ubicacion','codigo_barras');
    }

    public function scopeEnReserva($query)
    {
        return $query->where('reserva_lotes.estado', 'R');
    }

    public function scopeEnProceso($query)
    {

        return $query->where('reserva_lotes.estado', 'P');

    }

    public function usuario_picking()
    {

        return $this->belongsTo('App\User', 'id_usuario_picking');
    }

}
