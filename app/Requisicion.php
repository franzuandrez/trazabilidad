<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

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
        return $query->where('requisicion_encabezado.estado','!=', 'B');
    }

    public function scopeDeUsuarioRecepcion($query, $type)
    {

        return $query->where('id_usuario_ingreso', $type);
    }
}
