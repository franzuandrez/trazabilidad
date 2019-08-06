<?php

namespace App\Http\Controllers;

use App\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'codigo_barras' : $request->get('field');

        $bodegas = Bodega::join('localidades','localidades.id_localidad','=','bodegas.id_localidad')
            ->join('users','users.id','=','bodegas.id_encargado')
            ->select('bodegas.*','localidades.descripcion as localidad','users.nombre as encargado')
            ->actived()
            ->where(function ($query) use ($search){
                $query->where('bodegas.codigo_barras','LIKE','%'.$search.'%')
                    ->orWhere('bodegas.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('localidades.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('users.nombre','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if($request->ajax()){

            return view('registro.bodegas.index',compact('sort','sortField','search','bodegas'));

        }else{

            return view('registro.bodegas.ajax',compact('sort','sortField','search','bodegas'));

        }



    }
}
