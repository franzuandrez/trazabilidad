<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Producto
 *
 * @property int $id_producto
 * @property string|null $codigo_barras
 * @property string|null $codigo_interno
 * @property string|null $descripcion
 * @property int|null $id_dimensional
 * @property int|null $id_presentacion
 * @property int|null $id_proveedor
 * @property string|null $tipo_producto
 * @property string|null $fecha_creacion
 * @property string|null $fecha_actualizacion
 * @property string|null $estado
 * @property int|null $creado_por
 * @property string|null $unidad_medida
 * @property string|null $codigo_proveedor
 * @property int|null $dias_vencimiento
 * @property string|null $codigo_interno_cliente
 * @property string|null $codigo_dun
 * @property int|null $cantidad_unidades
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\User|null $creador
 * @property-read \App\Dimensional|null $dimensional
 * @property-read \App\Presentacion|null $presentacion
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Presentacion[] $presentaciones
 * @property-read int|null $presentaciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Proveedor[] $proveedores
 * @property-read int|null $proveedores_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto esMateriaPrima()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto esProductoProceso()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto esProductoTerminado()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereCantidadUnidades($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereCodigoDun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereCodigoInternoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereCodigoProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereCreadoPor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereDiasVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereFechaActualizacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereFechaCreacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereIdDimensional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereIdPresentacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereIdProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereTipoProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereUnidadMedida($value)
 * @mixin \Eloquent
 */
class Producto extends Model
{
    //

    use LogsActivity;
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;


    protected $fillable = [
        'codigo_barras',
        'codigo_interno',
        'descripcion',
        'id_dimensional',
        'id_presentacion',
        'id_proveedor',
        'tipo_producto',
        'fecha_creacion',
        'fecha_actualizacion',
        'estado',
        'creado_por',
        'unidad_medida',
    ];

    public static $logAttributes = [
        'codigo_barras',
        'codigo_interno',
        'descripcion',
        'id_dimensional',
        'id_presentacion',
        'id_proveedor',
        'tipo_producto',
        'fecha_creacion',
        'estado',
        'creado_por',
        'unidad_medida',
    ];

    protected static $logOnlyDirty = true;

    public function scopeActived($query)
    {

        return $query->where('productos.estado', 1);

    }

    public function scopeEsProductoTerminado($query)
    {
        return $query->where('productos.tipo_producto', 'PT');
    }

    public function scopeEsProductoProceso($query)
    {

        return $query->where('productos.tipo_producto', 'PP');
    }

    public function scopeEsMateriaPrima($query)
    {

        return $query->where('productos.tipo_producto', 'MP')->orWhere('productos.tipo_producto', 'ME');
    }

    public function proveedores()
    {

        return $this
            ->belongsToMany('App\Proveedor',
                'proveedores_productos',
                'id_producto', 'id_proveedor');
    }

    public function dimensional()
    {

        return $this->belongsTo('App\Dimensional', 'id_dimensional');

    }

    public function presentacion()
    {

        return $this->belongsTo('App\Presentacion', 'id_presentacion');
    }

    public function creador()
    {

        return $this->belongsTo('App\User', 'creado_por');
    }


    public function presentaciones()
    {
        return $this
            ->belongsToMany(Presentacion::class, 'producto_presentacion', 'id_producto', 'id_presentacion')
            ->groupBy('id_presentacion');
    }


}
