<?php

namespace App\Http\Controllers;

use App\Http\tools\RealTimeService;
use App\LineaChaomin;
use App\Operacion;
use App\Presentacion;
use App\Producto;
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
        $sortField = $request->get('field') == null ? 'id_control' : $request->get('field');

        $lineas = LineaChaomin::select(
            'chaomin.*',
            'presentaciones.descripcion as presentacion',
            'productos.descripcion as producto',
            'users.nombre as responsable'
        )
            ->leftJoin('presentaciones', 'presentaciones.id_presentacion', '=', 'chaomin.id_presentacion')
            ->leftJoin('productos', 'productos.id_producto', '=', 'chaomin.id_producto')
            ->join('users', 'users.id', '=', 'chaomin.responsable')
            ->where(function ($query) use ($search) {
                $query->where('chaomin.id_control', 'LIKE', '%' . $search . '%')
                    ->orWhere('chaomin.id_turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('chaomin.verificacion_codificacion_lote', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('presentaciones.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%')
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


        try {
            $id_chaomin = $request->get('id_chaomin');
            $linea_chaomin = LineaChaomin::where('id_chaomin', $id_chaomin)
                ->firstOrFail();
            $linea_chaomin->observaciones_acciones = $request->observaciones_acciones;
            $finalizo_liberacion = $request->get('verificacion_codificacion_lote') !== null
                &&
                $request->get('verificacion_codificacion_lote') !== "";
            if ($finalizo_liberacion) {
                $linea_chaomin->estado = 1;
            }
            $linea_chaomin->save();

            RealTimeService::guardar($linea_chaomin, $request->except(['no_orden_produccion', '_token', 'id_chaomin', 'producto']));
            return redirect()->route('chaomin.index')
                ->with('success', 'Linea  Finalizada correctamente');
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

        $chaomin = LineaChaomin::with('producto')
            ->findOrFail($id);


        return view('control.chaomin.edit', [
            'chaomin' => $chaomin
        ]);
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

    public function verficar_no_orden_produccion(Request $request)
    {

        $orden_produccion = $request->no_orden_produccion;

        $control = DB::table('control_trazabilidad_orden_produccion')
            ->where('no_orden_produccion', $orden_produccion)
            ->get();
        $id_control = $control->pluck('id_control')->toArray();

        $existe_orden_produccion = Operacion::whereIn('id_control', $id_control)
            ->exists();


        try {


            if ($existe_orden_produccion) {


                $productos = Producto::with('presentaciones')->whereIn('id_producto',
                    $control->pluck('id_producto')->toArray()
                )->get();
                $response = [
                    'status' => 1,
                    'message' => 'Siguiente paso',
                    'data' => $productos
                ];


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


    public function iniciar_linea_chaomein(Request $request)
    {

        $no_orden_produccion = $request->get('no_orden_produccion');
        $id_producto = $request->get('id_producto');
        $id_presentacion = $request->get('id_presentacion');

        $control = DB::table('control_trazabilidad_orden_produccion')
            ->where('id_producto', $id_producto)
            ->where('no_orden_produccion', $no_orden_produccion)
            ->first();

        $chaomin = LineaChaomin::where('id_control', $control->id_control)
            ->first();

        if ($chaomin == null) {
            $linea_chaomein = new LineaChaomin();
            $linea_chaomein->id_presentacion = $id_presentacion;
            $linea_chaomein->id_control = $control->id_control;
            $linea_chaomein->id_producto = $id_producto;
            $linea_chaomein->responsable = \Auth::user()->id;
            $linea_chaomein->id_turno = $request->get('id_turno');
            $linea_chaomein->save();

            $response = [
                'status' => 1,
                'message' => 'Iniciada correctamente',
                'data' => $linea_chaomein
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => 'Liberacion ya iniciada',
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
