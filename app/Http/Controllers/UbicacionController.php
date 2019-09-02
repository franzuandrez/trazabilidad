<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Http\Requests\UbicacionRequest;
use App\Localidad;
use App\Nivel;
use App\Pasillo;
use App\Posicion;
use App\Sector;
use App\Ubicacion;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;

class UbicacionController extends Controller
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
        $sortField = $request->get('field') == null ? 'id_ubicacion' : $request->get('field');


        $ubicaciones = Ubicacion::leftJoin('bodegas', 'bodegas.id_bodega', '=', 'ubicaciones.id_bodega')
            ->leftJoin('localidades', 'localidades.id_localidad', '=', 'ubicaciones.id_localidad')
            ->leftJoin('sectores','sectores.id_sector','=','ubicaciones.id_sector')
            ->leftJoin('pasillos','pasillos.id_pasillo','=','ubicaciones.id_pasillo')
            ->leftJoin('racks','racks.id_rack','=','ubicaciones.id_rack')
            ->leftJoin('nivel','nivel.id_nivel','=','ubicaciones.id_nivel')
            ->leftJoin('posiciones','posiciones.id_posicion','=','ubicaciones.id_posicion')
            ->leftJoin('bines','bines.id_bin','=','ubicaciones.id_posicion')
            ->select('localidades.descripcion as localidad',
                'bodegas.descripcion as bodega', 'ubicaciones.*'
            )
            ->where(function ($query) use ($search) {
                $query->where('localidades.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('ubicaciones.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orWhere('bodegas.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('sectores.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('pasillos.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('racks.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('nivel.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('posiciones.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('bines.descripcion','LIKE','%'.$search.'%');

            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {

            return view('registro.ubicaciones.index', compact('ubicaciones', 'search', 'sort', 'sortField'));

        } else {
            return view('registro.ubicaciones.ajax', compact('ubicaciones', 'search', 'sort', 'sortField'));
        }


    }

    public function create()
    {

        $localidades = Localidad::actived()->get();
        return view('registro.ubicaciones.create', compact('localidades'));
    }


    public function store(UbicacionRequest $request)
    {




        try {
            $ubicacion = new Ubicacion;
            $ubicacion->id_localidad = $request->id_localidad;
            $ubicacion->id_bodega = $request->id_bodega;
            $ubicacion->id_sector = $request->id_sector;
            $ubicacion->id_pasillo = $request->id_pasillo;
            $ubicacion->id_rack = $request->id_rack;
            $ubicacion->id_nivel = $request->id_nivel;
            $ubicacion->id_posicion = $request->id_posicion;
            $ubicacion->id_bin = $request->id_bin;
            $codigo_barras = $this->getCodigoBarras($ubicacion);

            $existeCodigoBarras = Ubicacion::where('codigo_barras',$codigo_barras)->exists();

            if($existeCodigoBarras){
                return Redirect::back()->withErrors(['Ubicacion existente']);
            }

            $ubicacion->codigo_barras = $codigo_barras;
            $ubicacion->save();

            return redirect()->route('ubicaciones.index')
                ->with('success','Ubicacion dada de alta correctamente');
        } catch (\Exception $e) {

            return redirect()->route('ubicaciones.index')
                ->withErrors(['error'=>'Su petición no pudo ser procesada']);

        }

    }

    private function getCodigoBarras($ubicacion)
    {

        $localidad = str_pad($ubicacion->localidad->codigo_interno,2,"0",STR_PAD_LEFT);
        $bodega=str_pad($ubicacion->bodega->codigo_interno,2,"0",STR_PAD_LEFT);
        $sector = str_pad($ubicacion->sector->codigo_interno,2,"0",STR_PAD_LEFT);
        $pasillo = str_pad($ubicacion->pasillo->codigo_interno,2,"0",STR_PAD_LEFT);
        $rack = str_pad($ubicacion->rack->codigo_interno,2,"0");
        $nivel = str_pad($ubicacion->nivel->codigo_interno,1,"0",STR_PAD_LEFT);
        $posicion = str_pad($ubicacion->posicion->codigo_interno,1,"0",STR_PAD_LEFT);
        $bin = str_pad($ubicacion->bin->codigo_interno,1,"0",STR_PAD_LEFT);
        $codigo_barras = $localidad.$bodega.$sector.$pasillo.$rack.$nivel.$posicion.$bin;

        return $codigo_barras;

    }
}
