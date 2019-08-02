<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferenciasComerciales extends Model
{
    //

    protected $table = 'referencias_comerciales';
    protected $primaryKey = 'id_referencias_comerciales';
    public $timestamps = false;


    protected $fillable = [
        'nombre_empresa',
        'telefono',
        'direccion',
        'contacto',
        'id_proveedor'
    ];

    public function proveedor(){

        return $this->belongsTo('App\Proveedor','id_proveedor');
    }
}
