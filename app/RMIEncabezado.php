<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\RMIEncabezado
 *
 * @property int $id_rmi_encabezado
 * @property string|null $tipo_documento
 * @property string|null $documento
 * @property \Illuminate\Support\Carbon|null $fecha_ingreso
 * @property int|null $usuario_ingreso
 * @property string|null $estado
 * @property string|null $rampa
 * @property string|null $control
 * @property string|null $mp
 * @property string|null $observaciones
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RMIDetalle[] $rmi_detalle
 * @property-read int|null $rmi_detalle_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado whereControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado whereIdRmiEncabezado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado whereMp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado whereRampa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado whereTipoDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RMIEncabezado whereUsuarioIngreso($value)
 * @mixin \Eloquent
 */
class RMIEncabezado extends Model
{
    //
    use LogsActivity;
    public static $logAttributes = [
        '*'
    ];
    protected static $logOnlyDirty = true;
    protected $table = 'rmi_encabezado';
    protected $primaryKey = 'id_rmi_encabezado';
    public $timestamps = false;

    protected $fillable = [
        'tipo_docoumento',
        'documento',
        'fecha_ingreso',
        'usuario_ingreso',
        'estado'
    ];

    public $dates = [
        'fecha_ingreso'
    ];

    public $with = [
        'rmi_detalle'
    ];

    /**
     * ----------------------------------------RELATIONSHIPS-------------------------
     */

    public function rmi_detalle(){

       return  $this->hasMany('App\RMIDetalle','id_rmi_encabezado');
    }
}
