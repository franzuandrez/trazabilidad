<?php

namespace App\Http\Controllers;

use App\EntregaDet;
use App\EntregaEnc;
use App\Operacion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupervisionTarimasController extends Controller
{
    //


    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'entrega_pt_enc.fecha_hora' : $request->get('field');


        $entrega_enc = EntregaDet::select('id_enc')
            ->where('no_tarima', $search)
            ->orWhere('sscc', $search)
            ->groupBy('id_enc')
            ->first();


        $collection = EntregaEnc::select('entrega_pt_enc.*', 'users.nombre', 'productos.descripcion', 'control_trazabilidad.lote')
            ->join('users', 'users.id', '=', 'entrega_pt_enc.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'entrega_pt_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->orWhere('entrega_pt_enc.estado', '=', 1);


        if (!is_null($entrega_enc)) {
            $collection = $collection->where('entrega_pt_enc.id', $entrega_enc->id_enc);
        }


        $collection = $collection->paginate(20);


        if ($request->ajax()) {

            return view('entregas.supervision.index'
                , [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'collection' => $collection

                ]);
        }
        return view('entregas.supervision.ajax', [
            'search' => $search,
            'sort' => $sort,
            'sortField' => $sortField,
            'collection' => $collection

        ]);
    }


    public function edit($id)
    {

        $entrega_enc = EntregaEnc::find($id);

        if ($entrega_enc->estado != 1) {
            return
                redirect()
                    ->back()
                    ->withErrors(['Entrega no encontrada']);
        }
        $control_trazabilidad = Operacion::find($entrega_enc->id_control);


        $entrega_det = EntregaDet::select(\DB::raw('sum(cantidad)as total_cajas'), 'entrega_pt_det.*')
            ->where('id_enc', $entrega_enc->id)
            ->groupBy('no_tarima')
            ->groupBy('unidad_medida')
            ->get();

        return view('entregas.supervision.edit', [
            'entrega_enc' => $entrega_enc,
            'entrega_det' => $entrega_det,
            'control_trazabilidad' => $control_trazabilidad
        ]);

    }


    public function update($id, Request $request)
    {

    }


    public function verficar_tarima(Request $request)
    {


        $entrega_det = EntregaDet::select(\DB::raw('sum(cantidad)as total_cajas'), 'entrega_pt_det.*')
            ->where('no_tarima', $request->no_tarima)
            ->groupBy('no_tarima')
            ->groupBy('unidad_medida')
            ->first();


        if (is_null($entrega_det)) {
            return response([
                'success' => false,
                'data' => 'Tarima no encontrada'
            ]);

        }


        if (!is_null($entrega_det->fecha_supervision)) {
            return response([
                'success' => false,
                'data' => 'Tarima ya verificada'
            ]);

        }

        if (intval($entrega_det->total_cajas) != intval($request->cantidad)) {
            return response([
                'success' => false,
                'data' => 'Cantidad incorrecta'
            ]);
        }

        \DB::table('entrega_pt_det')
            ->where('no_tarima', $request->no_tarima)
            ->update([
                'fecha_supervision' => Carbon::now(),
                'supervisor' => \Auth::user()->id
            ]);

        $finalizo = !EntregaDet::where('id_enc', $entrega_det->id_enc)
            ->whereNull('fecha_supervision')
            ->exists();

        if ($finalizo) {
            $entrega_enc = EntregaEnc::find($entrega_det->id_enc);
            $entrega_enc->fecha_supervisado = Carbon::now();
            $entrega_enc->supervisor = \Auth::id();
            $entrega_enc->estado = 2;
            $entrega_enc->save();
        }

        return response([
            'success' => true,
            'data' => 'Leido correctamente'
        ]);


    }
}
