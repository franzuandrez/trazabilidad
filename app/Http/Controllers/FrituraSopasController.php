<?php

namespace App\Http\Controllers;

use App\FrituraSopasDet;
use App\FrituraSopasEnc;
use App\Http\tools\OrdenProduccion;
use App\Http\tools\RealTimeService;
use App\LaminadoSopasEnc;
use App\Recepcion;
use App\User;
use Illuminate\Http\Request;

class FrituraSopasController extends Controller
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


        $frituras = FrituraSopasEnc::select('fritura_sopas_enc.*', 'users.nombre as usuario')
            ->join('users', 'users.id', '=', 'fritura_sopas_enc.id_usuario')
            ->where(function ($query) use ($search) {
                $query->where('fritura_sopas_enc.id_turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('fritura_sopas_enc.fecha_hora', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {
            return view('sopas.frituras.index',
                compact('frituras', 'sort', 'sortField', 'search'));
        } else {

            return view('sopas.frituras.ajax',
                compact('frituras', 'sort', 'sortField', 'search'));
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

        return view('sopas.frituras.create',
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
            $mezlcado_sopas = FrituraSopasEnc::where('id_control', $orden_produccion)
                ->firstOrFail();
            $mezlcado_sopas->observaciones = $request->get('acciones');
            $mezlcado_sopas->save();
            return redirect()->route('fritura.index')
                ->with('success', 'Fritura de Sopas ingresada corrrectamente');
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


    public function iniciar_fritura(Request $request)
    {
        $no_orden_produccion = $request->get('no_orden_produccion');


        $linea_chaomin = OrdenProduccion::verificar_linea_sopas($no_orden_produccion);


        if ($linea_chaomin['status'] == 0) {
            $response = $linea_chaomin;
        } else {
            $response = [
                'status' => 1,
                'message' => 'Fritura de sopas iniciado correctamente',
                'data' => $linea_chaomin
            ];


        }

        return response()->json($response);
    }


    public function iniciar_formulario(Request $request)
    {

        $id_control = $request->get('id_control');
        $id_producto = $request->get('id_producto');


        $laminado = FrituraSopasEnc::where('id_control', $id_control)
            ->first();

        if ($laminado == null) {
            $laminado = new FrituraSopasEnc();
            $laminado->id_usuario = \Auth::user()->id;
            $laminado->id_control = $id_control;
            $laminado->fecha_hora = \Carbon\Carbon::now();
            $laminado->id_producto = $id_producto;
            $laminado->save();

            $response = [
                'status' => 1,
                'message' => "Iniciado correctamente",
                'data' => $laminado
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => "Fritura ya iniciado",
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

            $peso_humedo = FrituraSopasEnc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                FrituraSopasDet::query()->getModel(),
                $request->fields,
                'id_fritura_sopas_enc',
                $peso_humedo->id_frutura_sopas_enc);

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
            $detalle = FrituraSopasDet::findOrFail($request->id);

            $response = RealTimeService::borrar_detalle($detalle);

        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => $ex->getMessage()
            ];
        }

        return response()->json($response);


    }
}
