<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ReferenciasComerciales
 *
 * @property int $id_referencia_comercial
 * @property string|null $nombre_empresa
 * @property string|null $telefono
 * @property string|null $direccion
 * @property string|null $contacto
 * @property int|null $id_proveedor
 * @property-read \App\Proveedor|null $proveedor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReferenciasComerciales newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReferenciasComerciales newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReferenciasComerciales query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReferenciasComerciales whereContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReferenciasComerciales whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReferenciasComerciales whereIdProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReferenciasComerciales whereIdReferenciaComercial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReferenciasComerciales whereNombreEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReferenciasComerciales whereTelefono($value)
 * @mixin \Eloquent
 */
class ReferenciasComerciales extends Model
{
    //

    protected $table = 'referencias_comerciales';
    protected $primaryKey = 'id_referencias_comerciales';
    public $timestamps = false;


    protected $fillable = [
        'nombre_empresa',
        'telefono',
        'direccion',
        'contacto',
        'id_proveedor'
    ];

    public function proveedor(){

        return $this->belongsTo('App\Proveedor','id_proveedor');
    }
}
