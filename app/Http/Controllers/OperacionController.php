<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Requisicion;
use App\RequisicionDetalle;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OperacionController extends Controller
{
    //
    const ESTADO_ORDEN_EXISTENTE = 0;
    const ESTADO_ORDEN_NUEVA = 1;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');

        $operaciones = Requisicion::select('requisicion_encabezado.*')
            ->join('users', 'users.id', '=', 'requisicion_encabezado.id_usuario_ingreso')
            ->where(function ($query) use ($search) {
                $query->where('requisicion_encabezado.no_orden_produccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('requisicion_encabezado.no_requision', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(15);


        if ($request->ajax()) {
            return view('produccion.operaciones.index',
                compact('operaciones', 'sort', 'sortField', 'search'));
        } else {
            return view('produccion.operaciones.ajax',
                compact('operaciones', 'sort', 'sortField', 'search'));
        }
    }


    public function create()
    {

        $bodegas = Bodega::actived()
            ->get();

        $requisicion = Requisicion::enProceso()
            ->where('id_usuario_ingreso', Auth::user()->id)
            ->get();


        return view('produccion.operaciones.create', compact('bodegas', 'requisicion'));
    }

    public function store(Request $request)
    {


        try {

            DB::beginTransaction();
            $id = $request->get('id_requisicion');

            $operacion = Requisicion::findOrFail($id);
            $operacion->estado = 'R';
            $operacion->fecha_actualizacion = Carbon::now();
            $operacion->update();

            DB::table('requisicion_detalle')->where('id_requisicion_encabezado', $operacion->id)
                ->update(['estado' => 'R']);


            DB::commit();
            return redirect()->route('produccion.requisiciones.index')
                ->with('success', 'Operacion realizada correctamente');

        } catch (\Exception $ex) {

            DB::rollback();

            return redirect()->route('produccion.requisiciones.index')
                ->withErrors(['Algo salio mal, intentelo más tarde']);
        }
    }

    public function show($id){

        $requisicion = Requisicion::findOrFail($id);

        return view('produccion.operaciones.show',compact('requisicion'));


    }

    public function verificarOrdenRequisicion($orden_requisicion)
    {

        $response = [];
        $orden = Requisicion::where('no_requision', $orden_requisicion)
            ->first();

        if ($orden != null) {

            $response = [self::ESTADO_ORDEN_EXISTENTE, $orden->estado];
        } else {
            $requisicion = new Requisicion();
            $requisicion->no_requision = $orden_requisicion;
            $requisicion->id_usuario_ingreso = Auth::user()->id;
            $requisicion->fecha_ingreso = Carbon::now();
            $requisicion->save();
            $response = [self::ESTADO_ORDEN_NUEVA, $requisicion->id];
        }
        return $response;

    }

    public function verificarOrdenProduccion($orden_produccion, $id)
    {
        $response = [];
        $orden = Requisicion::where('no_orden_produccion', $orden_produccion)
            ->first();

        if ($orden != null) {

            $response = [self::ESTADO_ORDEN_EXISTENTE, $orden->estado];
        } else {
            $requisicion = Requisicion::findOrFail($id);
            $requisicion->no_orden_produccion = $orden_produccion;
            $requisicion->update();
            $response = [self::ESTADO_ORDEN_NUEVA, $requisicion->id];
        }
        return $response;
    }

    public function reservar(Request $request)
    {


        try {
            $requisicion = Requisicion::findOrFail($request->get('id'));

            $requisicion_detalle = new RequisicionDetalle();
            $requisicion_detalle->id_requisicion_encabezado = $requisicion->id;
            $requisicion_detalle->orden_requisicion = $requisicion->no_requision;
            $requisicion_detalle->orden_produccion = $requisicion->no_orden_produccion;
            $requisicion_detalle->id_producto = $request->get('id_producto');
            $requisicion_detalle->cantidad = $request->get('cantidad');
            $requisicion_detalle->estado = 'R';
            $requisicion_detalle->save();
            $response = [1, $requisicion_detalle->id];
        } catch (\Exception $ex) {
            $response = [0, $ex->getMessage()];
        }


        return $response;


    }


    public function borrar_de_reserva(Request $request)
    {

        $id = $request->get('id');

        try {
            $requisicion_detalle = RequisicionDetalle::destroy($id);
            $response = [1];
        } catch (\Exception $e) {

            $response = [0];
        }

        return $response;
    }


    public function en_reserva($id)
    {

        $productos = [$id];
        $totalEnRequisiciones = RequisicionDetalle::whereIn('id_producto', $productos)
            ->where(function ($query) {
                $query->where('estado', 'P')
                    ->orWhere('estado', 'R');
            })
            ->sum('cantidad');

        return $totalEnRequisiciones;

    }

    public function borrar_reservas()
    {

        try {
            DB::beginTransaction();
            $requisicion = Requisicion::where('id_usuario_ingreso', Auth::user()->id)
                ->enProceso()
                ->first();
            $id_requisicion = $requisicion->id;
            $requisicion->delete();
            DB::table('requisicion_detalle')
                ->where('id_requisicion_encabezado', $id_requisicion)
                ->delete();
            DB::commit();
            $response = [1];
        } catch (\Exception $e) {

            DB::rollback();
            $response = [0];
        }

        return $response;


    }
}
