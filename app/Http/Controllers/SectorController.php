<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Http\Requests\SectorRequest;
use App\Localidad;
use App\Sector;
use App\User;
use DB;
use Illuminate\Http\Request;

class SectorController extends Controller
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


        $sectores = Sector::join('bodegas', 'bodegas.id_bodega', '=', 'sectores.id_bodega')
            ->join('users', 'users.id', '=', 'sectores.id_encargado')
            ->select('sectores.*', 'bodegas.descripcion as bodega', 'users.nombre as encargado')
            ->actived()
            ->where(function ($query) use ($search) {

                $query->where('sectores.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orWhere('sectores.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('bodegas.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');

            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {

            return view('registro.sectores.index', compact('sectores', 'search', 'sort', 'sortField'));

        } else {
            return view('registro.sectores.ajax', compact('sectores', 'search', 'sort', 'sortField'));
        }

    }


    public function create()
    {

        $localidades = Localidad::actived()->get();
        $encargados = User::actived()->get();


        return view('registro.sectores.create', compact('localidades', 'encargados'));


    }

    public function store(SectorRequest $request)
    {


        $max = DB::table('sectores')->where('id_bodega', $request->get('id_bodega'))->count();

        $existeCodigo = Sector::actived()
            ->where('codigo_barras', $request->get('codigo_barras'))
            ->exists();

        if ($existeCodigo) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['El codigo de barras ya existe']);
        }


        $sector = new Sector();
        $sector->codigo_barras = $request->get('codigo_barras');
        $sector->descripcion = $request->get('descripcion');
        $sector->id_bodega = $request->get('id_bodega');
        $sector->id_encargado = $request->get('id_encargado');
        $sector->codigo_interno = $max + 1;
        $sector->save();

        return redirect()->route('sectores.index')
            ->with('success', 'Bodega dada de alta correctamente');


    }

    public function edit($id)
    {

        try {
            $localidades = Localidad::actived()->get();
            $encargados = User::actived()->get();
            $sector = Sector::findOrFail($id);

            $idLocalidad = $sector->bodega->localidad->id_localidad;
            $bodegas = Localidad::findOrFail($idLocalidad)->bodegas()->actived()->get();


            return view('registro.sectores.edit',
                compact('localidades', 'encargados', 'bodegas', 'sector', 'idLocalidad'));

        } catch (\Exception $ex) {

            return redirect()->route('sectores.index')
                ->withErrors(['error' => 'Bodega no encontrada']);
        }
    }


    public function update(SectorRequest $request, $id)
    {

        try {
            $existeCodigo = Sector::actived()
                ->where('codigo_barras', $request->get('codigo_barras'))
                ->where('id_sector', '<>', $id)
                ->exists();

            if ($existeCodigo) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['El codigo de barras ya existe']);
            }

            $sector = Sector::findOrFail($id);
            $sector->codigo_barras = $request->get('codigo_barras');
            $sector->descripcion = $request->get('descripcion');
            $sector->id_bodega = $request->get('id_bodega');
            $sector->id_encargado = $request->get('id_encargado');
            $sector->update();

            return redirect()->route('sectores.index')
                ->with('success', 'Bodega actualizada correctamente');
        } catch
        (\Exception $ex) {

            return redirect()->route('sectores.index')
                ->withErrors(['error' => 'Bodega no encontrada']);
        }

    }

    public function show($id)
    {

        try {
            $localidades = Localidad::actived()->get();
            $encargados = User::actived()->get();
            $sector = Sector::findOrFail($id);

            $idLocalidad = $sector->bodega->localidad->id_localidad;
            $bodegas = Localidad::findOrFail($idLocalidad)->bodegas()->actived()->get();


            return view('registro.sectores.show',
                compact('localidades', 'encargados', 'bodegas', 'sector', 'idLocalidad'));

        } catch (\Exception $ex) {

            return redirect()->route('sectores.index')
                ->withErrors(['error' => 'Bodega no encontrada']);
        }

    }

    public function destroy($id)
    {

        try {
            $sector = Sector::findOrFail($id);
            $sector->estado = 0;
            $sector->update();
            return response()->json(['success' => 'Bodega dada de baja correctamente']);
        } catch (\Exception $ex) {

            return response()->json(
                ['error' => 'En este momento no es posible procesar su petición',
                    'mensaje' => $ex->getMessage()
                ]
            );
        }
    }


    public function sectores_by_bodega($bodega)
    {


        try {
            $sectores = Bodega::findOrFail($bodega)->sectores()->actived()->get();
        } catch (\Exception $ex) {

            $sectores = [];
        }


        return response()->json(['sectores' => $sectores]);
    }
}
