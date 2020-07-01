<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MezclaHarina_Det
 *
 * @property int $id_det_mezclaharina
 * @property int|null $id_Enc_mezclaharina
 * @property int|null $id_producto
 * @property string|null $lote
 * @property string|null $hora_carga
 * @property string|null $hora_descarga
 * @property string|null $solucion_inicial
 * @property string|null $solucion_observacion
 * @property string|null $ph_inicial
 * @property string|null $ph_observacion
 * @property int|null $id_usuario
 * @property-read \App\Producto|null $producto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det whereHoraCarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det whereHoraDescarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det whereIdDetMezclaharina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det whereIdEncMezclaharina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det wherePhInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det wherePhObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det whereSolucionInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MezclaHarina_Det whereSolucionObservacion($value)
 * @mixin \Eloquent
 */
class MezclaHarina_Det extends Model
{
    protected $table ='det_mezclaharina';
    protected $primaryKey = 'id_det_mezclaharina';
    public $timestamps = false;

    protected $fillable = [
        'id_enc_mezclaharina',
        'id_producto',
        'codigo_producto',
        'lote',
        'hora_carga',
        'hora_descarga',
        'solucion_inicial',
        'solucion_final',
        'solucion_observacion',
        'ph_inicial',
        'ph_final',
        'ph_observacion'
    ];
    protected $with = [
        'producto'
    ];

    public function producto(){

        return $this->belongsTo(Producto::class,'id_producto','id_producto');
    }

}
