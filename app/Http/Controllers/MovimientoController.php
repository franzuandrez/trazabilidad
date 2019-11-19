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
use Paginator;

class MovimientoController extends Controller
{
    //

    private $search;
    private $sort;
    private $sortField;
    private $lote;
    private $producto;
    private $start;
    private $end;

    public function __construct()
    {
        $this->middleware('auth');
    }


    private function setFiltros($request)
    {
        $this->search = $request->get('id_select_search') == null ? '' : $request->get('id_select_search');
        $this->lote = $request->get('lote') == null ? '' : $request->get('lote');
        $this->producto = $request->get('producto') == null ? '' : $request->get('producto');
        $this->start = $request->get('start');
        $this->end = $request->get('end');

        if ($request->get('search') != null) {
            $this->search = $request->get('search');
        }
        $this->sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $this->sortField = $request->get('field') == null ? 'producto' : $request->get('field');
    }

    public function index(Request $request)
    {

        $this->setFiltros($request);
        $filtro = $request->get('filtro') == null ? '2' : $request->get('filtro');
        $bodegas = Bodega::select('id_bodega as id', 'descripcion as descripcion')->get();
        $transito = $this->producto_en_transito($filtro);


        $productos = $this->producto_en_bodega()
            ->union($transito)
            ->orderBy($this->sortField, $this->sort)
            ->get();


        if ($request->ajax()) {
            return view('recepcion.kardex.index',
                [
                    'productos' => $productos,
                    'bodegas' => $bodegas,
                    'sort' => $this->sort,
                    'sortField' => $this->sortField,
                    'search' => $this->search,
                    'filtro' => $filtro,
                    'producto' => $this->producto,
                    'lote' => $this->lote,
                    'start' => $this->start,
                    'end' => $this->end
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
                    'filtro' => $filtro,
                    'producto' => $this->producto,
                    'lote' => $this->lote,
                    'start' => $this->start,
                    'end' => $this->end
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


        $this->setFiltros($request);
        $filtro = $request->get('filtro') == null ? '2' : $request->get('filtro');
        $transito = $this->producto_en_transito($filtro);
        $productos = $this->producto_en_bodega()
            ->union($transito)
            ->orderBy($this->sortField, $this->sort)
            ->get();


        return Excel::create("Inventario", function ($excel) use ($productos) {
            $excel->sheet("Inventario", function ($sheet) use ($productos) {
                $sheet->loadView('recepcion.kardex.excel',
                    [
                        'collection' => $productos,
                    ]);
            });
        })->export('xlsx');


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

        if ($this->start != '' && $this->start != null && $this->end != '' && $this->end != null) {
            $rmi_encabezado = $rmi_encabezado->whereBetween(DB::raw("date_format(rmi_encabezado.fecha_ingreso,'%Y-%m-%d')"), [$this->start, $this->end]);
        }

        $rmi_encabezado = $rmi_encabezado->get()
            ->pluck('id_rmi_encabezado');


        $productos = RMIDetalle::join('productos', 'rmi_detalle.id_producto', '=', 'productos.id_producto')
            ->select(DB::raw('0 as id_bodega'),
                'productos.descripcion as producto',
                'rmi_detalle.lote as lote',
                DB::raw("'BODEGA TRANSITO' as bodega"),
                DB::raw('sum(cantidad) as total'
                ))
            ->whereIn('id_rmi_encabezado', $rmi_encabezado)
            ->where(function ($query) {
                $query->estaEnRampa()
                    ->orWhere
                    ->estaEnControl();
            });

        if ($this->lote != null && $this->lote != '') {
            $productos = $productos->where('lote', $this->lote);
        }

        if ($this->producto != null && $this->producto != '') {
            $productos = $productos->where(function ($query) {
                $query->where('productos.descripcion', 'LIKE', '%' . $this->producto . '%')
                    ->orWhere('productos.codigo_barras', $this->producto)
                    ->orWhere('productos.codigo_interno', $this->producto);
            });
        }

        if ($this->search != null && $this->search != 0) {
            $productos = $productos->where(DB::RAW('0'), '1');
        }


        $productos = $productos->groupBy('rmi_detalle.id_producto')
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
            ->select('movimientos.id_bodega as id_bodega',
                'productos.descripcion as producto',
                'movimientos.lote as lote',
                'bodegas.descripcion as bodega',
                DB::raw('sum( cantidad  * factor ) as total')
            );


        if ($this->search != '' && $this->search != null) {
            $productos = $productos->where(function ($query) {
                $query->where('movimientos.id_bodega', $this->search);
            });
        }

        if ($this->producto != '' && $this->producto != null) {
            $productos = $productos->where(function ($query) {
                $query->where('productos.codigo_interno', $this->producto)
                    ->orwhere('productos.codigo_barras', $this->producto)
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $this->producto . '%');
            });
        }

        if ($this->lote != '' && $this->lote != null) {
            $productos = $productos->where(function ($query) {
                $query->where('movimientos.lote', $this->lote);
            });
        }

        if ($this->start != '' && $this->start != null && $this->end != '' && $this->end != null) {
            $productos = $productos->where(function ($query) {
                $query->whereBetween(DB::raw(" date_format(fecha_hora_movimiento,'%Y-%m-%d') "), [$this->start, $this->end]);
            });
        }

        $productos = $productos->groupBy('movimientos.id_producto')
            ->groupBy('movimientos.lote')
            ->having(DB::raw('sum( cantidad  * factor )'), '>', 0);


        return $productos;

    }

}
