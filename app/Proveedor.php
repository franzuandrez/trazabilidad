<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LogsActivity;
class Proveedor extends Model
{
    //

    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';

    public static $logAttributes =[
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
        'observaciones'
    ];

    protected static $logOnlyDirty = true;

    protected  $fillable = [
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
        'observaciones'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function referencias_comerciales(){

       return  $this->hasMany('App\ReferenciasComerciales','id_proveedor');
    }
}
