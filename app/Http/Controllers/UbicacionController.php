<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use Illuminate\Http\Request;
use DB;
class UbicacionController extends Controller
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
        $sortField = $request->get('field') == null ? 'id_ubicacion' : $request->get('field');


        $ubicaciones = Ubicacion::join('bodegas','bodegas.id_bodega','=','ubicaciones.id_bodega')
            ->join('localidades','localidades.id_localidad','=','ubicaciones.id_localidad')
            ->select('localidades.descripcion as localidad',
                'bodegas.descripcion as bodega','ubicaciones.*'
                )
            ->where(function ($query) use ($search){
                $query->where('localidades.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('ubicaciones.codigo_barras','LIKE','%'.$search.'%')
                    ->orWhere('bodegas.descripcion','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if($request->ajax()){

            return view('registro.ubicaciones.index',compact('ubicaciones','search','sort','sortField'));

        }else{
            return view('registro.ubicaciones.ajax',compact('ubicaciones','search','sort','sortField'));
        }


    }
}
