<?php

namespace App\Http\Controllers;

use App\Http\tools\OrdenProduccion;
use App\Http\tools\RealTimeService;
use App\PrecocidoDet;
use App\PrecocidoEnc;
use App\Recepcion;
use App\User;
use Illuminate\Http\Request;

class PrecocidoController extends Controller
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


        $precocidos = PrecocidoEnc::join('users', 'users.id', '=', 'precocido_enc.id_usuario')
            ->select('precocido_enc.*', 'users.nombre as usuario')
            ->where(function ($query) use ($search) {
                $query->where('precocido_enc.no_orden', 'LIKE', '%' . $search . '%')
                    ->orWhere('precocido_enc.fecha_ingreso', 'LIKE', '%' . $search . '%')
                    ->orWhere('precocido_enc.turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');

            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('control.precocido.index',
                compact('precocidos', 'sort', 'sortField', 'search'));
        } else {

            return view('control.precocido.ajax',
                compact('precocidos', 'sort', 'sortField', 'search'));
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

        return view('control.precocido.create',
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
            $LaminadoEnc = PrecocidoEnc::where('no_orden', $orden_produccion)
                ->firstOrFail();
            $LaminadoEnc->observaciones = $request->get('observacion_correctiva');
            $LaminadoEnc->save();
            return redirect()->route('precocido.index')
                ->with('success', 'Precocido de pasta ingresado corrrectamente');
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

        $precocido = PrecocidoEnc::findOrFail($id);




        return view('control.precocido.show', [
            'precocido' => $precocido
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

        $laminado = PrecocidoEnc::where('no_orden', $no_orden_produccion)
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
                if ($laminado != null) {
                    $response = [
                        'status' => 0,
                        'message' => 'Precocio de Pasta ya iniciado'
                    ];
                } else {
                    $precocido = new PrecocidoEnc();
                    $precocido->no_orden = $no_orden_produccion;
                    $precocido->id_usuario = \Auth::user()->id;
                    $precocido->save();
                    $response = [
                        'status' => 1,
                        'message' => 'Precocido de pasta iniciado correctamente',
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

            $precocido = PrecocidoEnc::where('no_orden', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                PrecocidoDet::query()->getModel(),
                $request->fields,
                'id_precocido_enc',
                $precocido->id_precocido_enc);

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
            $detalle = PrecocidoDet::findOrFail($request->id);

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
            PrecocidoEnc::where('no_orden', $id_model)->first(), $fields
        );


        return response()->json($response);


    }
}
