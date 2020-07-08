<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Recepcion
 *
 * @property int $id_recepcion_enc
 * @property string $orden_compra
 * @property int|null $id_proveedor
 * @property \Illuminate\Support\Carbon|null $fecha_ingreso
 * @property int|null $id_producto
 * @property \App\User|null $usuario_recepcion
 * @property string|null $documento_proveedor
 * @property string|null $estado
 * @property string|null $rampa
 * @property string|null $control
 * @property string|null $mp materia prima
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DetalleLotes[] $detalle_lotes
 * @property-read int|null $detalle_lotes_count
 * @property-read \App\InspeccionEmpaqueEtiqueta|null $inspeccion_empaque
 * @property-read \App\InspeccionVehiculo|null $inspeccion_vehiculos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Movimiento[] $movimientos
 * @property-read int|null $movimientos_count
 * @property-read \App\Producto|null $producto_materia_prima
 * @property-read \App\Proveedor|null $proveedor
 * @property-read \App\RMIEncabezado|null $rmi_encabezado
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion enControlCalidad()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion enMateriaPrima()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion enRampa()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion esDocumentoMateriaPrima()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion estaEnBodegaMP()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion estaEnControl()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion estaEnRampa()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion listaParaUbicacar()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion transito()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereDocumentoProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereIdProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereIdRecepcionEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereMp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereOrdenCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereRampa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recepcion whereUsuarioRecepcion($value)
 * @mixin \Eloquent
 */
class Recepcion extends Model
{
    //
    use LogsActivity;
    protected $primaryKey = 'id_recepcion_enc';
    protected $table = 'recepcion_encabezado';
    public $timestamps = false;

    protected $fillable = [
        'orden_compra',
        'id_proveedor',
        'estado',
        'fecha_ingreso',
        'estado',
        'usuario_recepcion',
        'documento_proveedor'
    ];

    protected $dates = [
        'fecha_ingreso'
    ];

    public static $logAttributes = [
        'orden_compra',
        'id_proveedor',
        'id_proveedor',
        'fecha_ingreso',
        'id_producto',
        'usuario_recepcion',
        'estado',
    ];

    public $with = [
        'proveedor',
        'rmi_encabezado',
        'recepcionado_por'
    ];

    protected static $logOnlyDirty = true;

    /**
     *
     * ------------------------------------------RELATIONSHIPS ---------------------------------------
     *
     */
    public function recepcionado_por()
    {

        return $this->belongsTo('App\User', 'usuario_recepcion');
    }

    public function proveedor()
    {

        return $this->belongsTo('App\Proveedor', 'id_proveedor');
    }


    public function producto_materia_prima()
    {

        return $this->belongsTo('App\Producto', 'id_producto');
    }

    public function inspeccion_vehiculos()
    {

        return $this->hasOne('App\InspeccionVehiculo', 'id_recepcion_enc');
    }

    public function inspeccion_empaque()
    {

        return $this->hasOne('App\InspeccionEmpaqueEtiqueta', 'id_recepcion_enc');
    }

    public function detalle_lotes()
    {

        return $this->hasMany('App\DetalleLotes', 'id_recepcion_enc');
    }

    public function movimientos()
    {

        return $this->hasMany('App\Movimiento', 'numero_documento', 'orden_compra');
    }

    public function rmi_encabezado(){

        return $this->hasOne('App\RMIEncabezado','documento','orden_compra');
    }
    /**
     * ------------------------------------------SCOPES -----------------------------------------------
     *
     */
    public function scopeTransito($query)
    {
        return $query->where('recepcion_encabezado.estado', 'T');
    }

    public function scopeEstaEnBodegaMP($query)
    {
        return $query->where('recepcion_encabezado.estado', 'MP');

    }

    public function scopeListaParaUbicacar($query)
    {

        return $query->where('recepcion_encabezado.estado', 'U');
    }

    public function scopeEnRampa($query)
    {
        return $query->where('recepcion_encabezado.rampa', 1);
    }

    public function scopeEnControlCalidad($query)
    {

        return $query->where('recepcion_encabezado.control', 1);
    }

    public function scopeEnMateriaPrima($query)
    {

        return $query->where('recepcion_encabezado.mp', 1);
    }

    public function scopeEsDocumentoMateriaPrima( $query ){
        return $query->join('rmi_encabezado',function ($join){
            $join->on('recepcion_encabezado.orden_compra','=','rmi_encabezado.documento')
                ->where('rmi_encabezado.tipo_documento','MP');
        });
    }

    public function scopeEstaEnRampa( $query ){

        return $query->where('rmi_encabezado.rampa',1);
    }

    public function scopeEstaEnControl( $query ){

        return $query->where('rmi_encabezado.control',1);
    }

}
