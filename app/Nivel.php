<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

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
