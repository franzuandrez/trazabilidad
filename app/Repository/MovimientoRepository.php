<?php


namespace App\Repository;


use App\Bodega;
use App\Http\tools\Movimientos;
use App\Movimiento;
use App\Producto;
use App\RMIDetalle;
use App\Sector;
use App\User;
use Illuminate\Http\Request;

/**
 * @property int $cantidad
 * @property string $numero_documento
 * @property string $fecha_vencimiento
 * @property string $lote
 * @property array $lotes
 * @property array $observaciones
 * @property array $cantidades
 * @property array $idsProductos
 * @property array $idsUbicaciones
 * @property User $usuario_autoriza
 * @property Producto $producto
 * @property Bodega $bodega
 * @property Sector $sector
 */
class MovimientoRepository
{


    private $bodega = null;
    private $sector = null;
    private $producto = null;
    private $observaciones = '';
    private $usuario_autoriza = '';
    private $cantidad = 0;
    private $fecha_vencimiento;
    private $lote = '';
    private $numero_documento = '';
    private $lotes = [];
    private $cantidades = [];
    private $idsProductos = [];
    private $idsUbicaciones = [];


    public function setLotes(array $lotes)
    {

        $this->lotes = $lotes;
        return $this;
    }

    public function setCantidades(array $cantidades)
    {
        $this->cantidades = $cantidades;
        return $this;
    }

    public function setIdsProductos(array $ids)
    {
        $this->idsProductos = $ids;
    }

    public function setIdsUbicaciones($ubicaciones)
    {
        $this->idsUbicaciones = $ubicaciones;
    }

    public function setNoDocumento(string $no_documento)
    {

        $this->numero_documento = $no_documento;
        return $this;

    }

    public function setLote($lote)
    {
        $this->lote = $lote;
        return $this;
    }

    public function setFechaVencimiento($fecha)
    {
        $this->fecha_vencimiento = $fecha;
        return $this;
    }

    public function setUsuarioAutoriza(User $usuario)
    {
        $this->usuario_autoriza = $usuario;
        return $this;
    }


    function setProducto(Producto $producto)
    {

        $this->producto = $producto;
        return $this;
    }


    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
        return $this;
    }


    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
        return $this;
    }


    public function setSector(Sector $sector)
    {
        $this->sector = $sector;
        return $this;
    }


    public function setBodega(Bodega $bodega)
    {
        $this->bodega = $bodega;
        return $this;
    }


    public function ubicarProductos()
    {
        $productos = $this->idsProductos;
        foreach ($productos as $key => $id_producto) {
            $this->ubicarProducto($key, $id_producto, '');
        }
    }


    private function ubicarProducto($key, $id_producto, $fecha_vencimiento)
    {

        $sector = Sector::where('id_sector', $this->idsUbicaciones[$key])->first();;
        $producto = Producto::findOrFail($id_producto);
        $this->sector = $sector;
        $this->producto = $producto;
        $this->lote = $this->lotes[$key];
        $this->cantidad = $this->cantidades[$key];
        $this->fecha_vencimiento = $fecha_vencimiento;
        $this->ingreso_producto();
    }


    public function ingresar_control_calidad($rmi_detalle, $cantidad)
    {
        $rmi_detalle->control = 1;
        $rmi_detalle->cantidad_entrante = $rmi_detalle->cantidad_entrante + $cantidad;
        $rmi_detalle->rampa = 0;
        $rmi_detalle->update();

    }


    public function ingresar_bodega_desecho()
    {
        $ubicacion = Sector::where('sistema', 1)->first();
        $this->setSector($ubicacion);

        $this->ingreso_producto();


    }


    public function ingreso_producto()
    {

        $this->generar_movimiento(1);

    }


    public function salida_producto()
    {

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
        $movimiento->id_localidad = $this->sector->bodega->localidad->id_localidad;
        $movimiento->id_bodega = $this->sector->bodega->id_bodega;
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


}
