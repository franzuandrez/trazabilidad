<?php

namespace App\Http\Controllers;

use App\Repository\ExistenciasRepository;
use App\Http\tools\Movimientos;
use App\Picking;
use App\Repository\PickingRepository;
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
    private $pickingRepository = null;

    public function __construct(PickingRepository $pickingRepository)
    {
        $this->pickingRepository = $pickingRepository;
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
            ->NoDespachada()
            ->esMateriaPrima()
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
            $pickingRepository = new PickingRepository();
            $pickingRepository->setOrdenRequisicion($requisicion);
            $pickingRepository->crear_oden_picking();
            $debeRecalcularseListadoDeLotesADespachar = $pickingRepository->debeRecalcularseReserva();

            if ($debeRecalcularseListadoDeLotesADespachar) {
                $pickingRepository->recalcularReservas();
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

            $this->pickingRepository->setOrdenRequisicion($reserva->requisicion);
            $debeRecalcular = $this->pickingRepository->debeRecalcularseReserva();
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


}
