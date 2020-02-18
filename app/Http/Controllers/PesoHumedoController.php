<?php

namespace App\Http\Controllers;

use App\Http\tools\OrdenProduccion;
use App\Http\tools\RealTimeService;
use App\PesoHumedoDet;
use App\PesoHumedoEnc;
use App\User;
use Illuminate\Http\Request;
use DB;
class PesoHumedoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');


        $humedos = PesoHumedoEnc::select(
            'peso_humedo_enc.*',
            'users.nombre as usuario',
            'productos.descripcion as producto',
            DB::raw("date_format(fecha_ingreso,'%d/%m/%Y %h:%i:%s') as fecha_ingreso")
        )
            ->join('users', 'users.id', '=', 'peso_humedo_enc.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'peso_humedo_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('peso_humedo_enc.no_orden', 'LIKE', '%' . $search . '%')
                    ->orWhere('peso_humedo_enc.fecha_ingreso', 'LIKE', '%' . $search . '%')
                    ->orWhere('peso_humedo_enc.turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('control.peso_humedo.index',
                compact('humedos', 'sort', 'sortField', 'search'));
        } else {

            return view('control.peso_humedo.ajax',
                compact('humedos', 'sort', 'sortField', 'search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $responsables = User::actived()->get();

        return view('control.peso_humedo.create',
            compact('responsables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        try {

            $orden_produccion = $request->get('id_control');
            $LaminadoEnc = PesoHumedoEnc::where('id_control', $orden_produccion)
                ->firstOrFail();
            $LaminadoEnc->observaciones = $request->get('observacion_correctiva');
            $LaminadoEnc->save();
            return redirect()->route('peso_humedo.index')
                ->with('success', 'Peso humedo ingresado corrrectamente');
        } catch (\Exception $ex) {
            DD($ex);
            return redirect()->back()
                ->withErrors(['No se ha podido completar su petición, codigo de error :  ' . $ex->getCode()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $humedo = PesoHumedoEnc::findOrFail($id);


        return view('control.peso_humedo.show', [
            'humedo' => $humedo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function iniciar_laminado(Request $request)
    {
        $no_orden_produccion = $request->get('no_orden_produccion');


        $linea_chaomin = OrdenProduccion::verificar_linea_chaomin($no_orden_produccion);


        if ($linea_chaomin['status'] == 0) {
            $response = $linea_chaomin;
        } else {

            $response = [
                'status' => 1,
                'message' => 'Peso humedo iniciado correctamente',
                'data' => $linea_chaomin
            ];


        }

        return response()->json($response);
    }


    public function iniciar_formulario(Request $request)
    {

        $id_control = $request->get('id_control');


        $humedo = PesoHumedoEnc::where('id_control', $id_control)
            ->first();

        if ($humedo == null) {
            $humedo = new PesoHumedoEnc();
            $humedo->id_usuario = \Auth::user()->id;
            $humedo->id_control = $id_control;
            $humedo->cortador_no = $request->cortador_no;
            $humedo->save();

            $response = [
                'status' => 1,
                'message' => "Iniciado correctamente",
                'data' => $humedo
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => "Peso Humedo  ya iniciado",
                'data' => $humedo
            ];
        }


        return response()
            ->json($response);

    }

    public function insertar_detalle(Request $request)
    {


        try {
            $no_orden_produccion = $request->get('no_orden_produccion');

            $peso_humedo = PesoHumedoEnc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                PesoHumedoDet::query()->getModel(),
                $request->fields,
                'id_peso_humedo_enc',
                $peso_humedo->id_peso_humedo);

        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => $ex->getMessage(),
            ];
        }


        return response()->json($response);
    }

    public function borrar_detalle(Request $request)
    {


        try {
            $detalle = PesoHumedoDet::findOrFail($request->id);

            $response = RealTimeService::borrar_detalle($detalle);

        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => $ex->getMessage()
            ];
        }

        return response()->json($response);


    }

    public function nuevo_registro(Request $request)
    {
        $id_model = $request->id_model;
        $fields = $request->fields;


        $response = RealTimeService::actualizar_modelo(
            PesoHumedoEnc::where('id_control', $id_model)->first(), $fields
        );


        return response()->json($response);


    }


}
