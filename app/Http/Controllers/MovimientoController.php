<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Movimiento;
use App\Producto;
use Illuminate\Http\Request;
use DB;
class MovimientoController extends Controller
{
    //

    public function index( Request $request ){


        $search = $request->get('id_select_search') == null ? '0' : $request->get('id_select_search');
        if($request->get('search') != null){
            $search = $request->get('search');
        }
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'movimientos.ubicacion' : $request->get('field');
        $bodegas = Bodega::select('id_bodega as id','descripcion as descripcion')->get();
        $productos = Movimiento::join('productos','movimientos.id_producto','=','productos.id_producto')
            ->join('tipo_movimiento','tipo_movimiento.id_movimiento','=','movimientos.tipo_movimiento')
            ->leftJoin('bodegas','movimientos.ubicacion','=','bodegas.id_bodega')
            ->select('movimientos.*',
                'productos.descripcion as producto',
                DB::raw('sum( cantidad  * factor ) as total'),
                'bodegas.descripcion as bodega')
            ->where(function (  $query ) use ( $search   ) {
                $query->where('ubicacion',$search);
            })
            ->orderBy($sortField,$sort)
            ->groupBy('movimientos.id_producto')
            ->groupBy('movimientos.lote')
            ->paginate(15);

        if($request->ajax()){
            return view('movimientos.bodegas.index',
                compact('productos','bodegas','sort','sortField','search'));
        }else{
            return view('movimientos.bodegas.ajax',
                compact('productos','bodegas','sort','sortField','search'));
        }

    }
}
