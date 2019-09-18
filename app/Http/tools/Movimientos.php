<?php


namespace App\Http\tools;

use App\Movimiento;

class Movimientos
{


    private $ubicacion;
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

        $this->ubicacion = $ubicacion;
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
        $movimiento->ubicacion = $this->ubicacion->codigo_barras;
        $movimiento->lote = $this->lote;
        $movimiento->fecha_vencimiento = $this->fecha_vencimiento;
        $movimiento->clave_autorizacion = 1234;
        $movimiento->estado = 1;
        $movimiento->id_localidad = $this->ubicacion->id_localidad;
        $movimiento->id_bodega = $this->ubicacion->id_bodega;
        $movimiento->id_sector = $this->ubicacion->id_sector;
        $movimiento->id_pasillo = $this->ubicacion->id_pasillo;
        $movimiento->id_rack = $this->ubicacion->id_rack;
        $movimiento->id_nivel = $this->ubicacion->id_nivel;
        $movimiento->id_posicion = $this->ubicacion->id_posicion;
        $movimiento->id_bin = $this->ubicacion->id_bin;
        $movimiento->usuario_autorizo = $this->usuario_autoriza->id;

        $movimiento->save();
    }


}
