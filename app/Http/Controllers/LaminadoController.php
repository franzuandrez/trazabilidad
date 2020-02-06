<?php

namespace App\Http\Controllers;


use App\Http\tools\OrdenProduccion;
use App\Http\tools\RealTimeService;
use App\Laminado_Det;
use App\Laminado_Enc;
use App\MezclaHarina_Det;
use App\MezclaHarina_Enc;
use App\Recepcion;
use App\User;
use Illuminate\Http\Request;
use DB;

class LaminadoController extends Controller
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

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');


        $laminados = Laminado_Enc::select('laminado_enc.*', 'users.nombre as usuario')
            ->join('users', 'users.id', '=', 'laminado_enc.id_usuario')
            ->where(function ($query) use ($search) {
                $query->where('laminado_enc.no_orden', 'LIKE', '%' . $search . '%')
                    ->orWhere('laminado_enc.turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('laminado_enc.fecha_ingreso', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('control.laminado.index',
                compact('laminados', 'sort', 'sortField', 'search'));
        } else {

            return view('control.laminado.ajax',
                compact('laminados', 'sort', 'sortField', 'search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //AL PULSAR EL BOTON CREAR NOS LLEVA A ESTA VISTA
        $responsables = User::actived()->get();

        return view('control.laminado.create',
            compact('responsables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $laminado = Laminado_Enc::findOrFail($id);

        return view('control.laminado.show', [
            'laminado' => $laminado
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

    public function store(Request $request)
    {


        try {

            $orden_produccion = $request->get('id_control');
            $LaminadoEnc = Laminado_Enc::where('id_control', $orden_produccion)
                ->firstOrFail();
            $LaminadoEnc->observaciones = $request->get('observacion_correctiva');
            $LaminadoEnc->save();
            return redirect()->route('control.laminado.index')
                ->with('success', 'Laminado ingresado corrrectamente');
        } catch (\Exception $ex) {
            DD($ex);
            return redirect()->back()
                ->withErrors(['No se ha podido completar su petición, codigo de error :  ' . $ex->getCode()]);
        }
    }

    private function GuardarDetalle($request, $id_enc_Laminado)
    {


        $detalleLaminado = $request->get('LOTE');

        if (is_iterable($detalleLaminado)) {


            foreach ($detalleLaminado as $key => $value) {
                $detalleLaminado1 = Laminado_Det::create([
                    'lote_producto' => $value,
                    'id_enc_laminado' => $id_enc_Laminado,
                    'temperatura_inicio' => $request->get('temperatura_inicial')[$key],
                    'temperatura_final' => $request->get('temperatura_final')[$key],
                    'temperatura_observaciones' => $request->get('temperatura_observaciones')[$key],
                    'espesor_inicio' => $request->get('espesor_inicial')[$key],
                    'espesor_final' => $request->get('espesor_final')[$key],
                    'espesor_observaciones' => $request->get('espesor_observaciones')[$key],
                    'lote_producto' => $request->get('LOTE')[$key],
                    'hora' => $request->get('hora')[$key]
                ]);
            }
        }

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
                'message' => 'Siguiente paso',
                'data' => $linea_chaomin
            ];


        }

        return response()->json($response);
    }

    public function iniciar_formulario(Request $request)
    {

        $id_control = $request->get('id_control');


        $laminado = Laminado_Enc::where('id_control', $id_control)
            ->first();

        if ($laminado == null) {
            $laminado = new Laminado_Enc();
            $laminado->id_usuario = \Auth::user()->id;
            $laminado->id_control = $id_control;
            $laminado->id_responsable = \Auth::user()->id;
            $laminado->save();

            $response = [
                'status' => 1,
                'message' => "Iniciada correctamente",
                'data' => $laminado
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => "Laminado  ya iniciado",
                'data' => $laminado
            ];
        }


        return response()
            ->json($response);

    }

    public function insertar_detalle(Request $request)
    {


        try {
            $no_orden_produccion = $request->get('no_orden_produccion');

            $laminado = Laminado_Enc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                Laminado_Det::query()->getModel(),
                $request->fields,
                'id_enc_laminado',
                $laminado->id_enc_laminado);

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
            $detalle = Laminado_Det::findOrFail($request->id);

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
            Laminado_Enc::where('id_control', $id_model)->first(), $fields
        );


        return response()->json($response);


    }

}
