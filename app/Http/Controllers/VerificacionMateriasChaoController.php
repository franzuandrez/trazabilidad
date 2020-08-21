<?php

namespace App\Http\Controllers;

use App\Repository\OrdenProduccionRepository;
use App\Http\tools\RealTimeService;
use App\VerificacionMateriaChaoDet;
use App\VerificacionMateriaChaoEnc;
use DB;
use Illuminate\Http\Request;

class VerificacionMateriasChaoController extends Controller
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


        $verificacion = VerificacionMateriaChaoEnc::select(
            'verificacion_materias_chao_enc.*',
            DB::raw("date_format(fecha_hora,'%d/%m/%Y %h:%i:%s') as fecha_ingreso"),
            'users.nombre as usuario',
            'productos.descripcion as producto'
        )
            ->join('users', 'users.id', '=', 'verificacion_materias_chao_enc.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'verificacion_materias_chao_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('verificacion_materias_chao_enc.id_turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('verificacion_materias_chao_enc.id_control', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('verificacion_materias_chao_enc.fecha_hora', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {
            return view('control.verificacion_materia_prima_chao.index',
                compact('verificacion', 'sort', 'sortField', 'search'));
        } else {

            return view('control.verificacion_materia_prima_chao.ajax',
                compact('verificacion', 'sort', 'sortField', 'search'));
        }
    }


    public function create()
    {


        return view('control.verificacion_materia_prima_chao.create'
        );
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


    public function iniciar_formulario(Request $request)
    {

        $id_control = $request->get('id_control');
        $id_turno = $request->get('id_turno');


        $verificacion = VerificacionMateriaChaoEnc::where('id_control', $id_control)
            ->first();

        if ($verificacion == null) {
            $verificacion = new VerificacionMateriaChaoEnc();
            $verificacion->id_usuario = \Auth::user()->id;
            $verificacion->id_control = $id_control;
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


    public function edit($id)
    {
        $verificacion = VerificacionMateriaChaoEnc::findOrFail($id);


        return view('control.verificacion_materia_prima_chao.edit', [
            'verificacion' => $verificacion
        ]);

    }

    public function insertar_detalle(Request $request)
    {


        try {
            $no_orden_produccion = $request->get('no_orden_produccion');

            $laminado = VerificacionMateriaChaoEnc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                VerificacionMateriaChaoDet::query()->getModel(),
                $request->fields,
                'id_verificacion',
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
            VerificacionMateriaChaoEnc::where('id_control', $id_model)->first(), $fields
        );


        return response()->json($response);


    }

    public function destroy($id)
    {

    }


    public function show($id)
    {


        $verificacion = VerificacionMateriaChaoEnc::findOrFail($id);


        return view('control.verificacion_materia_prima_chao.show', [
            'verificacion' => $verificacion
        ]);

    }
}
