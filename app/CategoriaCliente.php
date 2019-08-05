<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class CategoriaCliente extends Model
{
    //
    use LogsActivity;

    protected $table = 'categoria_clientes';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;

    protected  $fillable = [
        'descripcion',
        'estado',
        'tipo_documento',
        'impresion_recibo'
    ];

    public static $logAttributes = [
        'descripcion',
        'estado',
        'tipo_documento',
        'impresion_recibo'
    ];

    public static $logOnlyDirty = true;


    public function scopeActived($query){

        return $query->where('categoria_clientes.estado',1);

    }


}
