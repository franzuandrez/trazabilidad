<?php

namespace App\Http\Controllers;

use App\Colaborador;
use App\Http\Requests\ColaboradorRequest;
use App\Http\tools\GeneradorCodigos;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ColaboradorController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getHeaders()
    {
        $headers = ['Codigo', 'Nombre', 'Apellido', 'Telefono'];

        return $headers;

    }

    private function getExamples()
    {
        $examples = ['8018075484200000000024', 'Pedro', 'Perez', '12345678'];

        return $examples;
    }

    public function index(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'id_colaborador' : $request->get('field');



        $colaboradores = Colaborador::
        where(function ($query) use ($search) {

            $query->where('colaboradores.codigo_barras', 'LIKE', '%' . $search . '%')
                ->orWhere('colaboradores.nombre', 'LIKE', '%' . $search . '%')
                ->orWhere('colaboradores.apellido', 'LIKE', '%' . $search . '%');

        })
            ->orderBy($sortField, $sort)
            ->paginate(12);


        if ($request->ajax()) {

            return view('registro.colaboradores.index',
                [
                    'colaboradores' => $colaboradores,
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField
                ]
            );
        } else {

            $headers = $this->getHeaders();
            $examples = $this->getExamples();
            return view('registro.colaboradores.ajax',
                [
                    'colaboradores' => $colaboradores,
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'examples' => $examples,
                    'headers' => $headers
                ]

            );

        }

    }


    public function create()
    {


        return view('registro.colaboradores.create');
    }

    public function store(ColaboradorRequest $request)
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
        $colaborador->codigo_barras = GeneradorCodigos::getCodigoColaborador();
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
            return view('registro.colaboradores.edit',
                [
                    'colaborador' => $colaborador
                ]
            );
        } catch (\Exception $e) {

            return redirect()
                ->route('colaboradores.index')
                ->withErrors(['Colaborador no encontrado']);
        }

    }

    public function update(ColaboradorRequest $request, $id)
    {

        try {
            $existeColaborador = Colaborador::actived()
                ->where('codigo_barras', $request->get('codigo_barras'))
                ->where('id_colaborador', '<>', $id)
                ->exists();
            if ($existeColaborador) {
                return redirect()
                    ->back()
                    ->withErrors(['El codigo de barras ya existe'])
                    ->withInput();
            }

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
            return view('registro.colaboradores.show',
                [
                    'colaborador' => $colaborador
                ]
            );
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

        $extensionesValidas = ['xlsx', 'xls'];
        $file = $request->file('archivo_importar');
        $total = 0;
        if (!in_array($file->extension(), $extensionesValidas)) {
            return redirect()
                ->back()
                ->withErrors(['El archivo debe ser formato Excel']);
        }

        try {
            $cargar = Excel::load($file, function ($reader) {

                $results = $reader->noHeading()->get();
                $results = $results->slice(1)->where(0, '<>', '');


                foreach ($results as $key => $value) {

                    $codigo = str_replace(['(', ')'], '', $value[0]);
                    $nombre = $value[1];
                    $apellido = $value[2];
                    $telefono = empty($value[3]) ? "" : $value[3];

                    $existeColaborador = Colaborador::where('codigo_barras', $codigo)->exists();


                    if ($existeColaborador) {

                        $colaborador = Colaborador::where('codigo_barras', $codigo)->first();
                        $colaborador->nombre = $nombre;
                        $colaborador->apellido = $apellido;
                        $colaborador->telefono = $telefono;
                        $colaborador->estado = 1;
                        $colaborador->update();

                    } else {
                        $colaborador = new Colaborador();
                        $colaborador->codigo_barras = $codigo;
                        $colaborador->nombre = $nombre;
                        $colaborador->apellido = $apellido;
                        $colaborador->telefono = $telefono;
                        $colaborador->save();

                    }

                }


            });
            $total = $cargar->parsed->where(0, '<>', '')->count() - 1;


            return redirect()->route('colaboradores.index')
                ->with('success', 'Un total de ' . $total . ' colaboradores cargados correctamente.');

        } catch (\PHPExcel_Reader_Exception $e) {

            return redirect()->route('colaboradores.index')
                ->withErrors(['Archivo no valido']);

        } catch (\Exception $e) {

            return redirect()->route('colaboradores.index')
                ->withErrors(['No ha sido posible cargar los colaboradores']);
        }


    }

    public function search(Request $request)
    {

        $search = $request->get('q');
        $colaboradores = [];
        if ($search != null) {
            $colaboradores = Colaborador::actived()
                ->where(function ($query) use ($search) {
                    $query->where('codigo_barras', 'LIKE', '%' . $search . '%')
                        ->orWhere('nombre', 'LIKE', '%' . $search . '%')
                        ->orWhere('apellido', 'LIKE', '%' . $search . '%');
                })
                ->get();
        }


        return response()->json(['colaboradores' => $colaboradores]);


    }




}
