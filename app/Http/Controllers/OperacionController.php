<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Asistencia;
use App\DetalleInsumo;
use App\Operacion;
use App\OperariosInvolucrados;
use App\Producto;
use App\Repository\ProductoRepository;
use App\Repository\TrazabilidadRepository;
use App\Requisicion;
use App\ReservaPicking;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;


/**
 * @property TrazabilidadRepository $trazabilidad_repository
 * @property ProductoRepository $producto_repository
 **/
class OperacionController extends Controller
{
    //

    private $trazabilidad_repository = null;
    private $producto_repository = null;

    public function __construct(TrazabilidadRepository $trazabilidad_repository, ProductoRepository $producto_repository)
    {
        $this->trazabilidad_repository = $trazabilidad_repository;
        $this->producto_repository = $producto_repository;
        $this->middleware('auth');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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


        $operaciones = Operacion::join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search, $id_control) {
                $query->where('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.codigo_interno', 'LIKE', '%' . $search . '%')
                    ->orWhereIn('control_trazabilidad.id_control', $id_control)
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


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscar_producto(Request $request)
    {

        $producto = $this
            ->producto_repository
            ->buscarProductoPTorPP($request->get('codigo_interno'));


        $this
            ->trazabilidad_repository
            ->setProducto($producto);


        $this
            ->trazabilidad_repository
            ->calcularFechaVencimiento();


        return response()->json([
            'producto' => $producto,
            'fecha_vencimiento' => $this->trazabilidad_repository->getFechaVencimiento()
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscar_orden_produccion(Request $request)
    {


        try {
            $search = $request->get('q');
            $id_producto = $request->get('id_producto');
            $id_control = $request->get('id_control');


            $response = $this
                ->trazabilidad_repository
                ->buscarOrdenProduccion($search, $id_producto, $id_control);

        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => 'Algo salio mal ' . $ex->getMessage(),
                'data' => []
            ];
        }


        return response()->json($response);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $actividades = Actividad::actived()->get();


        return view('produccion.control_trazabilidad.create',
            [
                'actividades' => $actividades
            ]
        );


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {


        try {
            DB::beginTransaction();

            $id_control = $request->get('id_control');

            $this->trazabilidad_repository->getControlTrazabilidadById($id_control);
            $this->trazabilidad_repository->setIdsActividades($request->id_actividad);
            $this->trazabilidad_repository->setIdsColaboradores($request->id_colaborador);
            $this->trazabilidad_repository->setIdsInsumos($request->id_insumo);
            $this->trazabilidad_repository->setColores($request->color);
            $this->trazabilidad_repository->setOlores($request->olor);
            $this->trazabilidad_repository->setImpresiones($request->impresion);
            $this->trazabilidad_repository->setAusenciaMaterialExtranios($request->ausencia_me);
            $this->trazabilidad_repository->registrarOperariosInvolucrados();
            $this->trazabilidad_repository->saveInsumos();
            $this->trazabilidad_repository->marcarIniciadoControlTrazabilidad();

            DB::commit();
            return redirect()
                ->route('produccion.operacion.index')
                ->with('success', 'Guardado correctamente');

        } catch (\Exception $ex) {

            DB::rollback();

            return redirect()->back()
                ->withInput()
                ->withErrors(['Algo salió mal, vuelva a intentarlo']);
        }


    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

        $operacion = Operacion::findOrFail($id);


        return view('produccion.control_trazabilidad.show', [
            'operacion' => $operacion
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $control = Operacion::with('producto')
            ->with('asistencias')
            ->with('actividades')
            ->with('detalle_insumos')
            ->findOrFail($id);

        $actividades = Actividad::actived()
            ->get();


        return view('produccion.control_trazabilidad.edit', [
            'control' => $control,
            'actividades' => $actividades
        ]);


    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function finalizar_asistencia(Request $request)
    {
        $id_control = $request->get('id_control');
        $id_colaborador = $request->get('id_colaborador');
        $id_actividad = $request->get('id_actividad');

        try {


            $fechaFinalizacion = $this
                ->trazabilidad_repository
                ->finalizarAsistencia($id_control, $id_colaborador, $id_actividad);

            $response = [
                'status' => 1,
                'message' => 'Finalizado correctamente',
                'data' => $fechaFinalizacion->format('h:i:s')

            ];

        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => $e->getMessage(),
            ];

        }

        return response()->json($response);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verificar_proximo_lote(Request $request)
    {


        $response = $this->trazabilidad_repository->verificarProximoLote($request);

        return $response;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verificar_existencia_lote(Request $request)
    {


        $response = $this
            ->trazabilidad_repository
            ->verificarExistenciaLoteMateriaPrimaOrMaterialEmpaque($request);

        return $response;


    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verificar_existencia_lote_pp(Request $request)
    {


        $codigo_producto = $request->codigo;
        $lote = $request->lote;
        $id_control = $request->id_control;
        $cantidad = $request->cantidad;


        $this
            ->trazabilidad_repository
            ->getControlTrazabilidadById($id_control);

        $response = $this
            ->trazabilidad_repository
            ->verificarExistenciaLoteProductoProceso($codigo_producto, $lote, $cantidad);


        return response()->json($response);

    }

}
