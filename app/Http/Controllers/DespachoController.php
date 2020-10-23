<?php

namespace App\Http\Controllers;

use App\Http\tools\Movimientos;
use App\Picking;
use App\Repository\PickingRepository;
use App\Sector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Requisicion;
use Illuminate\Support\Facades\Auth;
use DB;

class DespachoController extends Controller
{
    //


    private $pickingRepository;

    public function __construct(PickingRepository $pickingRepository)
    {
        $this->middleware('auth');
        $this->pickingRepository = $pickingRepository;
    }


    public function index(Request $request)
    {
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');

        $requisiciones_pendientes = Requisicion::select('requisicion_encabezado.*', 'detalle_requisicion_pt.*')
            ->join('users', 'users.id', '=', 'requisicion_encabezado.id_usuario_ingreso')
            ->join('detalle_requisicion_pt', 'detalle_requisicion_pt.id_requisicion', '=', 'requisicion_encabezado.id')
            ->NoDeBaja()
            ->NoDespachada()
            ->esProductoTerminado()
            ->where(function ($query) use ($search) {
                $query->where('requisicion_encabezado.no_orden_produccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('requisicion_encabezado.no_requision', 'LIKE', '%' . $search . '%')
                    ->orWhere('detalle_requisicion_pt.cliente_ref_1', 'LIKE', '%' . $search . '%')
                    ->orWhere('detalle_requisicion_pt.cliente_ref_2', 'LIKE', '%' . $search . '%')
                    ->orWhere('detalle_requisicion_pt.no_factura', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(15);


        if ($request->ajax()) {

            return view('produccion.despacho_pt.index',
                compact('requisiciones_pendientes', 'search', 'sort', 'sortField'));
        } else {

            return view('produccion.despacho_pt.ajax',
                compact('requisiciones_pendientes', 'search', 'sort', 'sortField'));
        }

    }


    public function despachar($id, Request $request)
    {


        $requisicion = Requisicion::find($id);

        if ($requisicion->estado !== "D") {
            $validarOrdenProductos = false;
            $pickingRepository = $this->pickingRepository;
            $pickingRepository->setOrdenRequisicion($requisicion);
            $pickingRepository->crear_oden_picking();
            $debeRecalcularseListadoDeLotesADespachar = $pickingRepository->debeRecalcularseReserva();
            $existenMovimientos = false;
            $movimientos = collect([]);
            if ($debeRecalcularseListadoDeLotesADespachar) {
                $movimientos = $pickingRepository->recalcularReservas(true);
                $existenMovimientos = ($movimientos != null) ? !$movimientos->isEmpty() : false;

                if ($existenMovimientos) {
                    $pickingRepository->borrarReservasNoLeidas();
                    return view
                    ('produccion.despacho_pt.despacho',
                        compact(
                            'requisicion',
                            'validarOrdenProductos',
                            'existenMovimientos',
                            'movimientos'
                        )
                    );
                }
                return $this->despachar($id, $request);
            }

            if ($request->ajax()) {

                return view('produccion.despacho_pt.listado_productos',
                    compact(
                        'requisicion'
                    ));

            } else {
                return view
                ('produccion.despacho_pt.despacho',
                    compact(
                        'requisicion', 'validarOrdenProductos', 'existenMovimientos',
                        'movimientos'
                    )
                );
            }
        } else {

            $productos = $requisicion->reservas->groupBy('id_producto')->keys();

            return view('produccion.despacho_pt.show', compact('requisicion', 'productos'));
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
                ->route('produccion.despacho.index')
                ->with('success', 'Requisicion Armada');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->withErrors(['Algo salió mal']);
        }


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

    private function rebajar_inventario(Requisicion $requisicion)
    {
        foreach ($requisicion->reservas as $reserva) {

            $movimientos = new Movimientos();
            $movimientos->salida_producto(
                $reserva->ubicacion()->first(),
                $reserva->producto,
                $reserva->lote,
                $reserva->fecha_vencimiento,
                $reserva->cantidad,
                $requisicion->no_requision,
                Auth::user(),
                'DES'
            );

        }
    }

}
