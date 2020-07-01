<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Cliente
 *
 * @property int $id_cliente
 * @property string $Codigo
 * @property string|null $razon_social
 * @property string $nit
 * @property string|null $direccion
 * @property string|null $telefono
 * @property int|null $ruta
 * @property string|null $lunes
 * @property string|null $martes
 * @property string|null $miercoles
 * @property string|null $jueves
 * @property string|null $viernes
 * @property string|null $sabado
 * @property string|null $domingo
 * @property string|null $latitud
 * @property string|null $longitud
 * @property int|null $id_categoria
 * @property string|null $email
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\CategoriaCliente|null $categoria
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereDomingo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereIdCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereIdCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereJueves($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereLatitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereLongitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereLunes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereMartes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereMiercoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereRuta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereSabado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cliente whereViernes($value)
 * @mixin \Eloquent
 */
class Cliente extends Model
{

    use LogsActivity;

    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;
    protected $fillable = [
        'razon_social',
        'nit',
        'direccion',
        'telefono',
        'ruta',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo',
        'latitud',
        'longitud',
        'id_categoria',
        'Codigo',
        'email',
    ];

    public static $logAttributes =[

        'razon_social',
        'nit',
        'direccion',
        'telefono',
        'ruta',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo',
        'latitud',
        'longitud',
        'id_categoria',
        'Codigo',
        'email',
    ];

    protected static $logOnlyDirty = true;

    public function categoria(){

        return $this->belongsTo('App\CategoriaCliente','id_categoria');
    }


}
