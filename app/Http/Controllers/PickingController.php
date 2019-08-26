<?php

namespace App\Http\Controllers;

use App\Requisicion;
use Illuminate\Http\Request;

class PickingController extends Controller
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
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');

        $requisiciones_pendientes = Requisicion::enReserva()
        ->select('requisicion_encabezado.*')
            ->join('users', 'users.id', '=', 'requisicion_encabezado.id_usuario_ingreso')
            ->where(function ($query) use ($search) {
                $query->where('requisicion_encabezado.no_orden_produccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('requisicion_encabezado.no_requision', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(15);



        if($request->ajax()){

            return view('produccion.picking.index',
                compact('requisiciones_pendientes','search','sort','sortField'));
        }else{

            return view('produccion.picking.ajax',
                compact('requisiciones_pendientes','search','sort','sortField'));
        }


    }
}
