<?php


namespace App\Http\tools;

use App\Movimiento;
use App\Producto;
use App\Sector;
use App\User;
use DB;

class Movimientos
{


    private $bodega;
    private $sector;
    private $producto;
    private $lote;
    private $fecha_vencimiento;
    private $cantidad;
    private $numero_documento;
    private $usuario_autoriza;
    private $observaciones = '';

    public function ingreso_producto(
        Sector $ubicacion,
        Producto $producto,
        $lote,
        $fecha_vencimiento,
        $cantidad,
        $numero_documento,
        User $usuario_autoriza ,
        $observaciones = '')
    {
        $this->sector = $ubicacion;
        $this->bodega = $ubicacion->bodega;
        $this->producto = $producto;
        $this->lote = $lote;
        $this->fecha_vencimiento = $fecha_vencimiento;
        $this->cantidad = $cantidad;
        $this->numero_documento = $numero_documento;
        $this->usuario_autoriza = $usuario_autoriza;
        $this->observaciones = $observaciones;
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
        $this->sector = $ubicacion;
        $this->bodega = $ubicacion->bodega;
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
        $movimiento->ubicacion = $this->sector->codigo_barras;
        $movimiento->lote = $this->lote;
        $movimiento->fecha_vencimiento = $this->fecha_vencimiento;
        $movimiento->clave_autorizacion = 1234;
        $movimiento->estado = 1;
        $movimiento->id_localidad = $this->bodega->localidad->id_localidad;
        $movimiento->id_bodega = $this->bodega->id_bodega;
        $movimiento->id_sector = $this->sector->id_sector;
        $movimiento->id_pasillo = 0;
        $movimiento->id_rack = 0;
        $movimiento->id_nivel = 0;
        $movimiento->id_posicion = 0;
        $movimiento->id_bin = 0;
        $movimiento->usuario_autorizo = $this->usuario_autoriza->id;
        $movimiento->observaciones = $this->observaciones;
        $movimiento->save();
    }


    public function existencia($search)
    {


        $productos = Producto::where('codigo_interno', '=', $search)
            ->orWhere('codigo_barras', '=', $search)
            ->pluck('id_producto');


        $existencias = Movimiento::join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
            ->select('movimientos.id_movimiento',
                'movimientos.lote',
                'movimientos.id_producto',
                'movimientos.ubicacion',
                'movimientos.fecha_vencimiento',
                DB::raw('sum(cantidad * factor) as total'))
            ->whereIn('id_producto', $productos)
            ->where('movimientos.observaciones','=','')
            ->groupBy('id_producto')
            ->groupBy('lote')
            ->orderBy('movimientos.fecha_vencimiento', 'asc')
            ->with('producto')
            ->with('bodega')
            ->get();


        $response = $existencias;
        return response()->json($response);

    }

}
