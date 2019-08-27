<?php

namespace App\Http\Controllers;

use App\DetalleLotes;
use App\LineaChaomin;
use App\MezclaHarina_Det;
use App\MezclaHarina_Enc;
use App\Presentacion;
use App\Recepcion;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class MezclaHarinaController extends Controller
{

    public function index(Request $request)
    {
        //
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'no_orden_produccion' : $request->get('field');


        $lineas = MezclaHarina_Enc::select('chaomin.*')
            ->where(function ($query) use ($search){
                $query->where('chaomin.no_orden_produccion','LIKE','%'.$search.'%')
                    ->orWhere('chaomin.id_turno','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);


        if($request->ajax()){

            return view('control.Mezcla_Harina.index',compact('lineas','search','sort','sortField'));

        }else{
            return view('control.Mezcla_Harina.ajax',compact('lineas','search','sort','sortField'));
        }
    }

    public function create()
    {
        //
        $responsables = User::actived()->get();

        return view('control.mezcla_harina.create',
            compact('responsables'));
    }

    public function store(Request $request)
    {
        //dd(Carbon::now());
      //dd($request->all());
       // dd($request->"NO_ORDEN_PRODUCCION");
        try {
           DB::beginTransaction();

            //Insertar recepcion encabezado.

            $MezclaHarina = new MezclaHarina_Enc();
            $MezclaHarina->no_orden = $request->get('NO_ORDEN_PRODUCCION');
            $MezclaHarina->id_responsable_maquina = $request->get('id_responsable');
            $MezclaHarina->observaciones = $request->get('observacion_correctiva');
            $MezclaHarina->id_usuario = \Auth::user()->id;
            //$MezclaHarina->puesto = $request->get('puesto');
            $MezclaHarina->save();

            $this->GuardarDetalle($request, $MezclaHarina->id_Enc_mezclaharina);

           DB::commit();

            return redirect()->route('recepcion.materia_prima.index')
                ->with('success', 'Materia prima ingresada corrrectamente');
        } catch (\Exception $e) {

            DB::rollback();
            dd($e);
             return redirect()->route('recepcion.materia_prima.index')
                ->withErrors(['Lo sentimos, su peticion no puede ser procesada en este momento ']);

        }

    }

    private function GuardarDetalle($request, $id_enc_MezclaHarina)
    {


        //$detalleMezclaHarina = $request->get('id_producto');
        $detalleMezclaHarina = $request->get('id_producto');

        if (is_iterable($detalleMezclaHarina)) {


            foreach ($detalleMezclaHarina as $key => $value) {
                $detalleLote = MezclaHarina_Det::create([
                'id_producto' => $value,
                'codigo_producto' => $request->get('codigo_producto')[$key],
                'lote' => $request->get('lote')[$key] ,
                'hora_carga'=> $request->get('hora_carga')[$key] ,
                'hora_descarga'=> $request->get('hora_descarga')[$key] ,
                'solucion_inicial'=> $request->get('solucion_inicial')[$key] ,
                'solucion_final' => $request->get('solucion_final')[$key] ,
                'solucion_observacion'=> $request->get('solucion_observacion')[$key],
                'ph_inicial'=> $request->get('ph_inicial')[$key] ,
                'ph_final' => $request->get('ph_final')[$key] ,
                'ph_observacion'=> $request->get('ph_observacion')[$key],
                'id_enc_mezclaharina' => $id_enc_MezclaHarina
                ]);
            }
        }

    }

    private function saveDetalleLotes($request, $id_recepcion)
    {


        $productos = $request->get('descripcion_producto');

        if (is_iterable($productos)) {


            foreach ($productos as $key => $value) {

                $detalleLote = DetalleLotes::create([
                    'id_producto' => $value,
                    'cantidad' => $request->get('cantidad')[$key],
                    'no_lote' => $request->get('no_lote')[$key],
                    'fecha_vencimiento' => $request->get('fecha_vencimiento')[$key],
                    'id_recepcion_enc' => $id_recepcion
                ]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $presentaciones =Presentacion::actived()->get();
        $chaomin = LineaChaomin::findOrFail($id);
        return view('control.mezcla_harina.show',compact('chaomin','presentaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
