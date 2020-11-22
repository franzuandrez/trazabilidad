<?php

namespace App\Http\Controllers;

use App\Http\Requests\NivelRequest;
use App\Localidad;
use App\Nivel;
use App\Rack;
use DB;
use Illuminate\Http\Request;

class NivelController extends Controller
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

        $niveles = Nivel::join('racks', 'racks.id_rack', '=', 'nivel.id_rack')
            ->select('nivel.*', 'racks.descripcion as rack')
            ->actived()
            ->where(function ($query) use ($search) {

                $query->where('nivel.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orwhere('nivel.descripcion', 'LIKE', '%' . $search . '%')
                    ->orwhere('racks.descripcion', 'LIKE', '%' . $search . '%');

            })
            ->orderBy($sortField, $sort)
            ->paginate(12);

        if ($request->ajax()) {
            return view('registro.niveles.index', compact('search', 'sort', 'sortField', 'niveles'));

        } else {
            return view('registro.niveles.ajax', compact('search', 'sort', 'sortField', 'niveles'));

        }
    }

    public function create()
    {

        $localidades = Localidad::actived()->get();

        return view('registro.niveles.create', compact('localidades'));
    }

    public function store(NivelRequest $request)
    {

        $max = DB::table('nivel')->where('id_rack', $request->get('id_rack'))->count();
        $existeCodigo = Nivel::actived()
            ->where('codigo_barras', $request->get('codigo_barras'))
            ->exists();
        if ($existeCodigo) {
            return redirect()
                ->back()
                ->withErrors(['El codigo de barras ya existe'])
                ->withInput();
        }

        $nivel = new Nivel();
        $nivel->codigo_barras = $request->get('codigo_barras');
        $nivel->descripcion = $request->get('descripcion');
        $nivel->id_rack = $request->get('id_rack');
        $nivel->codigo_interno = $max + 1;
        $nivel->save();

        return redirect()->route('niveles.index')->with('success', 'Nivel dado de alta correctamente');
    }

    public function edit($id)
    {

        try {

            $nivel = Nivel::findOrFail($id);

            $pasillo = $nivel->rack->pasillo;
            $sector = $pasillo->sector;
            $bodega = $sector->bodega;
            $localidad = $bodega->localidad;


            $localidades = Localidad::actived()->get();


            return view('registro.niveles.edit',
                compact('pasillo', 'bodega', 'sector', 'nivel', 'localidades', 'localidad'));


        } catch (\Exception $ex) {

            return redirect()->route('niveles.index')
                ->withErrors(['error' => 'Nivel no encontrado']);
        }
    }

    public function update(NivelRequest $request, $id)
    {
        try {
            $existeCodigo = Nivel::actived()
                ->where('codigo_barras', $request->get('codigo_barras'))
                ->where('id_nivel', $id)
                ->exists();
            if ($existeCodigo) {
                return redirect()
                    ->back()
                    ->withErrors(['El codigo de barras ya existe'])
                    ->withInput();
            }
            $nivel = Nivel::findOrFail($id);
            $nivel->codigo_barras = $request->get('codigo_barras');
            $nivel->descripcion = $request->get('descripcion');
            $nivel->id_rack = $request->get('id_rack');
            $nivel->update();

            return redirect()->route('niveles.index')
                ->with('success', 'Nivel actualizado correctamente');

        } catch (\Exception $ex) {

            return redirect()->route('niveles.index')
                ->withErrors(['error' => 'Lo sentimos, no se ha podido completar su petición']);

        }

    }

    public function show($id)
    {
        try {

            $nivel = Nivel::findOrFail($id);

            $pasillo = $nivel->rack->pasillo;
            $sector = $pasillo->sector;
            $bodega = $sector->bodega;
            $localidad = $bodega->localidad;

            $localidades = Localidad::actived()->get();

            return view('registro.niveles.show',
                compact('pasillo', 'bodega', 'sector', 'nivel', 'localidades', 'localidad'));


        } catch (\Exception $ex) {

            return redirect()->route('niveles.index')
                ->withErrors(['error' => 'Nivel no encontrado']);
        }
    }

    public function destroy($id)
    {

        try {
            $nivel = Nivel::findOrFail($id);
            $nivel->estado = 0;
            $nivel->update();
            return response()->json(['success' => 'Nivel dado de baja correctamente']);

        } catch (\Exception $ex) {

            return response()->json(
                ['error' => 'En este momento no es posible procesar su petición',
                    'mensaje' => $ex->getMessage()
                ]
            );

        }

    }

    public function niveles_by_rack($rack)
    {
        try {
            $niveles = Rack::findOrFail($rack)->niveles()->actived()->get();

        } catch (\Exception $ex) {

            $niveles = [];
        }

        return response()->json(['niveles' => $niveles]);


    }
}
