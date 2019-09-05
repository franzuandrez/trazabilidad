<?php


namespace App\Http\tools;


use App\Movimiento;
use App\Producto;
use DB;
class Existencias
{
    public function existencia($codigo_producto)
    {



        $productos = Producto::where('codigo_interno','=',$codigo_producto)
            ->orWhere('codigo_barras','=',$codigo_producto)
            ->pluck('id_producto');





        $existencias = Movimiento::join('tipo_movimiento','tipo_movimiento.id_movimiento','=','movimientos.tipo_movimiento')
            ->select('movimientos.id_movimiento',
                'movimientos.lote',
                'movimientos.id_producto',
                'movimientos.id_bodega',
                'movimientos.fecha_vencimiento',
                DB::raw('sum(cantidad * factor) as total'))
            ->whereIn('id_producto', $productos)
            ->groupBy('id_producto')
            ->groupBy('lote')
            ->orderBy('movimientos.fecha_vencimiento','asc')
            ->with('producto')
            ->with('bodega')
            ->with('producto.presentacion')
            ->with('producto.dimensional')
            ->get();


        $response = $existencias;
        return $response;

    }

}
