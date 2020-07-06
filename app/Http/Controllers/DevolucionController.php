<?php

namespace App\Http\Controllers;

use App\Repository\TrazabilidadRepository;
use DB;
use Illuminate\Http\Request;

/**
 * @property TrazabilidadRepository $trazabilidad_repository
 *
 **/
class DevolucionController extends Controller
{
    //
    private $trazabilidad_repository = null;

    public function __construct(TrazabilidadRepository $trazabilidad_repository)
    {

        $this->middleware('auth');
        $this->trazabilidad_repository = $trazabilidad_repository;
    }


    public function index(Request $request)
    {
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'id_control' : $request->get('field');
        $id_control = DB::table('control_trazabilidad_orden_produccion')
            ->where('no_orden_produccion', 'LIKE', '%' . $search . '%')
            ->get()
            ->pluck('id_control')
            ->toArray();


        $operaciones = $this->trazabilidad_repository
            ->searchControlesDeTrazabilidad($search, $sortField, $sort, $id_control)
            ->where('control_trazabilidad.status', 3)
            ->paginate(20);

        if ($request->ajax()) {

            return view('produccion.devoluciones.index',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'operaciones' => $operaciones
                ]
            );
        } else {
            return view('produccion.devoluciones.ajax',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'operaciones' => $operaciones
                ]

            );
        }


    }
}
