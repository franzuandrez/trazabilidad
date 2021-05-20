<?php


namespace App\Repository;


use App\Picking;
use App\Requisicion;
use App\RequisicionDetalle;
use App\ReservaPicking;
use App\Sector;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property Picking $orden_picking
 * @property Requisicion $orden_requisicion
 * @property ReservaPicking $ultima_reserva
 * @property string $fecha_ultima_reserva
 **/
class PickingRepository
{


    const POSICION_UBICACION = 1;
    const POSICION_LOTE = 0;
    /**
     *
     */
    const KEY_DELIMITER = '|';

    private $orden_picking = null;
    private $orden_requisicion = null;
    private $ultima_reserva = null;
    private $fecha_ultima_reserva = '';


    /**
     * @param ReservaPicking $ultima_reserva
     */
    public function setUltimaReserva(ReservaPicking $ultima_reserva): void
    {
        $this->ultima_reserva = $ultima_reserva;
    }

    /**
     * @return string
     */
    public function getFechaUltimaReserva(): string
    {
        return $this->fecha_ultima_reserva;
    }

    /**
     * @param string $fecha_ultima_reserva
     */
    public function setFechaUltimaReserva(string $fecha_ultima_reserva): void
    {
        $this->fecha_ultima_reserva = $fecha_ultima_reserva;
    }

    /**
     * @return Picking
     */
    public function getOrdenPicking(): Picking
    {
        return $this->orden_picking;
    }

    /**
     * @param Picking $orden_picking
     */
    public function setOrdenPicking(Picking $orden_picking): void
    {
        $this->orden_picking = $orden_picking;
    }

    /**
     * @return Requisicion
     */
    public function getOrdenRequisicion(): Requisicion
    {
        return $this->orden_requisicion;
    }

    /**
     * @param Requisicion $orden_requisicion
     */
    public function setOrdenRequisicion(Requisicion $orden_requisicion): void
    {
        $this->orden_requisicion = $orden_requisicion;
    }


    public function existe_orden_picking($id)
    {
        $existeOrden = Picking::where('id_requisicion', $id)->exists();

        return $existeOrden;

    }

    public function despachar()
    {

        $this->crear_oden_picking();

        $debeRecalcularseListadoDeLotesADespachar = $this->debeRecalcularseReserva();

        if ($debeRecalcularseListadoDeLotesADespachar) {
            $this->recalcularReservas();
            return $this->despachar();
        }
        return true;

    }


    public function crear_oden_picking()
    {

        $picking = new Picking();
        $picking->id_requisicion = $this->getOrdenRequisicion()->id;
        $picking->fecha_inicio = Carbon::now();
        $picking->estado = 'P';
        $picking->save();
        $this->setOrdenPicking($picking);
    }


    /**
     * @return ReservaPicking|null
     */
    public function getUltimaReserva()
    {
        $this->ultima_reserva = $this->ultima_reserva == null
            ?
            $this->getOrdenRequisicion()->reservas->last()
            :
            $this->ultima_reserva;
        return $this->ultima_reserva;
    }

    private function getFechaUltimaLectura()
    {
        $ultimaReserva = $this->getUltimaReserva();
        $fechaUltimaReserva = Carbon::now()->format('Y-m-d H:i:s');
        if ($ultimaReserva != null) {
            $fechaUltimaReserva = $ultimaReserva->created_at->format('Y-m-d H:i:s');
        }
        $this->fecha_ultima_reserva = $fechaUltimaReserva;
        return $this->fecha_ultima_reserva;
    }

    private function getReservasUltimasRequisiones()
    {
        $reservas = ReservaPicking::where('id_requisicion', '<>', $this->getOrdenRequisicion()->id)
            ->where('fecha_lectura', '>', $this->getFechaUltimaLectura())
            ->get();

        return $reservas;
    }

    private function getLotesUltimasReservas($ultimas_reservas)
    {
        $lotes = $ultimas_reservas
            ->pluck('lote')
            ->toArray();
        return $lotes;
    }

