<?php

namespace App\Http\Controllers;

use App\Colaborador;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
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
        $sortField = $request->get('field') == null ? 'codigo_barras' : $request->get('field');

        $colaboradores = Colaborador::actived()
            ->where(function ($query) use ($search) {

                $query->where('colaboradores.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orWhere('colaboradores.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('colaboradores.apellido', 'LIKE', '%' . $search . '%');

            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {

            return view('registro.colaboradores.index',
                compact('colaboradores', 'search', 'sort', 'sortField'));
        } else {
            return view('registro.colaboradores.ajax',
                compact('colaboradores', 'search', 'sort', 'sortField'));

        }

    }


    public function create(){


        return view('registro.colaboradores.create');
    }

    public function store( Request $request ){

        $colaborador = new Colaborador();
        $colaborador->codigo_barras = $request->get('codigo_barras');
        $colaborador->nombre = $request->get('nombre');
        $colaborador->apellido = $request->get('apellido');
        $colaborador->telefono = $request->get('telefono');
        $colaborador->save();


        return redirect()->route('colaboradores.index')
            ->with('success','Colaborador dado de alta correctamente');

    }

    public function edit( $id ){

        try {
            $colaborador = Colaborador::findOrFail($id);
            return view('registro.colaboradores.edit', compact('colaborador'));
        } catch (\Exception $e) {

            return redirect()
                ->route('colaboradores.index')
                ->withErrors(['Colaborador no encontrado']);
        }

    }

    public function update( Request $request , $id){

        try {
            $colaborador = Colaborador::findOrFail($id);
            $colaborador->codigo_barras = $request->get('codigo_barras');
            $colaborador->nombre = $request->get('nombre');
            $colaborador->apellido = $request->get('apellido');
            $colaborador->telefono = $request->get('telefono');
            $colaborador->update();

            return redirect()
                ->route('colaboradores.index')
                ->with('success','Colaborador actualizado correctamente');

        } catch (\Exception $e) {

            return redirect()
                ->route('colaboradores.index')
                ->withErrors(['Su petición no puede ser procesada en este momento']);
        }
    }
}
