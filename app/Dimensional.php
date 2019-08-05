<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Dimensional extends Model
{
    //
    use LogsActivity;
    protected $table = 'dimensionales';
    protected $primaryKey = 'id_dimensional';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'unidad_medida',
        'factor',
        'estado'
    ];

    public static $logAttributes = [
        'descripcion',
        'unidad_medida',
        'factor',
        'estado'
    ];

    protected static $logOnlyDirty = true;

    public function scopeActived($query){

        return $query->where('dimensionales.estado',1);

    }

}
