<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Bin extends Model
{
    //
    use LogsActivity;
    protected $table = 'bines';
    protected $primaryKey = 'id_bin';
    public $timestamps = false;

    protected $fillable = [
        'id_posicion',
        'codigo_barras',
        'descripcion',
        'estado'
    ];

    public static $logAttributes = [
        'id_posicion',
        'codigo_barras',
        'descripcion',
        'estado'
    ];

    protected  static $logOnlyDirty = true;
    public function scopeActived($query){

        return $query->where('bines.estado',1);
    }

    public function posicion(){

        return $this->belongsTo('App\Posicion','id_posicion');


    }

}
