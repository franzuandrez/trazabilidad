<?php

namespace App\Http\Controllers;

use App\LineaChaomin;
use App\Presentacion;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChaomeanController extends Controller
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
     * @return \Illuminate\Http\Response
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd("geovany");
        $linea_chaomin = new LineaChaomin();
        $linea_chaomin->no_orden_produccion = $request->get('no_orden_produccion');
        $linea_chaomin->id_presentacion = $request->get('id_presentacion');
        $linea_chaomin->id_turno = $request->get('id_turno');
        $linea_chaomin->cant_solucion_carga = $request->get('cant_solucion_carga');
        $linea_chaomin->cant_carga_salida = $request->get('cant_carga_salida');
        $linea_chaomin->cantidad_solucion_observacion = $request->get('cantidad_solucion_observacion');
        $linea_chaomin->ph_solucion_inicial = $request->get('ph_solucion_inicial');
        $linea_chaomin->ph_solucion_final = $request->get('ph_solucion_final');
        $linea_chaomin->ph_solucion_observacion = $request->get('ph_solucion_observacion');
        $linea_chaomin->mezcla_seca_inicial = $request->get('mezcla_seca_inicial');
        $linea_chaomin->mezcla_seca_final = $request->get('mezcla_seca_final');
        $linea_chaomin->mezcla_seca_observacion = $request->get('mezcla_seca_observacion');
        $linea_chaomin->mezcla_alta_inicial = $request->get('mezcla_alta_inicial');
        $linea_chaomin->mezcla_alta_final = $request->get('mezcla_alta_final');
        $linea_chaomin->mezcla_alta_observacion = $request->get('mezcla_alta_observacion');
        $linea_chaomin->mezcla_baja_inicial = $request->get('mezcla_baja_inicial');
        $linea_chaomin->mezcla_baja_final = $request->get('mezcla_baja_final');
        $linea_chaomin->mezcla_baja_observacion = $request->get('mezcla_baja_observacion');
        $linea_chaomin->temperatura_reposo_inicial = $request->get('temperatura_reposo_inicial');
        $linea_chaomin->temperatura_reposo_final = $request->get('temperatura_reposo_final');
        $linea_chaomin->temperatura_reposo_observacion = $request->get('temperatura_reposo_observacion');
        $linea_chaomin->ancho_cartucho_inicial = $request->get('ancho_cartucho_inicial');
        $linea_chaomin->ancho_cartucho_final = $request->get('ancho_cartucho_final');
        $linea_chaomin->ancho_cartucho_observacion = $request->get('ancho_cartucho_observacion');
        $linea_chaomin->temperatura_precocedora_1_inicial = $request->get('temperatura_precocedora_1_inicial');
        $linea_chaomin->temperatura_precocedora_1_final = $request->get('temperatura_precocedora_1_final');
        $linea_chaomin->temperatura_precocedora_1_observacion = $request->get('temperatura_precocedora_1_observacion');
        $linea_chaomin->tiempo_precocedora_1_inicial = $request->get('tiempo_precocedora_1_inicial');
        $linea_chaomin->tiempo_precocedora_1_final = $request->get('tiempo_precocedora_1_final');
        $linea_chaomin->tiempo_precocedora_1_observacion = $request->get('tiempo_precocedora_1_observacion');
        $linea_chaomin->temperatura_precocedora_2_inicial = $request->get('temperatura_precocedora_2_inicial');
        $linea_chaomin->temperatura_precocedora_2_final = $request->get('temperatura_precocedora_2_final');
        $linea_chaomin->temperatura_precocedora_2_observacion = $request->get('temperatura_precocedora_2_observacion');
        $linea_chaomin->tiempo_precocedora_2_inicial = $request->get('tiempo_precocedora_2_inicial');
        $linea_chaomin->tiempo_precocedora_2_final = $request->get('tiempo_precocedora_2_final');
        $linea_chaomin->tiempo_precocedora_2_observacion = $request->get('tiempo_precocedora_2_observacion');
        $linea_chaomin->temperatura_central_inicial = $request->get('temperatura_central_inicial');
        $linea_chaomin->temperatura_central_final = $request->get('temperatura_central_final');
        $linea_chaomin->temperatura_central_observaciones = $request->get('temperatura_central_observaciones');
        $linea_chaomin->velocidad_pass200_inicial = $request->get('velocidad_pass200_inicial');
        $linea_chaomin->velocidad_pass200_final = $request->get('velocidad_pass200_final');
        $linea_chaomin->velocidad_pass200_observaciones = $request->get('velocidad_pass200_observaciones');
        $linea_chaomin->velocidad_pasc180_inicial = $request->get('velocidad_pasc180_inicial');
        $linea_chaomin->velocidad_pasc180_final = $request->get('velocidad_pasc180_final');
        $linea_chaomin->velocidad_pasc180_observaciones = $request->get('velocidad_pasc180_observaciones');
        $linea_chaomin->velocidad_pask180_inicial = $request->get('velocidad_pask180_inicial');
        $linea_chaomin->velocidad_pask180_final = $request->get('velocidad_pask180_final');
        $linea_chaomin->velocidad_pask180_observaciones = $request->get('velocidad_pask180_observaciones');
        $linea_chaomin->velocidad_pasi180_inicial = $request->get('velocidad_pasi180_inicial');
        $linea_chaomin->velocidad_pasi180_final = $request->get('velocidad_pasi180_final');
        $linea_chaomin->velocidad_pasi180_observaciones = $request->get('velocidad_pasi180_observaciones');


        $linea_chaomin->velocidad_pasm160_inicial = $request->get('velocidad_pasm160_inicial');
        $linea_chaomin->velocidad_pasm160_final = $request->get('velocidad_pasm160_final');
        $linea_chaomin->velocidad_pasm160_observaciones = $request->get('velocidad_pasm160_observaciones');
        $linea_chaomin->extractor_activo_inicial = $request->get('extractor_activo_inicial');
        $linea_chaomin->extractor_activo_final = $request->get('extractor_activo_final');
        $linea_chaomin->extractor_activo_observaciones = $request->get('extractor_activo_observacion');
        $linea_chaomin->ventilacion_inicial = $request->get('ventilacion_inicial');
        $linea_chaomin->ventilacion_final = $request->get('ventilacion_final');
        $linea_chaomin->ventilacion_observacion = $request->get('ventilacion_observacion');
        $linea_chaomin->verificacion_codificacion_lote = $request->get('verificacion_codificacion_lote');
        $linea_chaomin->verificacion_codificacion_vence = $request->get('verificacion_codificacion_vence');
        $linea_chaomin->verificacion_codificacion_obs = $request->get('verificacion_codificacion_obs');
        $linea_chaomin->id_maquina = $request->get('id_maquina');
        $linea_chaomin->maquina_inicial = $request->get('maquina_inicial');
        $linea_chaomin->maquina_final = $request->get('maquina_final');
        $linea_chaomin->sellos_observaciones = $request->get('sellos_observaciones');
        $linea_chaomin->observaciones_acciones = $request->get('observaciones_acciones');
        $linea_chaomin->responsable = Auth::user()->id;
        $linea_chaomin->save();


        return redirect()->route('chaomin.index')
            ->with('success', 'Linea para ChaoMin dado de alta correctamente');


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
        $presentaciones = Presentacion::actived()->get();
        $chaomin = LineaChaomin::findOrFail($id);
        return view('control.chaomin.show', compact('chaomin', 'presentaciones'));
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

    public function iniciar_linea_chaomein(Request $request)
    {



        try {
            $linea_chaomin = new LineaChaomin();
            $linea_chaomin->no_orden_produccion = $request->no_orden_produccion;
            $linea_chaomin->save();

            $response = [
                'status' => 1,
                'message' => 'Creado correctamente',

            ];
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
        $field = $request->field;
        $value = $request->value;

        $rows = DB::table('linea_chaomin')
            ->where('id_chaomin', $id_model)
            ->update([$field => $value]);

        return response()->json([
            'rows_affected' => $rows
        ]);


    }
}
