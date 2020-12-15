<?php

namespace App\Http\Controllers;

use App\EntregaEnc;
use App\EntregaParcial;
use App\Http\tools\Impresiones;
use App\Operacion;
use App\Repository\TrazabilidadRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntregasParcialesController extends Controller
{
    //

    private $trazabilidadRepository;

    public function __construct(TrazabilidadRepository $trazabilidadRepository)
    {
        $this->trazabilidadRepository = $trazabilidadRepository;
        $this->middleware('auth');
    }


    public function store(Request $request, $id)
    {


        $control_trazabilidad = $this->trazabilidadRepository->getControlTrazabilidadById($id);

        if ($control_trazabilidad->producto->tipo_producto == 'PT') {
            $entrega = new EntregaParcial();
            $entrega->id_control = $id;
            $entrega->fecha_hora = Carbon::now();
            $entrega->cantidad_unidades_etiqueta = $request->get('cantidad_etiquetas_unidades_parcial');
            $entrega->cantidad_unidades_distribucion = $request->get('cantidad_etiquetas_corrugado_parcial');
            $entrega->cantidad_produccion = $request->get('cantidad_produccion_parcial');
            $entrega->impresora = $request->get('impresora');
            $entrega->id_usuario = \Auth::id();
            $entrega->save();
            $control_trazabilidad->cantidad_producida = $control_trazabilidad->cantidad_producida + $entrega->cantidad_produccion;
            $control_trazabilidad->save();
            Impresiones::imprimir_corrugado($control_trazabilidad, $request->get('cantidad_produccion_parcial'), $request->get('ip'));
        }

        return response([
            'success' => true,
        ]);

    }
}
