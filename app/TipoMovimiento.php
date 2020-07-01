<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\TipoMovimiento
 *
 * @property int $id_movimiento
 * @property string $descripcion
 * @property int|null $factor
 * @property string|null $estado
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoMovimiento actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoMovimiento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoMovimiento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoMovimiento query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoMovimiento whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoMovimiento whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoMovimiento whereFactor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoMovimiento whereIdMovimiento($value)
 * @mixin \Eloquent
 */
class TipoMovimiento extends Model
{
    //
    use LogsActivity;
    protected $table = 'tipo_movimiento';
    protected $primaryKey = 'id_movimiento';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'factor',
        'estado'
    ];

    public static $logAttributes = [
        'descripcion',
        'factor',
        'estado'
    ];

    protected static $logOnlyDirty = true;

    public  function scopeActived( $query ){
        return $query->where('estado',1);
    }


}
