<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'clave_autorizacion',
        'estado'
    ];

    /**
     *           -----------------------RELATIONSHIPS ------------------------------------------
     */

    public function producto()
    {

        return $this->belongsTo('App\Producto', 'id_producto');
    }


    public function usuario()
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
