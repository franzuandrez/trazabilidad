<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Operacion;
use App\Producto;
use App\Requisicion;
use Carbon\Carbon;
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
        $producto = Producto::where('codigo_interno', $request->get('codigo_interno'))
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
            ->where('no_orden_produccion', $search )
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

        dd($request->all());

    }
}
