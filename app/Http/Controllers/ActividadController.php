<?php

namespace App\Http\Controllers;

use App\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    //


    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'descripcion' : $request->get('field');


        $actividades = Actividad::actived()
            ->where(function ($query) use ($search) {
                $query->where('descripcion', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {
            return view('registro.actividades.index',compact('sort','sortField','search','actividades'));
        }else{
            return view('registro.actividades.ajax',compact('sort','sortField','search','actividades'));
        }



    }

    public function create(){


        return view('registro.actividades.create');


    }

    public function store(Request $request ){

        $actividad = new Actividad();
        $actividad->descripcion = $request->get('descripcion');
        $actividad->save();

        return redirect()->route('actividades.index')
            ->with('success','Actividad dada de alta correctamente');
    }
}
