<?php

namespace App\Http\Controllers;


use App\Http\Requests\MateriaPrimaRequest;
use App\Producto;
use App\Proveedor;
use App\Recepcion;
use App\Repository\MovimientoRepository;
use App\Repository\RecepcionRepository;
use App\RMIDetalle;
use App\Sector;
use App\User;
use DB;
use Illuminate\Http\Request;


class RecepcionController extends Controller
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
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');


        $recepciones = Recepcion::join('proveedores', 'proveedores.id_proveedor', '=', 'recepcion_encabezado.id_proveedor')
            ->select('recepcion_encabezado.*', 'proveedores.nombre_comercial as proveedor')
            ->where(function ($query) use ($search) {
                $query->where('proveedores.nombre_comercial', 'LIKE', '%' . $search . '%')
                    ->orWhere('recepcion_encabezado.orden_compra', 'LIKE', '%' . $search . '%');

            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('recepcion.materia_prima.index',
                [
                    'recepciones' => $recepciones,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'search' => $search
                ]);
        } else {

            return view('recepcion.materia_prima.ajax',
                [
                    'recepciones' => $recepciones,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'search' => $search
                ]

            );
        }


    }

    public function create()
    {


        $productos = Producto::esMateriaPrima()->get();
        $proveedores = Proveedor::all();

        return view('recepcion.materia_prima.create',

            [
                'productos' => $productos,
                'proveedores' => $proveedores
            ]
        );


    }

    public function store(MateriaPrimaRequest $request)
    {


        try {
            DB::beginTransaction();
            $recepcion = new RecepcionRepository();
            $recepcion->saveRecepcion($request);
            DB::commit();

            return redirect()->route('recepcion.materia_prima.index')
                ->with('success', 'Materia prima ingresada corrrectamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('recepcion.materia_prima.index')
                ->withErrors(['Lo sentimos, su peticion no puede ser procesada en este momento ']);

        }


    }


    public function show($id)
    {

        try {
            $recepcion = Recepcion::findOrFail($id);


            return view('recepcion.materia_prima.show',
                [
                    'recepcion' => $recepcion
                ]
            );
        } catch (\Exception $e) {

            return redirect()->route('recepcion.materia_prima.index')
                ->withErrors(['errors' => ' Recepcion no encontrada ']);

        }


    }

    public function edit($id)
    {

        try {
            $recepcion = Recepcion::findOrFail($id);


            return view('recepcion.materia_prima.edit',
                [
                    'recepcion' => $recepcion
                ]
            );
        } catch (\Exception $e) {
            return redirect()->route('recepcion.materia_prima.index')
                ->withErrors(['errors' => ' Recepcion no encontrada ']);
        }


    }

    public function update(Request $request, $id)
    {


        try {

            DB::beginTransaction();
            $recepcion = Recepcion::findOrFail($id);
            $recepcionRepository = new RecepcionRepository();
            $recepcionRepository->setRecepcionEncabezado($recepcion);
            $recepcionRepository->setIdsProductos($request->get('id_producto'));
            $recepcionRepository->setLotes($request->get('no_lote'));
            $recepcionRepository->setCantidades($request->get('cantidad'));
            $recepcionRepository->setFechasVencimiento($request->get('fecha_vencimiento'));


            $recepcionRepository->setEstadoByIdProducto($request->id_producto);
            $recepcionRepository->saveDetalleLotes();
            $recepcionRepository->saveRMIDetalle('RAMPA');
            DB::commit();

            return redirect()->route('recepcion.materia_prima.index')
                ->with('success', 'Materia prima ingresada corrrectamente');

        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('recepcion.materia_prima.index')
                ->withErrors(['errors' => 'Lo sentimos, su peticion no puede ser procesada en este momento ']);

        }


    }


    public function transito(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'orden_compra' : $request->get('field');
        $campo_busqueda = $request->get('campo_busqueda') == null ? '1' : $request->get('campo_busqueda');


        $movimientos_en_transito = Recepcion::join('proveedores', 'proveedores.id_proveedor', '=', 'recepcion_encabezado.id_proveedor')
            ->esDocumentoMateriaPrima()
            ->select('recepcion_encabezado.*')
            ->where('rmi_encabezado.rampa', $campo_busqueda)
            ->where(function ($query) use ($search) {
                $query->where('proveedores.nombre_comercial', 'LIKE', '%' . $search . '%')
                    ->orWhere('recepcion_encabezado.orden_compra', 'LIKE', '%' . $search . '%');
            })
            ->groupBy('recepcion_encabezado.orden_compra')
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {
            return view('recepcion.transito.index',
                [
                    'movimientos_en_transito' => $movimientos_en_transito,
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'campo_busqueda' => $campo_busqueda,
                ]);
        } else {
            return view('recepcion.transito.ajax',
                [
                    'movimientos_en_transito' => $movimientos_en_transito,
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'campo_busqueda' => $campo_busqueda,
                ]
            );
        }


    }


    public function ingreso_transito($id)
    {

        try {
            $recepcion = Recepcion::findOrFail($id);
            $rmi_encabezado = $recepcion->rmi_encabezado;
            $recepcionRepository = new RecepcionRepository();
            $recepcionRepository->setRecepcionEncabezado($recepcion);
            $movimientos = $recepcionRepository->getMovimientosRmiDetalle();
            $paso_calidad = $rmi_encabezado->rampa == "0";

            if ($paso_calidad) {
                return view('recepcion.transito.show_liberada',
                    [
                        'recepcion' => $recepcion,
                        'movimientos' => $movimientos,
                        'rmi_encabezado' => $rmi_encabezado
                    ]
                );
            }
            return view('recepcion.transito.ingreso',
                [
                    'recepcion' => $recepcion,
                    'movimientos' => $movimientos
                ]
            );


        } catch (\Exception $e) {


            return redirect()->route('recepcion.transito.index')
                ->withErrors(['Recepcion no encontrada']);
        }


    }

    public function ingresar(Request $request, $id)
    {


        try {
            DB::beginTransaction();
            $recepcion = Recepcion::findOrFail($id);
            $recepcionRepository = new RecepcionRepository();
            $observaciones = $request->get('observaciones');
            $recepcionRepository->setRecepcionEncabezado($recepcion);
            $recepcionRepository->setObservacionesToRMIEncabezazdo($observaciones);
            $recepcionRepository->ingresarToControlCalidad($request);
            $recepcion->id_usuario_calidad = \Auth::id();
            $recepcion->save();

            DB::commit();
            return redirect()->route('recepcion.transito.index')
                ->with('success', 'Orden preparada');
        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('recepcion.transito.index')
                ->withErrors(['No ha sido posible procesar su transaccion']);
        }

    }

    public function show_transito($id)
    {

        try {

            $recepcion = Recepcion::findOrFail($id);
            $rmi_encabezado = $recepcion->rmi_encabezado;
            $recepcionRepository = new RecepcionRepository();
            $recepcionRepository->setRecepcionEncabezado($recepcion);
            $movimientos = $recepcionRepository->getMovimientosRmiDetalle();
            $paso_calidad = $rmi_encabezado->rampa == "0";
            if ($paso_calidad) {
                return view('recepcion.transito.show_liberada',
                    [
                        'recepcion' => $recepcion,
                        'movimientos' => $movimientos,
                        'rmi_encabezado' => $rmi_encabezado
                    ]
                );
            } else {
                return view('recepcion.transito.show',
                    [
                        'recepcion' => $recepcion,
                        'movimientos' => $movimientos
                    ]
                );
            }
        } catch (\Exception $e) {


            return redirect()->route('recepcion.transito.index')
                ->withErrors(['Recepcion no encontrada']);
        }

    }


    public function recepcion_ubicacion(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'orden_compra' : $request->get('field');

        $ordenes_en_control = Recepcion::join('proveedores', 'proveedores.id_proveedor', '=', 'recepcion_encabezado.id_proveedor')
            ->esDocumentoMateriaPrima()
            ->estaEnControl()
            ->select('recepcion_encabezado.*')
            ->where(function ($query) use ($search) {
                $query->where('proveedores.nombre_comercial', 'LIKE', '%' . $search . '%')
                    ->orWhere('recepcion_encabezado.orden_compra', 'LIKE', '%' . $search . '%');
            })
            ->groupBy('recepcion_encabezado.orden_compra')
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {
            return view('recepcion.ubicacion.index',
                [
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'search' => $search,
                    'ordenes_en_control' => $ordenes_en_control
                ]);
        } else {
            return view('recepcion.ubicacion.ajax',
                [
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'search' => $search,
                    'ordenes_en_control' => $ordenes_en_control
                ]);
        }


    }


    public function ubicacion($id)
    {


        try {
            $orden = Recepcion::findOrFail($id);
            $estaPendienteDeAsignarUbicacion = $orden->rmi_encabezado->control == 1;
            if (!$estaPendienteDeAsignarUbicacion) {
                return redirect()
                    ->route('recepcion.ubicacion.index')
                    ->withErrors(['Orden ya procesada']);
            }
            $rmi_detalle = RMIDetalle::where('id_rmi_encabezado', $orden->rmi_encabezado->id_rmi_encabezado)
                ->select(DB::raw('sum(cantidad_entrante) as total'), 'rmi_detalle.*')
                ->groupBy('id_producto')
                ->groupBy('lote')
                ->get();

            $ubicaciones = Sector::actived()
                ->with('bodega')
                ->get();


            return view('recepcion.ubicacion.ubicar',
                [
                    'orden' => $orden,
                    'rmi_detalle' => $rmi_detalle,
                    'ubicaciones' => $ubicaciones
                ]);

        } catch (\Exception $e) {

            return redirect()->route('recepcion.ubicacion.index')
                ->withErrors(['Recepcion no encontrada']);
        }


    }


    public function ubicar(Request $request, $id)
    {


        $orden = Recepcion::findOrFail($id);
        $rmi_encabezado = $orden->rmi_encabezado;

        $usuario_autoriza = User::where('username', $request->get('user_acepted'))->first();
        $productos = $request->get('id_producto');
        $cantidades = $request->get('cantidad');
        $lotes = $lote = $request->get('lote');
        $ubicaciones = $request->get('ubicacion');
        $fechas_vencimiento = $request->get('fecha_vencimiento');
        $movimientoRepository = new MovimientoRepository();


        try {
            DB::beginTransaction();
            $movimientoRepository->setUsuarioAutoriza($usuario_autoriza);
            $movimientoRepository->setIdsProductos($productos);
            $movimientoRepository->setCantidades($cantidades);
            $movimientoRepository->setFechasVencimiento($fechas_vencimiento);
            $movimientoRepository->setLotes($lotes);
            $movimientoRepository->setIdsUbicaciones($ubicaciones);
            $movimientoRepository->setNoDocumento($rmi_encabezado->documento);
            $movimientoRepository->ubicarProductos();

            $rmi_encabezado->mp = 1;
            $rmi_encabezado->control = 0;
            $rmi_encabezado->id_usuario_ubicacion = \Auth::id();
            $rmi_encabezado->update();
            $orden->id_usuario_ubicacion = \Auth::id();
            $orden->id_usuario_autoriza = $usuario_autoriza->id;


            DB::commit();
            return redirect()->route('recepcion.ubicacion.index')
                ->with('success', 'Producto ubicado correctamente');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('recepcion.ubicacion.index')
                ->withErrors(['Su peticion no ha podido ser procesada']);

        }


    }


    public function show_producto_a_ubicar($id)
    {


        $recepcion = Recepcion::findOrFail($id);

        $movimientos = $recepcion->rmi_encabezado->rmi_detalle;


        return view('recepcion.ubicacion.show',
            [
                'recepcion' => $recepcion,
                'movimientos' => $movimientos
            ]
        );


    }
}
