<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Movimiento
 *
 * @property int $id_movimiento
 * @property string|null $numero_documento
 * @property \App\User|null $usuario
 * @property int|null $tipo_movimiento
 * @property float|null $cantidad
 * @property int|null $id_producto
 * @property string|null $fecha_hora_movimiento
 * @property string|null $ubicacion
 * @property string|null $lote
 * @property string|null $fecha_vencimiento
 * @property string|null $clave_autorizacion
 * @property int|null $usuario_autorizo
 * @property string|null $estado
 * @property int|null $id_localidad
 * @property int|null $id_bodega
 * @property int|null $id_sector
 * @property int|null $id_pasillo
 * @property int|null $id_rack
 * @property int|null $id_nivel
 * @property int|null $id_posicion
 * @property int|null $id_bin
 * @property string|null $observaciones
 * @property-read \App\Bin|null $bin
 * @property-read \App\Bodega|null $bodega
 * @property-read \App\Localidad|null $localidad
 * @property-read \App\Nivel|null $nivel
 * @property-read \App\Recepcion $orden_compra
 * @property-read \App\Pasillo|null $pasillo
 * @property-read \App\Posicion|null $posicion
 * @property-read \App\Producto|null $producto
 * @property-read \App\Rack|null $rack
 * @property-read \App\Sector|null $sector
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento enTransito()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereClaveAutorizacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereFechaHoraMovimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereIdBin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereIdBodega($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereIdLocalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereIdMovimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereIdNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereIdPasillo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereIdPosicion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereIdRack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereIdSector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereNumeroDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereTipoMovimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movimiento whereUsuarioAutorizo($value)
 * @mixin \Eloquent
 */
class Movimiento extends Model
{
    //

    protected $table = 'movimientos';
    protected $primaryKey = 'id_movimiento';
    public $timestamps = false;

    protected $fillable = [
        'numero_documento',
        'usuario',
        'tipo_movimiento',
        'cantidad',
        'id_producto',
        'fecha_hora_movimiento',
        'ubicacion',
        'lote',
        'fecha_vencimiento',
        'usuario_autorizo',
        'clave_autorizacion',
        'estado',
        'id_localidad',
        'id_bodega',
        'id_sector',
        'id_pasillo',
        'id_rack',
        'id_nivel',
        'id_posicion',
        'id_bin'
    ];

    /**
     *           -----------------------RELATIONSHIPS ------------------------------------------
     */

    public $dates = [
        'fecha_hora_movimiento'
    ];

    public function producto()
    {

        return $this->belongsTo('App\Producto', 'id_producto');
    }


    public function usuario()
    {

        return $this->belongsTo('App\User', 'usuario');
    }

    public function responsable()
    {

        return $this->belongsTo('App\User', 'usuario');
    }

    public function orden_compra()
    {

        return $this->belongsTo('App\Recepcion', 'orden_compra', 'numero_documento');

    }

    public function localidad()
    {

        return $this->belongsTo('App\Localidad', 'id_localidad')->withDefault([
            'descripcion' => 'Localidad por defecto'
        ]);
    }

    public function bodega()
    {

        return $this->belongsTo('App\Bodega', 'id_bodega')->withDefault([
            'descripcion' => 'Bodega por defecto'
        ]);

    }

    public function sector()
    {
        return $this->belongsTo('App\Sector', 'id_sector')->withDefault([
            'descripcion' => 'Sector por defecto'
        ]);
    }

    public function pasillo()
    {

        return $this->belongsTo('App\Pasillo', 'id_pasillo')->withDefault([
            'descripcion' => 'Pasillo por Defecto'
        ]);
    }

    public function rack()
    {

        return $this->belongsTo('App\Rack', 'id_rack')->withDefault([
            'descripcion' => ' Rack por defecto',
        ]);;

    }

    public function nivel()
    {

        return $this->belongsTo('App\Nivel', 'id_nivel')->withDefault([
            'descripcion' => 'Nivel por defecto'
        ]);

    }

    public function posicion()
    {

        return $this->belongsTo('App\Posicion', 'id_posicion')->withDefault([
            'descripcion' => 'Posicion por defecto'
        ]);
    }

    public function bin()
    {
        return $this->belongsTo('App\Bin', 'id_bin')->withDefault([
            'descripcion' => 'Bin por defecto'
        ]);
    }

    /**
     * ---------------------------------SCOPES---------------------------------
     *
     */

    public function scopeEnTransito($query)
    {

        return $query->where('movimientos.ubicacion', 0);
    }


}
