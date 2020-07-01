<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Presentacion
 *
 * @property int $id_presentacion
 * @property string|null $codigo_barras
 * @property string $descripcion
 * @property string|null $estado
 * @property int|null $creado_por
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion whereCreadoPor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion whereIdPresentacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Presentacion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Presentacion extends Model
{
    //

    use LogsActivity;

    protected $table = 'presentaciones';
    protected $primaryKey = 'id_presentacion';

    protected $fillable = [
        'codigo_barras',
        'descripcion',
        'estado',
        'creado_por',
    ];

    protected static $logAttributes = [
        'codigo_barras',
        'descripcion',
        'estado'
    ];

    protected static $logOnlyDirty = true;

    public function scopeActived($query){

        return $query->where('presentaciones.estado',1);
    }


}
