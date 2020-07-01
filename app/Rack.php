<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * App\Rack
 *
 * @property int $id_rack
 * @property int|null $id_pasillo
 * @property string|null $codigo_barras
 * @property string|null $descripcion
 * @property string|null $lado
 * @property string|null $estado
 * @property int|null $codigo_interno
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Nivel[] $niveles
 * @property-read int|null $niveles_count
 * @property-read \App\Pasillo|null $pasillo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack whereIdPasillo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack whereIdRack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rack whereLado($value)
 * @mixin \Eloquent
 */
class Rack extends Model
{
    //
    use LogsActivity;
    protected  $table = 'racks';
    protected $primaryKey = 'id_rack';
    public $timestamps = false;

    protected $fillable = [
        'id_pasillo',
        'codigo_barras',
        'descripcion',
        'lado',
        'estado',
        'codigo_interno'
    ];
    protected $with = [
        'niveles'
    ];
    public static $logAttributes = [
        'id_pasillo',
        'codigo_barras',
        'descripcion',
        'lado',
        'estado',
        'codigo_interno'
    ];

    protected static $logOnlyDirty =true;

    public function scopeActived( $query ){

        return $query->where('racks.estado',1);

    }
    public function pasillo(){

        return $this->belongsTo('App\Pasillo' ,'id_pasillo');
    }

    public function niveles(){

        return $this->hasMany('App\Nivel','id_rack')->actived();
    }

}
