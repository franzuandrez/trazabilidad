<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecepcionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){




        return view('recepcion.materia_prima.ajax');


    }
}
