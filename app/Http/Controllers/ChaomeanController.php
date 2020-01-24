<?php

namespace App\Http\Controllers;

use App\Http\tools\RealTimeService;
use App\LineaChaomin;
use App\Operacion;
use App\Presentacion;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChaomeanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'no_orden_produccion' : $request->get('field');


        $lineas = LineaChaomin::select('chaomin.*')
            ->where(function ($query) use ($search) {
                $query->where('chaomin.no_orden_produccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('chaomin.id_turno', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {

            return view('control.chaomin.index', compact('lineas', 'search', 'sort', 'sortField'));

        } else {
            return view('control.chaomin.ajax', compact('lineas', 'search', 'sort', 'sortField'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $presentaciones = Presentacion::actived()->get();
        $responsables = User::actived()->get();
        return view('control.chaomin.create', compact('presentaciones', 'responsables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $orden_produccion = $request->get('no_orden_produccion');
        $linea_chaomin = LineaChaomin::where('no_orden_produccion', $orden_produccion)
            ->first();

        try {
            RealTimeService::guardar($linea_chaomin, $request->except(['no_orden_produccion', '_token']));
            return redirect()->route('chaomin.index')
                ->with('success', 'Linea para ChaoMin Finalizada correctamente');
        } catch (\Exception $ex) {
            return redirect()->back()
                ->withErrors(['No se ha podido completar su petición, codigo de error :  ' . $ex->getCode()]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
        $presentaciones = Presentacion::actived()->get();
        $chaomin = LineaChaomin::findOrFail($id);
        return view('control.chaomin.show', compact('chaomin', 'presentaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function iniciar_linea_chaomein(Request $request)
    {

        $orden_produccion = $request->no_orden_produccion;
        $existe_orden_produccion = Operacion::where('no_orden_produccion', $orden_produccion)
            ->exists();


        try {


            if ($existe_orden_produccion) {

                $control_iniciado = LineaChaomin::where('no_orden_produccion', $orden_produccion)
                    ->exists();
                if ($control_iniciado) {
                    $response = [
                        'status' => 0,
                        'message' => 'Linea de chaomin ya iniciada'
                    ];
                } else {
                    $linea_chaomin = new LineaChaomin();
                    $linea_chaomin->no_orden_produccion = $orden_produccion;
                    $linea_chaomin->save();

                    $response = [
                        'status' => 1,
                        'message' => 'Creado correctamente',
                        'id' => $linea_chaomin->id_chaomin
                    ];
                }


            } else {
                $response = [
                    'status' => 0,
                    'message' => 'Orden de produccion no existente'
                ];
            }

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
            LineaChaomin::find($id_model), $fields
        );


        return response()->json($response);


    }
}
