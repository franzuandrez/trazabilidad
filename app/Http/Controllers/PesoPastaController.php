<?php

namespace App\Http\Controllers;

use App\Http\tools\OrdenProduccion;
use App\Http\tools\RealTimeService;
use App\PesoPastaSopasDet;
use App\PesoPastaSopasEnc;
use App\User;
use DB;
use Illuminate\Http\Request;

class PesoPastaController extends Controller
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


        $pesos = PesoPastaSopasEnc::select(
            'peso_pasta_enc.*',
            DB::raw("date_format(fecha_hora,'%d/%m/%Y %h:%i:%s') as fecha_hora"),
            'users.nombre as usuario',
            'productos.descripcion as producto'
        )
            ->join('users', 'users.id', '=', 'peso_pasta_enc.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'peso_pasta_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('peso_pasta_enc.id_turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('peso_pasta_enc.id_control', 'LIKE', '%' . $search . '%')
                    ->orWhere('peso_pasta_enc.fecha_hora', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {
            return view('sopas.peso_pasta.index',
                compact('pesos', 'sort', 'sortField', 'search'));
        } else {

            return view('sopas.peso_pasta.ajax',
                compact('pesos', 'sort', 'sortField', 'search'));
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

        return view('sopas.peso_pasta.create',
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
            $mezlcado_sopas = PesoPastaSopasEnc::where('id_control', $orden_produccion)
                ->firstOrFail();
            $mezlcado_sopas->observaciones = $request->get('observacion_correctiva');
            $mezlcado_sopas->save();
            return redirect()->route('peso_pasta.index')
                ->with('success', 'Peso de Sopas ingresada corrrectamente');
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
        $peso = PesoPastaSopasEnc::with('control_trazabilidad')
            ->with('control_trazabilidad.producto')
            ->with('control_trazabilidad.liberacion_sopas')
            ->findOrFail($id);


        return view('sopas.peso_pasta.show', [
            'peso' => $peso
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
        $peso = PesoPastaSopasEnc::with('control_trazabilidad')
            ->with('control_trazabilidad.producto')
            ->with('control_trazabilidad.liberacion_sopas')
            ->findOrFail($id);


        return view('sopas.peso_pasta.edit', [
            'peso' => $peso
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

    public function iniciar_peso(Request $request)
    {
        $no_orden_produccion = $request->get('no_orden_produccion');


        $linea_chaomin = OrdenProduccion::verificar_linea_sopas($no_orden_produccion);


        if ($linea_chaomin['status'] == 0) {
            $response = $linea_chaomin;
        } else {
            $response = [
                'status' => 1,
                'message' => 'Peso de sopas iniciado correctamente',
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


        $laminado = PesoPastaSopasEnc::where('id_control', $id_control)
            ->first();

        if ($laminado == null) {
            $laminado = new PesoPastaSopasEnc();
            $laminado->id_usuario = \Auth::user()->id;
            $laminado->id_control = $id_control;
            $laminado->fecha_hora = \Carbon\Carbon::now();
            $laminado->id_producto = $id_producto;
            $laminado->lote = $lote;
            $laminado->id_turno = $turno;
            $laminado->save();

            $response = [
                'status' => 1,
                'message' => "Iniciado correctamente",
                'data' => $laminado
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => "Peso ya iniciado",
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

            $peso_humedo = PesoPastaSopasEnc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                PesoPastaSopasDet::query()->getModel(),
                $request->fields,
                'id_peso_pasta_enc',
                $peso_humedo->id_peso_pasta_enc);

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
            $detalle = PesoPastaSopasDet::findOrFail($request->id);

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
