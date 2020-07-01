<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VerificacionMateriaChaoEnc
 *
 * @property int $id_verificacion
 * @property int|null $id_usuario
 * @property string|null $id_turno
 * @property string|null $fecha_hora
 * @property int|null $id_control
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\VerificacionMateriaChaoDet[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoEnc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoEnc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoEnc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoEnc whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoEnc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoEnc whereIdTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoEnc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VerificacionMateriaChaoEnc whereIdVerificacion($value)
 * @mixin \Eloquent
 */
class VerificacionMateriaChaoEnc extends Model
{
    //

    protected $primaryKey = 'id_verificacion';
    protected $table = 'verificacion_materias_chao_enc';
    public $timestamps = false;


    public function detalle()
    {


        return $this->hasMany(VerificacionMateriaChaoDet::class, 'id_verificacion', 'id_verificacion');

    }


    public function control_trazabilidad()
    {


        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }


}
