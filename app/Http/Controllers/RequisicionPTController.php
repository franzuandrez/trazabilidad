<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Cliente;
use App\DetalleRequisicionPT;
use App\Http\tools\Movimientos;
use App\Producto;
use App\Repository\OrdenProduccionRepository;
use App\Repository\RequisicionRepository;
use App\Requisicion;
use App\RequisicionDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RequisicionPTController extends Controller
{
    //
    private $productos_no_agregados = [];
    private $requisicionRepository;

    public function __construct(RequisicionRepository $requisicionRepository)
    {
        $this->middleware('auth');
        $this->requisicionRepository = $requisicionRepository;
    }

    public function index(Request $request)
    {
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');

        $operaciones = Requisicion::select('requisicion_encabezado.id as id_requi', 'requisicion_encabezado.*', 'detalle_requisicion_pt.*')
            ->join('users', 'users.id', '=', 'requisicion_encabezado.id_usuario_ingreso')
            ->join('detalle_requisicion_pt', 'detalle_requisicion_pt.id_requisicion', '=', 'requisicion_encabezado.id')
            ->NoDeBaja()
            ->esProductoTerminado()
            ->where(function ($query) use ($search) {
                $query->where('requisicion_encabezado.no_orden_produccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('requisicion_encabezado.no_requision', 'LIKE', '%' . $search . '%')
                    ->orWhere('detalle_requisicion_pt.cliente_ref_1', 'LIKE', '%' . $search . '%')
                    ->orWhere('detalle_requisicion_pt.cliente_ref_2', 'LIKE', '%' . $search . '%')
                    ->orWhere('detalle_requisicion_pt.no_factura', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(15);


        if ($request->ajax()) {
            return view('produccion.requisiciones_pt.index',
                compact('operaciones', 'sort', 'sortField', 'search'));
        } else {
            return view('produccion.requisiciones_pt.ajax',
                compact('operaciones', 'sort', 'sortField', 'search'));
        }
    }

    public function create()
    {

        $bodegas = Bodega::actived()->get();
        $requisiciones = $this->requisicionRepository->get_mis_requisiciones_proceso_pt();


        return view('produccion.requisiciones_pt.create', [
            'bodegas' => $bodegas,
            'requisicion' => $requisiciones,
        ]);
    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {

        try {

            $id = $request->get('id_requisicion');
            $this->requisicionRepository->finalizar_proceso_de_creacion($id);
            return redirect()->route('requisicion_pt.index')
                ->with('success', 'Operacion realizada correctamente');

        } catch (\Exception $ex) {

            return redirect()->route('requisicion_pt.index')
                ->withErrors(['Algo salio mal, nuevamente']);
        }
    }

    public function importar(Request $request)
    {


        $file = $request->file('file_requisiones');


        Excel::load($file, function ($reader) {
            $movimientos = new Movimientos();
            $results = $reader->noHeading()->get();
            $results = $results->slice(1);


            $detalle = $results->take(11 - count($results));

            $no_factura = $results[3][8];

            $cliente_ref_1 = $results[5][0];
            $cliente_ref_2 = $results[7][0];
            $direccion = $results[9][0];


            $requisicion = new Requisicion();
            $requisicion->no_requision = $no_factura;
            $requisicion->no_orden_produccion = null;
            $requisicion->fecha_ingreso = Carbon::now();
            $requisicion->id_usuario_ingreso = \Auth::id();
            $requisicion->estado = 'P';
            $requisicion->tipo = 'PT';
            $requisicion->save();

            $requisicion_pt = new DetalleRequisicionPT();
            $requisicion_pt->id_requisicion = $requisicion->id;
            $requisicion_pt->no_factura = $no_factura;
            $requisicion_pt->cliente_ref_1 = $cliente_ref_1;
            $requisicion_pt->cliente_ref_2 = $cliente_ref_2;
            $requisicion_pt->direccion = $direccion;
            $requisicion_pt->observaciones = $results->last()[1];
            $requisicion_pt->save();


            foreach ($detalle as $key => $value) {

                if ($value[2] != null && $value[0] != null) {


                    $codigo = $value[2];
                    $unidad_medida = $value[3];
                    $cantidadEntrante = floatval($value[0]);
                    $producto = ($movimientos->existencia($codigo)->getData());

                    if (count($producto) > 0) {
                        $idProducto = $producto[0]->id_producto;

                        $request = new \Illuminate\Http\Request();
                        $request->query->add(
                            [
                                'id' => $requisicion->id,
                                'cantidad' => $cantidadEntrante,
                                'id_producto' => $idProducto,
                                'unidad_medida' => $this->unidad_despacho($unidad_medida)
                            ]
                        );
                        $this->reservar($request);

                    } else {
                        //CANTIDAD 0
                        $mensaje = 'EL producto ' . $codigo . ' no tiene existencia';
                        array_push($this->productos_no_agregados, $mensaje);
                    }
                }
            }
        });;
        return redirect()->route('requisicion_pt.create')
            ->withErrors(
                $this->productos_no_agregados
            )
            ->with('importacion', true);
    }


    private function unidad_despacho($unidad_medida)
    {
        $unidad_despacho = env('DESPACHAR_SIEMPRE_EN_UNIDADES', '1');
        if ($unidad_despacho == 1) {
            return 'UN';
        } else {
            return $unidad_medida;
        }

    }

    public
    function reservar(Request $request)
    {


        try {
            $id = $request->get('id');
            $requisicionRepository = new RequisicionRepository();
            $requisicionRepository->setRequisicion(Requisicion::findOrFail($id));
            $requisicionRepository->setIdsProductosAReservar([$request->get('id_producto')]);
            $requisicionRepository->setCantidadesAReservar([$request->get('cantidad')]);
            $requisicionRepository->setUnidadesMedida([$request->get('unidad_medida')]);
            $reserva = $requisicionRepository->reservar_productos()->first();
            $response = [1, $reserva->id];
        } catch (\Exception $ex) {

            $response = [0, $ex->getMessage()];
        }


        return $response;


    }
}
