<?php

namespace App\Http\Controllers;

use App\EntregaDet;
use App\EntregaEnc;
use App\Operacion;
use App\Repository\EntregaRepository;
use App\Repository\TrazabilidadRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntregaPTController extends Controller
{
    //


    private $trazabilidad_repository;
    private $entrega_repository;

    public function __construct(TrazabilidadRepository $trazabilidad_repository, EntregaRepository $entrega_repository)
    {
        $this->middleware('auth');
        $this->trazabilidad_repository = $trazabilidad_repository;
        $this->entrega_repository = $entrega_repository;

    }


    public function index_entrega_pt(Request $request)
    {


        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'productos.id_producto' : $request->get('field');


        $collection = EntregaEnc::select('entrega_pt_enc.*', 'users.nombre')
            ->join('users', 'users.id', '=', 'entrega_pt_enc.id_usuario')
            ->paginate(20);

        if ($request->ajax()) {
            return view('entregas.entrega_pt.index',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'collection' => $collection
                ]);
        } else {
            return view('entregas.entrega_pt.ajax',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'collection' => $collection
                ]);
        }

    }

    public function show_entrega_pt($id)
    {

        $entrega = EntregaEnc::findOrFail($id);
        return view('entregas.entrega_pt.show', [
            'entrega' => $entrega
        ]);
    }

    public function create_entrega_pt()
    {


        return view('entregas.entrega_pt.create');
    }

    public function store_entrega_pt()
    {


        return redirect()
            ->route('produccion.index_entrega_pt')
            ->with('success', 'Guardado correctamente');
    }

    public function index_recepcion_pt(Request $request)
    {
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'id_producto' : $request->get('field');


        if ($request->ajax()) {
            return view('entregas.recepcion_pt.index',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,

                ]);
        } else {
            return view('entregas.recepcion_pt.ajax',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                ]);
        }
    }


    public function create_recepcion_pt()
    {

        return view('entregas.recepcion_pt.create');
    }

    public function buscar_producto(Request $request)
    {
        $lote = $request->get('lote');

        $trazabilidad = $this->trazabilidad_repository->getControlTrazabilidadByLote($lote);
        $unidades_entregadas = 0;
        $cajas_entregadas = 0;
        if ($trazabilidad != null) {
            $unidades_entregadas = $this->entrega_repository->getTotalUnidadesEntregadas($trazabilidad->id_control);
            $cajas_entregadas = $this->entrega_repository->getTotalCajasEntregadas($trazabilidad->id_control);
        }


        return response([
            'esta_entregado' => $trazabilidad->esta_entregado == 1,
            'data' => [
                'trazabilidad' => $trazabilidad,
                'unidades_entregadas' => $unidades_entregadas,
                'cajas_entregadas' => $cajas_entregadas,
            ]
        ]);

    }


    public function agregar_producto(Request $request)
    {


        try {
            $data = $this->entrega_repository->agregar_producto($request);

            return response([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

}
