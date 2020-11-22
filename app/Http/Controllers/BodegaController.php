<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Http\Requests\BodegaRequest;
use App\Localidad;
use App\User;
use DB;
use Illuminate\Http\Request;

class BodegaController extends Controller
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

        $bodegas = Bodega::join('localidades', 'localidades.id_localidad', '=', 'bodegas.id_localidad')
            ->join('users', 'users.id', '=', 'bodegas.id_encargado')
            ->select('bodegas.*', 'localidades.descripcion as localidad', 'users.nombre as encargado')
            ->actived()
            ->where(function ($query) use ($search) {
                $query->where('bodegas.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orWhere('bodegas.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('localidades.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(12);

        if ($request->ajax()) {

            return view('registro.bodegas.index',
                [
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'search' => $search,
                    'bodegas' => $bodegas
                ]
            );

        } else {

            return view('registro.bodegas.ajax',
                [
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'search' => $search,
                    'bodegas' => $bodegas
                ]
            );

        }


    }

    public function create()
    {


        $encargados = User::actived()->get();
        $localidades = Localidad::actived()->get();

        return view('registro.bodegas.create',
            [
                'encargados' => $encargados,
                'localidades' => $localidades
            ]
        );
    }

    public function store(BodegaRequest $request)
    {

        $existeCodigo = Bodega::actived()
            ->where('codigo_barras', $request->get('codigo_barras'))
            ->exists();

        if ($existeCodigo) {
            return redirect()
                ->back()
                ->withErrors(['El codigo de barras ya existe'])
                ->withInput();
        }

        $max = DB::table('bodegas')->where('id_localidad', $request->get('id_localidad'))->count();

        $bodega = new Bodega();
        $bodega->codigo_barras = $request->get('codigo_barras');
        $bodega->descripcion = $request->get('descripcion');
        $bodega->telefono = $request->get('telefono');
        $bodega->largo = $request->get('largo');
        $bodega->alto = $request->get('alto');
        $bodega->ancho = $request->get('ancho');
        $bodega->id_encargado = $request->get('id_encargado');
        $bodega->id_localidad = $request->get('id_localidad');
        $bodega->codigo_interno = $max + 1;
        $bodega->save();

        return redirect()->route('bodegas.index')
            ->with('success', 'Bodega dada de alta correctamente');


    }

    public function edit($id)
    {

        try {

            $bodega = Bodega::findOrFail($id);
            $encargados = User::actived()->get();
            $localidades = Localidad::actived()->get();
            return view('registro.bodegas.edit',
                [
                    'encargados' => $encargados,
                    'localidades' => $localidades,
                    'bodega' => $bodega
                ]
            );

        } catch (\Exception $ex) {

            return redirect()->route('bodegas.index')
                ->withErrors(['error' => 'Bodega no encontrada']);

        }
    }

    public function update(BodegaRequest $request, $id)
    {

        try {

            $existeCodigo = Bodega::actived()
                ->where('codigo_barras', $request->get('codigo_barras'))
                ->where('id_bodega', '<>', $id)
                ->exists();

            if ($existeCodigo) {
                return redirect()
                    ->back()
                    ->withErrors(['El codigo de barras ya existe'])
                    ->withInput();
            }
            $bodega = Bodega::findOrFail($id);
            $bodega->codigo_barras = $request->get('codigo_barras');
            $bodega->descripcion = $request->get('descripcion');
            $bodega->telefono = $request->get('telefono');
            $bodega->largo = $request->get('largo');
            $bodega->ancho = $request->get('ancho');
            $bodega->alto = $request->get('alto');
            $bodega->id_encargado = $request->get('id_encargado');
            $bodega->id_localidad = $request->get('id_localidad');
            $bodega->update();

            return redirect()->route('bodegas.index')
                ->with('success', 'Bodega actualizada correctamente');

        } catch (\Exception $ex) {

            return redirect()->route('bodegas.index')
                ->withErrors(['error' => 'Bodega no encontrada']);

        }
    }

    public function show($id)
    {

        try {

            $bodega = Bodega::findOrFail($id);
            $encargados = User::actived()->get();
            $localidades = Localidad::actived()->get();
            return view('registro.bodegas.show',
                [
                    'encargados' => $encargados,
                    'localidades' => $localidades,
                    'bodega' => $bodega
                ]
            );

        } catch (\Exception $ex) {

            return redirect()->route('bodegas.index')
                ->withErrors(['error' => 'Bodega no encontrada']);

        }
    }

    public function destroy($id)
    {


        try {

            $bodega = Bodega::findOrFail($id);
            $bodega->estado = 0;
            $bodega->update();

            return response()->json(['success' => 'Bodega dada de baja exitosamente']);

        } catch (\Exception $ex) {

            return response()->json(
                ['error' => 'En este momento no es posible procesar su petición',
                    'mensaje' => $ex->getMessage()
                ]
            );

        }
    }

    public function bodegas_by_localidad($localidad)
    {

        try {
            $bodegas = Localidad::findOrFail($localidad)->bodegas()->actived()->get();
        } catch (\Exception $ex) {
            $bodegas = [];
        }


        return response()->json(['bodegas' => $bodegas]);


    }
}
