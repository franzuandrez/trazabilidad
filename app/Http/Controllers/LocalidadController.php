<?php

namespace App\Http\Controllers;

use App\Localidad;
use Illuminate\Http\Request;

class LocalidadController extends Controller
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


        $localidades = Localidad::join('users','users.id','=','localidades.id_encargado')
            ->select('localidades.*','users.username as encargado')
            ->actived()
            ->where(function ($query)use($search){
                $query->where('codigo_barras','LIKE','%'.$search.'%')
                ->orWhere('descripcion','LIKE','%'.$search.'%')
                ->orWhere('direccion','LIKE','%'.$search.'%')
                ->orWhere('username','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if($request->ajax()){
            return view('registro.localidades.index',compact('search','sort','sortField','localidades'));
        }else{
            return view('registro.localidades.ajax',compact('search','sort','sortField','localidades'));
        }





    }
}
