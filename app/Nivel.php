<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Nivel
 *
 * @property int $id_nivel
 * @property int|null $id_rack
 * @property string|null $codigo_barras
 * @property string|null $descripcion
 * @property string|null $estado
 * @property int|null $codigo_interno
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Posicion[] $posiciones
 * @property-read int|null $posiciones_count
 * @property-read \App\Rack|null $rack
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Nivel actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Nivel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Nivel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Nivel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Nivel whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Nivel whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Nivel whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Nivel whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Nivel whereIdNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Nivel whereIdRack($value)
 * @mixin \Eloquent
 */
class Nivel extends Model
{
    //
    use LogsActivity;
    public $timestamps = false;
    protected $table = 'nivel';
    protected $primaryKey = 'id_nivel';


    protected $fillable = [
        'codigo_barras',
        'id_rack',
        'descripcion',
        'estado',
        'codigo_interno'
    ];

    public static $logAttributes = [
        'codigo_barras',
        'id_rack',
        'descripcion',
        'estado',
        'codigo_interno'
    ];

    protected $with = [
        'posiciones'
    ];

    protected $logOnlyDirty = true;

    public function scopeActived($query)
    {

        return $query->where('nivel.estado', 1);

    }

    public function rack()
    {

        return $this->belongsTo('App\Rack', 'id_rack');

    }

    public function posiciones()
    {

        return $this->hasMany('App\Posicion', 'id_nivel')->actived();
    }
}
