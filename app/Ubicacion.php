<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ubicacion
 *
 * @property int|null $id_localidad
 * @property int|null $id_bodega
 * @property int|null $id_sector
 * @property int|null $id_pasillo
 * @property int|null $id_rack
 * @property int|null $id_nivel
 * @property int|null $id_posicion
 * @property int|null $id_bin
 * @property string|null $estado
 * @property int $id_ubicacion
 * @property string|null $codigo_barras
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Bin|null $bin
 * @property-read \App\Bodega|null $bodega
 * @property-read \App\Localidad|null $localidad
 * @property-read \App\Nivel|null $nivel
 * @property-read \App\Pasillo|null $pasillo
 * @property-read \App\Posicion|null $posicion
 * @property-read \App\Rack|null $rack
 * @property-read \App\Sector|null $sector
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereIdBin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereIdBodega($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereIdLocalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereIdNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereIdPasillo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereIdPosicion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereIdRack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereIdSector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereIdUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ubicacion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ubicacion extends Model
{
    //
    protected $primaryKey = 'id_ubicacion';
    protected $table = 'ubicaciones';

    protected $fillable = [
        'id_localidad',
        'id_bodega',
        'id_sector',
        'id_pasillo',
        'id_rack',
        'id_nivel',
        'id_posicion',
        'id_bin',
        'estado',
    ];

    public $with = [
        'localidad',
        'bodega',
        'sector',
        'pasillo',
        'rack',
        'nivel',
        'posicion',
        'bin'
    ];

    public function localidad()
    {
        return $this->belongsTo('App\Localidad', 'id_localidad');
    }

    public function bodega()
    {
        return $this->belongsTo('App\Bodega', 'id_bodega');
    }

    public function sector()
    {
        return $this->belongsTo('App\Sector', 'id_sector');
    }

    public function pasillo()
    {
        return $this->belongsTo('App\Pasillo', 'id_pasillo');
    }

    public function rack()
    {
        return $this->belongsTo('App\Rack', 'id_rack');
    }

    public function nivel()
    {

        return $this->belongsTo('App\Nivel', 'id_nivel');
    }

    public function posicion()
    {
        return $this->belongsTo('App\Posicion', 'id_posicion');
    }

    public function bin()
    {
        return $this->belongsTo('App\Bin', 'id_bin');
    }


    /*
     *
     */

    public function scopeActived($query)
    {
        return $query->where('ubicaciones.estado', 1);
    }
}
