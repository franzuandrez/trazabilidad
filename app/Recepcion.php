<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Recepcion extends Model
{
    //
    use LogsActivity;
    protected $primaryKey = 'id_recepcion_enc';
    protected $table = 'recepcion_encabezado';
    public $timestamps = false;

    protected $fillable = [
        'orden_compra',
        'id_proveedor',

        'fecha_ingreso',
        'estado',
        'usuario_recepcion',
        'documento_proveedor'
    ];

    protected $dates = [
        'fecha_ingreso'
    ];

    public static $logAttributes = [
        'orden_compra',
        'id_proveedor',
        'id_proveedor',
        'fecha_ingreso',
        'id_producto',
        'usuario_recepcion'
    ];

    protected static $logOnlyDirty = true;

    public function usuario_recepcion(){

        return $this->belongsTo('App\User','usuario_recepcion');
    }

    public function proveedor(){

        return $this->belongsTo('App\Proveedor','id_proveedor');
    }



    public function producto_materia_prima(){

        return $this->belongsTo('App\Producto','id_producto');
    }

    public function inspeccion_vehiculos(){

        return $this->hasOne('App\InspeccionVehiculo','id_recepcion_enc');
    }

    public function inspeccion_empaque(){

        return $this->hasOne('App\InspeccionEmpaqueEtiqueta','id_recepcion_enc');
    }

    public function detalle_lotes(){

        return $this->hasMany('App\DetalleLotes','id_recepcion_enc');
    }

    public function movimientos(){

        return $this->hasMany('App\Movimiento','numero_documento','orden_compra');
    }

    public function scopeTransito($query){
        return $query->where('recepcion_encabezado.estado','T');
    }

    public function scopeEstaEnBodegaMP($query){
        return $query->where('recepcion_encabezado.estado','MP');

    }

}