    private function getProductosUltimasReservas($ultimas_reservas)
    {
        $productos = $ultimas_reservas
            ->pluck('id_producto')
            ->toArray();

        return $productos;
    }

    /**
     * @return bool
     */
    public function debeRecalcularseReserva()
    {
        $ultimasReservas = $this->getReservasUltimasRequisiones();
        $productos = $this->getProductosUltimasReservas($ultimasReservas);
        $lotes = $this->getLotesUltimasReservas($ultimasReservas);

        $existenReservasConElMismoProducto = $this->existenReservasConElMismoProducto($productos, $lotes);

        $debeRecalcular = $existenReservasConElMismoProducto || $this->noExistenReservas();

        return $debeRecalcular;
    }

    private function existenReservasConElMismoProducto(array $productos, array $lotes)
    {
        $existenReservasConElMismoProducto =
            ReservaPicking::where('id_requisicion', $this->getOrdenRequisicion()->id)
                ->enProceso()
                ->whereIn('id_producto', $productos)
                ->whereIn('lote', $lotes)
                ->exists();

        return $existenReservasConElMismoProducto;
    }

    private function noExistenReservas()
    {

        return $this->getOrdenRequisicion()->reservas->isEmpty();
    }

    public function recalcularReservas($es_producto_terminado = false)
    {
        $result = null;

        $this->borrarReservasNoLeidas();
        $result = $this->generarListadoLotesDespachar($es_producto_terminado);


        return $result;
    }

    public function borrarReservasNoLeidas()
    {
        $id_reservas_no_leidas = $this->getReservasNoLeidas()
            ->pluck('id_reserva')
            ->toArray();

        DB::table('reserva_lotes')
            ->whereIn('id_reserva', $id_reservas_no_leidas)
            ->delete();
    }


    /**
     * @return Collection
     */
    private function getReservasNoLeidas()
    {
        $reservas_no_leidas = $this->getOrdenRequisicion()
            ->reservas()
            ->enProceso();
        return $reservas_no_leidas;

    }

    private function getCantidadSolicitada(RequisicionDetalle $detalle_requisicion, $reservas_misma_requisicion)
    {

        $total_reservado = $this
            ->getTotalReservadoByProducto($detalle_requisicion->id_producto, $reservas_misma_requisicion);
        $cantidadSolicitada = $detalle_requisicion->cantidad - $total_reservado;

        return $cantidadSolicitada;
    }


    private function generarProductoADespachar($lotesADespachar, $cantidadSolicitada, $detalle_requisicion)
    {
        $reserva = null;
        $total_en_existencia = collect($lotesADespachar)->sum('total');

        if ($total_en_existencia < $cantidadSolicitada && $detalle_requisicion->producto->tipo_producto == 'PT') {
            $caja = clone $detalle_requisicion;
            $caja->cantidad = 1;
            return [
                "existencia" => $total_en_existencia,
                "detalle_requisicion" => $detalle_requisicion,
                'proximos_lotes' => collect($this->getLotesADespachar(($caja), '4140754842000031'))];
        }

        if ($total_en_existencia < $cantidadSolicitada && $detalle_requisicion->producto->tipo_producto != 'PT') {
            return null;
        }
        foreach ($lotesADespachar as $key => $loteADespachar) {

            $key = $this->descomponerKeyLoteUbicacion($key);
            $codigo_ubicacion = $key[self::POSICION_UBICACION];
            $no_lote = $key[self::POSICION_LOTE];
            $ubicacion = Sector::where('codigo_barras', $codigo_ubicacion)
                ->first();

            $reserva = $this->setValuesToReservaPicking($detalle_requisicion, $no_lote, $loteADespachar['fecha_vencimiento'], $ubicacion);
            $esLoteConsumido = $cantidadSolicitada >= $loteADespachar['total'];

            if ($esLoteConsumido) {
                $reserva->cantidad = $loteADespachar['total'];
                $reserva->save();
                $cantidadSolicitada = $cantidadSolicitada - $loteADespachar['total'];
            } else {
                $reserva->cantidad = $cantidadSolicitada;
                if ($cantidadSolicitada != 0) {
                    $reserva->save();
                }
                $cantidadSolicitada = 0;
            }

        }

        return $reserva;
    }

