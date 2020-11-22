<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasilloRequest;
use App\Localidad;
use App\Pasillo;
use App\Sector;
use App\User;
use DB;
use Illuminate\Http\Request;

class PasilloController extends Controller
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


        $pasillos = Pasillo::join('sectores', 'sectores.id_sector', '=', 'pasillos.id_sector')
            ->join('users', 'users.id', '=', 'pasillos.id_encargado')
            ->select('pasillos.*', 'users.nombre as encargado', 'sectores.descripcion as sector')
            ->actived()
            ->where(function ($query) use ($search) {
                $query->where('pasillos.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orWhere('pasillos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('sectores.descripcion', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(12);


        if ($request->ajax()) {
            return view('registro.pasillos.index', compact('search', 'sortField', 'sort', 'pasillos'));
        } else {
            return view('registro.pasillos.ajax', compact('search', 'sortField', 'sort', 'pasillos'));

        }
    }

    public function create()
    {


        $localidades = Localidad::actived()->get();
        $encargados = User::actived()->get();
        return view('registro.pasillos.create', compact('localidades', 'encargados'));
    }

    public function store(PasilloRequest $request)
    {


        $max = DB::table('pasillos')->where('id_sector', $request->get('id_sector'))->count();
        $existeCodigo = Pasillo::actived()
            ->where('codigo_barras', $request->get('codigo_barras'))
            ->exists();

        if ($existeCodigo) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['El codigo de barras ya existe']);
        }
        $pasillo = new Pasillo();
        $pasillo->id_sector = $request->get('id_sector');
        $pasillo->codigo_barras = $request->get('codigo_barras');
        $pasillo->descripcion = $request->get('descripcion');
        $pasillo->id_encargado = $request->get('id_encargado');
        $pasillo->codigo_interno = $max + 1;
        $pasillo->save();

        return redirect()->route('pasillos.index')
            ->with('success', 'Pasillo dado de alta correctamente');

    }


    public function edit($id)
    {

        try {

            $pasillo = Pasillo::findOrFail($id);
            $localidades = Localidad::actived()->get();
            $encargados = User::actived()->get();

            $localidad = $pasillo->sector->bodega->localidad;
            $bodega = $pasillo->sector->bodega;

            return view('registro.pasillos.edit',
                compact('pasillo', 'localidad', 'bodega', 'localidades', 'encargados'));

        } catch (\Exception $ex) {
            return redirect()->route('pasillos.index')
                ->withErrors(['error' => 'Pasillo no encontrado']);

        }
    }


    public function update(PasilloRequest $request, $id)
    {

        try {
            $existeCodigo = Pasillo::actived()
                ->where('codigo_barras', $request->get('codigo_barras'))
                ->where('id_pasillo', '<>', $id)
                ->exists();

            if ($existeCodigo) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['El codigo de barras ya existe']);
            }
            $pasillo = Pasillo::findOrFail($id);
            $pasillo->codigo_barras = $request->get('codigo_barras');
            $pasillo->descripcion = $request->get('descripcion');
            $pasillo->id_sector = $request->get('id_sector');
            $pasillo->id_encargado = $request->get('id_encargado');
            $pasillo->update();

            return redirect()->route('pasillos.index')
                ->with('success', 'Pasillo actualizado correctamente');

        } catch (\Exception $ex) {
            return redirect()->route('pasillos.index')
                ->withErrors(['error' => 'No se ha completar su petición']);
        }

    }

    public function show($id)
    {

        try {

            $pasillo = Pasillo::findOrFail($id);
            $localidades = Localidad::actived()->get();
            $encargados = User::actived()->get();

            $localidad = $pasillo->sector->bodega->localidad;
            $bodega = $pasillo->sector->bodega;

            return view('registro.pasillos.show',
                compact('pasillo', 'localidad', 'bodega', 'localidades', 'encargados'));

        } catch (\Exception $ex) {
            return redirect()->route('pasillos.index')
                ->withErrors(['error' => 'Pasillo no encontrado']);
        }
    }

    public function destroy($id)
    {

        try {

            $pasillo = Pasillo::findOrFail($id);
            $pasillo->estado = 0;
            $pasillo->update();

            return response()->json(['success' => 'Pasillo dado de baja correctamente']);

        } catch (\Exception $ex) {

            return response()->json(
                ['error' => 'En este momento no es posible procesar su petición',
                    'mensaje' => $ex->getMessage()
                ]
            );

        }
    }

    public function pasillos_by_sector($sector)
    {


        try {
            $pasillos = Sector::findOrFail($sector)->pasillos()->actived()->get();

        } catch (\Exception $ex) {

            $pasillos = [];
        }

        return response()->json(['pasillos' => $pasillos]);

    }
}
