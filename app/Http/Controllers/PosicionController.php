<?php

namespace App\Http\Controllers;

use App\Http\Requests\PosicionRequest;
use App\Nivel;
use App\Posicion;
use App\Localidad;
use Illuminate\Http\Request;
use DB;
class PosicionController extends Controller
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

        $posiciones = Posicion::join('nivel', 'nivel.id_nivel', '=', 'posiciones.id_nivel')
            ->select('posiciones.*', 'nivel.descripcion as nivel')
            ->actived()
            ->where(function ($query) use ($search) {
                $query->where('posiciones.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orwhere('posiciones.descripcion', 'LIKE', '%' . $search . '%')
                    ->orwhere('nivel.descripcion', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('registro.posiciones.index',
                compact('posiciones', 'sort', 'sortField', 'search'));

        } else {
            return view('registro.posiciones.ajax',
                compact('posiciones', 'sort', 'sortField', 'search'));

        }


    }

    public function create()
    {

        $localidades = Localidad::actived()->get();
        return view('registro.posiciones.create', compact('localidades'));
    }

    public function store(PosicionRequest $request)
    {

        $max = DB::table('posiciones')->where('id_nivel', $request->get('id_nivel'))->count();


        $posicion = new Posicion();
        $posicion->codigo_barras = $request->get('codigo_barras');
        $posicion->descripcion = $request->get('descripcion');
        $posicion->id_nivel = $request->get('id_nivel');
        $posicion->codigo_interno = $max + 1;
        $posicion->save();

        return redirect()->route('posiciones.index')
            ->with('success', 'Posicion dada de alta correctamente');


    }

    public function edit($id)
    {

        try {

            $posicion = Posicion::findOrFail($id);

            $nivel = $posicion->nivel;
            $rack = $nivel->rack;
            $pasillo = $nivel->rack->pasillo;
            $sector = $pasillo->sector;
            $bodega = $sector->bodega;
            $localidad = $bodega->localidad;


            $localidades = Localidad::actived()->get();


            return view('registro.posiciones.edit',
                compact('pasillo', 'bodega', 'sector',
                    'nivel', 'localidades', 'localidad', 'posicion', 'rack'));


        } catch (\Exception $ex) {

            return redirect()->route('posiciones.index')
                ->withErrors(['error' => 'Posicion no encontrada']);
        }

    }

    public function update(PosicionRequest $request, $id)
    {

        try {

            $posicion = Posicion::findOrFail($id);
            $posicion->codigo_barras = $request->get('codigo_barras');
            $posicion->descripcion = $request->get('descripcion');
            $posicion->id_nivel = $request->get('id_nivel');
            $posicion->update();

            return redirect()->route('posiciones.index')
                ->with('success', 'Posicion actualizada correctamente');


        } catch (\Exception $ex) {

            return redirect()->route('posiciones.index')
                ->withErrors(['error' => 'Posicion no encontrada']);

        }
    }

    public function show($id)
    {

        try {

            $posicion = Posicion::findOrFail($id);

            $nivel = $posicion->nivel;
            $rack = $nivel->rack;
            $pasillo = $nivel->rack->pasillo;
            $sector = $pasillo->sector;
            $bodega = $sector->bodega;
            $localidad = $bodega->localidad;

            $localidades = Localidad::actived()->get();


            return view('registro.posiciones.show',
                compact('pasillo', 'bodega', 'sector',
                    'nivel', 'localidades', 'localidad', 'posicion', 'rack'));


        } catch (\Exception $ex) {

            return redirect()->route('posiciones.index')
                ->withErrors(['error' => 'Posicion no encontrada']);
        }

    }

    public function destroy($id)
    {

        try {

            $posicion = Posicion::findOrFail($id);
            $posicion->estado = 0;
            $posicion->update();
            return response()->json(['success' => 'Posicion dada de baja correctamente']);

        } catch (\Exception $ex) {
            return response()->json(
                ['error' => 'En este momento no es posible procesar su petición',
                    'mensaje' => $ex->getMessage()
                ]
            );

        }
    }

    public function posiciones_by_nivel($nivel)
    {

        try {
            $posiciones = Nivel::findOrFail($nivel)->posiciones()->actived()->get();

        } catch (\Exception $ex) {

            $posiciones = [];
        }

        return response()->json(['posiciones' => $posiciones]);
    }

}
