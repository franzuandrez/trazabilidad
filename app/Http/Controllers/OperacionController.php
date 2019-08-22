<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Requisicion;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

        $operaciones = Requisicion::select('requisicion_encabezado.*')
            ->join('users','users.id','=','requisicion_encabezado.id_usuario_ingreso')
            ->where(function ( $query ) use ($search){
                $query->where('requisicion_encabezado.no_orden_produccion','LIKE','%'.$search.'%')
                    ->orWhere('requisicion_encabezado.no_requision','LIKE','%'.$search.'%')
                    ->orWhere('users.nombre','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(15);


        if($request->ajax()){
            return view('produccion.operaciones.index',
                compact('operaciones','sort','sortField','search'));
        }else{
            return view('produccion.operaciones.ajax',
                compact('operaciones','sort','sortField','search'));
        }
    }


    public function create(){

        $bodegas = Bodega::actived()
            ->get();

        return view('produccion.operaciones.create',compact('bodegas'));
    }

    public function store(Request $request){


        try{

            DB::beginTransaction();

            $operacion =new Requisicion();
            $operacion->no_requision = $request->get('no_requision');
            $operacion->no_orden_produccion = $request->get('no_orden_produccion');
            $operacion->fecha_ingreso =Carbon::now();
            $operacion->id_usuario_ingreso = Auth::user()->id;
            $operacion->save();

            DB::commit();
            return redirect()->route('produccion.operaciones.index')
                ->with('success','Operacion realizada correctamente');

        }catch (\Exception $ex ){

            DB::rollback();
            dd($ex);
            return redirect()->route('produccion.operaciones.index')
                ->withErrors(['Algo salio mal, intentelo más tarde']);
        }
    }
}
