<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesoHumedoDet extends Model
{
    //

    protected $primaryKey = 'id_peso_humedo_det';
    protected $table = 'peso_humedo_det';
    public $timestamps = false;
    protected $fillable = [
        'hora',
        'muestra_no1',
        'muestra_no2',
        'muestra_no3',
        'muestra_no4',
        'muestra_no5',
        'producto',
        'lote',
        'observaciones',
        'id_peso_humedo_enc'

    ];
    protected $with = [
        'producto'
    ];

    public function producto()
    {

        return $this->belongsTo(Producto::class, 'producto', 'id_producto');

    }
}
