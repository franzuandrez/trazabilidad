<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MezclaHarina_Enc
 *
 * @property int $id_Enc_mezclaharina
 * @property string|null $no_orden
 * @property int|null $id_responsable_maquina
 * @property string|null $fecha_hora
 * @property string|null $observaciones
 * @property string|null $id_usuario
 * @property string|null $puesto
 * @property int|null $id_control
 * @property string|null $lote
 * @property-read \App\Operacion|null $control_trazabilidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MezclaHarina_Det[] $detalle
 * @property-read int|null $detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc whereIdEncMezclaharina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc whereIdResponsableMaquina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc whereNoOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Enc wherePuesto($value)
 * @mixin \Eloquent
 */
class MezclaHarina_Enc extends Model
{
    protected $table = 'enc_mezclaharina';
    protected $primaryKey = 'id_Enc_mezclaharina';
    public $timestamps = false;

    protected $fillable = [
        'no_orden',
        'id_responsable_maquina',
        'observaciones',
        'id_usuario',
        'puesto',
        'id_control'
    ];

    protected $with = [
        'detalle'
    ];

    public function detalle()
    {

        return $this->hasMany(MezclaHarina_Det::class, 'id_Enc_mezclaharina', 'id_Enc_mezclaharina');
    }

    public function control_trazabilidad()
    {
        return $this->belongsTo(Operacion::class, 'id_control', 'id_control');
    }
}
