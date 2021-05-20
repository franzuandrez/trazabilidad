<?php

namespace App\Http\Controllers;

use App\EntregaDet;
use App\EntregaEnc;
use App\Http\tools\GeneradorCodigos;
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
            ->where('cantidad_producida', '>', '0')//HAY ENTREGAS PARCIALES
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


    public function edit($id)
    {
        $control_trazabilidad = $this->trazabilidad_repository->getControlTrazabilidadById($id);

        $entregas = EntregaDet::where('entrega_pt_det.id_control', $control_trazabilidad->id_control)
            ->select('entrega_pt_det.*',
                \DB::raw('(select estado from tb_imprimir_corrugado
                    where concat(identificador_aplicacion,digito_indicador,prefijo_compania,numerio_serial,codigo_verificador)=  entrega_pt_det.no_tarima
                    limit 1) as estado_tarima
                ')
            )
            ->get();


        return view('entregas.entrega_pt.create', [
            'control_trazabilidad' => $control_trazabilidad,
            'entregas' => $entregas
        ]);

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

    public function store_entrega_pt(Request $request)
    {


        $control_trazabilidad = $this->trazabilidad_repository->getControlTrazabilidadById($request->id_control);
        $unidades_producidas = intval($control_trazabilidad->cantidad_producida % $control_trazabilidad->producto->cantidad_unidades);
        $cajas_producidas = intval($control_trazabilidad->cantidad_producida / $control_trazabilidad->producto->cantidad_unidades);


        $unidades_entregadas = $this->entrega_repository->getTotalUnidadesEntregadas($request->id_control);
        $cajas_entregadas = $this->entrega_repository->getTotalCajasEntregadas($request->id_control);


        if ($cajas_entregadas == 0 && $unidades_entregadas == 0) {

            return redirect()->back()->withErrors(['Entrega incompleta']);
        }

        if ($unidades_producidas - $unidades_entregadas >= 0 && $cajas_producidas - $cajas_entregadas >= 0) {
            $this->trazabilidad_repository->marcarEntregado();
            $entrega = EntregaEnc::where('id_control',
                $control_trazabilidad->id_control
            )
                ->first();
            $entrega->estado = 1;
            $entrega->update();

            return redirect()
                ->route('produccion.index_entrega_pt')
                ->with('success', 'Entrega realizada correctamente');
        }

        return redirect()->back()->withErrors(['Cantidades incorrectas']);


    }

    public function index_recepcion_pt(Request $request)
    {
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'entrega_pt_enc.fecha_hora' : $request->get('field');

        $collection = EntregaEnc::select('entrega_pt_enc.*', 'users.nombre')
            ->join('users', 'users.id', '=', 'entrega_pt_enc.id_usuario')
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'entrega_pt_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where('entrega_pt_enc.estado', '=', 2)
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

            $entrega->estado = 3;//ENTREGADO
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

    public function buscar_producto_by_sscc(Request $request)
    {


        $sscc = GeneradorCodigos::searchSSCCCaja($request->get('sscc'));

        if ($sscc == null) {
            return response([
                'success' => false,
                'data' => 'SSCC no encontrado'
            ]);
        }
        if ($sscc->is_active == 0) {
            return response([
                'success' => false,
                'data' => 'SSCC dado de baja'
            ]);
        }

        $existe_sscc_agregado = $this->entrega_repository->existeSSCCEntregado($request->get('sscc'));
        if ($existe_sscc_agregado) {
            return response([
                'success' => false,
                'data' => 'SSCC entarimado'
            ]);
        }
        if ($request->get('id_control') == null) {
            return response([
                'success' => false,
                'data' => 'Algo salió mal'
            ]);
        }
        if ($request->get('id_control') != $sscc->id_control) {
            return response([
                'success' => false,
                'data' => 'Este número de sscc pertenece a un producto diferente'
            ]);
        }
        $trazabilidad = $this->trazabilidad_repository->getControlTrazabilidadById($sscc->id_control);


        $unidades_entregadas = 0;
        $cajas_entregadas = 0;
        if ($trazabilidad != null) {
            $unidades_entregadas = $this->entrega_repository->getTotalUnidadesEntregadas($trazabilidad->id_control);
            $cajas_entregadas = $this->entrega_repository->getTotalCajasEntregadas($trazabilidad->id_control);
        }


        return response([
            'success' => true,
            'esta_entregado' => $trazabilidad->esta_entregado == 1,
            'data' => [
                'trazabilidad' => $trazabilidad,
                'unidades_entregadas' => $unidades_entregadas,
                'cajas_entregadas' => $cajas_entregadas,

            ]
        ]);


    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function buscar_no_tarima(Request $request)
    {
        $tarima = GeneradorCodigos::searchSSCCPallet($request->get('no_tarima'));

        if ($tarima == null) {
            return response([
                'success' => false,
                'data' => 'tarima no existente'
            ]);
        }
        if ($tarima->is_active === 0) {
            return response([
                'success' => false,
                'data' => 'tarima dada de baja'
            ]);
        }
        if ($tarima->estado === 'FINALIZADO') {
            return response([
                'success' => false,
                'data' => 'tarima finalizada'
            ]);
        }
        $detalle_tarima = $this->entrega_repository->getDetalleEntregaByTarima($request->get('no_tarima'));

        if ($detalle_tarima != null) {
            if ($detalle_tarima->id_control != $request->get('id_control')) {
                return response([
                    'success' => false,
                    'data' => 'tarima en uso'
                ]);
            }
        } else {
            if ($request->get('validar_si_esta_vacia')) {
                return response([
                    'success' => false,
                    'data' => 'Tarima vacia'
                ]);
            }

        }

        return response([
            'success' => true,
            'data' => 'tarima correcta'
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


    public function terminar_tarima(Request $request)
    {

        $request->query->set('validar_si_esta_vacia', true);
        $result = $this->buscar_no_tarima($request)->getOriginalContent();

        if (($result['success'])) {
            $tarima = GeneradorCodigos::searchSSCCPallet($request->get('no_tarima'));
            $tarima->estado = 'FINALIZADO';
            $tarima->update();

            return response([
                'success' => true,
                'data' => 'tarima terminada'
            ]);
        }

        return $result;
    }

}
