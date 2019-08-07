<?php

namespace App\Http\Controllers;

use App\Localidad;
use App\Rack;
use Illuminate\Http\Request;
use League\Flysystem\ConfigAwareTrait;

class RackController extends Controller
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

        $racks = Rack::join('pasillos','pasillos.id_pasillo','=','racks.id_pasillo')
            ->select('racks.*','pasillos.descripcion as pasillo')
            ->actived()
            ->where( function ( $query ) use  ( $search ) {
                $query->where('racks.codigo_barras','LIKE','%'.$search.'%')
                    ->orwhere('racks.descripcion','LIKE','%'.$search.'%')
                    ->orwhere('pasillos.descripcion','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);


        if($request->ajax()){
            return view('registro.racks.index',compact('search','sort','sortField','racks'));
        }else{
            return view('registro.racks.ajax',compact('search','sort','sortField','racks'));
        }


    }


    public function create(){

        $localidades = Localidad::actived()->get();


        return view('registro.racks.create',compact('localidades'));
    }
}
