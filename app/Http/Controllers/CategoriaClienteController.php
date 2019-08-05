<?php

namespace App\Http\Controllers;

use App\CategoriaCliente;
use Illuminate\Http\Request;

class CategoriaClienteController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index(Request $request){

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'id_categoria' : $request->get('field');

        $categorias = CategoriaCliente::actived()
            ->where(function($query) use ($search){

                $query->where('categoria_clientes.descripcion','LIKE','%'.$search.'%');

            })
            ->orderBy($sortField,$sort)
            ->paginate(20);


        if($request->ajax()){
            return view('registro.categoria_clientes.index',
                compact('search','sort','sortField','categorias'));

        }else{
            return view('registro.categoria_clientes.ajax',
                compact('search','sort','sortField','categorias'));
        }





    }

}
