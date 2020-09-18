<?php

namespace App\Http\Controllers;

use App\Http\tools\RealTimeService;
use App\Repository\OrdenProduccionRepository;
use App\SolucionSopasDet;
use App\SolucionSopasEnc;
use Illuminate\Http\Request;
use DB;
class SolucionSopasController extends Controller
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
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');


        $formulario = SolucionSopasEnc::select(
            'solucion_sopas_enc.*',
            DB::raw("date_format(fecha_hora,'%d/%m/%Y %h:%i:%s') as fecha_ingreso"),
            'users.nombre as usuario',
            'productos.descripcion as producto'
        )
            ->join('users', 'users.id', '=', 'solucion_sopas_enc.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'solucion_sopas_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('solucion_sopas_enc.id_turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('solucion_sopas_enc.id_control', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('solucion_sopas_enc.fecha_hora', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('sopas.materias_primas_solucion.index',
                compact('formulario', 'sort', 'sortField', 'search'));
        } else {

            return view('sopas.materias_primas_solucion.ajax',
                compact('formulario', 'sort', 'sortField', 'search'));
        }
    }


    public function create()
    {

        return view('sopas.materias_primas_solucion.create');

    }


    public function buscar_orden_produccion(Request $request)
    {
        $no_orden_produccion = $request->get('no_orden_produccion');


        $linea_chaomin = OrdenProduccionRepository::verificar_linea_sopas($no_orden_produccion);


        if ($linea_chaomin['status'] == 0) {
            $response = $linea_chaomin;
        } else {
            $response = [
                'status' => 1,
                'message' => 'Siguiente paso',
                'data' => $linea_chaomin
            ];


        }

        return response()->json($response);
    }



    public function store(Request $request)
    {

        try {

            $orden_produccion = $request->get('id_control');
            $formulario = SolucionSopasEnc::where('id_control', $orden_produccion)
                ->firstOrFail();
            $formulario->observaciones = $request->get('observacion_correctiva');
            $formulario->save();
            return redirect()->route('solucion_sopas.index')
                ->with('success', 'Verificacion ingresada corrrectamente');
        } catch (\Exception $ex) {

            return redirect()->back()
                ->withErrors(['No se ha podido completar su petición, codigo de error :  ' . $ex->getCode()]);
        }

    }


    public function edit($id)
    {

        $formulario = SolucionSopasEnc::with('control_trazabilidad')
            ->with('control_trazabilidad.liberacion_linea')
            ->findOrFail($id);

        return view('sopas.materias_primas_solucion.edit', [
            'formulario' => $formulario
        ]);
    }


    public function show($id)
    {
        $formulario = SolucionSopasEnc::with('control_trazabilidad')
            ->with('control_trazabilidad.liberacion_linea')
            ->findOrFail($id);

        return view('sopas.materias_primas_solucion.show', [
            'formulario' => $formulario
        ]);
    }

    public function iniciar_formulario(Request $request)
    {

        $id_control = $request->get('id_control');
        $id_producto = $request->get('id_producto');
        $id_turno = $request->get('turno');


        $formulario = SolucionSopasEnc::where('id_control', $id_control)
            ->first();

        if ($formulario == null) {
            $formulario = new SolucionSopasEnc();
            $formulario->id_usuario = \Auth::user()->id;
            $formulario->id_control = $id_control;
            $formulario->id_producto = $id_producto;
            $formulario->id_turno = $id_turno;
            $formulario->save();

            $response = [
                'status' => 1,
                'message' => "Iniciada correctamente",
                'data' => $formulario
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => "Verificacion de Materias  ya iniciado",
                'data' => $formulario
            ];
        }


        return response()
            ->json($response);

    }


    public function insertar_detalle(Request $request)
    {


        try {
            $no_orden_produccion = $request->get('no_orden_produccion');

            $formulario = SolucionSopasEnc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                SolucionSopasDet::query()->getModel(),
                $request->fields,
                'id_solucion_enc',
                $formulario->id_solucion_enc);

        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => $ex->getMessage(),
            ];
        }


        return response()->json($response);
    }

    public function nuevo_registro(Request $request)
    {
        $id_model = $request->id_model;
        $fields = $request->fields;


        $response = RealTimeService::actualizar_modelo(
            SolucionSopasEnc::where('id_control', $id_model)->first(), $fields
        );


        return response()->json($response);


    }
}
