<?php

namespace App\Http\Controllers;

use App\TipoMovimiento;
use Illuminate\Http\Request;

class TipoMovimientoController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index( Request $request){


        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'descripcion' : $request->get('field');

        $tipos = TipoMovimiento::actived()
            ->where('descripcion','LIKE','%'.$search.'%')
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if ($request->ajax()) {

            return view('registro.tipo_movimientos.index',
                compact('search','sort','sortField','tipos'));

        }else{

            return view('registro.tipo_movimientos.ajax',
                compact('search','sort','sortField','tipos'));
        }


    }

    public function create(){



        return view('registro.tipo_movimientos.create');

    }
}
