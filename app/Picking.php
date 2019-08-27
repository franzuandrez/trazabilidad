<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picking extends Model
{
    //

    protected $table = 'picking_encabezado';
    protected $primaryKey = 'id_picking';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    protected $dates = [
        'fecha_inicio',
        'fecha_fin'
    ];

    public function bodeguero(){

        return $this->belongsTo('App\User','id_usuario');
    }
}
