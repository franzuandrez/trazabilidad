<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
