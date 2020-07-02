<?php

namespace App\Http\Controllers;

use App\Repository\OrdenProduccionRepository;
use App\Http\tools\RealTimeService;
use App\SecadoDet;
use App\SecadoEnc;
use App\User;
use Illuminate\Http\Request;
use DB;
class SecadoController extends Controller
{
    //

    public function index(Request $request)
    {
        //
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');


        $secos = SecadoEnc::select(
            'secado_enc.*',
            'users.nombre as usuario',
            'productos.descripcion as producto',
            DB::raw("date_format(fecha_ingreso,'%d/%m/%Y %h:%i:%s') as fecha_ingreso")
        )
            ->join('users', 'users.id', '=', 'secado_enc.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'secado_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('secado_enc.id_control', 'LIKE', '%' . $search . '%')
                    ->orWhere('secado_enc.fecha_ingreso', 'LIKE', '%' . $search . '%')
                    ->orWhere('secado_enc.id_turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('control.secado.index',
                compact('secos', 'sort', 'sortField', 'search'));
        } else {

            return view('control.secado.ajax',
                compact('secos', 'sort', 'sortField', 'search'));
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

        return view('control.secado.create',
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
            $LaminadoEnc = SecadoEnc::where('id_control', $orden_produccion)
                ->firstOrFail();
            $LaminadoEnc->observaciones = $request->get('observacion_correctiva');
            $LaminadoEnc->save();
            return redirect()->route('secado.index')
                ->with('success', 'Secado ingresado corrrectamente');
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

        $seco = SecadoEnc::findOrFAil($id);

        return view('control.secado.show', [
            'peso_seco' => $seco
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
        $peso_seco = SecadoEnc::with('control_trazabilidad')
            ->with('control_trazabilidad.producto')
            ->with('control_trazabilidad.liberacion_linea')
            ->findOrFail($id);


        return view('control.secado.edit', [
            'peso_seco' => $peso_seco
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

    public function iniciar_laminado(Request $request)
    {
        $no_orden_produccion = $request->get('no_orden_produccion');


        $linea_chaomin = OrdenProduccionRepository::verificar_linea_chaomin($no_orden_produccion);


        if ($linea_chaomin['status'] == 0) {
            $response = $linea_chaomin;
        } else {

            $response = [
                'status' => 1,
                'message' => 'Secado iniciado correctamente',
                'data' => $linea_chaomin
            ];

        }

        return response()->json($response);
    }

    public function iniciar_formulario(Request $request)
    {

        $id_control = $request->get('id_control');
        $lote = $request->get('lote');


        $humedo = SecadoEnc::where('id_control', $id_control)
            ->first();

        if ($humedo == null) {
            $humedo = new SecadoEnc();
            $humedo->id_usuario = \Auth::user()->id;
            $humedo->id_control = $id_control;
            $humedo->lote = $lote;
            $humedo->save();

            $response = [
                'status' => 1,
                'message' => "Iniciado correctamente",
                'data' => $humedo
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => "Secado  ya iniciado",
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

            $peso_seco = SecadoEnc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                SecadoDet::query()->getModel(),
                $request->fields,
                'id_secado_enc',
                $peso_seco->id_secado_enc);

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
            $detalle = SecadoDet::findOrFail($request->id);

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
            SecadoEnc::where('id_control', $id_model)->first(), $fields
        );


        return response()->json($response);


    }
}
