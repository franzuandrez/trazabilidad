<?php

namespace App\Http\Controllers;

use App\Colaborador;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request ){

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'codigo_barras' : $request->get('field');

        $colaboradores = Colaborador::actived()
            ->where(function ( $query ) use ( $search) {

                $query->where('colaboradores.codigo_barras','LIKE','%'.$search.'%')
                    ->orWhere('colaboradores.nombre','LIKE','%'.$search.'%')
                    ->orWhere('colaboradores.apellido','LIKE','%'.$search.'%');

            })
            ->orderBy($sortField,$sort)
        ->paginate(20);


        if($request->ajax()){

            return view('registro.colaboradores.index',
                compact('colaboradores','search','sort','sortField'));
        }else{
            return view('registro.colaboradores.ajax',
                compact('colaboradores','search','sort','sortField'));

        }

    }
}