    private function generarListadoLotesDespachar($es_producto_terminado = false)
    {

        if (!$es_producto_terminado) {
            $reservas_misma_requisicion = $this->getReservasAgrupadasPorProducto();
            $detalles_requisicion = $this->getDetalleRequisicionAgrupadoPorProducto();
            $movs = $this->generarListadoLotesDespacharAux($detalles_requisicion, $reservas_misma_requisicion);

            return null;
        } else {
            //DESPACHO DE PRODUCTOS TERMINADOS.

            $reservas_misma_requisicion = $this->getReservasAgrupadasPorProducto();
            $detalles_requisicion = $this->getDetalleRequisicionAgrupadoPorProducto();
            $unidades = collect([]);
            $cajas = collect([]);

            foreach ($detalles_requisicion as $det_requi) {


                //SI LA UNIDAD DE DESPACHO NO ES UNIDAD DE DISTRIBUCION.

                $result = $this->despachar_pt_en_unidades($det_requi);
                $unidades->push($result['unidad']);
                $cajas->push($result['caja']);

            }

            $movimientos_unidades = $this
                ->generarListadoLotesDespacharAux($unidades, $reservas_misma_requisicion, '4140754842000208');
            $this->generarListadoLotesDespacharAux($cajas, $reservas_misma_requisicion, '4140754842000031');

            return $movimientos_unidades;
        }


    }

    private function despachar_pt_en_caja($det_requi)
    {
        $caja = clone $det_requi;
        $caja->cantidad = intval($det_requi->cantidad);
        $caja->unidad_medida = 'CA';
        return $caja;
    }

    private function despachar_pt_en_unidades($det_requi)
    {
        $caja = clone $det_requi;
        $caja->cantidad = intval($det_requi->cantidad / $det_requi->producto->cantidad_unidades);
        $caja->unidad_medida = 'CA';

        $unidad = clone $det_requi;
        $unidad->cantidad = intval($det_requi->cantidad % $det_requi->producto->cantidad_unidades);
        $unidad->unidad_medida = 'UN';

        return [
            'caja' => $caja,
            'unidad' => $unidad
        ];
    }

