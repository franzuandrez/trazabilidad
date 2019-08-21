<?php

namespace App\Http\Controllers;

use App\Operacion;
use Illuminate\Http\Request;
use function foo\func;

class OperacionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');

        $operaciones = Operacion::select('produccion_encabezado.*')
            ->join('users','users.id','=','produccion_encabezado.id_usuario_ingreso')
            ->where(function ( $query ) use ($search){
                $query->where('produccion_encabezado.no_orden_produccion','LIKE','%'.$search.'%')
                    ->orWhere('produccion_encabezado.no_requision','LIKE','%'.$search.'%')
                    ->orWhere('users.nombre','LIKE','%'.$search.'%');
            })
            ->paginate(15);


        if($request->ajax()){
            return view('produccion.operaciones.index',
                compact('operaciones','sort','sortField','search'));
        }else{
            return view('produccion.operaciones.ajax',
                compact('operaciones','sort','sortField','search'));
        }
    }
}
