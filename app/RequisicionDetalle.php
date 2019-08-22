<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisicionDetalle extends Model
{
    //

    protected  $table = 'requisicion_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;

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
