<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasilloController extends Controller
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





        return view('registro.pasillos.ajax',compact('search','sortField','sort'));
    }
}
