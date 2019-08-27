<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservaPicking extends Model
{
    //

    protected $table = 'reserva_lotes';
    protected $primaryKey = 'id_reserva';
    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'lote',
        'cantidad',
        'id_requisicion',
        'id_bodega'
    ];

    public $with = [
        'producto','bodega'
    ];
    public function requisicion(){


        return $this->belongsTo('App\Requisicion','id_requisicion');
    }

    public function producto(){
        return $this->belongsTo('App\Producto','id_producto');
    }

    public function bodega(){
        return $this->belongsTo('App\Bodega','id_bodega');

    }
    public function scopeEnReserva( $query ){
        return $query->where('reserva_lotes.estado','R');
    }

}
