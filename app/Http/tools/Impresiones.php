<?php


namespace App\Http\tools;


use App\Impresion;
use App\ImpresionCorrugado;
use App\Movimiento;
use App\Operacion;
use App\Producto;
use App\Repository\ConfiguracionesRepository;
use App\RMIDetalle;

class Impresiones
{
    private static $file = "C:\\ImpresionRed\\imprimir.txt";

    public static function imprimirFromRMIDetalle($ids, $tipo, $impresiones)
    {

        $movimientos = RMIDetalle::whereIn('id_rmi_detalle', $ids)
            ->orderBy('id_rmi_detalle', 'asc')
            ->get();


        foreach ($movimientos as $key => $mov) {

            if ($impresiones[$key] > 0) {
                $producto = Producto::find($mov->id_producto);
                $imprimir = new \App\Impresion();
                $imprimir->IP = (new ConfiguracionesRepository())->getIpImpresora()->valor;
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
        self::activarTriggerParaLaImpresora();

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

        self::activarTriggerParaLaImpresora();
    }


    public static function imprimir_corrugado(Operacion $control_trazabilidad)
    {


        $producto = $control_trazabilidad->producto;
        $cantidad_impresiones = intval($control_trazabilidad->cantidad_producida / $producto->cantidad_unidades);

        $lote = $control_trazabilidad->lote;
        $fecha_vencimiento = $control_trazabilidad->fecha_vencimiento;
        $cantidad = 1;

        $impresion_producto = self::imprimir($producto, $lote, $fecha_vencimiento, $cantidad, 'T', true);

        for ($i = 0; $i < $cantidad_impresiones; $i++) {
            GeneradorCodigos::getCodigoCorrugado();
            $corrugado = new ImpresionCorrugado();
            $corrugado->id_control = $control_trazabilidad->id_control;
            $corrugado->identificador_aplicacion = GeneradorCodigos::CODIGO_SSCC;
            $corrugado->digito_indicador = GeneradorCodigos::getDigitoIndicador();;
            $corrugado->prefijo_compania = GeneradorCodigos::CODIGO_EMPRESA;
            $corrugado->numerio_serial = GeneradorCodigos::getNumeroSerial();
            $corrugado->codigo_verificador = GeneradorCodigos::getDigitoVerificador();
            $corrugado->id_tb_imprimir = $impresion_producto->CORRELATIVO;
            $corrugado->ip =  (new ConfiguracionesRepository())->getIpImpresora()->valor;
            $corrugado->save();
        }
        self::activarTriggerParaLaImpresora();

    }

    public static function imprimir($producto, $lote, $fecha_vencimiento, $cantidad, $tipo, $es_pt = false)
    {
        $imprimir = new Impresion();
        $imprimir->IP =  (new ConfiguracionesRepository())->getIpImpresora()->valor;
        $imprimir->CODIGO_BARRAS = $es_pt ? $producto->codigo_dun : $producto->codigo_barras;
        $imprimir->DESCRIPCION_PRODUCTO = $producto->descripcion;
        $imprimir->LOTE = $lote;
        $imprimir->FECHA_VENCIMIENTO = $fecha_vencimiento;
        $imprimir->COPIAS = $cantidad;
        $imprimir->TIPO = $tipo;
        $imprimir->IMPRESO = 'N';
        $imprimir->REIMPRESION = 0;
        $imprimir->ID_USUARIO = \Auth::user()->id;
        $imprimir->save();

        return $imprimir;
    }

    public static function procesarImpresionesPendientes()
    {
        self::activarTriggerParaLaImpresora();
    }

    private static function activarTriggerParaLaImpresora()
    {

        $file = fopen(self::$file, 'w');
        fclose($file);

    }
}
