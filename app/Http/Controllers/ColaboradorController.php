<?php

namespace App\Http\Controllers;

use App\Colaborador;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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


    public function create()
    {


        return view('registro.colaboradores.create');
    }

    public function store(Request $request)
    {

        $existeColaborador = Colaborador::where('codigo_barras', $request->get('codigo_barras'))
            ->where('estado', 1)
            ->exists();

        if ($existeColaborador) {
            return redirect()
                ->back()
                ->withErrors(['El codigo de barras ya existe'])->withInput();
        }

        $colaborador = new Colaborador();
        $colaborador->codigo_barras = $request->get('codigo_barras');
        $colaborador->nombre = $request->get('nombre');
        $colaborador->apellido = $request->get('apellido');
        $colaborador->telefono = $request->get('telefono');
        $colaborador->save();


        return redirect()->route('colaboradores.index')
            ->with('success', 'Colaborador dado de alta correctamente');

    }

    public function edit($id)
    {

        try {
            $colaborador = Colaborador::findOrFail($id);
            return view('registro.colaboradores.edit', compact('colaborador'));
        } catch (\Exception $e) {

            return redirect()
                ->route('colaboradores.index')
                ->withErrors(['Colaborador no encontrado']);
        }

    }

    public function update(Request $request, $id)
    {

        try {
            $colaborador = Colaborador::findOrFail($id);
            $colaborador->codigo_barras = $request->get('codigo_barras');
            $colaborador->nombre = $request->get('nombre');
            $colaborador->apellido = $request->get('apellido');
            $colaborador->telefono = $request->get('telefono');
            $colaborador->update();

            return redirect()
                ->route('colaboradores.index')
                ->with('success', 'Colaborador actualizado correctamente');

        } catch (\Exception $e) {

            return redirect()
                ->route('colaboradores.index')
                ->withErrors(['Su petición no puede ser procesada en este momento']);
        }
    }

    public function show($id)
    {

        try {
            $colaborador = Colaborador::findOrFail($id);
            return view('registro.colaboradores.show', compact('colaborador'));
        } catch (\Exception $e) {

            return redirect()
                ->route('colaboradores.index')
                ->withErrors(['Colaborador no encontrado']);
        }


    }

    public function destroy($id)
    {

        try {

            $colaborador = Colaborador::findOrFail($id);
            $colaborador->estado = 0;
            $colaborador->update();
            return response()->json(['success' => 'Colaborador dado de baja correctamente']);

        } catch (\Exception $ex) {
            return response()->json(
                ['error' => 'En este momento no es posible procesar su petición',
                    'mensaje' => $ex->getMessage()
                ]
            );

        }
    }


    public function importar(Request $request)
    {

        $file = $request->file('archivo_importar');


        try {
            Excel::load($file, function ($reader) {

                $results = $reader->noHeading()->get();
                $results = $results->slice(1);

                foreach ($results as $key => $value) {


                    $existeColaborador = Colaborador::where('codigo_barras', $value[0])->exists();

                    if ($existeColaborador) {

                        $colaborador = Colaborador::where('codigo_barras', $value[0])->first();
                        $colaborador->nombre = $value[1];
                        $colaborador->apellido = $value[2];
                        $colaborador->telefono = $value[3];
                        $colaborador->estado = 1;
                        $colaborador->update();

                    } else {
                        $colaborador = new Colaborador();
                        $colaborador->codigo_barras = $value[0];
                        $colaborador->nombre = $value[1];
                        $colaborador->apellido = $value[2];
                        $colaborador->telefono = $value[3];;
                        $colaborador->save();

                    }

                }


            });
            return redirect()->route('colaboradores.index')
                ->with('success', 'Colaboradores cargados correctamente.');

        } catch (\PHPExcel_Reader_Exception $e) {

            return redirect()->route('colaboradores.index')
                ->withErrors(['Archivo no valido']);

        } catch (\Exception $e) {

            return redirect()->route('colaboradores.index')
                ->withErrors(['No ha sido posible cargar los colaboradores']);
        }


    }
}
