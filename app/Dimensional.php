<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * App\Dimensional
 *
 * @property int $id_dimensional
 * @property string $descripcion
 * @property string $unidad_medida
 * @property int $factor
 * @property string|null $estado
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Dimensional actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Dimensional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Dimensional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Dimensional query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Dimensional whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Dimensional whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Dimensional whereFactor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Dimensional whereIdDimensional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Dimensional whereUnidadMedida($value)
 * @mixin \Eloquent
 */
class Dimensional extends Model
{
    //
    use LogsActivity;
    protected $table = 'dimensionales';
    protected $primaryKey = 'id_dimensional';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'unidad_medida',
        'factor',
        'estado'
    ];

    public static $logAttributes = [
        'descripcion',
        'unidad_medida',
        'factor',
        'estado'
    ];

    protected static $logOnlyDirty = true;

    public function scopeActived($query){

        return $query->where('dimensionales.estado',1);

    }

}
