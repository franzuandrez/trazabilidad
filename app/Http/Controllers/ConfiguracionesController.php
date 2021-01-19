<?php

namespace App\Http\Controllers;

use App\ConfiguracionesGenerales;
use App\Http\tools\Impresiones;
use App\Repository\ConfiguracionesRepository;
use Illuminate\Http\Request;

class ConfiguracionesController extends Controller
{
    //


    private $configuracionesGenerales;

    public function __construct(ConfiguracionesRepository $configuracionesGenerales)
    {
        $this->configuracionesGenerales = $configuracionesGenerales;
    }

    public function impresion(Request $request)
    {


        $configuraciones = $this
            ->configuracionesGenerales
            ->configuraciones_de_impresion();


        return view('configuraciones.impresion.index', [
            'configuraciones' => $configuraciones
        ]);
    }

    public function store_impresion(Request $request)
    {

        $this->configuracionesGenerales->storeFromRequest($request->except('_token'));

        return redirect()->route('configuraciones.index')
            ->with('success', 'Guardado correctamente');
    }


    public function imprimir_etiquetas_tarima(Request $request)
    {
        Impresiones::imprimir_corrugado_pallet($request->cantidad);

        return response([
            'success' => true,
            'data' => 'Impresion enviada correctamente'
        ]);

    }
}
