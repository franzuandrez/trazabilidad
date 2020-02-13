<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperariosInvolucrados extends Model
{
    //

    protected $table = 'actividades_colaboradores';
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

    public $dates = [
        'fecha_hora_asociacion',
        'fecha_asistencia',
        'fecha_hora_fin',
    ];
    public $with = [
        'actividad',
        'colaborador'
    ];

    public function operacion() {

        return $this->belongsTo(Operacion::class,'id_control','id_control');
    }

    public function colaborador(){

        return $this->belongsTo(Colaborador::class,'id_colaborador','id_colaborador');
    }

    public function actividad(){

        return $this->belongsTo(Actividad::class,'id_actividad','id_actividad');
    }

}
