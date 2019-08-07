<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index( Request $request){

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'codigo_barras' : $request->get('field');

        $productos = Producto::join('dimensionales','dimensionales.id_dimensional','=','productos.id_dimensional')
            ->join('presentaciones','presentaciones.id_presentacion','=','productos.id_presentacion')
            ->select('productos.*','presentaciones.descripcion as presentacion',
                'dimensionales.descripcion as dimensional')
            ->where(function ( $query ) use ( $search ){
                $query->where('productos.codigo_barras','LIKE','%'.$search.'%')
                    ->orwhere('productos.descripcion','LIKE','%'.$search.'%')
                    ->orwhere('presentaciones.descripcion','LIKE','%'.$search.'%')
                    ->orwhere('dimensionales.descripcion','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if($request->ajax()){
            return view('registro.productos.index',
                compact('search','sort','sortField','productos'));
        }else{
            return view('registro.productos.ajax',
                compact('search','sort','sortField','productos'));
        }


    }
}
