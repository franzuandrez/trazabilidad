<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * App\CategoriaCliente
 *
 * @property int $id_categoria
 * @property string|null $descripcion
 * @property string|null $estado
 * @property string|null $tipo_documento
 * @property string|null $impresion_recibo
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoriaCliente actived()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoriaCliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoriaCliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoriaCliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoriaCliente whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoriaCliente whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoriaCliente whereIdCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoriaCliente whereImpresionRecibo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoriaCliente whereTipoDocumento($value)
 * @mixin \Eloquent
 */
class CategoriaCliente extends Model
{
    //
    use LogsActivity;

    protected $table = 'categoria_clientes';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;

    protected  $fillable = [
        'descripcion',
        'estado',
        'tipo_documento',
        'impresion_recibo'
    ];

    public static $logAttributes = [
        'descripcion',
        'estado',
        'tipo_documento',
        'impresion_recibo'
    ];

    public static $logOnlyDirty = true;


    public function scopeActived($query){

        return $query->where('categoria_clientes.estado',1);

    }


}
