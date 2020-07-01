<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PesoPastaSopasDet
 *
 * @property int $id_peso_pasta_det
 * @property int|null $id_peso_pasta_enc
 * @property string|null $fecha_hora
 * @property int|null $id_usuario
 * @property string|null $hora
 * @property string|null $no_1
 * @property string|null $no_2
 * @property string|null $no_3
 * @property string|null $no_4
 * @property string|null $largo_fideo
 * @property string|null $observaciones
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereIdPesoPastaDet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereIdPesoPastaEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereLargoFideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereNo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereNo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereNo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereNo4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PesoPastaSopasDet whereObservaciones($value)
 * @mixin \Eloquent
 */
class PesoPastaSopasDet extends Model
{
    //
    protected $table = 'peso_pasta_det';
    protected $primaryKey = 'id_peso_pasta_det';
    public $timestamps = false;
}
