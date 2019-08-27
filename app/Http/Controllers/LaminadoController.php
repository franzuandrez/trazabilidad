<?php

namespace App\Http\Controllers;


use App\Laminado_Det;
use App\Laminado_Enc;
use App\Recepcion;
use App\User;
use Illuminate\Http\Request;
use DB;

class LaminadoController extends Controller
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
        //FUNCION PARA CARGAR BOTONES Y  EL LISTADO DE LAMINADOS INGRESADOS
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'orden_compra' : $request->get('field');



        $recepciones = Recepcion::join('proveedores', 'proveedores.id_proveedor', '=', 'recepcion_encabezado.id_proveedor')
            ->join('productos', 'productos.id_producto', '=', 'recepcion_encabezado.id_producto')
            ->select('recepcion_encabezado.*', 'productos.descripcion as producto', 'proveedores.razon_social as proveedor')
            ->where(function ($query) use ($search) {
                $query->where('proveedores.razon_social', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('recepcion_encabezado.orden_compra', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);
        if ($request->ajax()) {
            return view('control.laminado.index',
                compact('recepciones', 'sort', 'sortField', 'search'));
        } else {

            return view('control.laminado.ajax',
                compact('recepciones', 'sort', 'sortField', 'search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //AL PULSAR EL BOTON CREAR NOS LLEVA A ESTA VISTA
        $responsables = User::actived()->get();

        return view('control.laminado.create',
            compact('responsables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


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

    public function store(Request $request)
    {
        /// FUNCION PARA GUARDAR CAMBIOS
        dd($request->all());
        try
        {
            DB::beginTransaction();
            //Insertar el encabezado de laminado
            $LaminadoEnc = new Laminado_Enc();
            $LaminadoEnc->id_responsable = $request->get('id_responsable');
            $LaminadoEnc->id_usuario = \Auth::user()->id;
            $LaminadoEnc->turno = $request->get('turno');
            $LaminadoEnc->observaciones = $request->get('observacion_correctiva');
            $LaminadoEnc->no_orden = $request->get('NO_ORDEN_PRODUCCION');
            $LaminadoEnc->save();
            $this->GuardarDetalle($request, $LaminadoEnc->id_enc_laminado);
            DB::commit();
            return redirect()->route('laminado.index')
                ->with('success', 'Laminado ingresada corrrectamente');
        }catch (\Exception $ex)
        {
            DB::rollBack();
            dd("ERROR AL GUARDA ENCABEZADO");
        }
    }

    private function GuardarDetalle($request, $id_enc_Laminado)
    {


        $detalleLaminado = $request->get('LOTE');

        if (is_iterable($detalleLaminado)) {


            foreach ($detalleLaminado as $key => $value) {
                $detalleLaminado1 = Laminado_Det::create([
                    'lote_producto' => $value,
                    'id_enc_laminado' => $id_enc_Laminado,
                    'temperatura_inicio' => $request->get('temperatura_inicial')[$key] ,
                    'temperatura_final'=> $request->get('temperatura_final')[$key] ,
                    'temperatura_observaciones'=> $request->get('temperatura_observaciones')[$key] ,
                    'espesor_inicio'=> $request->get('espesor_inicial')[$key] ,
                    'espesor_final' => $request->get('espesor_final')[$key] ,
                    'espesor_observaciones'=> $request->get('espesor_observaciones')[$key],
                    'lote_producto'=> $request->get('LOTE')[$key],
                    'hora'=> $request->get('hora')[$key]
                ]) ;
            }
        }

    }


}
