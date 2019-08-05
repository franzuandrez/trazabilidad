<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    //

    protected $table = 'tipo_documento';
    protected $primaryKey = 'id_tipo_documento';
    public $timestamps  = false;
    protected $fillable = [
        'codigo',
        'descripcion',
        'estado'
    ];
}
