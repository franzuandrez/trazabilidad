<?php

namespace App\Http\Controllers;

use App\Http\tools\OrdenProduccion;
use App\Http\tools\RealTimeService;
use App\PesoSecoDet;
use App\PesoSecoEnc;
use App\Recepcion;
use App\User;
use Illuminate\Http\Request;

class PesoSecoController extends Controller
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


        $secos = PesoSecoEnc::select('peso_seco_enc.*', 'users.nombre as usuario')
            ->join('users', 'users.id', '=', 'peso_seco_enc.id_usuario')
            ->where(function ($query) use ($search) {
                $query->where('peso_seco_enc.no_orden', 'LIKE', '%' . $search . '%')
                    ->orWhere('peso_seco_enc.fecha_ingreso', 'LIKE', '%' . $search . '%')
                    ->orWhere('peso_seco_enc.turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('control.peso_seco.index',
                compact('secos', 'sort', 'sortField', 'search'));
        } else {

            return view('control.peso_seco.ajax',
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

        return view('control.peso_seco.create',
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

            $orden_produccion = $request->get('no_orden_produccion');
            $LaminadoEnc = PesoSecoEnc::where('no_orden', $orden_produccion)
                ->firstOrFail();
            $LaminadoEnc->observaciones = $request->get('observacion_correctiva');
            $LaminadoEnc->save();
            return redirect()->route('peso_seco.index')
                ->with('success', 'Peso seco ingresado corrrectamente');
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

        $seco = PesoSecoEnc::findOrFAil($id);

        return view('control.peso_seco.show', [
            'humedo' => $seco
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

        $peso_seco = PesoSecoEnc::where('no_orden', $no_orden_produccion)
            ->first();


        if ($linea_chaomin['status'] == 0) {
            $response = $linea_chaomin;
        } else {
            if ($linea_chaomin['data']->estado == 0) {
                $response = [
                    'status' => 0,
                    'message' => 'Linea chaomin aun en proceso'
                ];
            } else {
                if ($peso_seco != null) {
                    $response = [
                        'status' => 0,
                        'message' => 'Peso Seco ya iniciado'
                    ];
                } else {
                    $peso_seco = new PesoSecoEnc();
                    $peso_seco->no_orden = $no_orden_produccion;
                    $peso_seco->id_usuario = \Auth::user()->id;
                    $peso_seco->save();
                    $response = [
                        'status' => 1,
                        'message' => 'Peso Seco iniciado correctamente',
                        'data' => $linea_chaomin
                    ];

                }
            }

        }

        return response()->json($response);
    }

    public function insertar_detalle(Request $request)
    {


        try {
            $no_orden_produccion = $request->get('no_orden_produccion');

            $peso_seco = PesoSecoEnc::where('no_orden', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                PesoSecoDet::query()->getModel(),
                $request->fields,
                'id_peso_seco_enc',
                $peso_seco->id_peso_seco);

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
            $detalle = PesoSecoDet::findOrFail($request->id);

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
            PesoSecoEnc::where('no_orden', $id_model)->first(), $fields
        );


        return response()->json($response);


    }
}
