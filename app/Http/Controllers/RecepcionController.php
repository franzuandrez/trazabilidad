<?php

namespace App\Http\Controllers;

use App\Recepcion;
use Illuminate\Http\Request;

class RecepcionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){



        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'orden_compra' : $request->get('field');



        $recepciones = Recepcion::join('proveedores','proveedores.id_proveedor','=','recepcion_encabezado.id_proveedor')
            ->join('productos','productos.id_producto','=','recepcion_encabezado.id_producto')
            ->where(function ( $query ) use ( $search ){
                $query->where('proveedores.razon_social','LIKE','%'.$search.'%')
                    ->orWhere('productos.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('recepcion_encabezado.orden_compra','LIKE','%'.$search.'%');

            })
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('recepcion.materia_prima.index',
                compact('recepciones','sort','sortField','search'));
        }else{

            return view('recepcion.materia_prima.ajax',
                compact('recepciones','sort','sortField','search'));
        }






    }
}
