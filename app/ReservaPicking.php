<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'producto', 'bodega', 'usuario_picking'
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

        return $this->belongsTo('App\Ubicacion', 'id_ubicacion');
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
