<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
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
        'estado'
    ];

    public static $logAttributes = [
        'codigo_barras',
        'descripcion',
        'id_encargado',
        'estado'
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


}
