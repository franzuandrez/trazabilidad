<?php

namespace App\Http\Controllers;

use App\Repository\OrdenProduccionRepository;
use App\Http\tools\RealTimeService;
use App\MezclaHarina_Det;
use App\MezclaHarina_Enc;
use App\User;
use DB;
use Illuminate\Http\Request;

class MezclaHarinaController extends Controller
{

    public function index(Request $request)
    {
        //
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'no_orden' : $request->get('field');


        $lineas = MezclaHarina_Enc::select(
            'enc_mezclaharina.*',
            DB::raw("date_format(fecha_hora,'%d/%m/%Y %h:%i:%s') as fecha_hora"),
            'users.nombre as usuario',
            'productos.descripcion as producto'
        )
            ->leftJoin('users', 'users.id', '=', 'enc_mezclaharina.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'enc_mezclaharina.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('enc_mezclaharina.no_orden', 'LIKE', '%' . $search . '%')
                    ->orWhere('enc_mezclaharina.fecha_hora', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {

            return view('control.Mezcla_Harina.index', compact('lineas', 'search', 'sort', 'sortField'));

        } else {
            return view('control.Mezcla_Harina.ajax', compact('lineas', 'search', 'sort', 'sortField'));
        }
    }

    public function create()
    {
        //
        $responsables = User::actived()->get();

        return view('control.mezcla_harina.create',
            compact('responsables'));
    }

    public function store(Request $request)
    {


        $orden_produccion = $request->get('no_orden_produccion');


        try {
            $mezcla = MezclaHarina_Enc::where('id_control', $request->id_control)
                ->firstOrFail();
            $mezcla->observaciones = $request->get('observacion');
            $mezcla->save();
            return redirect()->route('mezcla_harina.index')
                ->with('success', 'Operacion Finalizada correctamente');

        } catch (\Exception $ex) {
            dd($ex);
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

        $mezcla_harina = MezclaHarina_Enc::findOrFail($id);

        return view('control.mezcla_harina.show', compact('mezcla_harina'));
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
        $mezcla_harina = MezclaHarina_Enc::with('control_trazabilidad')
            ->with('control_trazabilidad.producto')
            ->with('control_trazabilidad.liberacion_linea')
            ->findOrFail($id);

        $tiempo = floatval($mezcla_harina->control_trazabilidad->liberacion_linea->mezcla_seca_inicial)
            +
            floatval($mezcla_harina->control_trazabilidad->liberacion_linea->mezcla_alta_inicial)
            +
            floatval($mezcla_harina->control_trazabilidad->liberacion_linea->mezcla_baja_inicial);

        return view('control.mezcla_harina.edit', [
            'mezcla_harina' => $mezcla_harina,
            'tiempo'=>$tiempo
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

    public function iniciar_harina(Request $request)
    {

        $no_orden_produccion = $request->get('no_orden_produccion');


        $linea_chaomin = OrdenProduccionRepository::verificar_linea_chaomin($no_orden_produccion);


        if ($linea_chaomin['status'] == 0) {
            $response = $linea_chaomin;
        } else {
            $response = [
                'status' => 1,
                'message' => 'Mezcla de harina  iniciada correctamente',
                'data' => $linea_chaomin
            ];


        }

        return response()->json($response);


    }


    public function iniciar_formulario(Request $request)
    {

        $id_control = $request->get('id_control');
        $lote = $request->get('lote');


        $harina = MezclaHarina_Enc::where('id_control', $id_control)
            ->first();

        if ($harina == null) {
            $harina = new MezclaHarina_Enc();
            $harina->id_usuario = \Auth::user()->id;
            $harina->id_control = $id_control;
            $harina->id_responsable_maquina = \Auth::user()->id;
            $harina->lote = $lote;
            $harina->save();

            $response = [
                'status' => 1,
                'message' => "Iniciada correctamente",
                'data' => $harina
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => "Mezcla de Harina ya iniciada",
                'data' => $harina
            ];
        }


        return response()
            ->json($response);


    }

    public function insertar_detalle(Request $request)
    {


        try {
            $no_orden_produccion = $request->get('no_orden_produccion');

            $harina_enc = MezclaHarina_Enc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                MezclaHarina_Det::query()->getModel(),
                $request->fields,
                'id_Enc_mezclaharina',
                $harina_enc->id_Enc_mezclaharina);

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
            $detalle = MezclaHarina_Det::findOrFail($request->id);

            $response = RealTimeService::borrar_detalle($detalle);

        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => $ex->getMessage()
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
            $mezcla = MezclaHarina_Det::findOrFail($id);
            $mezcla->hora_descarga = $hora_descarga;
            $mezcla->solucion_observacion = $observaciones;
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

}
