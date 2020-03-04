<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultaTrazabilidadController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {


        $lote = $request->lote == null ? '' :$request->lote;



        return view('consultas.trazabilidad.index');

    }

}
