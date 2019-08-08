<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoMovimiento extends Model
{
    //
    use LogsActivity;
    protected $table = 'tipo_movimiento';
    protected $primaryKey = 'id_movimiento';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'factor',
        'estado'
    ];

    public static $logAttributes = [
        'descripcion',
        'factor',
        'estado'
    ];

    protected static $logOnlyDirty = true;

    public  function scopeActived( $query ){
        return $query->where('estado',1);
    }


}
