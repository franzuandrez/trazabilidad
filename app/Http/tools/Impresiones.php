<?php


namespace App\Http\tools;


use App\Movimiento;
use App\Producto;

class Impresiones
{
    private static $file =  "C:\\ImpresionRed\\imprimir.txt";

    public static function imprimir( $ids ,$ip, $tipo,$cantidades,$impresiones){

        $movimientos = Movimiento::whereIn('id_movimiento', $ids)
            ->orderBy('id_movimiento', 'asc')
            ->get();


        self::crearArchivo();

        foreach ( $movimientos as $key => $mov){

            if($impresiones[$key] == 1){

                $producto = Producto::find($mov->id_producto);
                $imprimir = new \App\Impresion();
                $imprimir->IP = $ip;
                $imprimir->CODIGO_BARRAS = $producto->codigo_barras;
                $imprimir->DESCRIPCION_PRODUCTO = $producto->descripcion;
                $imprimir->LOTE = $mov->lote;
                $imprimir->FECHA_VENCIMIENTO = $mov->fecha_vencimiento;
                $imprimir->COPIAS = $cantidades[$key];
                $imprimir->TIPO = $tipo;
                $imprimir->save();
            }

        }

    }

    private static function crearArchivo(){

        $file  = fopen(self::$file,'w');
        fclose($file);

    }
}
