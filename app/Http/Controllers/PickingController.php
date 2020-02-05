<?php

namespace App\Http\Controllers;

use App\Http\tools\Existencias;
use App\Http\tools\Movimientos;
use App\Picking;
use App\Requisicion;
use App\ReservaPicking;
use App\Sector;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickingController extends Controller
{
    //
    protected $productos;

    public function __construct(Existencias $exitencias)
    {
        $this->productos = $exitencias;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');

        $requisiciones_pendientes = Requisicion::select('requisicion_encabezado.*')
            ->join('users', 'users.id', '=', 'requisicion_encabezado.id_usuario_ingreso')
            ->NoDeBaja()
            ->where(function ($query) use ($search) {
                $query->where('requisicion_encabezado.no_orden_produccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('requisicion_encabezado.no_requision', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(15);


        if ($request->ajax()) {

            return view('produccion.picking.index',
                compact('requisiciones_pendientes', 'search', 'sort', 'sortField'));
        } else {

            return view('produccion.picking.ajax',
                compact('requisiciones_pendientes', 'search', 'sort', 'sortField'));
        }


    }


    public function despachar($id, Request $request)
    {


        $requisicion = Requisicion::findOrFail($id);

        if ($requisicion->estado !== "D") {
            $validarOrdenProductos = false;
            $this->crearOrdenPicking($requisicion);

            $debeRecalcular = $this->debeRecalcular($requisicion);


            if ($requisicion->reservas->isEmpty() || $debeRecalcular) {

                $this->recalcular($requisicion);
                return $this->despachar($id, $request);
            }

            if ($request->ajax()) {

                return view('produccion.picking.listado_productos',
                    compact(
                        'requisicion'
                    ));

            } else {
                return view
                ('produccion.picking.despacho',
                    compact(
                        'requisicion', 'validarOrdenProductos'
                    )
                );
            }
        } else {

            $productos = $requisicion->reservas->groupBy('id_producto')->keys();


            return view('produccion.picking.show', compact('requisicion', 'productos'));
        }


    }

    public function show($id)
    {

        $requisicion = Requisicion::findOrFail($id);

        $productos = $requisicion->reservas->groupBy('id_producto')->keys();

        return view('produccion.picking.show', compact('requisicion', 'productos'));

    }

    public function leer($id_reserva)
    {


        try {

            $reserva = ReservaPicking::without('bodega')
                ->findOrFail($id_reserva);


            $debeRecalcular = $this->debeRecalcular($reserva->requisicion);
            if ($debeRecalcular) {
                $response = [
                    'status' => 2,
                    'message' => 'Debe recalcular'
                ];
            } else {
                $reserva->leido = 'S';
                $reserva->estado = 'R';
                $reserva->id_usuario_picking = Auth::user()->id;
                $reserva->fecha_lectura = \Carbon\Carbon::now();
                $reserva->update();

                $response = [
                    'status' => 1,
                    'message' => 'Leido correctamente',
                    'reserva' => [$reserva, Auth::user()->nombre]
                ];
            }


        } catch (\Exception $e) {

            $response = [
                'status' => 0,
                'message' => $e->getMessage(),
            ];
        }

        return $response;

    }

    /**
     * @param $lotes
     * @param $id_producto
     * @return array
     *
     * Devuelve los lotes disponibles,
     * verificando los que ya han sido reservados por otras requisiciones
     */

    private function getLotesDisponibles($lotes, $id_producto)
    {

        $lotesDisponibles = [];

        foreach ($lotes as $key => $lote) {


            $total_reservado = ReservaPicking::where('lote', $lote['lote'])
                ->where('id_producto', $id_producto)
                ->enReserva()
                ->sum('cantidad');

            $total_disponible = $lote['total'] - $total_reservado;

            $esta_lote_disponible = $total_disponible > 0;
            if ($esta_lote_disponible) {
                $lote_ubicacion = $lote['lote'] . '|' . $lote['ubicacion'];
                $fecha_vencimiento = $lote['fecha_vencimiento'];
                if (!array_key_exists($lote_ubicacion, $lotesDisponibles)) {
                    $lotesDisponibles[$lote_ubicacion] = [
                        'total' => $total_disponible,
                        'fecha_vencimiento' => $fecha_vencimiento
                    ];

                } else {
                    $total_previo = $lotesDisponibles[$lote_ubicacion]['total'];
                    $lotesDisponibles[$lote_ubicacion] = [
                        'total' => $total_previo + $total_disponible,
                        'fecha_vencimiento' => $fecha_vencimiento
                    ];
                }

            }


        }


        return $lotesDisponibles;
    }

    private function despachar_reservas($requisicion)
    {


        $requisicion
            ->reservas()
            ->update
            (
                ['estado' => 'D']
            );

    }

    private function despachar_requisicion($requisicion)
    {
        $requisicion->estado = 'D';
        $requisicion->update();

        $requisicion
            ->detalle()
            ->update(
                ['estado' => 'D']
            );
    }

    private function despachar_orden_picking($picking)
    {
        $picking->fecha_fin = Carbon::now();
        $picking->id_usuario = Auth::user()->id;
        $picking->estado = 'D';
        $picking->update();
    }

    private function rebajar_inventario($requisicion)
    {
        foreach ($requisicion->reservas as $reserva) {

            $movimientos = new Movimientos();
            $movimientos->salida_producto(
                $reserva->ubicacion()->first(),
                $reserva->producto,
                $reserva->lote,
                $reserva->fecha_vencimiento,
                $reserva->cantidad,
                $requisicion->no_orden_produccion,
                Auth::user()
            );

        }
    }

    public function store(Request $request)
    {


        try {
            $requisicion = Requisicion::where('no_requision', $request->no_requisicion)->first();

            $picking = Picking::where('id_requisicion', $requisicion->id)->first();
            if ($picking->enProceso()) {
                DB::beginTransaction();

                $this->despachar_reservas($requisicion);
                $this->despachar_requisicion($requisicion);
                $this->despachar_orden_picking($picking);
                $this->rebajar_inventario($requisicion);


                DB::commit();
            }
            return redirect()
                ->route('produccion.picking.index')
                ->with('success', 'Requisicion Armada');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->withErrors(['Algo salió mal']);
        }


    }

    public function crearOrdenPicking($requisicion)
    {

        $existeOrden = Picking::where('id_requisicion', $requisicion->id)->exists();
        if (!$existeOrden) {
            $picking = new Picking();
            $picking->id_requisicion = $requisicion->id;
            $picking->fecha_inicio = Carbon::now();
            $picking->estado = 'P';
            $picking->save();
        }
    }

    private function debeRecalcular($requisicion)
    {


        $ultimaReserva = $requisicion->reservas->last();
        if ($ultimaReserva == null) {
            $fechaUltimaReserva = Carbon::now()->format('Y-m-d H:i:s');
        } else {
            $fechaUltimaReserva = $ultimaReserva->created_at->format('Y-m-d H:i:s');
        }

        //DESPACHAS O EN RESERVAS QUE NO SEAN DE LA MISMA REQUISICION.
        $reservas = ReservaPicking::where('id_requisicion', '<>', $requisicion->id)
            ->where('fecha_lectura', '>', $fechaUltimaReserva)
            ->get();

        $productos = $reservas
            ->pluck('id_producto')
            ->toArray();

        $lotes = $reservas
            ->pluck('lote')
            ->toArray();


        $debeRecalcular = ReservaPicking::where('id_requisicion', $requisicion->id)
            ->enProceso()
            ->whereIn('id_producto', $productos)
            ->whereIn('lote', $lotes)
            ->exists();


        return $debeRecalcular;
    }


    private function recalcular($requisicion)
    {

        try {
            $this->borrarReservasNoLeidas($requisicion);
            $this->generarListadoLotesDespachar($requisicion);


        } catch (\Exception $ex) {

            return $ex;
            //DB::rollback();
        }


    }

    private function borrarReservasNoLeidas($requisicion)
    {
        //DB::beginTransaction();


        $ids_reservas = $requisicion
            ->reservas()
            ->enProceso()
            ->pluck('id_reserva')
            ->toArray();

        //Borrar las reservas que no ha sido leidas.
        DB::table('reserva_lotes')
            ->whereIn('id_reserva', $ids_reservas)
            ->delete();

    }


    private function reservas_previas($requisicion)
    {

        $reservas = $requisicion
            ->reservas()
            ->select('*', DB::raw('sum(cantidad) as total'))
            ->groupBy('id_producto')
            ->get();

        return $reservas;

    }

    private function total_reservado($id_producto, $reservas)
    {

        $producto = $reservas
            ->where('id_producto', $id_producto)
            ->first();


        //SI TIENE RESERVA, obtengo el total.
        if ($producto != null) {
            $cantidadReserva = $producto->total;
        } else {
            $cantidadReserva = 0;
        }

        return $cantidadReserva;

    }

    private function generarListadoLotesDespachar($requisicion)
    {
        //RESERVAS DE LA MISMA REQUISICION.
        $reservas = $this->reservas_previas($requisicion);


        $detalles_requisicion = $requisicion
            ->detalle()
            ->select('requisicion_detalle.id',
                'requisicion_detalle.id_requisicion_encabezado',
                'requisicion_detalle.orden_requisicion',
                'requisicion_detalle.orden_produccion',
                'requisicion_detalle.id_producto',
                'requisicion_detalle.estado',
                \DB::raw('sum(cantidad) as cantidad'))
            ->groupBy('id_producto')
            ->get()
            ;

        foreach ($detalles_requisicion as $detalle_requisicion) {

            //CANTIDAD YA RESERVADA. (0 en caso de no haber)
            $cantidadReserva = $this->total_reservado($detalle_requisicion->id_producto, $reservas);

            $cantidadEntrante = $detalle_requisicion->cantidad - $cantidadReserva;

            // LOTES CON INVENTARIO DISPONIBLE
            $lotes = $this
                ->productos
                ->existencia($detalle_requisicion->producto->codigo_barras)
                ->map
                ->only(['total', 'lote', 'fecha_vencimiento', 'ubicacion']);


            //LOS LOTES QUE SI PODES UTILIZAR PORQUE NO HA SIDO RESERVADOS.
            $lotesDisponibles = $this->getLotesDisponibles($lotes, $detalle_requisicion->id_producto);


            if (!empty($lotesDisponibles)) {

                foreach ($lotesDisponibles as $lote => $cantidadDisponible) {

                    $codigo_ubicacion = explode('|', $lote)[1];
                    $no_lote = explode('|', $lote)[0];

                    $ubicacion = Sector::where('codigo_barras', $codigo_ubicacion)->first();

                    $reserva = new ReservaPicking();
                    $reserva->id_producto = $detalle_requisicion->id_producto;
                    $reserva->lote = $no_lote;
                    $reserva->fecha_vencimiento = $cantidadDisponible['fecha_vencimiento'];
                    $reserva->id_requisicion = $detalle_requisicion->requision_encabezado->id;
                    $reserva->id_bodega = $ubicacion->bodega->id_bodega;
                    $reserva->ubicacion = $ubicacion->codigo_barras;
                    $reserva->estado = 'P';

                    $esLoteConsumido = $cantidadEntrante >= $cantidadDisponible['total'];
                    if ($esLoteConsumido) {
                        $reserva->cantidad = $cantidadDisponible['total'];
                        $reserva->save();
                        $cantidadEntrante = $cantidadEntrante - $cantidadDisponible['total'];
                    } else {
                        $reserva->cantidad = $cantidadEntrante;
                        if ($cantidadEntrante != 0) {
                            $reserva->save();
                        }
                        $cantidadEntrante = 0;
                    }


                }
            } else {
                return redirect()->route('produccion.picking.index')
                    ->withErrors(['No hay lotes disponibles']);
            }
        }


    }

}
