<?php

namespace App\Http\Controllers;

use App\Operacion;
use App\PesoCondimentoDet;
use App\PesoCondimentoEnc;
use App\PesoHumedoEnc;
use Illuminate\Http\Request;
use DB;

use App\Http\tools\RealTimeService;
class PesoCondimentosController extends Controller
{
    //
    public function index(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');


        $pesos = PesoCondimentoEnc::select(
            'peso_condimentos_enc.*',
            'users.nombre as usuario',
            'productos.descripcion as producto',
            DB::raw("date_format(fecha_ingreso,'%d/%m/%Y %h:%i:%s') as fecha_ingreso")
        )
            ->join('users', 'users.id', '=', 'peso_condimentos_enc.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'peso_condimentos_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('peso_condimentos_enc.no_orden', 'LIKE', '%' . $search . '%')
                    ->orWhere('peso_condimentos_enc.fecha_ingreso', 'LIKE', '%' . $search . '%')
                    ->orWhere('peso_condimentos_enc.turno', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(12);


        if ($request->ajax()) {
            return view('condimentos.pesos.index',
                compact('pesos', 'sort', 'sortField', 'search'));
        } else {

            return view('condimentos.pesos.ajax',
                compact('pesos', 'sort', 'sortField', 'search'));
        }
    }

    public function create()
    {

        return view('condimentos.pesos.create');
    }

    public function edit($id)
    {

        $formulario = PesoCondimentoEnc::findOrFail($id);
        return view('condimentos.pesos.edit', compact('formulario'));
    }
    public function show($id)
    {

        $formulario = PesoCondimentoEnc::findOrFail($id);
        return view('condimentos.pesos.show', compact('formulario'));
    }

    public function store(Request $request)
    {
        try {

            $orden_produccion = $request->get('id_control');
            $formulario = PesoCondimentoEnc::where('id_control', $orden_produccion)
                ->firstOrFail();
            $formulario->observaciones = $request->get('observacion_correctiva');
            $formulario->save();
            return redirect()->route('peso_condimentos')
                ->with('success', 'Ingresado corrrectamente');
        } catch (\Exception $ex) {

            return redirect()->back()
                ->withErrors(['No se ha podido completar su petición, codigo de error :  ' . $ex->getCode()]);
        }
    }


    public function iniciar_formulario(Request $request)

    {
        $id_control = $request->get('id_control');
        $lote = $request->get('lote');
        $turno = $request->get('turno');


        $formulario = PesoCondimentoEnc::where('id_control', $id_control)
            ->first();
        if ($formulario == null) {
            $formulario = new PesoCondimentoEnc();
            $formulario->id_usuario = \Auth::user()->id;
            $formulario->id_control = $id_control;
            $formulario->turno = $turno;
            $formulario->lote = $lote;
            $formulario->save();

            $response = [
                'status' => 1,
                'message' => "Iniciado correctamente",
                'data' => $formulario
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => "Formulario ya iniciado",
                'data' => $formulario
            ];
        }
        return response()
            ->json($response);

    }

    public function buscar_orden_produccion(Request $request)
    {
        $no_orden_produccion = $request->get('no_orden_produccion');


        $controles = DB::table('control_trazabilidad_orden_produccion')
            ->where('no_orden_produccion', $no_orden_produccion)
            ->get();

        $trazabilidad = Operacion::whereIn('id_control', $controles->pluck('id_control')->toArray())
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->select('control_trazabilidad.*')
            ->where('productos.tipo_producto', 'PP')
            ->with('producto')
            ->get();


        if ($trazabilidad->count() == 0) {
            $response = $trazabilidad;
        } else {
            $response = [
                'status' => 1,
                'message' => 'Encontrado',
                'data' => [
                    'data' => $trazabilidad
                ]
            ];
        }

        return response()->json($response);

    }

    public function insertar_detalle(Request $request)
    {


        try {
            $no_orden_produccion = $request->get('no_orden_produccion');

            $formulario = PesoCondimentoEnc::where('id_control', $no_orden_produccion)
                ->first();

            $response = RealTimeService::insertar_detalle(
                PesoCondimentoDet::query()->getModel(),
                $request->fields,
                'id_peso_enc',
                $formulario->id_peso_enc);

        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => $ex->getMessage(),
            ];
        }


        return response()->json($response);
    }

}
