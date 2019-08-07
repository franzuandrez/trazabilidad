<?php

namespace App\Http\Controllers;

use App\Localidad;
use App\Pasillo;
use App\User;
use Illuminate\Http\Request;

class PasilloController extends Controller
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


        $pasillos = Pasillo::join('sectores','sectores.id_sector','=','pasillos.id_sector')
            ->join('users','users.id','=','pasillos.id_encargado')
            ->select('pasillos.*','users.nombre as encargado','sectores.descripcion as sector')
            ->actived()
            ->where(function ($query) use ($search){
                $query->where('pasillos.codigo_barras','LIKE','%'.$search.'%')
                    ->orWhere('pasillos.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('users.nombre','LIKE','%'.$search.'%')
                    ->orWhere('sectores.descripcion','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);


        if($request->ajax()){
            return view('registro.pasillos.index',compact('search','sortField','sort','pasillos'));
        }else{
            return view('registro.pasillos.ajax',compact('search','sortField','sort','pasillos'));

        }
    }

    public function create(){


        $localidades = Localidad::actived()->get();
        $encargados = User::actived()->get();
        return view('registro.pasillos.create',compact('localidades','encargados'));
    }

    public function store(Request $request){


        $pasillo = new Pasillo();
        $pasillo->id_sector = $request->get('id_sector');
        $pasillo->codigo_barras = $request->get('codigo_barras');
        $pasillo->descripcion = $request->get('descripcion');
        $pasillo->id_encargado = $request->get('id_encargado');
        $pasillo->save();

        return redirect()->route('pasillos.index')
            ->with('success','Pasillo dado de alta correctamente');

    }
}
