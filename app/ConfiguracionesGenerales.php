<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionesGenerales extends Model
{
    //


    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $table = 'configuraciones';
    protected $fillable = [
        'configuracion',
        'descripcion',
        'valor',
        'status'
    ];
}
