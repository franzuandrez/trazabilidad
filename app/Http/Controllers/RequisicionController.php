<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Http\tools\Movimientos;
use App\Repository\RequisicionRepository;
use App\Repository\OrdenProduccionRepository;
use App\Requisicion;
use App\RequisicionDetalle;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RequisicionController extends Controller
{
    //

    private $productos_no_agregados = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');

        $operaciones = Requisicion::select('requisicion_encabezado.*')
            ->join('users', 'users.id', '=', 'requisicion_encabezado.id_usuario_ingreso')
            ->NoDeBaja()
            ->esMateriaPrima()
            ->where(function ($query) use ($search) {
                $query->where('requisicion_encabezado.no_orden_produccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('requisicion_encabezado.no_requision', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(12);


        if ($request->ajax()) {
            return view('produccion.operaciones.index',
                compact('operaciones', 'sort', 'sortField', 'search'));
        } else {
            return view('produccion.operaciones.ajax',
                compact('operaciones', 'sort', 'sortField', 'search'));
        }
    }


    public function create()
    {

        $bodegas = Bodega::actived()->get();
        $requisicionRepository = new RequisicionRepository();
        $no_orden_produccion = OrdenProduccionRepository::obtener_nuevo_numero_de_orden();
        $requisiciones = $requisicionRepository->get_mis_requisiciones_proceso_mp();

        return view('produccion.operaciones.create', [
            'bodegas' => $bodegas,
            'requisicion' => $requisiciones,
            'no_orden_produccion' => $no_orden_produccion
        ]);
    }

    public function store(Request $request)
    {


        try {
            $requisicionRepository = new RequisicionRepository();
            $id = $request->get('id_requisicion');
            $requisicionRepository->finalizar_proceso_de_creacion($id);
            return redirect()->route('produccion.requisiciones.index')
                ->with('success', 'Operacion realizada correctamente');

        } catch (\Exception $ex) {

            return redirect()->route('produccion.requisiciones.index')
                ->withErrors(['Algo salio mal, nuevamente']);
        }
    }

    public function importar(Request $request)
    {

        $file = $request->file('file_requisiones');
        $id_requisicion = $request->get('id_requisicion_importar');
        $productos_no_agregados = [];

        Excel::load($file, function ($reader) use ($id_requisicion) {
            $movimientos = new Movimientos();

            $results = $reader->noHeading()->get();
            $results = $results->slice(1);


            foreach ($results as $key => $value) {

                if (count($value) > 1) {
                    $codigo = $value[0];
                    $cantidadEntrante = floatval($value[1]);
                    $producto = ($movimientos->existencia($codigo)->getData());
                    if (count($producto) > 0) {
                        $idProducto = $producto[0]->id_producto;
                        $cantidadDisponible = floatval($producto[0]->total);

                        $cantidadReservada = floatval(RequisicionDetalle::select('cantidad')
                            ->where('id_requisicion_encabezado', $id_requisicion)
                            ->where('id_producto', $idProducto)
                            ->sum('cantidad'));

                        if (($cantidadEntrante + $cantidadReservada) <= ($cantidadDisponible)) {
                            $this->reservar_aux(
                                $id_requisicion,
                                $idProducto,
                                $cantidadEntrante
                            );
                        } else {
                            //CANTIDAD INSUFICIENTE
                            $mensaje = 'EL producto ' . $codigo . ' tiene un excedente de ' . ($cantidadEntrante - $cantidadDisponible);
                            array_push($this->productos_no_agregados, $mensaje);
                        }
                    } else {
                        //CANTIDAD 0
                        $mensaje = 'EL producto ' . $codigo . ' no tiene existencia';
                        array_push($this->productos_no_agregados, $mensaje);
                    }


                }
            }

        });;
        return redirect()->route('produccion.requisiciones.create')
            ->withErrors(
                $this->productos_no_agregados
            )
            ->with('importacion', true);

    }

    public function show($id)
    {

        $requisicion = Requisicion::findOrFail($id);


        return view('produccion.operaciones.show',
            ['requisicion' => $requisicion]);


    }

    public function verificarOrdenRequisicion($orden_requisicion)
    {

        $requisicionRepository = new RequisicionRepository();
        $requisicionRepository->setOrdenRequisicion($orden_requisicion);
        $response = $requisicionRepository->verificar_orden_requisicion();

        return $response;

    }

    public function verificarOrdenProduccion($orden_produccion, $id)
    {

        $requisicionRepository = new RequisicionRepository();
        $requisicionRepository->setNumeroOrdenProduccion($orden_produccion);
        $response = $requisicionRepository->verificar_orden_produccion($id);

        return $response;
    }

    public function reservar(Request $request)
    {


        return $this->reservar_aux(
            $request->get('id'),
            $request->get('id_producto'),
            $request->get('cantidad')
        );


    }

    private function reservar_aux($id, $id_producto, $cantidad)
    {
        try {

            $requisicionRepository = new RequisicionRepository();
            $requisicionRepository->setRequisicion(Requisicion::findOrFail($id));
            $requisicionRepository->setIdsProductosAReservar([$id_producto]);
            $requisicionRepository->setCantidadesAReservar([$cantidad]);
            $reserva = $requisicionRepository->reservar_productos()->first();

            $response = [1, $reserva->id];
        } catch (\Exception $ex) {
            $response = [0, $ex->getMessage()];
        }


        return $response;
    }


    public function borrar_de_reserva(Request $request)
    {

        $id = $request->get('id');

        $requisicionRepository = new RequisicionRepository();
        $response = $requisicionRepository->deshacer_reservas([$id]);

        return $response;
    }


    public function en_reserva($id)
    {

        $productos = [$id];

        $requisicionRepository = new RequisicionRepository();
        $total_producto_en_reserva = $requisicionRepository->get_total_producto_en_reserva($productos);

        return $total_producto_en_reserva;

    }

    public function borrar_reservas()
    {


        $requisicionRepository = new RequisicionRepository();
        try {
            DB::beginTransaction();
            $requisicionRepository->borrar_requision_en_proceso();
            DB::commit();
            $response = [1];
        } catch (\Exception $e) {

            DB::rollback();
            $response = [0];
        }

        return $response;


    }


    public function destroy($id)
    {

        try {

            $requisicion = Requisicion::findOrFail($id);
            $requisicionRepository = new RequisicionRepository();
            $requisicionRepository->setRequisicion($requisicion);
            $response = $requisicionRepository->dar_baja_requisicion();

        } catch (\Exception $ex) {
            $response = [
                'status' => 0,
                'message' => $ex->getMessage()
            ];

        }


        return response()->json($response);


    }
}
