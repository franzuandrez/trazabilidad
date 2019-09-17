<?php

namespace App\Http\Controllers;

use App\Http\tools\Existencias;
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

        $requisiciones_pendientes = Requisicion::enReserva()
            ->select('requisicion_encabezado.*')
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


    public function despachar($id)
    {


        $requisicion = Requisicion::findOrFail($id);
        $validarOrdenProductos = false;


        $debeRecalcular = $this->debeRecalcular($requisicion);


        if ($requisicion->reservas->isEmpty() || $debeRecalcular) {

            $this->recalcular($requisicion);

            return redirect()
                ->route('produccion.picking.despachar',
                    [
                        'id' => $id
                    ]
                );


        }
        return view
        ('produccion.picking.despacho',
            compact(
                'requisicion', 'validarOrdenProductos'
            )
        );


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
                    'reserva'=>[$reserva,Auth::user()->nombre]
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
                   'total'=>  $lote['total'] - $total_reservado,
                    'fecha_vencimiento'=>$lote['fecha_vencimiento']
                ];
            }


        }


        return $lotesDisponibles;
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
            dd($ex);
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
            $lotes = $existencia->map->only(['total', 'lote','fecha_vencimiento']);

            //LOS LOTES QUE SI PODES UTILIZAR PORQUE NO HA SIDO RESERVADOS.
            $lotesDisponibles = $this->getLotesDisponibles($lotes, $detalle_requisicion->id_producto);

            if (!empty($lotesDisponibles)) {

                foreach ($lotesDisponibles as $lote => $cantidadDisponible) {



                    $ubicacion = Ubicacion::where('codigo_barras', $existencia->where('lote', $lote)->first()->ubicacion)->first();
                    $reserva = new ReservaPicking();
                    $reserva->id_producto = $detalle_requisicion->id_producto;
                    $reserva->lote = $lote;
                    $reserva->fecha_vencimiento = $cantidadDisponible['fecha_vencimiento'];
                    $reserva->id_requisicion = $detalle_requisicion->requision_encabezado->id;
                    $reserva->id_bodega = $ubicacion->id_bodega;
                    $reserva->id_ubicacion = $ubicacion->id_ubicacion;
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
