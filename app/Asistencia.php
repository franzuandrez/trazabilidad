<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    //DEPRECATED INSTEAD USE OperariosInvolucrados

    protected $table = 'actividades_colaboradores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_colaborador',
        'id_actividad',
        'id_control',
        'fecha_hora_asociacion',
        'fecha_asistencia',
        'fecha_hora_fin',
        'asistio'
    ];

    protected $dates = [
        'fecha_hora_fin',
        'fecha_hora_asociacion',
        'fecha_asistencia'
    ];

}
