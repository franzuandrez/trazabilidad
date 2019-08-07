<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Producto extends Model
{
    //

    use LogsActivity;
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'codigo_barras',
        'codigo_interno',
        'descripcion',
        'id_dimensional',
        'id_presentacion',
        'id_proveedor',
        'tipo_producto',
        'fecha_creacion',
        'fecha_actualizacion',
        'estado',
        'creado_por'
    ];

    public static $logAttributes = [
        'codigo_barras',
        'codigo_interno',
        'descripcion',
        'id_dimensional',
        'id_presentacion',
        'id_proveedor',
        'tipo_producto',
        'fecha_creacion',
        'fecha_actualizacion',
        'estado',
        'creado_por'
    ];

    protected static $logOnlyDirty = true;

    public function scopeActived( $query ){

        return $query->where('productos.estado',1);

    }

    public function proveedor(){

        return $this->belongsTo('App\Proveedor','id_proveedor');
    }

    public function dimensional(){

        return $this->belongsTo('App\Dimensional','id_dimensional');

    }

    public function presentacion(){

        return $this->belongsTo('App\Presentacion','id_presentacion');
    }

    public function creador(){

        return $this->belongsTo('App\User','creado_por');
    }



}
