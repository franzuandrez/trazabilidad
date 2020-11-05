<?php

namespace App\Http\Controllers;

use App\DetalleInsumo;
use App\Operacion;
use App\Producto;
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

        $trazabilidadHaciaAtras = $this->consulta->getTrazabilidadHaciaAtrasByProducto($search);


        $productoTrazabilidad = $this->consulta->getControlTrazabilidad();
        $trazabilidadHaciaAtras_pp = null;
        $productoTrazabilidad_pp = null;
        if ($productoTrazabilidad != null) {
            if ($productoTrazabilidad->producto->tipo_producto == 'PT') {
                $producto_proceso = DetalleInsumo::whereIdControl($productoTrazabilidad->id_control)
                    ->join('productos', 'productos.id_producto', '=', 'detalle_insumos.id_producto')
                    ->where('productos.tipo_producto', 'PP')
                    ->first();
                if ($producto_proceso != null) {
                    $trazabilidadHaciaAtras_pp = $this->consulta->getTrazabilidadHaciaAtrasByProducto(
                        $producto_proceso->lote
                    );
                    $productoTrazabilidad_pp = Operacion::whereLote($producto_proceso->lote)->first();

                }

            }
        }


        if ($request->ajax()) {
            return view('operaciones.trazabilidad.ajax_second', [
                'search' => $search,
                'trazabilidad_hacia_atras' => $trazabilidadHaciaAtras,
                'trazabilidad_hacia_atras_pp' => $trazabilidadHaciaAtras_pp,
                'producto_trazabilidad' => $productoTrazabilidad,
                'producto_trazabilidad_pp' => $productoTrazabilidad_pp,

            ]);
        }

        return view('operaciones.trazabilidad.index', [
            'search' => $search,
            'trazabilidad_hacia_atras' => $trazabilidadHaciaAtras,
            'trazabilidad_hacia_atras_pp' => $trazabilidadHaciaAtras_pp,
            'producto_trazabilidad' => $productoTrazabilidad,
            'producto_trazabilidad_pp' => $productoTrazabilidad_pp,

        ]);

    }


    public function hacia_adelante(Request $request)
    {

        $search = $request->search == null ? '' : $request->search;


        $trazabilidadHaciaAdelante = $this->consulta->getTrazabilidadHaciaAdelanteByProducto($search);


        if ($request->ajax()) {

            return view('operaciones.hacia_adelante.ajax', [
                'search' => $search,
                'trazabilidad_hacia_adelante' => $trazabilidadHaciaAdelante
            ]);
        }

        return view('operaciones.hacia_adelante.index', [
            'search' => $search,
            'trazabilidad_hacia_adelante' => $trazabilidadHaciaAdelante
        ]);


    }

}
