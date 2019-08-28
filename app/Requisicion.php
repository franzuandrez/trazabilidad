<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    //

    protected $table = 'requisicion_encabezado';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public $with = ['detalle'];
    protected $fillable = [

        'no_requision',
        'no_orden_produccion',
        'fecha_ingreso',
        'id_usuario_ingreso',
        'id_usuario_aprobo',
        'estado',
    ];

    protected $dates =[
        'fecha_ingreso'
    ];

    public function usuario_ingreso() {

        return $this->belongsTo('App\User','id_usuario_ingreso');
    }

    public function usuario_aprobo(){

        return $this->belongsTo('App\User','id_usuario_aprobo');
    }

    public function detalle(){
        return $this->hasMany('App\RequisicionDetalle','id_requisicion_encabezado');
    }

    public function reservas(){
        return $this->hasMany('App\ReservaPicking','id_requisicion')
            ->orderBy('id_bodega','desc');
    }

    public function scopeEnProceso( $query){
        return $query->where('estado','P');
    }

    public function scopeEnReserva( $query ){

        return $query->where('requisicion_encabezado.estado','R');
    }
}
