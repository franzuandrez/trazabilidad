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
    ];


    public function requisicion(){


        return $this->belongsTo('App\Requisicion','id_requisicion');
    }

    public function scopeEnReserva( $query ){
        return $query->where('reserva_lotes','R');
    }

}
