<?php

namespace App\Http\Controllers;

use App\Posicion;
use Illuminate\Http\Request;

class PosicionController extends Controller
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

        $posiciones = Posicion::join('nivel','nivel.id_nivel','=','posiciones.id_nivel')
            ->select('posiciones.*','nivel.descripcion as nivel')
            ->actived()
            ->where(function ( $query ) use ( $search) {
                $query->where('posiciones.codigo_barras','LIKE','%'.$search.'%')
                    ->orwhere('posiciones.descripcion','LIKE','%'.$search.'%')
                    ->orwhere('nivel.descripcion','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if($request->ajax()){
            return view('registro.posiciones.index',
                compact('posiciones','sort','sortField','search'));

        }else{
            return view('registro.posiciones.ajax',
                compact('posiciones','sort','sortField','search'));

        }


    }
}
