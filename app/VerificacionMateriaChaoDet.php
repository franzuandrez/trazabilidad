<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificacionMateriaChaoDet extends Model
{
    //


    protected $primaryKey = 'id_verificacion_det';
    protected $table = 'verificacion_materias_chao_det';
    public $timestamps = false;

    protected $with = ['producto'];

    public function producto()
    {

        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
