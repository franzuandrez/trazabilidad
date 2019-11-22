<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    //

    protected $primaryKey = 'id_control';
    protected $table = 'control_trazabilidad';

    public $timestamps = true;

    protected $fillable = [
        'id_producto',
        'id_turno',
        'hora_inicio',
        'hora_fin',
        'fecha_vencimiento',
        'cantidad_producida',
        'cantidad_programada',
        'lote',
        'no_orden_produccion',
        'id_usuario',
    ];

    public function detalle_insumos()
    {

        return $this->hasMany(DetalleInsumo::class, 'id_control', 'id_control');

    }

    public function asistencias()
    {

        return $this->hasMany(Asistencia::class, 'id_control', 'id_control');
    }

    public function producto()
    {
        $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
