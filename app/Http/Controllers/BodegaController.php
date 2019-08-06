<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BodegaController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){


        return view('registro.bodegas.ajax');

    }
}
