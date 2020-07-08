<?php

namespace App\Http\Controllers;

use App\Repository\ConsultaTrazabilidadRepository;
use App\Requisicion;
use Illuminate\Http\Request;

class ConsultaTrazabilidadController extends Controller
{
    //
    private $consulta = null;

    public function __construct(ConsultaTrazabilidadRepository $consulta)
    {
        $this->middleware('auth');
        $this->consulta = $consulta;

    }

    public function index(Request $request)
    {



        $search = $request->search == null ? '' : $request->search;

        $trazabilidadHaciaAtras = $this->consulta->getTrazabilidadHaciaAtras($search);

        $productoTrazabilidad = $this->consulta->getControlTrazabilidad();



        if ($request->ajax()) {
            return view('operaciones.trazabilidad.ajax', [
                'search' => $search,
                'trazabilidad_hacia_atras' => $trazabilidadHaciaAtras,
                'producto_trazabilidad' => $productoTrazabilidad,

            ]);
        }

        return view('operaciones.trazabilidad.index', [
            'search' => $search,
            'trazabilidad_hacia_atras' => $trazabilidadHaciaAtras,
            'producto_trazabilidad' => $productoTrazabilidad,

        ]);

    }

}
