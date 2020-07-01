<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Asistencia
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia whereAsistio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia whereFechaAsistencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia whereFechaHoraAsociacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia whereFechaHoraFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia whereIdActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia whereIdColaborador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asistencia whereNoOrdenProduccion($value)
 * @mixin \Eloquent
 */
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
