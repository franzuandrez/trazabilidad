<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Asistencia;
use App\DetalleInsumo;
use App\Operacion;
use App\OperariosInvolucrados;
use App\Producto;
use App\Requisicion;
use App\ReservaPicking;
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
        $id_control = DB::table('control_trazabilidad_orden_produccion')
            ->where('no_orden_produccion', 'LIKE', '%' . $search . '%')
            ->get()
            ->pluck('id_control')
            ->toArray();


        $operaciones = Operacion::join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search, $id_control) {
                $query->where('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.codigo_interno', 'LIKE', '%' . $search . '%')
                    ->orWhereIn('control_trazabilidad.id_control', $id_control)
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
        $producto = Producto::where(function ($query) {
            $query->esProductoTerminado()
                ->orWhere
                ->esProductoProceso();
        })
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

    private function get_id_control_trazabilidad($ordenes, $id_producto)
    {

        $ids = DB::table('control_trazabilidad_orden_produccion')
            ->select('id_control')
            ->whereIn('no_orden_produccion', $ordenes)
            ->where('id_producto', $id_producto)
            ->first();
        if ($ids != null) {
            $ids = $ids->id_control;
        }

        return [$ids];
    }

    public function buscar_orden_produccion(Request $request)
    {


        try {
            $search = $request->get('q');
            $id_producto = $request->get('id_producto');


            $ordenProduccion = Requisicion::select('estado', 'id', 'no_requision', 'no_orden_produccion')
                ->where('no_orden_produccion', $search)
                ->first();


            if ($ordenProduccion == null) {
                $response = [
                    'status' => 0,
                    'message' => 'No existe orden de produccion',
                    'data' => []
                ];
            } else {
                $orden_produccion_iniciada = Operacion::whereIn('id_control', $this->get_id_control_trazabilidad([$search], $id_producto))
                    ->where('id_control', $id_producto)
                    ->exists();
                if ($orden_produccion_iniciada) {
                    $response = [
                        'status' => 0,
                        'message' => 'Orden de produccion ya iniciada',
                        'data' => []
                    ];
                } else {
                    $response = [
                        'status' => 1,
                        'message' => 'Nueva orden de produccion ',
                        'data' => $ordenProduccion
                    ];
                }
            }

        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => 'Algo salió mal, codigo error :' . $e->getCode(),
                'data' => [],
            ];

        }

        return response()->json($response);

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


            $id_control = $request->get('id_control');

            $operacion = Operacion::where('id_producto', $request->id_producto)
                ->where('id_control', $id_control)
                ->first();


            if ($request->get('cantidad_produccion') != null) {
                $operacion->cantidad_producida = $request->get('cantidad_produccion');
                $operacion->save();
            }

            $actividades = $request->id_actividad;
            if (is_iterable($actividades)) {
                foreach ($actividades as $key => $actividad) {
                    $operario_involucrado = new OperariosInvolucrados();
                    $operario_involucrado->id_colaborador = $request->id_colaborador[$key];
                    $operario_involucrado->id_actividad = $actividad;
                    $operario_involucrado->id_control = $operacion->id_control;
                    $operario_involucrado->fecha_hora_asociacion = Carbon::now();
                    $operario_involucrado->save();
                }
            }


            $insumos = $request->id_insumo;
            if (is_iterable($insumos)) {
                foreach ($insumos as $key => $insumo) {
                    $detalle_insumo = DetalleInsumo::find($insumo);
                    $detalle_insumo->color = $request->color[$key];
                    $detalle_insumo->olor = $request->olor[$key];
                    $detalle_insumo->impresion = $request->impresion[$key];
                    $detalle_insumo->ausencia_material_extranio = $request->ausencia_me[$key];
                    $detalle_insumo->save();
                }
            }

            DB::commit();
            return redirect()
                ->route('produccion.operacion.index')
                ->with('success', 'Guardado correctamente');

        } catch (\Exception $ex) {


            DB::rollback();

            return redirect()->back()
                ->withInput()
                ->withErrors(['Algo salió mal, vuelva a intentarlo']);
        }


    }

    public function show($id)
    {

        $operacion = Operacion::findOrFail($id);


        return view('produccion.control_trazabilidad.show', [
            'operacion' => $operacion
        ]);
    }

    public function edit($id)
    {

        $control = Operacion::with('producto')
            ->with('asistencias')
            ->with('actividades')
            ->with('detalle_insumos')
            ->findOrFail($id);

        $actividades = Actividad::actived()
            ->get();


        return view('produccion.control_trazabilidad.edit', [
            'control' => $control,
            'actividades' => $actividades
        ]);


    }


    public function finalizar_asistencia(Request $request)
    {
        $id_control = $request->get('id_control');
        $id_colaborador = $request->get('id_colaborador');
        $id_actividad = $request->get('id_actividad');

        try {
            $now = Carbon::now();;
            $asistencia = Asistencia::where('id_control', $id_control)
                ->where('id_colaborador', $id_colaborador)
                ->where('id_actividad', $id_actividad)
                ->firstOrFail();
            $asistencia->fecha_hora_fin = $now;
            $asistencia->update();

            $response = [
                'status' => 1,
                'message' => 'Finalizado correctamente',
                'data' => $now->format('h:i:s')

            ];

        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => $e->getMessage(),
            ];

        }

        return response()->json($response);


    }

    public function verificar_proximo_lote(Request $request)
    {

        $orden_produccion = explode(",", $request->get('no_orden_produccion'));
        $codigo_barras = $request->get('codigo_barras');
        $lote = $request->get('lote');
        $producto = Producto::where('codigo_barras', $codigo_barras)
            ->first();


        $response = $this->es_lote_proximo_a_vencer($producto->id_producto, $orden_produccion, $lote);

        return response()->json($response);
    }


    private function save_orden_produccion(Request $request)
    {


        $operacion = new Operacion();
        $operacion->id_producto = $request->id_producto;
        $operacion->id_turno = $request->turno;
        $operacion->fecha_vencimiento = Carbon::createFromFormat('d/m/Y', $request->best_by)->format('Y-m-d');
        $operacion->cantidad_programada = $request->cantidad_programada;
        $operacion->lote = $request->lote_pt;
        $operacion->no_orden_produccion = $request->no_orden_produccion;
        $operacion->id_usuario = Auth::user()->id;
        $operacion->save();


        return $operacion;

    }

    public function verificar_existencia_lote(Request $request)
    {


        $proximo_lote = $this->verificar_proximo_lote($request)->getData();


        if ($proximo_lote->status == 1) {
            $cantidad_solicitada = $request->get('cantidad');
            $reserva = $proximo_lote->data->reserva_insumo;
            $no_orden_produccion = explode(',', $request->no_orden_produccion);
            $id_producto = $request->id_producto;
            $cantidad_reservada = $reserva == null ? 0 : floatval($reserva->cantidad);

            $cantidad_disponible = floatval($proximo_lote->data->siguiente_lote->cantidad - $cantidad_reservada);

            $es_cantidad_suficiente = $cantidad_disponible >= $cantidad_solicitada;
            if ($es_cantidad_suficiente) {

                $id_control = $this->get_id_control_trazabilidad($no_orden_produccion, $id_producto);


                $orden_produccion = Operacion::whereIn('id_control', $id_control)
                    ->where('id_producto', $id_producto)
                    ->first();


                $existe_orden_produccion = ($orden_produccion) != null;
                if (!$existe_orden_produccion) {
                    $orden_produccion = $this->save_orden_produccion($request);
                }
                DB::table('control_trazabilidad_orden_produccion')
                    ->where('id_control', $orden_produccion->id_control)
                    ->delete();
                foreach ($no_orden_produccion as $orden) {
                    $requisicion = Requisicion::where('no_orden_produccion', $orden)->first();


                    DB::table('control_trazabilidad_orden_produccion')
                        ->insert([
                            'id_control' => $orden_produccion->id_control,
                            'no_orden_produccion' => $requisicion->no_orden_produccion,
                            'id_requisicion' => $requisicion->id,
                            'id_producto' => $id_producto
                        ]);
                }
                $detalle_insumo = new DetalleInsumo();
                $detalle_insumo->id_control = $orden_produccion->id_control;
                $detalle_insumo->id_producto = $proximo_lote->data->siguiente_lote->producto->id_producto;
                $detalle_insumo->color = 0;
                $detalle_insumo->olor = 0;
                $detalle_insumo->impresion = 0;
                $detalle_insumo->ausencia_material_extranio = 0;
                $detalle_insumo->lote = $request->lote;
                $detalle_insumo->fecha_vencimiento = $proximo_lote->data->siguiente_lote->fecha_vencimiento;
                $detalle_insumo->cantidad = $cantidad_solicitada;
                $detalle_insumo->no_orden_produccion = Requisicion::find($proximo_lote->data->siguiente_lote->id_requisicion)->no_orden_produccion;
                $detalle_insumo->save();
                $response = [
                    'status' => 1,
                    'message' => 'Ingresado correctamente',
                    'data' => $detalle_insumo
                        ->with('producto')
                        ->orderBy('id_detalle_insumo', 'desc')
                        ->first()
                ];

            } else {
                $response = [
                    'status' => 0,
                    'message' => 'La cantidad  tiene un excedente',
                    'data' => [
                        $proximo_lote->data->siguiente_lote->cantidad,
                        $cantidad_reservada,
                        $cantidad_disponible
                    ]
                ];
            }

        } else {
            $response = $proximo_lote;
        }

        return response()->json($response);


    }


    private function es_lote_proximo_a_vencer($id_producto, $orden_produccion, $lote)
    {
        $result = $this->get_lote_siguiente_y_reserva_insumo($id_producto, $orden_produccion);

        if ($result['siguiente_lote'] == null) {
            $response = [
                'status' => 0,
                'message' => 'No hay en existencia  ',
                'data' => $result
            ];
        } else {
            if ($result['siguiente_lote']->lote == $lote) {
                $response = [
                    'status' => 1,
                    'message' => 'Lote correcto',
                    'data' => $result
                ];
            } else {
                $response = [
                    'status' => 0,
                    'message' => 'Lote no proximo a vencer',

                ];
            }
        }


        return $response;

    }

    private function get_lote_siguiente_y_reserva_insumo($id_producto, $no_orden_produccion)
    {

        $reserva_insumo = DetalleInsumo::where('id_producto', $id_producto)
            ->whereIn('no_orden_produccion', $no_orden_produccion)
            ->select('id_producto', 'lote', DB::raw('sum(cantidad) as cantidad'))
            ->orderBy('fecha_vencimiento', 'desc')
            ->groupBy('lote')
            ->groupBy('id_producto')
            ->get();


        $requisicion = Requisicion::select('id')->whereIn('no_orden_produccion', $no_orden_produccion)
            ->get()->pluck('id')->toArray();;

        $reservas = ReservaPicking::whereIn('id_requisicion', $requisicion)
            ->select('reserva_lotes.*', DB::raw('sum(cantidad) as cantidad'))
            ->where('id_producto', $id_producto)
            ->groupBy('id_producto')
            ->groupBy('lote')
            ->orderBy('fecha_vencimiento', 'asc')
            ->get();


        $siguiente_lote = [
            'reserva_insumo' => $reserva_insumo->first(),
            'siguiente_lote' => null
        ];


        if ($reserva_insumo != null) {
            foreach ($reservas as $reserva) {
                $lote_reservado = $reserva_insumo->where('lote', $reserva->lote)->first();
                $existe_lote_reservado = $lote_reservado != null;

                if ($existe_lote_reservado) {

                    if (floatval($reserva->cantidad) != floatval($lote_reservado->cantidad)) {
                        $siguiente_lote = [
                            'reserva_insumo' => $lote_reservado,
                            'siguiente_lote' => $reserva
                        ];
                        break;
                    }
                } else {

                    $siguiente_lote = [
                        'reserva_insumo' => $lote_reservado,
                        'siguiente_lote' => $reserva
                    ];
                    break;
                }

            }
        }


        return $siguiente_lote;


    }

}
