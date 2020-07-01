<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Picking
 *
 * @property int $id_picking
 * @property int|null $id_usuario
 * @property \Illuminate\Support\Carbon|null $fecha_inicio
 * @property \Illuminate\Support\Carbon|null $fecha_fin
 * @property string|null $estado
 * @property int|null $id_requisicion
 * @property-read \App\User|null $bodeguero
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picking query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picking whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picking whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picking whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picking whereIdPicking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picking whereIdRequisicion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picking whereIdUsuario($value)
 * @mixin \Eloquent
 */
class Picking extends Model
{
    //

    protected $table = 'picking_encabezado';
    protected $primaryKey = 'id_picking';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'id_requisicion',
    ];

    protected $dates = [
        'fecha_inicio',
        'fecha_fin'
    ];

    public function bodeguero(){

        return $this->belongsTo('App\User','id_usuario');
    }

    public function enProceso(){
        return $this->estado == 'P';
    }

    public function despachado(){
        return $this->estado == 'D';
    }
}
