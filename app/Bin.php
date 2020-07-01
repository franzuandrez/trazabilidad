<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * App\Bin
 *
 * @property int $id_bin
 * @property int|null $id_posicion
 * @property string|null $codigo_barras
 * @property string|null $descripcion
 * @property string|null $estado
 * @property int|null $codigo_interno
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Posicion|null $posicion
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bin actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bin whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bin whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bin whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bin whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bin whereIdBin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bin whereIdPosicion($value)
 * @mixin \Eloquent
 */
class Bin extends Model
{
    //
    use LogsActivity;
    protected $table = 'bines';
    protected $primaryKey = 'id_bin';
    public $timestamps = false;

    protected $fillable = [
        'id_posicion',
        'codigo_barras',
        'descripcion',
        'estado',
        'codigo_interno'
    ];

    public static $logAttributes = [
        'id_posicion',
        'codigo_barras',
        'descripcion',
        'estado',
        'codigo_interno'
    ];

    protected  static $logOnlyDirty = true;
    public function scopeActived($query){

        return $query->where('bines.estado',1);
    }

    public function posicion(){

        return $this->belongsTo('App\Posicion','id_posicion');


    }

}
