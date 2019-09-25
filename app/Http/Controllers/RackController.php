<?php

namespace App\Http\Controllers;

use App\Http\Requests\RackRequest;
use App\Localidad;
use App\Pasillo;
use App\Rack;
use DB;
use Illuminate\Http\Request;

class RackController extends Controller
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

        $racks = Rack::join('pasillos', 'pasillos.id_pasillo', '=', 'racks.id_pasillo')
            ->select('racks.*', 'pasillos.descripcion as pasillo')
            ->actived()
            ->where(function ($query) use ($search) {
                $query->where('racks.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orwhere('racks.descripcion', 'LIKE', '%' . $search . '%')
                    ->orwhere('pasillos.descripcion', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {
            return view('registro.racks.index', compact('search', 'sort', 'sortField', 'racks'));
        } else {
            return view('registro.racks.ajax', compact('search', 'sort', 'sortField', 'racks'));
        }


    }


    public function create()
    {

        $localidades = Localidad::actived()->get();


        return view('registro.racks.create', compact('localidades'));
    }

    public function store(RackRequest $request)
    {

        $max = DB::table('racks')->where('id_pasillo', $request->get('id_pasillo'))->count();

        $existeCodigo = Rack::actived()
            ->where('codigo_barras', $request->get('codigo_barras'))
            ->exists();
        if ($existeCodigo) {
            return redirect()
                ->back()
                ->withErrors(['El codigo de barras ya existe'])
                ->withInput();
        }

        $rack = new Rack();
        $rack->codigo_barras = $request->get('codigo_barras');
        $rack->descripcion = $request->get('descripcion');
        $rack->id_pasillo = $request->get('id_pasillo');
        $rack->lado = $request->get('lado');
        $rack->codigo_interno = $max + 1;
        $rack->save();

        return redirect()
            ->route('racks.index')
            ->with('success', 'Rack dado de alta correctamente');


    }


    public function edit($id)
    {

        try {

            $rack = Rack::findOrFail($id);
            $localidades = Localidad::actived()->get();

            $sector = $rack->pasillo->sector;
            $bodega = $sector->bodega;
            $localidad = $bodega->localidad;

            return view('registro.racks.edit',
                compact('rack', 'localidades', 'sector', 'bodega', 'localidad'));


        } catch (\Exception $ex) {

            return redirect()->route('racks.index')
                ->withErrors(['error' => 'Rack no encontrado']);

        }


    }

    public function update(RackRequest $request, $id)
    {

        try {
            $existeCodigo = Rack::actived()
                ->where('codigo_barras', $request->get('codigo_barras'))
                ->where('id_rack', '<>', $id)
                ->exists();
            if ($existeCodigo) {
                return redirect()
                    ->back()
                    ->withErrors(['El codigo de barras ya existe'])
                    ->withInput();
            }

            $rack = Rack::findOrFail($id);
            $rack->codigo_barras = $request->get('codigo_barras');
            $rack->descripcion = $request->get('descripcion');
            $rack->id_pasillo = $request->get('id_pasillo');
            $rack->lado = $request->get('lado');
            $rack->update();

            return redirect()->route('racks.index')
                ->with('success', 'Rack actualizado correctamente');
        } catch (\Exception $ex) {
            return redirect()->route('racks.index')
                ->withErrors(['error' => 'Lo sentimos, no se ha podido completar su petición']);
        }

    }

    public function show($id)
    {
        try {

            $rack = Rack::findOrFail($id);
            $localidades = Localidad::actived()->get();

            $sector = $rack->pasillo->sector;
            $bodega = $sector->bodega;
            $localidad = $bodega->localidad;

            return view('registro.racks.show',
                compact('rack', 'localidades', 'sector', 'bodega', 'localidad'));


        } catch (\Exception $ex) {

            return redirect()->route('racks.index')
                ->withErrors(['error' => 'Rack no encontrado']);

        }
    }

    public function destroy($id)
    {

        try {

            $rack = Rack::findOrFail($id);
            $rack->estado = 0;
            $rack->update();

            return response()->json(['success' => 'Rack dado de baja correctamente']);

        } catch (\Exception $ex) {

            return response()->json(
                ['error' => 'En este momento no es posible procesar su petición',
                    'mensaje' => $ex->getMessage()
                ]
            );

        }
    }

    public function racks_by_pasillo($pasillo)
    {

        try {
            $racks = Pasillo::findOrFail($pasillo)->racks()->actived()->get();
        } catch (\Exception $ex) {

            $racks = [];
        }


        return response()->json(['racks' => $racks]);
    }
}
