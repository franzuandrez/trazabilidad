<?php

namespace App\Http\Controllers;

use App\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
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


        $sectores = Sector::join('bodegas','bodegas.id_bodega','=','sectores.id_bodega')
            ->join('users','users.id','=','sectores.id_sector')
            ->select('sectores.*','bodegas.descripcion as bodega','users.nombre as encargado')
            ->actived()
            ->where(function ($query) use ($search){

                $query->where('sectores.codigo_barras','LIKE','%'.$search.'%')
                    ->orWhere('sectores.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('bodegas.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('users.nombre','LIKE','%'.$search.'%');

            })
            ->orderBy($sort,$sortField)
            ->paginate(20);


        if($request->ajax()){

            return view('registro.sectores.index',compact('sectores','search','sort','sortField'));

        }else{
            return view('registro.sectores.ajax',compact('sectores','search','sort','sortField'));
        }

    }
}
