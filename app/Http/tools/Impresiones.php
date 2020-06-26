<?php


namespace App\Http\tools;


use App\Impresion;
use App\Movimiento;
use App\Producto;
use App\RMIDetalle;

class Impresiones
{
    private static $file = "C:\\ImpresionRed\\imprimir.txt";

    public static function imprimir($ids, $ip, $tipo, $impresiones)
    {

        $movimientos = RMIDetalle::whereIn('id_rmi_detalle', $ids)
            ->orderBy('id_rmi_detalle', 'asc')
            ->get();


        foreach ($movimientos as $key => $mov) {

            if ($impresiones[$key] > 0) {

                $producto = Producto::find($mov->id_producto);
                $imprimir = new \App\Impresion();
                $imprimir->IP = $ip;
                $imprimir->CODIGO_BARRAS = $producto->codigo_barras;
                $imprimir->DESCRIPCION_PRODUCTO = $producto->descripcion;
                $imprimir->LOTE = $mov->lote;
                $imprimir->FECHA_VENCIMIENTO = $mov->fecha_vencimiento;
                $imprimir->COPIAS = $impresiones[$key];
                $imprimir->TIPO = $tipo;
                $imprimir->ID_USUARIO = \Auth::user()->id;
                $imprimir->save();
            }

        }
        self::crearArchivo();

    }

    public static function reimprimir($impresion, $cantidad)
    {

        $reimprimir = new Impresion();
        $reimprimir->IP = $impresion->IP;
        $reimprimir->CODIGO_BARRAS = $impresion->CODIGO_BARRAS;
        $reimprimir->DESCRIPCION_PRODUCTO = $impresion->DESCRIPCION_PRODUCTO;
        $reimprimir->LOTE = $impresion->LOTE;
        $reimprimir->FECHA_VENCIMIENTO = $impresion->FECHA_VENCIMIENTO;
        $reimprimir->COPIAS = $cantidad;
        $reimprimir->TIPO = $impresion->TIPO;
        $reimprimir->IMPRESO = 'N';
        $reimprimir->REIMPRESION = 1;
        $reimprimir->ID_USUARIO = \Auth::user()->id;
        $reimprimir->save();

    }

    private static function crearArchivo()
    {

        $file = fopen(self::$file, 'w');
        fclose($file);

    }
}
