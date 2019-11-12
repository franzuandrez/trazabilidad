<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Movimiento;
use App\Producto;
use App\Recepcion;
use App\RMIDetalle;
use DB;
use Excel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    //

    private $search;
    private $sort;
    private $sortField;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {


        $this->search = $request->get('id_select_search') == null ? '0' : $request->get('id_select_search');


        if ($request->get('search') != null) {
            $search = $request->get('search');
        }
        $this->sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $this->sortField = $request->get('field') == null ? 'producto' : $request->get('field');
        $filtro = $request->get('filtro') == null ? '2' : $request->get('filtro');
        $bodegas = Bodega::select('id_bodega as id', 'descripcion as descripcion')->get();
        if ($this->search == 0) {

            $productos = $this->producto_en_transito($filtro)
                ->paginate(15);


        } else {
            $productos = $this->producto_en_bodega()
                ->paginate(15);
        }


        if ($request->ajax()) {
            return view('recepcion.kardex.index',
                [
                    'productos' => $productos,
                    'bodegas' => $bodegas,
                    'sort' => $this->sort,
                    'sortField' => $this->sortField,
                    'search' => $this->search,
                    'filtro' => $filtro
                ]
            );
        } else {
            return view('recepcion.kardex.ajax',
                [
                    'productos' => $productos,
                    'bodegas' => $bodegas,
                    'sort' => $this->sort,
                    'sortField' => $this->sortField,
                    'search' => $this->search,
                    'filtro' => $filtro
                ]
            );
        }

    }


    public function existencia(Request $request)
    {

        $search = $request->get('search');


        $productos = Producto::where('codigo_interno', '=', $search)
            ->orWhere('codigo_barras', '=', $search)
            ->pluck('id_producto');


        $ubicacion = $request->get('ubicacion');


        $existencias = Movimiento::join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
            ->select('movimientos.id_movimiento',
                'movimientos.lote',
                'movimientos.id_producto',
                'movimientos.ubicacion',
                'movimientos.fecha_vencimiento',
                DB::raw('sum(cantidad * factor) as total'))
            ->whereIn('id_producto', $productos)
            ->groupBy('id_producto')
            ->groupBy('lote')
            ->orderBy('movimientos.fecha_vencimiento', 'asc')
            ->with('producto')
            ->with('bodega')
            ->with('producto.presentacion')
            ->with('producto.dimensional')
            ->get();


        $response = $existencias;
        return response()->json($response);

    }


    public function reporte_excel(Request $request)
    {


    }

    /**
     * @param $filtro
     * @return Builder;
     */
    private function producto_en_transito($filtro)
    {


        $rmi_encabezado = Recepcion::esDocumentoMateriaPrima();
        if ($filtro == 2) { // TODAS
            $rmi_encabezado = $rmi_encabezado
                ->where(function ($query) {
                    $query->estaEnRampa()
                        ->orWhere
                        ->estaEnControl();
                });
        } elseif ($filtro == 0) { //SOLO LAS QUE DEBE VERIFICAR CALIDAD
            $rmi_encabezado = $rmi_encabezado->where(function ($query) {
                $query->estaEnRampa();
            });

        } else {
            $rmi_encabezado = $rmi_encabezado->where(function ($query) { // LAS QUE YA FUERON VERIFICADAS POR CALIDAD
                $query->estaEnControl();
            });
        }
        $rmi_encabezado = $rmi_encabezado->get()
            ->pluck('id_rmi_encabezado');


        $productos = RMIDetalle::join('productos', 'rmi_detalle.id_producto', '=', 'productos.id_producto')
            ->select('*',
                'productos.descripcion as producto',
                DB::raw('sum(cantidad) as total'), DB::raw('0 as bodega'))
            ->whereIn('id_rmi_encabezado', $rmi_encabezado)
            ->where(function ($query) {
                $query->estaEnRampa()
                    ->orWhere
                    ->estaEnControl();
            })
            ->orderBy($this->sortField, $this->sort)
            ->groupBy('rmi_detalle.id_producto')
            ->groupBy('rmi_detalle.lote');


        return $productos;
    }


    /**
     * @return Builder;
     */
    private function producto_en_bodega()
    {


        $productos = Movimiento::join('productos', 'movimientos.id_producto', '=', 'productos.id_producto')
            ->join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
            ->leftJoin('bodegas', 'movimientos.id_bodega', '=', 'bodegas.id_bodega')
            ->select('movimientos.*',
                'productos.descripcion as producto',
                DB::raw('sum( cantidad  * factor ) as total'),
                'bodegas.descripcion as bodega')
            ->where(function ($query) {
                $query->where('movimientos.id_bodega', $this->search);
            })
            ->orderBy($this->sortField, $this->sort)
            ->groupBy('movimientos.id_producto')
            ->groupBy('movimientos.lote')
            ->having(DB::raw('sum( cantidad  * factor )'), '>', 0);

        return $productos;

    }

}
