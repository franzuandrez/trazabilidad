<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    //

    protected $table = 'produccion_encabezado';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [

        'no_requision',
        'no_orden_produccion',
        'fecha_ingreso',
        'id_usuario_ingreso',
        'id_usuario_aprobo',

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
}
