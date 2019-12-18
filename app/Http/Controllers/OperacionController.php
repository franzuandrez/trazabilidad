<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\DetalleInsumo;
use App\Operacion;
use App\OperariosInvolucrados;
use App\Producto;
use App\Requisicion;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class OperacionController extends Controller
{
    //


    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'id_control' : $request->get('field');

        $operaciones = Operacion::join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.codigo_interno', 'LIKE', '%' . $search . '%')
                    ->orWhere('control_trazabilidad.no_orden_produccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('control_trazabilidad.lote', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {

            return view('produccion.control_trazabilidad.index',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'operaciones' => $operaciones
                ]
            );
        } else {
            return view('produccion.control_trazabilidad.ajax',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'operaciones' => $operaciones
                ]

            );
        }

    }


    public function buscar_producto(Request $request)
    {

        $fecha_vencimiento = null;
        $producto = Producto::esProductoTerminado()
            ->where('codigo_interno', $request->get('codigo_interno'))
            ->select('id_producto', 'descripcion', 'codigo_interno', 'dias_vencimiento', 'unidad_medida')
            ->first();
        if ($producto != null) {

            $fecha_vencimiento = Carbon::now()
                ->addDays($producto->dias_vencimiento + 1)
                ->format('d/m/Y');
        }
        return response()->json([
            'producto' => $producto,
            'fecha_vencimiento' => $fecha_vencimiento
        ]);
    }

    public function buscar_orden_produccion(Request $request)
    {

        $search = $request->get('q');
        $ordenProduccion = Requisicion::select('estado', 'id', 'no_requision', 'no_orden_produccion')
            ->where('no_orden_produccion', $search)
            ->first();

        return response()->json(['orden_produccion' => $ordenProduccion]);

    }

    public function create()
    {

        $actividades = Actividad::actived()->get();


        return view('produccion.control_trazabilidad.create',
            [
                'actividades' => $actividades
            ]
        );


    }

    public function store(Request $request)
    {


        try {
            DB::beginTransaction();

            $no_orden_produccion = $request->no_orden_produccion;

            $operacion = new Operacion();
            $operacion->id_producto = $request->id_producto;
            $operacion->id_turno = $request->turno;
            $operacion->fecha_vencimiento = Carbon::createFromFormat('d/m/Y', $request->best_by)->format('Y-m-d');
            $operacion->cantidad_programada = $request->cantidad_programada;
            $operacion->lote = $request->lote_pt;
            $operacion->no_orden_produccion = $no_orden_produccion;
            $operacion->id_usuario = Auth::user()->id;
            $operacion->save();

            $actividades = $request->id_actividad;

            foreach ($actividades as $key => $actividad) {
                $operario_involucrado = new OperariosInvolucrados();
                $operario_involucrado->id_colaborador = $request->id_colaborador[$key];
                $operario_involucrado->id_actividad = $actividad;
                $operario_involucrado->id_control = $operacion->id_control;
                $operario_involucrado->fecha_hora_asociacion = Carbon::now();
                $operario_involucrado->save();
            }

            $insumos = $request->id_producto_mp;

            foreach ($insumos as $key => $insumo) {
                $detalle_insumo = new DetalleInsumo();
                $detalle_insumo->id_control = $operacion->id_control;
                $detalle_insumo->id_producto = $insumo;
                $detalle_insumo->color = $request->color[$key];
                $detalle_insumo->olor = $request->olor[$key];
                $detalle_insumo->impresion = $request->impresion[$key];
                $detalle_insumo->ausencia_material_extranio = $request->ausencia_me[$key];
                $detalle_insumo->lote = $request->lote[$key];
                $detalle_insumo->fecha_vencimiento = $request->fecha_vencimiento[$key];
                $detalle_insumo->cantidad = $request->cantidad[$key];
                $detalle_insumo->save();
            }

            DB::commit();
            return redirect()
                ->route('produccion.operacion.index')
                ->with('success','Orden creada correctamente');

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->withErrors(['Algo salió mal, vuelva a intentarlo']);
        }


    }
}
