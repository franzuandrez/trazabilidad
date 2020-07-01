<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Posicion
 *
 * @property int $id_posicion
 * @property int|null $id_nivel
 * @property string|null $codigo_barras
 * @property string|null $descripcion
 * @property string|null $estado
 * @property int|null $codigo_interno
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Bin[] $bines
 * @property-read int|null $bines_count
 * @property-read \App\Nivel|null $nivel
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posicion actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posicion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posicion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posicion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posicion whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posicion whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posicion whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posicion whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posicion whereIdNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posicion whereIdPosicion($value)
 * @mixin \Eloquent
 */
class Posicion extends Model
{
    //
    use LogsActivity;

    protected $table = 'posiciones';
    protected $primaryKey = 'id_posicion';
    public $timestamps = false;

    protected $fillable = [

        'id_nivel',
        'codigo_barras',
        'descripcion',
        'estado',
        'codigo_interno'
    ];

    public static $logAttributes = [
        'id_nivel',
        'codigo_barras',
        'descripcion',
        'estado',
        'codigo_interno'
    ];

    public static $logOnlyDirty = true;



    public function scopeActived($query)
    {
        return $query->where('posiciones.estado', 1);

    }

    public function nivel()
    {

        return $this->belongsTo('App\Nivel', 'id_nivel');
    }

    public function bines(){

        return $this->hasMany('App\Bin','id_posicion')->actived();
    }
}
