<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Http\tools\Movimientos;
use App\Movimiento;
use App\Producto;
use App\Recepcion;
use App\Repository\MovimientoRepository;
use App\RMIDetalle;
use App\Sector;
use App\Tarima;
use App\TipoMovimiento;
use Carbon\Carbon;
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
    private $movimientoRepository;

    public function __construct(MovimientoRepository $movimientoRepository)
    {
        $this->middleware('auth');
        $this->movimientoRepository = $movimientoRepository;
    }


    public function store(Request $request)
    {


        if ($request->ajax()) {

            $this->generar_movimiento($request);
            return response(
                [
                    'success' => true,
                    'data' => ($request->all())

                ]
            );
        } else {


            foreach ($request->get('unidad_distribucion') as $caja) {

                Tarima::where('sscc_unidad_distribucion', $caja)->update([
                    'estado' => 0
                ]);
            }
            $this->generar_movimiento($request);
            return redirect()->route('produccion.despacho.despachar', $request->get('id_despacho'));
        }

    }


    public function movimientos_inventario(Request $request)
    {

        $ubicaciones = Sector::actived()
            ->where('id_bodega', '1')
            ->get();
        $tipo_movimientos_entrada = TipoMovimiento::actived()->where('factor', '>', '0')->get();
        $tipo_movimientos_salida = TipoMovimiento::actived()->where('factor', '<', '0')->get();


        return view('movimientos.movimiento_inventario.index', [
            'ubicaciones' => $ubicaciones,
            'tipo_movimientos_entrada' => $tipo_movimientos_entrada,
            'tipo_movimientos_salida' => $tipo_movimientos_salida,
        ]);

    }


    public function generar_movimiento(Request $request)
    {


        foreach ($request->id_producto as $key => $item) {

            $this->movimientoRepository->setNoDocumento($request->get('no_documento') == null ? 'DESPACHO-' . Carbon::now()->format('hisdmY') : $request->get('no_documento'));
            $this->movimientoRepository->setUsuarioAutoriza(\Auth::getUser());
            $this->movimientoRepository->setTipoDocumento($request->get('tipo_doc') == null ? 'DESPACHO' : $request->get('tipo_doc'));
            $this->movimientoRepository->setProducto(Producto::find($item));
            $this->movimientoRepository->setFechaVencimiento($request->get('fecha_vencimiento')[$key]);
            $this->movimientoRepository->setLote($request->get('lote')[$key]);
            $this->movimientoRepository->setSector(Sector::whereCodigoBarras($request->get('bodega_saliente')[$key])->first());
            $this->movimientoRepository->setCantidad($request->get('cantidad_saliente')[$key]);
            $this->movimientoRepository->generar_movimiento($request->get('tipo_movimiento_salida')[$key] == null ? 2 : $request->get('tipo_movimiento_salida')[$key]);
            $this->movimientoRepository->setSector(Sector::whereCodigoBarras($request->get('bodega_entrante')[$key])->first());
            $this->movimientoRepository->setCantidad($request->get('cantidad_entrante')[$key]);
            $this->movimientoRepository->generar_movimiento($request->get('tipo_movimiento_entrada')[$key] == null ? 1 : $request->get('tipo_movimiento_entrada')[$key]);

        }


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
        $bodegas = Sector::select('id_sector as id', 'descripcion as descripcion')
            ->actived()
            ->where('id_bodega', '1')
            ->get();
        $transito = $this->producto_en_transito($filtro);


        $productos = $this->producto_en_bodega()
            ->union($transito)
            ->orderBy($this->sortField, $this->sort)
            ->get();

        $tipos_movimiento = TipoMovimiento::all();


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
                    'end' => $this->end,
                    'tipos_movimiento' => $tipos_movimiento,
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
                    'end' => $this->end,
                    'tipos_movimiento' => $tipos_movimiento,
                ]
            );
        }

    }


    public function existencia(Request $request)
    {

        $movimientos = new Movimientos();

        if ($request->get('con_lotes')) {
            return $movimientos->existencia_con_lotes($request->get('search'));
        } else {

            return $movimientos->existencia($request->get('search'));
        }


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


        $filtrosDisponibles = [
            'id_select_search' => 'bodega',
            'producto' => 'producto',
            'lote' => 'lote',
            'end' => 'rango'
        ];
        $filtrosUsados = collect($filtrosDisponibles)->intersectByKeys(collect($request->all()));


        return Excel::create("Inventario", function ($excel) use ($productos, $request) {
            $excel->sheet("Inventario", function ($sheet) use ($productos, $request) {
                $sheet->loadView('recepcion.kardex.excel',
                    [
                        'collection' => $productos,
                        'parametros' => $request,
                        'tipos_movimiento' => TipoMovimiento::all()
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

        $query = $this->getTiposMovimientoQuery(true);
        $productos = RMIDetalle::join('productos', 'rmi_detalle.id_producto', '=', 'productos.id_producto')
            ->select(DB::raw('0 as id_bodega'),
                'productos.descripcion as producto',
                'productos.codigo_interno as codigo_interno',
                'productos.unidad_medida as unidad_medida',
                'rmi_detalle.lote as lote',
                DB::raw("'AREA TRANSITO' as bodega"),
                DB::raw("'AREA TRANSITO' as ubicacion"),
                DB::raw($query),
                DB::raw('sum(cantidad_entrante) as total'
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
                $query->orWhere('productos.descripcion', 'LIKE', '%' . $this->producto . '%')
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

        $query = $this->getTiposMovimientoQuery();
        $productos = Movimiento::join('productos', 'movimientos.id_producto', '=', 'productos.id_producto')
            ->join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
            ->leftJoin('bodegas', 'movimientos.id_bodega', '=', 'bodegas.id_bodega')
            ->leftJoin('sectores', 'movimientos.id_sector', '=', 'sectores.id_sector')
            ->select('movimientos.id_bodega as id_bodega',
                'productos.descripcion as producto',
                'productos.codigo_interno as codigo_interno',
                'productos.unidad_medida as unidad_medida',
                'movimientos.lote as lote',
                'bodegas.descripcion as bodega',
                'sectores.descripcion as ubicacion',
                DB::raw($query),
                DB::raw('sum( cantidad  * factor ) as total')
            );


        if ($this->search != '' && $this->search != null) {
            $productos = $productos->where(function ($query) {
                $query->where('movimientos.id_sector', $this->search);
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
            ->groupBy('movimientos.id_sector');


        return $productos;

    }

    private function getTiposMovimientoQuery($es_transito = false)
    {

        if ($es_transito) {

            $query = TipoMovimiento::all()->map(function ($item) {
                if ($item->id_movimiento == 1) {
                    return ('sum(cantidad_entrante) as ' . $item->descripcion);;
                }
                return (' "0"  as ' . $item->descripcion);

            });
        } else {
            $query = TipoMovimiento::all()->map(function ($item) {
                return (('sum( if(tipo_movimiento=' . $item->id_movimiento . ', cantidad  ,0) ) as ' . $item->descripcion));
            });
        }
        $query = $query->reduce(function ($item, $carry) {
            return $item . $carry . ',';
        }, "");
        $query = rtrim($query, ',');


        return $query;
    }


    public function kardex(Request $request)
    {

        $this->producto = $request->get('producto') == null ? '' : $request->get('producto');
        $ubicacion = $request->get('ubicacion') == null ? '' : $request->get('ubicacion');

        $movimientos = collect([]);

        $saldo_inicial = 0;
        $saldo_inicial_cajas = 0;
        $saldo_inicial_unidades = 0;
        if ($this->producto != '') {
            $producto = Producto::orWhere('productos.codigo_interno', $this->producto)
                ->orwhere('productos.codigo_barras', $this->producto)
                ->first();
            if ($producto != null) {
                $movimientos = Movimiento::join('productos', 'movimientos.id_producto', '=', 'productos.id_producto')
                    ->join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
                    ->leftJoin('bodegas', 'movimientos.id_bodega', '=', 'bodegas.id_bodega')
                    ->leftJoin('sectores', 'movimientos.id_sector', '=', 'sectores.id_sector')
                    ->select('movimientos.id_bodega as id_bodega',
                        'movimientos.numero_documento as numero_documento',
                        'movimientos.requisicion as requisicion',
                        'movimientos.fecha_hora_movimiento as fecha_hora_movimiento',
                        'productos.descripcion as producto',
                        'productos.codigo_interno as codigo_interno',
                        'productos.tipo_producto as tipo_produccto',
                        'productos.unidad_medida as unidad_medida',
                        'sectores.codigo_barras as codigo_sector',
                        'movimientos.lote as lote',
                        'bodegas.descripcion as bodega',
                        'sectores.descripcion as ubicacion',
                        DB::raw('( cantidad   ) as total'),
                        'tipo_movimiento.factor'
                    );

                if ($ubicacion != "") {
                    $movimientos = $movimientos->where('movimientos.id_sector', $ubicacion);
                }

                $movimientos = $movimientos->where(function ($query) {
                    $query->where('productos.codigo_interno', $this->producto)
                        ->orwhere('productos.codigo_barras', $this->producto);
                })->orderBy('sectores.codigo_barras', 'asc')
                    ->orderBy('fecha_hora_movimiento', 'asc')
                    ->get();
            }

        }


        $ubicaciones = Sector::select('id_sector as id', 'descripcion')
            ->where('id_bodega', '1')
            ->actived()
            ->get();
        $hay_movimientos_unidades = false;
        $hay_movimientos_cajas = false;
        if ($request->ajax()) {

            return view('recepcion.kardex_detallado.index',
                [

                    'movimientos' => $movimientos,
                    'sort' => $this->sort,
                    'sortField' => $this->sortField,
                    'search' => $this->search,
                    'producto' => $this->producto,
                    'lote' => $this->lote,
                    'start' => $this->start,
                    'end' => $this->end,
                    'saldo_inicial' => $saldo_inicial,
                    'saldo_inicial_cajas' => $saldo_inicial_cajas,
                    'saldo_inicial_unidades' => $saldo_inicial_unidades,
                    'ubicaciones' => $ubicaciones,
                    'ubicacion' => $ubicacion,
                    'hay_movimientos_unidades' => $hay_movimientos_unidades,
                    'hay_movimientos_cajas' => $hay_movimientos_cajas,

                ]
            );
        } else {
            return view('recepcion.kardex_detallado.ajax',
                [
                    'movimientos' => $movimientos,
                    'sort' => $this->sort,
                    'sortField' => $this->sortField,
                    'search' => $this->search,
                    'producto' => $this->producto,
                    'lote' => $this->lote,
                    'start' => $this->start,
                    'end' => $this->end,
                    'saldo_inicial' => $saldo_inicial,
                    'saldo_inicial_cajas' => $saldo_inicial_cajas,
                    'saldo_inicial_unidades' => $saldo_inicial_unidades,
                    'ubicaciones' => $ubicaciones,
                    'ubicacion' => $ubicacion,
                    'hay_movimientos_unidades' => $hay_movimientos_unidades,
                    'hay_movimientos_cajas' => $hay_movimientos_cajas,
                ]
            );
        }


    }

}
