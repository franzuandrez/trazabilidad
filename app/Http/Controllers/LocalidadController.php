<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalidadRequest;
use App\Localidad;
use App\User;
use Illuminate\Http\Request;

class LocalidadController extends Controller
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


        $localidades = Localidad::join('users', 'users.id', '=', 'localidades.id_encargado')
            ->select('localidades.*', 'users.nombre as encargado')
            ->actived()
            ->where(function ($query) use ($search) {
                $query->where('codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orWhere('descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('direccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('username', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(12);

        if ($request->ajax()) {
            return view('registro.localidades.index',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'localidades' => $localidades
                ]
            );
        } else {
            return view('registro.localidades.ajax',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'localidades' => $localidades
                ]
            );
        }


    }

    public function create()
    {

        $encargados = User::actived()->get();


        return view('registro.localidades.create', [
            'encargados' => $encargados
        ]);
    }

    public function store(LocalidadRequest $request)
    {


        $existeCodigoBarras = Localidad::actived()
            ->where('codigo_barras', $request->get('codigo_barras'))
            ->exists();

        if ($existeCodigoBarras) {
            return redirect()
                ->back()
                ->withErrors(['El codigo de barras ya existe'])
                ->withInput();
        }

        $localidad = new Localidad();
        $localidad->codigo_barras = $request->get('codigo_barras');
        $localidad->descripcion = $request->get('descripcion');
        $localidad->direccion = $request->get('direccion');
        $localidad->id_encargado = $request->get('id_encargado');
        $localidad->save();

        $localidad->codigo_interno = $localidad->id_localidad;
        $localidad->update();

        return redirect()->route('localidades.index')
            ->with('success', 'Localidad dada de alta correctamente');

    }

    public function edit($id)
    {

        try {

            $localidad = Localidad::findOrFail($id);
            $encargados = User::actived()->get();

            return view('registro.localidades.edit',
                [
                    'localidad' => $localidad,
                    'encargados' => $encargados
                ]
            );

        } catch (\Exception $ex) {

            return redirect()->route('localidades.index')
                ->withErrors(['error' => 'Localidad no encontrada']);
        }

    }

    public function update(LocalidadRequest $request, $id)
    {
        try {
            $existeCodigoBarras = Localidad::actived()
                ->where('codigo_barras', $request->get('codigo_barras'))
                ->where('id_localidad', '<>', $id)
                ->exists();

            if ($existeCodigoBarras) {
                return redirect()
                    ->back()
                    ->withErrors(['El codigo de barras ya existe'])
                    ->withInput();
            }
            $localidad = Localidad::findOrFail($id);
            $localidad->codigo_barras = $request->get('codigo_barras');
            $localidad->descripcion = $request->get('descripcion');
            $localidad->direccion = $request->get('direccion');
            $localidad->id_encargado = $request->get('id_encargado');
            $localidad->update();

            return redirect()->route('localidades.index')
                ->with('success', 'Localidad actualizada correctamente');


        } catch (\Exception $ex) {

            return redirect()->route('localidades.index')
                ->withErrors(['error' => 'Localidad no encontrada']);
        }

    }

    public function show($id)
    {
        try {

            $localidad = Localidad::findOrFail($id);
            $encargados = User::actived()->get();

            return view('registro.localidades.show',
                [
                    'localidad' => $localidad,
                    'encargados' => $encargados
                ]
            );

        } catch (\Exception $ex) {

            return redirect()->route('localidades.index')
                ->withErrors(['error' => 'Localidad no encontrada']);
        }
    }

    public function destroy($id)
    {

        try {

            $localidad = Localidad::findOrFail($id);
            $localidad->estado = 0;
            $localidad->update();

            return response()->json(['success' => 'Localidad dada de baja exitosamente']);

        } catch (\Exception $ex) {

            return response()->json(
                ['error' => 'En este momento no es posible procesar su petición',
                    'mensaje' => $ex->getMessage()
                ]
            );

        }
    }
}
