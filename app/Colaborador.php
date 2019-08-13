<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Colaborador extends Model
{
    //
    use LogsActivity;

    protected $table = 'colaboradores';
    protected $primaryKey = 'id_colaborador';

    protected $fillable = [
        'codigo_barras',
        'nombre',
        'apellido',
        'telefono',
        'estado'
    ];

    public static $logAttributes = [
        'codigo_barras',
        'nombre',
        'apellido',
        'telefono',
        'estado'
    ];

    protected static $logOnlyDirty = true;


    public function scopeActived( $query ){

        return $query->where('colaboradores.estado',1);
    }
}
