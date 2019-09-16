<?php

namespace App\Http\Controllers;

use App\Http\tools\Existencias;
use App\Requisicion;
use App\ReservaPicking;
use App\Ubicacion;
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
        $validarOrdenProductos = true;


        if ($requisicion->reservas->isEmpty()) {

            $detalles_requisicion = $requisicion->detalle->groupBy('id_producto');


            foreach ($detalles_requisicion as $detalle_requisicion) {


                $cantidadEntrante = $detalle_requisicion->sum('cantidad');

                $existencia = $this->productos->existencia($detalle_requisicion->first()->producto->codigo_barras);


                $lotes = $existencia->pluck('total', 'lote');

                $lotesDisponibles = $this->getLotesDisponibles($lotes, $detalle_requisicion->first()->id_producto);

                if (!empty($lotesDisponibles)) {
                    foreach ($lotesDisponibles as $lote => $cantidadDisponible) {

                        $ubicacion = Ubicacion::where('codigo_barras', $existencia->where('lote', $lote)->first()->ubicacion)
                            ->first();

                        $reserva = new ReservaPicking();
                        $reserva->id_producto = $detalle_requisicion->first()->id_producto;
                        $reserva->lote = $lote;
                        $reserva->id_requisicion = $requisicion->id;
                        $reserva->id_bodega = $ubicacion->id_bodega;
                        $reserva->id_ubicacion = $ubicacion->id_ubicacion;
                        $reserva->ubicacion = $ubicacion->codigo_barras;
                        $reserva->estado = 'P';

                        if ($cantidadEntrante >= $cantidadDisponible) {
                            $reserva->cantidad = $cantidadDisponible;
                            $reserva->save();
                            $cantidadEntrante = $cantidadEntrante - $cantidadDisponible;
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


        return view('produccion.picking.despacho', compact('requisicion', 'validarOrdenProductos'));


    }


    public function leer($id_reserva)
    {


        try {
            $reserva = ReservaPicking::findOrFail($id_reserva);
            $reserva->leido = 'S';
            $reserva->estado = 'R';
            $reserva->id_usuario_picking = Auth::user()->id;
            $reserva->fecha_lectura = \Carbon\Carbon::now();
            $reserva->update();

            $response = 1;
        } catch (\Exception $e) {

            $response = 0;
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

        foreach ($lotes as $lote => $cantidadEnExistencia) {

            $total_reservado = ReservaPicking::where('lote', $lote)
                ->where('id_producto', $id_producto)
                ->enReserva()
                ->sum('cantidad');

            if ($cantidadEnExistencia - $total_reservado != 0) {
                $lotesDisponibles[$lote] = $cantidadEnExistencia - $total_reservado;
            }


        }


        return $lotesDisponibles;
    }


    public function debeRecalcular( $id_producto , $lote ){

        $debeRecalcular = ReservaPicking::where('id_producto',$id_producto)
            ->where('lote',$lote)
            ->EnReserva()
            ->exists();

        return $debeRecalcular;


    }
}
