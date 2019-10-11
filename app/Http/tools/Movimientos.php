<?php


namespace App\Http\tools;

use App\Movimiento;

class Movimientos
{


    private $bodega;
    private $producto;
    private $lote;
    private $fecha_vencimiento;
    private $cantidad;
    private $numero_documento;
    private $usuario_autoriza;

    public function ingreso_producto(
        $ubicacion,
        $producto,
        $lote,
        $fecha_vencimiento,
        $cantidad,
        $numero_documento,
        $usuario_autoriza)
    {

        $this->bodega = $ubicacion;
        $this->producto = $producto;
        $this->lote = $lote;
        $this->fecha_vencimiento = $fecha_vencimiento;
        $this->cantidad = $cantidad;
        $this->numero_documento = $numero_documento;
        $this->usuario_autoriza = $usuario_autoriza;

        $this->generar_movimiento(1);


    }


    /**
     * @param $ubicacion
     * @param $producto
     * @param $lote
     * @param $fecha_vencimiento
     * @param $cantidad
     * @param $numero_documento
     * @param $usuario_autoriza
     */
    public function salida_producto($ubicacion,
                                    $producto,
                                    $lote,
                                    $fecha_vencimiento,
                                    $cantidad,
                                    $numero_documento,
                                    $usuario_autoriza)
    {
        $this->ubicacion = $ubicacion;
        $this->producto = $producto;
        $this->lote = $lote;
        $this->fecha_vencimiento = $fecha_vencimiento;
        $this->cantidad = $cantidad;
        $this->numero_documento = $numero_documento;
        $this->usuario_autoriza = $usuario_autoriza;
        $this->generar_movimiento(2);
    }

    private function generar_movimiento($tipo_movimiento)
    {
        $movimiento = new Movimiento();
        $movimiento->numero_documento = $this->numero_documento;
        $movimiento->usuario = \Auth::user()->id;
        $movimiento->tipo_movimiento = $tipo_movimiento;
        $movimiento->cantidad = $this->cantidad;
        $movimiento->id_producto = $this->producto->id_producto;
        $movimiento->fecha_hora_movimiento = \Carbon\Carbon::now();
        $movimiento->ubicacion = $this->bodega->codigo_barras;
        $movimiento->lote = $this->lote;
        $movimiento->fecha_vencimiento = $this->fecha_vencimiento;
        $movimiento->clave_autorizacion = 1234;
        $movimiento->estado = 1;
        $movimiento->id_localidad = $this->bodega->localidad->id_localidad;
        $movimiento->id_bodega = $this->bodega->id_bodega;
        $movimiento->id_sector = 0;
        $movimiento->id_pasillo = 0;
        $movimiento->id_rack = 0;
        $movimiento->id_nivel = 0;
        $movimiento->id_posicion = 0;
        $movimiento->id_bin = 0;
        $movimiento->usuario_autorizo = $this->usuario_autoriza->id;

        $movimiento->save();
    }


}
