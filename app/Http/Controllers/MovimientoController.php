<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Movimiento;
use App\Producto;
use App\RequisicionDetalle;
use Illuminate\Http\Request;
use DB;

class MovimientoController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {


        $search = $request->get('id_select_search') == null ? '0' : $request->get('id_select_search');
        if ($request->get('search') != null) {
            $search = $request->get('search');
        }
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'movimientos.ubicacion' : $request->get('field');
        $bodegas = Bodega::select('id_bodega as id', 'descripcion as descripcion')->get();
        $productos = Movimiento::join('productos', 'movimientos.id_producto', '=', 'productos.id_producto')
            ->join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
            ->leftJoin('bodegas', 'movimientos.id_bodega', '=', 'bodegas.id_bodega')
            ->select('movimientos.*',
                'productos.descripcion as producto',
                DB::raw('sum( cantidad  * factor ) as total'),
                'bodegas.descripcion as bodega')
            ->where(function ($query) use ($search) {
                $query->where('movimientos.id_bodega', $search);
            })
            ->orderBy($sortField, $sort)
            ->groupBy('movimientos.id_producto')
            ->groupBy('movimientos.lote')
            ->having(DB::raw('sum( cantidad  * factor )'), '>', 0)
            ->paginate(15);

        if ($request->ajax()) {
            return view('recepcion.kardex.index',
                compact('productos', 'bodegas', 'sort', 'sortField', 'search'));
        } else {
            return view('recepcion.kardex.ajax',
                compact('productos', 'bodegas', 'sort', 'sortField', 'search'));
        }

    }


    public function existencia(Request $request)
    {

        $search = $request->get('search');


        $productos = Producto::where('codigo_interno','=',$search)
            ->orWhere('codigo_barras','=',$search)
            ->pluck('id_producto');


        $ubicacion = $request->get('ubicacion');


        $existencias = Movimiento::join('tipo_movimiento','tipo_movimiento.id_movimiento','=','movimientos.tipo_movimiento')
            ->select('movimientos.id_movimiento',
                'movimientos.lote',
                'movimientos.id_producto',
                'movimientos.ubicacion',
                'movimientos.fecha_vencimiento',
                DB::raw('sum(cantidad * factor) as total'))
            ->whereIn('id_producto', $productos)
            ->groupBy('id_producto')
            ->groupBy('lote')
            ->orderBy('movimientos.fecha_vencimiento','asc')
            ->with('producto')
            ->with('bodega')
            ->with('producto.presentacion')
            ->with('producto.dimensional')
            ->get();


        $response = $existencias;
        return response()->json($response);

    }


}
