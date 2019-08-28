<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RMIEncabezado extends Model
{
    //
    protected $table = 'rmi_encabezado';
    protected $primaryKey = 'id_rmi_encabezado';
    public $timestamps = false;

    protected $fillable = [
        'tipo_docoumento',
        'fecha_ingreso',
        'usuario_ingreso',
        'estado'
    ];

    public $dates = [
        'fecha_ingreso'
    ];
}
