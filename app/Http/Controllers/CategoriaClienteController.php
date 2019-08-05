<?php

namespace App\Http\Controllers;

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
        $sortField = $request->get('field') == null ? 'descripcion' : $request->get('field');


        return view('registro.categoria_clientes.ajax');




    }

}
