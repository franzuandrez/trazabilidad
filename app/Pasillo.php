<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
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
        'id_encargado'
    ];

    public static $logAttributes = [
        'id_sector',
        'codigo_barras',
        'descripcion',
        'estado',
        'id_encargado'
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
}
