<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * App\Sector
 *
 * @property int $id_sector
 * @property int|null $id_bodega
 * @property string|null $codigo_barras
 * @property string|null $descripcion
 * @property int|null $id_encargado
 * @property string|null $estado
 * @property int|null $codigo_interno
 * @property string|null $sistema
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Bodega|null $bodega
 * @property-read \App\User|null $encargado
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Pasillo[] $pasillos
 * @property-read int|null $pasillos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector whereIdBodega($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector whereIdEncargado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector whereIdSector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sector whereSistema($value)
 * @mixin \Eloquent
 */
class Sector extends Model
{
    //

    use LogsActivity;
    protected $table = 'sectores';
    protected $primaryKey = 'id_sector';
    public $timestamps = false;

    protected $fillable = [
        'codigo_barras',
        'descripcion',
        'id_encargado',
        'estado',
        'codigo_interno'
    ];

    public static $logAttributes = [
        'codigo_barras',
        'descripcion',
        'id_encargado',
        'estado',
        'codigo_interno'
    ];

    protected static $logOnlyDirty = true;

    public function scopeActived($query){

        return $query->where('sectores.estado',1);
    }

    public function encargado() {

        return $this->belongsTo('App\User','id_encargado');
    }

    public function bodega(){
        return $this->belongsTo('App\Bodega','id_bodega');
    }
    public function pasillos(){

        return $this->hasMany('App\Pasillo','id_sector')->actived();
    }


}
