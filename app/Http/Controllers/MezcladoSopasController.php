<?php

namespace App\Http\Controllers;

use App\Repository\OrdenProduccionRepository;
use App\Http\tools\RealTimeService;
use App\MezclaSopaDet;
use App\MezclaSopaEnc;
use App\User;
use DB;
use Illuminate\Http\Request;

class MezcladoSopasController extends Controller
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
        $sortField = $request->get('field') == null ? 'fecha_hora' : $request->get('field');


        $sopas = MezclaSopaEnc::select(
            'mezclado_sopas_enc.*',
            DB::raw("date_format(fecha_hora,'%d/%m/%Y %h:%i:%s') as fecha_hora"),
            'users.nombre as usuario',
            'productos.descripcion as producto'
        )
            ->join('users', 'users.id', '=', 'mezclado_sopas_enc.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'mezclado_sopas_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('mezclado_sopas_enc.id_turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('mezclado_sopas_enc.id_control', 'LIKE', '%' . $search . '%')
                    ->orWhere('mezclado_sopas_enc.fecha_hora', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {
            return view('sopas.mezclado_sopas.index',
                compact('sopas', 'sort', 'sortField', 'search'));
        } else {

            return view('sopas.mezclado_sopas.ajax',
                compact('sopas', 'sort', 'sortField', 'search'));
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

        return view('sopas.mezclado_sopas.create',
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
            $mezlcado_sopas = MezclaSopaEnc::where('id_control', $orden_produccion)
                ->firstOrFail();
            $mezlcado_sopas->observaciones = $request->get('observaciones_generales');
            $mezlcado_sopas->save();
            return redirect()->route('mezclado_sopas.index')
                ->with('success', 'Mezcla de Sopas ingresada corrrectamente');
        } catch (\Exception $ex) {

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
        $mezlcado_sopas = MezclaSopaEnc::with('control_trazabilidad')
            ->with('control_trazabilidad.producto')
            ->with('control_trazabilidad.liberacion_sopas')
            ->findOrFail($id);


        return view('sopas.mezclado_sopas.show', [
            'mezclado_sopas' => $mezlcado_sopas
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

        $mezlcado_sopas = MezclaSopaEnc::with('control_trazabilidad')
            ->with('control_trazabilidad.producto')
            ->with('control_trazabilidad.liberacion_sopas')
            ->findOrFail($id);


        $tiempo_optimo = floatval($mezlcado_sopas->control_trazabilidad->liberacion_sopas->tiempos_mezcla_seco)
            + floatval($mezlcado_sopas->control_trazabilidad->liberacion_sopas->tiempos_mezcla_alta)
            + floatval($mezlcado_sopas->control_trazabilidad->liberacion_sopas->tiempos_mezcla_baja);

        return view('sopas.mezclado_sopas.edit', [
            'mezclado_sopas' => $mezlcado_sopas,
            'tiempo_optimo' => $tiempo_optimo
        ]);

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

    public function iniciar_mezclado_sopas(Request $request)
    {
        $no_orden_produccion = $request->get('no_orden_produccion');


        $linea_chaomin = OrdenProduccionRepository::verificar_linea_sopas($no_orden_produccion);


        if ($linea_chaomin['status'] == 0) {
            $response = $linea_chaomin;
        } else {
            $response = [
                'status' => 1,
                'message' => 'Mezclado de sopas iniciado correctamente',
                'data' => $linea_chaomin
            ];


        }

        return response()->json($response);
    }


    public function iniciar_formulario(Request $request)
    {

        $id_control = $request->get('id_control');
        $id_producto = $request->get('id_producto');
        $lote = $request->get('lote');
        $turno = $request->get('turno');


        $mezclado = MezclaSopaEnc::where('id_control', $id_control)
            ->first();

        if ($mezclado == null) {
            $mezclado = new MezclaSopaEnc();
            $mezclado->id_usuario = \Auth::user()->id;
            $mezclado->id_control = $id_control;
            $mezclado->fecha_hora = \Carbon\Carbon::now();
            $mezclado->lote = $lote;
            $mezclado->id_turno = $turno;
            $mezclado->id_producto = $id_producto;
            $mezclado->save();

            $response = [
                'status' => 1,
                'message' => "Iniciado correctamente",
                'data' => $mezclado
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => "Mezclado  ya iniciado",
                'data' => $mezclado
            ];
        }


        return response()
            ->json($response);

    }

    public function insertar_detalle(Request $request)
    {


        try {
            $no_orden_produccion = $request->get('no_orden_produccion');

            $peso_humedo = MezclaSopaEnc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                MezclaSopaDet::query()->getModel(),
                $request->fields,
                'id_mezclado_sopas_enc',
                $peso_humedo->id_mezclado);

        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => $ex->getMessage(),
            ];
        }


        return response()->json($response);
    }


    public function actualizar_detalle(Request $request)
    {
        $id = $request->id;
        $hora_descarga = $request->hora_descarga;;;;
        $observaciones = $request->observaciones;;;;


        try {
            $mezcla = MezclaSopaDet::findOrFail($id);
            $mezcla->hora_fin_mezcla = $hora_descarga;
            $mezcla->observaciones = $observaciones;
            $mezcla->update();

            $response = [
                'status' => 1,
                'message' => 'Actualizado correctamente'
            ];
        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => $ex->getMessage()
            ];
        }


        return response()->json($response);

    }

    public function borrar_detalle(Request $request)
    {


        try {
            $detalle = MezclaSopaDet::findOrFail($request->id);

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
            MezclaSopaEnc::where('id_control', $id_model)->first(), $fields
        );


        return response()->json($response);


    }
}
