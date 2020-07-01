<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * App\Bodega
 *
 * @property int $id_bodega
 * @property int|null $id_localidad
 * @property string|null $codigo_barras
 * @property string|null $descripcion
 * @property int|null $id_encargado
 * @property float|null $largo
 * @property float|null $ancho
 * @property float|null $alto
 * @property string|null $telefono
 * @property string|null $estado
 * @property int|null $codigo_interno
 * @property string|null $sistema
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Localidad|null $localidad
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Sector[] $sectores
 * @property-read int|null $sectores_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereAlto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereAncho($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereIdBodega($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereIdEncargado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereIdLocalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereLargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bodega whereTelefono($value)
 * @mixin \Eloquent
 */
class Bodega extends Model
{
    //
    use LogsActivity;
    protected $table = 'bodegas';
    protected $primaryKey = 'id_bodega';
    public $timestamps =false;

    protected $fillable = [
        'id_localidad',
        'codigo_barras',
        'descripcion',
        'id_encargado',
        'largo',
        'ancho',
        'alto',
        'telefono',
        'estado',
        'codigo_interno'
    ];
    public static $logAttributes = [
        'id_localidad',
        'codigo_barras',
        'descripcion',
        'id_encargado',
        'largo',
        'ancho',
        'alto',
        'telefono',
        'estado',
        'codigo_interno'
    ];

    protected $with = [
        'sectores'
    ];

    protected static $logOnlyDirty = true;

    public function scopeActived($query){

        return $query->where('bodegas.estado',1);

    }

    public function localidad(){

        return $this->belongsTo('App\Localidad','id_localidad')
            ->withDefault();
    }

    public function sectores(){
        return $this->hasMany('App\Sector','id_bodega')->actived();
    }
}
