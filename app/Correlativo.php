<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Correlativo
 *
 * @property int $id_correlativo
 * @property string|null $prefijo
 * @property int|null $correlativo
 * @property int|null $id_empresa
 * @property string|null $modulo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Correlativo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Correlativo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Correlativo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Correlativo whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Correlativo whereIdCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Correlativo whereIdEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Correlativo whereModulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Correlativo wherePrefijo($value)
 * @mixin \Eloquent
 */
class Correlativo extends Model
{
    //


    protected  $table = 'correlativos';
    protected $primaryKey = 'id_correlativo';

    protected $fillable = [
        'prefijo',
        'correlativo',
        'id_empresa',
        'modulo'
    ];

    public $timestamps = false;
}
