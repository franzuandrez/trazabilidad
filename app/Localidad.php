<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Localidad
 *
 * @property int $id_localidad
 * @property string|null $codigo_barras
 * @property string|null $descripcion
 * @property string|null $direccion
 * @property int|null $id_encargado
 * @property string|null $estado
 * @property int|null $codigo_interno
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Bodega[] $bodegas
 * @property-read int|null $bodegas_count
 * @property-read \App\User|null $encargado
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad whereIdEncargado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Localidad whereIdLocalidad($value)
 * @mixin \Eloquent
 */
class Localidad extends Model
{
    //
    use LogsActivity;
    protected $table='localidades';
    protected $primaryKey = 'id_localidad';

     public $timestamps = false;

    protected $fillable = [
        'codigo_barras',
        'descripcion',
        'direccion',
        'id_encargado',
        'estado'
    ];

    public static $logAttributes = [
        'codigo_barras',
        'descripcion',
        'direccion',
        'id_encargado',
        'estado',
        'codigo_interno'
    ];

    protected $with = [
        'bodegas'
    ];
    protected static $logOnlyDirty = true;

    public function scopeActived($query){

        return $query->where('localidades.estado',1);
    }

    public function encargado(){

        return $this->belongsTo('App\User','id_encargado');
    }

    public function bodegas(){

        return $this->hasMany('App\Bodega','id_localidad')->actived();
    }

}
