<?php

namespace App\Http\Controllers;

use App\Operacion;
use Illuminate\Http\Request;

class OperacionController extends Controller
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
        $sortField = $request->get('field') == null ? 'id_control' : $request->get('field');

        $operaciones = Operacion::join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search) {
                $query->where('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.codigo_interno', 'LIKE', '%' . $search . '%')
                    ->orWhere('control_trazabilidad.no_orden_produccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('control_trazabilidad.lote', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {

            return view('produccion.control_trazabilidad.index',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'operaciones' => $operaciones
                ]
            );
        } else {
            return view('produccion.control_trazabilidad.ajax',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'operaciones' => $operaciones
                ]

            );
        }

    }

    public function create()
    {



        return view('produccion.control_trazabilidad.create');


    }
}
