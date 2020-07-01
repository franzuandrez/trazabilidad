<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OperariosInvolucrados
 *
 * @property int $id
 * @property int|null $id_colaborador
 * @property int|null $id_actividad
 * @property int|null $id_control
 * @property \Illuminate\Support\Carbon|null $fecha_hora_asociacion
 * @property \Illuminate\Support\Carbon|null $fecha_asistencia
 * @property string|null $asistio
 * @property string|null $no_orden_produccion
 * @property \Illuminate\Support\Carbon|null $fecha_hora_fin
 * @property-read \App\Actividad|null $actividad
 * @property-read \App\Colaborador|null $colaborador
 * @property-read \App\Operacion|null $operacion
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados whereAsistio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados whereFechaAsistencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados whereFechaHoraAsociacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados whereFechaHoraFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados whereIdActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados whereIdColaborador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperariosInvolucrados whereNoOrdenProduccion($value)
 * @mixin \Eloquent
 */
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
