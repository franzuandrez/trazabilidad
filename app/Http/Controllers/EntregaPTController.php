<?php

namespace App\Http\Controllers;

use App\EntregaDet;
use App\EntregaEnc;
use App\Operacion;
use App\Repository\EntregaRepository;
use App\Repository\MovimientoRepository;
use App\Repository\TrazabilidadRepository;
use App\Sector;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class EntregaPTController extends Controller
{
    //


    private $trazabilidad_repository;
    private $entrega_repository;
    private $movimiento_repository;

    public function __construct(
        TrazabilidadRepository $trazabilidad_repository,
        EntregaRepository $entrega_repository,
        MovimientoRepository $movimientoRepository
    )
    {
        $this->middleware('auth');
        $this->trazabilidad_repository = $trazabilidad_repository;
        $this->entrega_repository = $entrega_repository;
        $this->movimiento_repository = $movimientoRepository;

    }


    public function index_entrega_pt(Request $request)
    {


        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'created_at' : $request->get('field');


        $collection = $this->trazabilidad_repository
            ->searchControlesDeTrazabilidad($search, $sortField, $sort)
            ->where('productos.tipo_producto', 'PT')//PRODUCTO TERMINADO
            ->where('esta_entregado', '<>', '1')//NO HA SIDO ENTREGADO
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
        $sortField = $request->get('field') == null ? 'fecha_hora' : $request->get('field');

        $collection = EntregaEnc::select('entrega_pt_enc.*', 'users.nombre')
            ->join('users', 'users.id', '=', 'entrega_pt_enc.id_usuario')
            ->where('entrega_pt_enc.estado', '<>', 2)
            ->paginate(20);

        if ($request->ajax()) {
            return view('entregas.recepcion_pt.index',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'collection' => $collection

                ]);
        } else {
            return view('entregas.recepcion_pt.ajax',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'collection' => $collection
                ]);
        }
    }


    public function edit_recepcion_pt($id)
    {
        $entrega = EntregaEnc::with('detalle.control_trazabilidad.producto')
            ->findOrFail($id);

        $ubicaciones = Sector::actived()
            ->with('bodega')
            ->get();


        return view('entregas.recepcion_pt.recepcion', [
            'entrega' => $entrega,
            'ubicaciones' => $ubicaciones
        ]);
    }

    public function update_recepcion_pt($id, Request $request)
    {
        $usuario_autoriza = User::where('username', $request->get('user_acepted'))->first();
        $productos = $request->get('id_producto');
        $cantidades = $request->get('cantidad');
        $lotes = $lote = $request->get('lote');
        $ubicaciones = $request->get('ubicacion');
        $fechas_vencimiento = $request->get('fecha_vencimiento');

        try {
            DB::beginTransaction();
            $entrega = EntregaEnc::findOrFail($id);

            $entrega->estado = 2;
            $entrega->fecha_recepcion = Carbon::now();
            $entrega->save();
            $this->movimiento_repository->setUsuarioAutoriza($usuario_autoriza);
            $this->movimiento_repository->setIdsProductos($productos);
            $this->movimiento_repository->setCantidades($cantidades);
            $this->movimiento_repository->setFechasVencimiento($fechas_vencimiento);
            $this->movimiento_repository->setLotes($lotes);
            $this->movimiento_repository->setIdsUbicaciones($ubicaciones);
            $this->movimiento_repository->setNoDocumento($entrega->id);
            $this->movimiento_repository->setTipoDocumento('RECEPCION_PT');
            $this->movimiento_repository->ubicarProductos();

            DB::commit();
            return redirect()->route('produccion.index_recepcion_pt')
                ->with('success', 'Producto ubicado correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->route('produccion.index_recepcion_pt')
                ->withErrors(['Su peticion no ha podido ser procesada']);

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
