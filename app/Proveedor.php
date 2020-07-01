<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * App\Proveedor
 *
 * @property int $id_proveedor
 * @property string|null $codigo_proveedor
 * @property string|null $razon_social
 * @property string $nombre_comercial
 * @property string|null $nit
 * @property string|null $direccion_fiscal
 * @property string|null $direccion_planta
 * @property string|null $nombre_contacto
 * @property string|null $puesto_contacto
 * @property string|null $telefono_contacto
 * @property string|null $email
 * @property string|null $regimen_tributario
 * @property string|null $patente_comercio
 * @property string|null $patente_sociedad
 * @property string|null $dias_credito
 * @property float|null $monto_credito
 * @property string|null $programa_bpm_implementado
 * @property string|null $otros_programas
 * @property string|null $sistema_haccp
 * @property string|null $programa_capacitacion
 * @property string|null $sistema_trazabilidad
 * @property string|null $sistema_calidad_auditado_intermamente
 * @property string|null $sistema_calidad_auditado_por_terceros
 * @property string|null $certificaciones
 * @property string|null $observaciones
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Producto[] $productos
 * @property-read int|null $productos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReferenciasComerciales[] $referencias_comerciales
 * @property-read int|null $referencias_comerciales_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereCertificaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereCodigoProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereDiasCredito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereDireccionFiscal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereDireccionPlanta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereIdProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereMontoCredito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereNombreComercial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereNombreContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereOtrosProgramas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor wherePatenteComercio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor wherePatenteSociedad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereProgramaBpmImplementado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereProgramaCapacitacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor wherePuestoContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereRegimenTributario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereSistemaCalidadAuditadoIntermamente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereSistemaCalidadAuditadoPorTerceros($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereSistemaHaccp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereSistemaTrazabilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereTelefonoContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Proveedor extends Model
{
    //
    use LogsActivity;

    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';

    public static $logAttributes =[
        'codigo',
        'razon_social',
        'nombre_comercial',
        'nit',
        'direccion_fiscal',
        'direccion_planta',
        'nombre_contacto',
        'puesto_contacto',
        'telefono_contacto',
        'email',
        'regimen_tributario',
        'patente_comercio',
        'patente_sociedad',
        'dias_credito',
        'monto_credito',
        'horario_entrega',
        'programa_bpm_implementado',
        'otros_programas',
        'sistema_haccp',
        'programa_capacitacion',
        'sistema_trazabilidad',
        'sistema_calidad_auditado_intermamente',
        'sistema_calidad_auditado_por_terceros',
        'certificaciones',
        'observaciones',
        'estado'
    ];

    protected static $logOnlyDirty = true;

    protected  $fillable = [
        'codigo',
        'razon_social',
        'nombre_comercial',
        'nit',
        'direccion_fiscal',
        'direccion_planta',
        'nombre_contacto',
        'puesto_contacto',
        'telefono_contacto',
        'email',
        'regimen_tributario',
        'patente_comercio',
        'patente_sociedad',
        'dias_credito',
        'monto_credito',
        'horario_entrega',
        'programa_bpm_implementado',
        'otros_programas',
        'sistema_haccp',
        'programa_capacitacion',
        'sistema_trazabilidad',
        'sistema_calidad_auditado_intermamente',
        'sistema_calidad_auditado_por_terceros',
        'certificaciones',
        'observaciones',
        'estado'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function scopeActived($query){

        return $query->where('proveedores.estado',1);
    }
    public function referencias_comerciales(){

       return  $this->hasMany('App\ReferenciasComerciales','id_proveedor');
    }

    public function productos(){

        return $this
            ->belongsToMany('App\Producto',
                'proveedores_productos',
                'id_proveedor','id_producto');
    }
}