    public function generarListadoLotesDespacharAux($detalles_requisicion, $reservas_misma_requisicion, $ubicacion = null)
    {

        $movimientos = collect([]);

        foreach ($detalles_requisicion as $det_requi) {

            $cantidadSolicitada = $this->getCantidadSolicitada($det_requi, $reservas_misma_requisicion);
            $lotesADespachar = $this->getLotesADespachar($det_requi, $ubicacion);
            $hayLotesDisponibles = !empty($lotesADespachar);

            $result = $this->generarProductoADespachar($lotesADespachar, $cantidadSolicitada, $det_requi);
            if (is_array($result)) {
                $caja = clone $det_requi;
                $caja->cantidad = 1;
                $movimientos->push($result);
            }
        }

        return $movimientos;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private
    function getReservasAgrupadasPorProducto()
    {
        $reservas = $this->getOrdenRequisicion()
            ->reservas()
            ->select('*', DB::raw('sum(cantidad) as total'))
            ->groupBy('id_producto')
            ->get();

        return $reservas;
    }

    private
    function getDetalleRequisicionAgrupadoPorProducto()
    {
        $detalles_requisicion = $this->getOrdenRequisicion()
            ->detalle()
            ->select('requisicion_detalle.id',
                'requisicion_detalle.id_requisicion_encabezado',
                'requisicion_detalle.orden_requisicion',
                'requisicion_detalle.orden_produccion',
                'requisicion_detalle.id_producto',
                'requisicion_detalle.estado',
                'requisicion_detalle.unidad_medida',
                \DB::raw('sum(cantidad) as cantidad'))
            ->groupBy('id_producto')
            ->groupBy('unidad_medida')
            ->get();

        return $detalles_requisicion;
    }

    private
    function getTotalReservadoByProducto($id_producto, $reservas = [])
    {

        $reservas = count($reservas) > 0 ? $this->getReservasAgrupadasPorProducto() : $reservas;
        $totalEnReserva = 0;
        $producto = $reservas
            ->where('id_producto', $id_producto)
            ->first();

        if ($producto != null) {
            $totalEnReserva = $producto->total;
        }
        return $totalEnReserva;
    }

    private
    function getLotesConInventarioDisponible($codigo_barras_producto, $ubicacion = null)
    {

        $existenciasRepository = new ExistenciasRepository();
        $lotes = $existenciasRepository
            ->existencia($codigo_barras_producto, $ubicacion)
            ->map
            ->only(['total', 'lote', 'fecha_vencimiento', 'ubicacion']);


        return $lotes;
    }

    private
    function getLotesADespachar(RequisicionDetalle $detalle_requisicion, $ubicacion = null)
    {
        $lotesConInventarioDisponible = $this
            ->getLotesConInventarioDisponible($detalle_requisicion->producto->codigo_barras, $ubicacion);


        $lotesSinReservas = [];
        foreach ($lotesConInventarioDisponible as $key => $inventario) {

            $total_reservado = $this->getTotalReservadoPorProductoAndLote($detalle_requisicion->id_producto, $inventario['lote']);

            $total_disponible = $inventario['total'] - $total_reservado;
            $esta_el_lote_disponible = $total_disponible > 0;

            if ($esta_el_lote_disponible) {

                $keyFormedByLoteAndUbicacion = $this->formarKeyEntreLoteAndUbicacion($inventario['lote'], $inventario['ubicacion']);
                $fecha_vencimiento = $inventario['fecha_vencimiento'];
                $esta_el_lote_agregado = array_key_exists($keyFormedByLoteAndUbicacion, $lotesSinReservas);
                $total_previo = 0;
                if ($esta_el_lote_agregado) {
                    $total_previo = $lotesSinReservas[$keyFormedByLoteAndUbicacion]['total'];
                }
                $lotesSinReservas[$keyFormedByLoteAndUbicacion] =
                    $this->getLoteSinReserva($total_previo + $total_disponible, $fecha_vencimiento, $inventario['lote'], $inventario['ubicacion']);
            } else {

            }
        }

        return $lotesSinReservas;
    }

    private
    function getLoteSinReserva($total, $fecha_vencimiento, $lote, $ubicacion)
    {
        return [
            'total' => $total,
            'fecha_vencimiento' => $fecha_vencimiento,
            'lote' => $lote,
            'ubicacion' => $ubicacion
        ];
    }


    private
    function formarKeyEntreLoteAndUbicacion($lote, $ubicacion)
    {
        $lote_ubicacion = $lote . self::KEY_DELIMITER . $ubicacion;
        return $lote_ubicacion;
    }

    private
    function descomponerKeyLoteUbicacion($key)
    {
        return explode(self::KEY_DELIMITER, $key);
    }

    private
    function getTotalReservadoPorProductoAndLote($id_producto, $lote)
    {
        $total_reservado = ReservaPicking::where('lote', $lote)
            ->where('id_producto', $id_producto)
            ->enReserva()
            ->sum('cantidad');
        return $total_reservado;

    }

    private
    function setValuesToReservaPicking(RequisicionDetalle $detalle_requisicion, $lote, $fecha_vencimiento, $ubicacion)
    {


        $reserva = new ReservaPicking();
        $reserva->id_producto = $detalle_requisicion->id_producto;
        $reserva->lote = $lote;
        $reserva->fecha_vencimiento = $fecha_vencimiento;
        $reserva->id_requisicion = $detalle_requisicion->requision_encabezado->id;
        $reserva->id_bodega = $ubicacion->bodega->id_bodega;
        $reserva->ubicacion = $ubicacion->codigo_barras;
        $reserva->id_ubicacion = $ubicacion->id_sector;
        $reserva->estado = 'P';
        return $reserva;

    }


}
