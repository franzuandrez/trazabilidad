<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * App\Actividad
 *
 * @property int $id_actividad
 * @property string|null $descripcion
 * @property string|null $estado
 * @property int|null $id_producto
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actividad actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actividad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actividad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actividad query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actividad whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actividad whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actividad whereIdActividad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actividad whereIdProducto($value)
 * @mixin \Eloquent
 */
class Actividad extends Model
{
    //
    use LogsActivity;
    protected $primaryKey = 'id_actividad';
    protected $table = 'actividades';
    public $timestamps = false;


    protected $fillable = [
        'descripcion',
        'estado',
        'id_producto'
    ];

    public static $logAttributes = [
        'descripcion',
        'estado',
        'id_producto'
    ];

    protected static $logOnlyDirty = true;

    public function scopeActived( $query ){

        return $query->where('actividades.estado',1);

    }


}
