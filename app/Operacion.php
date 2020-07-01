<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Operacion
 *
 * @property int $id_control
 * @property int|null $id_producto
 * @property int|null $id_turno
 * @property string|null $hora_inicio
 * @property string|null $hora_fin
 * @property \Illuminate\Support\Carbon|null $fecha_vencimiento
 * @property float|null $cantidad_producida
 * @property float|null $cantidad_programada
 * @property string|null $lote
 * @property string|null $no_orden_produccion
 * @property int|null $id_usuario
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OperariosInvolucrados[] $asistencias
 * @property-read int|null $asistencias_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DetalleInsumo[] $detalle_insumos
 * @property-read int|null $detalle_insumos_count
 * @property-read \App\LineaChaomin|null $liberacion_linea
 * @property-read \App\LineaSopa|null $liberacion_sopas
 * @property-read \App\Producto|null $producto
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Requisicion[] $requisiciones
 * @property-read int|null $requisiciones_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereCantidadProducida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereCantidadProgramada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereHoraFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereHoraInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereIdControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereIdTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereNoOrdenProduccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operacion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Operacion extends Model
{
    //

    protected $primaryKey = 'id_control';
    protected $table = 'control_trazabilidad';

    public $timestamps = true;

    public $dates = [
        'fecha_vencimiento'
    ];
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

    protected $with = ['requisiciones','detalle_insumos'];

    public function detalle_insumos()
    {

        return $this->hasMany(DetalleInsumo::class, 'id_control', 'id_control');

    }

    public function asistencias()
    {

        return $this->hasMany(OperariosInvolucrados::class, 'id_control', 'id_control');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    public function actividades()
    {

        return $this->asistencias()->groupBy('id_actividad');

    }

    public function requisiciones()
    {

        return $this->belongsToMany(Requisicion::class, 'control_trazabilidad_orden_produccion', 'id_control', 'id_requisicion');
    }

    public function liberacion_linea()
    {

        return $this->hasOne(LineaChaomin::class, 'id_control', 'id_control');
    }

    public function liberacion_sopas()
    {
        return $this->hasOne(LineaSopa::class, 'id_control', 'id_control');
    }
}
