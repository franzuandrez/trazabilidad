<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
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
    ];

    protected static $logOnlyDirty =true;

    public function scopeActived( $query ){

        return $query->where('racks.estado',1);

    }
    public function pasillo(){

        return $this->belongsTo('App\Pasillo' ,'id_pasillo');
    }

    public function niveles(){

        return $this->hasMany('App\Nivel','id_rack');
    }

}
