<?php

namespace App\Http\Controllers;

use App\Repository\OrdenProduccionRepository;
use App\Http\tools\RealTimeService;
use App\VerificacionMateriaDet;
use App\VerificacionMateriaEnc;
use DB;
use Illuminate\Http\Request;

class VerificacionMateriasController extends Controller
{
    //


    public function __construct()
    {


    }


    public function index(Request $request)
    {


        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');


        $verificacion = VerificacionMateriaEnc::select(
            'verificacion_materias_enc.*',
            DB::raw("date_format(fecha,'%d/%m/%Y %h:%i:%s') as fecha_ingreso"),
            'users.nombre as usuario',
            'productos.descripcion as producto'
        )
            ->join('users', 'users.id', '=', 'verificacion_materias_enc.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'verificacion_materias_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('verificacion_materias_enc.id_turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('verificacion_materias_enc.id_control', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('verificacion_materias_enc.fecha', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('control.verificacion_materia_prima.index',
                compact('verificacion', 'sort', 'sortField', 'search'));
        } else {

            return view('control.verificacion_materia_prima.ajax',
                compact('verificacion', 'sort', 'sortField', 'search'));
        }
    }


    public function create()
    {

        return view('control.verificacion_materia_prima.create');

    }


    public function iniciar_harina(Request $request)
    {
        $no_orden_produccion = $request->get('no_orden_produccion');


        $linea_chaomin = OrdenProduccionRepository::verificar_linea_chaomin($no_orden_produccion);


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

    public function destroy($id)
    {

    }

    public function store(Request $request)
    {

        try {

            $orden_produccion = $request->get('id_control');
            $LaminadoEnc = VerificacionMateriaEnc::where('id_control', $orden_produccion)
                ->firstOrFail();
            $LaminadoEnc->observaciones = $request->get('observacion_correctiva');
            $LaminadoEnc->save();
            return redirect()->route('verificacion_materias.index')
                ->with('success', 'Verificacion ingresada corrrectamente');
        } catch (\Exception $ex) {
            DD($ex);
            return redirect()->back()
                ->withErrors(['No se ha podido completar su petición, codigo de error :  ' . $ex->getCode()]);
        }

    }


    public function edit($id)
    {

        $verificacion = VerificacionMateriaEnc::with('control_trazabilidad')
            ->with('control_trazabilidad.liberacion_linea')
            ->findOrFail($id);

        return view('control.verificacion_materia_prima.edit', [
            'verificacion' => $verificacion
        ]);
    }


    public function show($id)
    {
        $verificacion = VerificacionMateriaEnc::with('control_trazabilidad')
            ->with('control_trazabilidad.liberacion_linea')
            ->findOrFail($id);

        return view('control.verificacion_materia_prima.show', [
            'verificacion' => $verificacion
        ]);
    }

    public function iniciar_formulario(Request $request)
    {

        $id_control = $request->get('id_control');
        $id_producto = $request->get('id_producto');
        $id_turno = $request->get('id_turno');


        $verificacion = VerificacionMateriaEnc::where('id_control', $id_control)
            ->first();

        if ($verificacion == null) {
            $verificacion = new VerificacionMateriaEnc();
            $verificacion->id_usuario = \Auth::user()->id;
            $verificacion->id_control = $id_control;
            $verificacion->id_producto = $id_producto;
            $verificacion->id_turno = $id_turno;
            $verificacion->save();

            $response = [
                'status' => 1,
                'message' => "Iniciada correctamente",
                'data' => $verificacion
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => "Verificacion de Materias  ya iniciado",
                'data' => $verificacion
            ];
        }


        return response()
            ->json($response);

    }


    public function insertar_detalle(Request $request)
    {


        try {
            $no_orden_produccion = $request->get('no_orden_produccion');

            $laminado = VerificacionMateriaEnc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                VerificacionMateriaDet::query()->getModel(),
                $request->fields,
                'id_verificacion_enc',
                $laminado->id_verificacion);

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
            VerificacionMateriaEnc::where('id_control', $id_model)->first(), $fields
        );


        return response()->json($response);


    }
}
