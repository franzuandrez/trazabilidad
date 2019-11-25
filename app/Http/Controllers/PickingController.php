<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Http\tools\Existencias;
use App\Http\tools\Movimientos;
use App\Picking;
use App\Requisicion;
use App\ReservaPicking;
use App\Ubicacion;
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


            return view('produccion.picking.show',compact('requisicion','productos'));
        }


    }

    public function show($id){

        $requisicion = Requisicion::findOrFail($id);

        $productos = $requisicion->reservas->groupBy('id_producto')->keys();

        return view('produccion.picking.show',compact('requisicion','productos'));

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

            if ($lote['total'] - $total_reservado != 0) {
                $lotesDisponibles[$lote['lote']] = [
                    'total' => $lote['total'] - $total_reservado,
                    'fecha_vencimiento' => $lote['fecha_vencimiento']
                ];
            }


        }


        return $lotesDisponibles;
    }


    public function store(Request $request)
    {


        try {
            $requisicion = Requisicion::where('no_requision', $request->no_requisicion)->first();

            $picking = Picking::where('id_requisicion', $requisicion->id)->first();
            if ($picking->enProceso()) {
                DB::beginTransaction();
                //LA RESERVAS PASAN A SER DESPACHADAS
                $requisicion
                    ->reservas()
                    ->update
                    (
                        ['estado' => 'D']
                    );
                //EL DETALLE DE REQUISICION PASA A SER DESPACHADO
                $requisicion
                    ->detalle()
                    ->update(
                        ['estado' => 'D']
                    );
                //LA REQUISICION SE DESPACHA.
                $requisicion->estado = 'D';
                $requisicion->update();

                //EL PICKING SE DESPACHA.
                $picking->fecha_fin = Carbon::now();
                $picking->id_usuario = Auth::user()->id;
                $picking->estado = 'D';
                $picking->update();

                foreach ($requisicion->reservas as $reserva) {

                    $movimientos = new Movimientos();
                    $movimientos->salida_producto(
                        $reserva->bodega,
                        $reserva->producto,
                        $reserva->lote,
                        $reserva->fecha_vencimiento,
                        $reserva->cantidad,
                        $requisicion->no_orden_produccion,
                        Auth::user()
                    );

                }
                DB::commit();
            }
            return redirect()
                ->route('produccion.picking.index')
                ->with('success', 'Requisicion despachada');
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


    private function generarListadoLotesDespachar($requisicion)
    {
        //RESERVAS DE LA MISMA REQUISICION.
        $reservas = $requisicion
            ->reservas()
            ->select('*', DB::raw('sum(cantidad) as total'))
            ->groupBy('id_producto')
            ->get();


        $detalles_requisicion = $requisicion->detalle()->groupBy('id_producto')->get();

        foreach ($detalles_requisicion as $detalle_requisicion) {

            //PRODUCTO CON RESERVA
            $producto = $reservas
                ->where('id_producto', $detalle_requisicion->id_producto)
                ->first();


            //SI TIENE RESERVA, obtengo el total.
            if ($producto != null) {
                $cantidadReserva = $producto->total;
            } else {
                $cantidadReserva = 0;
            }

            $cantidadEntrante = $detalle_requisicion->cantidad - $cantidadReserva;

            // EXISTENCIA DE UN PRODUCTO
            $existencia = $this->productos->existencia($detalle_requisicion->producto->codigo_barras);


            //LOS LOTES Y LAS CANTIDAD DE LA EXISTENCIA DEVUELTA
            $lotes = $existencia->map->only(['total', 'lote', 'fecha_vencimiento']);

            //LOS LOTES QUE SI PODES UTILIZAR PORQUE NO HA SIDO RESERVADOS.
            $lotesDisponibles = $this->getLotesDisponibles($lotes, $detalle_requisicion->id_producto);

            if (!empty($lotesDisponibles)) {

                foreach ($lotesDisponibles as $lote => $cantidadDisponible) {


                    $ubicacion = Bodega::where('codigo_barras', $existencia->where('lote', $lote)->first()->ubicacion)->first();
                    $reserva = new ReservaPicking();
                    $reserva->id_producto = $detalle_requisicion->id_producto;
                    $reserva->lote = $lote;
                    $reserva->fecha_vencimiento = $cantidadDisponible['fecha_vencimiento'];
                    $reserva->id_requisicion = $detalle_requisicion->requision_encabezado->id;
                    $reserva->id_bodega = $ubicacion->id_bodega;
                    $reserva->ubicacion = $ubicacion->codigo_barras;
                    $reserva->estado = 'P';

                    if ($cantidadEntrante >= $cantidadDisponible['total']) {
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
