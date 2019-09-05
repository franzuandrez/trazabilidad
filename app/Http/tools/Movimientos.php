<?php


namespace App\Http\tools;
use App\Movimiento;

class Movimientos
{


    public static function ingresar_producto( $ubicacion , $producto ,$lote ,$fecha_vencimiento ,$cantidad, $orden,$usuario_autoriza){


        $movimiento = new Movimiento();
        $movimiento->numero_documento = $orden->documento;
        $movimiento->usuario = \Auth::user()->id;
        $movimiento->tipo_movimiento = 1;
        $movimiento->cantidad = $cantidad;
        $movimiento->id_producto = $producto->id_producto;
        $movimiento->fecha_hora_movimiento = \Carbon\Carbon::now();
        $movimiento->ubicacion  = $ubicacion->codigo_barras;
        $movimiento->lote = $lote;
        $movimiento->fecha_vencimiento =$fecha_vencimiento;
        $movimiento->clave_autorizacion = 1234;
        $movimiento->estado = 1;
        $movimiento->id_localidad = $ubicacion->id_localidad;
        $movimiento->id_bodega = $ubicacion->id_bodega;
        $movimiento->id_sector = $ubicacion->id_sector;
        $movimiento->id_pasillo = $ubicacion->id_pasillo;
        $movimiento->id_rack = $ubicacion->id_rack;
        $movimiento->id_nivel = $ubicacion->id_nivel;
        $movimiento->id_posicion = $ubicacion->id_posicion;
        $movimiento->id_bin = $ubicacion->id_bin;
        $movimiento->usuario_autorizo = $usuario_autoriza->id;
        $movimiento->save();



    }
}
