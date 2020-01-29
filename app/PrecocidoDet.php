<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecocidoDet extends Model
{
    //

    protected $primaryKey = 'id_precocido_det';
    protected $table = 'precocido_det';
    public $timestamps = false;

    protected $fillable = [
        'hora_inicio',
        'hora_salida',
        'tiempo_efectivo',
        'alcance_presion',
        'temperatura',
        'observaciones',
        'id_producto',
        'lote',
        'id_precocido_enc',
    ];

    protected $with = [
        'producto'
    ];

    public function producto()
    {

        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
