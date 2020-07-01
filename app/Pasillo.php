<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * App\Pasillo
 *
 * @property int $id_pasillo
 * @property int|null $id_sector
 * @property string|null $codigo_barras
 * @property string|null $descripcion
 * @property string|null $estado
 * @property int|null $id_encargado
 * @property int|null $codigo_interno
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\User|null $encargado
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Rack[] $racks
 * @property-read int|null $racks_count
 * @property-read \App\Sector|null $sector
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo whereIdEncargado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo whereIdPasillo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pasillo whereIdSector($value)
 * @mixin \Eloquent
 */
class Pasillo extends Model
{
    //
    use LogsActivity;
    protected $table = 'pasillos';
    protected $primaryKey = 'id_pasillo';

    public $timestamps = false;

    protected $fillable = [
        'id_sector',
        'codigo_barras',
        'descripcion',
        'estado',
        'id_encargado',
        'codigo_interno'
    ];

    public static $logAttributes = [
        'id_sector',
        'codigo_barras',
        'descripcion',
        'estado',
        'id_encargado',
        'codigo_interno'
    ];

    protected $with = [
        'racks'
    ];
    protected static $logOnlyDirty = true;

    public function scopeActived($query){

        return $query->where('pasillos.estado',1);

    }

    public function sector(){

        return $this->belongsTo('App\Sector','id_sector');
    }

    public function encargado(){

        return $this->belongsTo('App\User','id_encargado');
    }

    public function racks(){

        return $this->hasMany('App\Rack','id_pasillo')->actived();
    }
}
