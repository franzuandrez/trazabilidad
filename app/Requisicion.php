<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Requisicion
 *
 * @property int $id
 * @property string|null $no_requision
 * @property string|null $no_orden_produccion
 * @property \Illuminate\Support\Carbon|null $fecha_ingreso
 * @property int|null $id_usuario_ingreso
 * @property int|null $id_usuario_aprobo
 * @property string|null $estado
 * @property string|null $fecha_actualizacion
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RequisicionDetalle[] $detalle
 * @property-read int|null $detalle_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReservaPicking[] $reservas
 * @property-read int|null $reservas_count
 * @property-read \App\User|null $usuario_aprobo
 * @property-read \App\User|null $usuario_ingreso
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion deUsuarioRecepcion($type)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion despachada()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion enProceso()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion enReserva()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion noDeBaja()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion whereFechaActualizacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion whereIdUsuarioAprobo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion whereIdUsuarioIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion whereNoOrdenProduccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requisicion whereNoRequision($value)
 * @mixin \Eloquent
 */
class Requisicion extends Model
{
    //
    use LogsActivity;
    public static $logAttributes = [
        '*'
    ];
    protected static $logOnlyDirty = true;

    protected $table = 'requisicion_encabezado';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public $with = ['detalle', 'reservas'];
    protected $fillable = [

        'no_requision',
        'no_orden_produccion',
        'fecha_ingreso',
        'id_usuario_ingreso',
        'id_usuario_aprobo',
        'estado',
    ];

    protected $dates = [
        'fecha_ingreso'
    ];

    public function usuario_ingreso()
    {

        return $this->belongsTo('App\User', 'id_usuario_ingreso');
    }

    public function usuario_aprobo()
    {

        return $this->belongsTo('App\User', 'id_usuario_aprobo');
    }

    public function detalle()
    {
        return $this->hasMany('App\RequisicionDetalle', 'id_requisicion_encabezado');
    }

    public function reservas()
    {
        return $this->hasMany('App\ReservaPicking', 'id_requisicion')
            ->orderBy('id_producto', 'asc')
            ->orderBy('fecha_vencimiento', 'asc')
            ->orderBy('id_ubicacion', 'asc');
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class,'numero_documento','no_orden_produccion');
    }

    public function scopeEnProceso($query)
    {
        return $query->where('estado', 'P');
    }

    public function scopeDespachada($query)
    {
        return $query->where('estado', 'D');
    }

    public function scopeEnReserva($query)
    {

        return $query->where('requisicion_encabezado.estado', 'R');
    }

    public function scopeNoDeBaja($query)
    {
        return $query->where('requisicion_encabezado.estado', '!=', 'B');
    }

    public function scopeDeUsuarioRecepcion($query, $type)
    {

        return $query->where('id_usuario_ingreso', $type);
    }
}
