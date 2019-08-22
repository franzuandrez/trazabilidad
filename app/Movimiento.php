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

    public function producto(){

        return $this->belongsTo('App\Producto','id_producto');
    }


    public function usuario(){

        return $this->belongsTo('App\User','usuario');
    }

    public function scopeEnTransito( $query ){

        return $query->where('movimientos.ubicacion',0);
    }

    public function orden_compra(){

        return $this->belongsTo('App\Recepcion','orden_compra','numero_documento');

    }

    public function bodega(){

        return $this->belongsTo('App\Bodega','ubicacion');

    }
}
