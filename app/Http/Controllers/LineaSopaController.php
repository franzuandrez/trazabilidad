<?php

namespace App\Http\Controllers;

use App\Http\tools\RealTimeService;
use App\LineaSopa;
use App\Operacion;
use App\Producto;
use DB;
use Illuminate\Http\Request;

class LineaSopaController extends Controller
{
    //


    public function index(Request $request)
    {
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'id_control' : $request->get('field');


        $sopas = LineaSopa::select('sopas.*', 'productos.descripcion as presentacion', 'users.nombre as responsable')
            ->leftJoin('productos', 'productos.id_producto', '=', 'sopas.id_producto')
            ->join('users', 'users.id', '=', 'sopas.id_usuario')
            ->where(function ($query) use ($search) {
                $query->where('sopas.id_turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('sopas.id_control', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {

            return view('sopas.liberacion.index', compact('sopas', 'search', 'sort', 'sortField'));

        } else {
            return view('sopas.liberacion.ajax', compact('sopas', 'search', 'sort', 'sortField'));
        }
    }


    public function create()
    {


        return view('sopas.liberacion.create');
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


                $productos = Producto::whereIn('id_producto',
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


    public function iniciar_linea_sopas(Request $request)
    {

        $no_orden_produccion = $request->get('no_orden_produccion');
        $id_producto = $request->get('id_producto');
        $id_presentacion = $request->get('id_presentacion');

        $control = DB::table('control_trazabilidad_orden_produccion')
            ->where('id_producto', $id_producto)
            ->where('no_orden_produccion', $no_orden_produccion)
            ->first();

        $chaomin = LineaSopa::where('id_control', $control->id_control)
            ->first();

        if ($chaomin == null) {
            $linea_sopa = new LineaSopa();
            $linea_sopa->id_presentacion = $id_presentacion;
            $linea_sopa->id_control = $control->id_control;
            $linea_sopa->id_producto = $id_producto;
            $linea_sopa->id_usuario = \Auth::user()->id;
            $linea_sopa->id_turno = $request->get('id_turno');
            $linea_sopa->save();

            $response = [
                'status' => 1,
                'message' => 'Iniciada correctamente',
                'data' => $linea_sopa
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
            LineaSopa::find($id_model), $fields
        );


        return response()->json($response);


    }


    public function store(Request $request)
    {
        try {
            $id_chaomin = $request->get('id_sopa');
            $linea_chaomin = LineaSopa::where('id_sopa', $id_chaomin)
                ->firstOrFail();
            $linea_chaomin->observaciones = $request->observaciones_acciones;
            $linea_chaomin->estado = 1;
            $linea_chaomin->save();

            RealTimeService::guardar($linea_chaomin, $request->except(['no_orden_produccion', '_token', 'id_sopa', 'producto']));
            return redirect()->route('sopas.liberacion')
                ->with('success', 'Linea  Finalizada correctamente');
        } catch (\Exception $ex) {

            return redirect()->back()
                ->withErrors(['No se ha podido completar su petición, codigo de error :  ' . $ex->getCode()]);
        }

    }


    public function edit($id)
    {
        $sopa = LineaSopa::with('producto')
            ->findOrFail($id);


        return view('sopas.liberacion.edit', [
            'sopa' => $sopa
        ]);

    }

    public function show($id)
    {

        $sopa = LineaSopa::with('producto')
            ->findOrFail($id);


        return view('sopas.liberacion.show', [
            'sopa' => $sopa
        ]);
    }
}
