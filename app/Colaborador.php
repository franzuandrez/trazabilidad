<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * App\Colaborador
 *
 * @property int $id_colaborador
 * @property string|null $codigo_barras
 * @property string $nombre
 * @property string|null $apellido
 * @property string|null $telefono
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador whereCodigoBarras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador whereIdColaborador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Colaborador whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Colaborador extends Model
{
    //
    use LogsActivity;

    protected $table = 'colaboradores';
    protected $primaryKey = 'id_colaborador';

    protected $fillable = [
        'codigo_barras',
        'nombre',
        'apellido',
        'telefono',
        'estado'
    ];

    public static $logAttributes = [
        'codigo_barras',
        'nombre',
        'apellido',
        'telefono',
        'estado'
    ];

    protected static $logOnlyDirty = true;


    public function scopeActived( $query ){

        return $query->where('colaboradores.estado',1);
    }
}
