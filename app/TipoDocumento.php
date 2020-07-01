<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TipoDocumento
 *
 * @property int $id_tipo_documento
 * @property string|null $codigo
 * @property string|null $descripcion
 * @property string|null $estado
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoDocumento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoDocumento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoDocumento query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoDocumento whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoDocumento whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoDocumento whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TipoDocumento whereIdTipoDocumento($value)
 * @mixin \Eloquent
 */
class TipoDocumento extends Model
{
    //

    protected $table = 'tipo_documento';
    protected $primaryKey = 'id_tipo_documento';
    public $timestamps  = false;
    protected $fillable = [
        'codigo',
        'descripcion',
        'estado'
    ];
}
