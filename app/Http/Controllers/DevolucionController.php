<?php

namespace App\Http\Controllers;

use App\DetalleInsumo;
use App\Operacion;
use App\Repository\MovimientoRepository;
use App\Repository\TrazabilidadRepository;
use App\Sector;
use App\User;
use DB;
use Illuminate\Http\Request;

/**
 * @property TrazabilidadRepository $trazabilidad_repository
 * @property MovimientoRepository $movimiento_repository
 *
 **/
class DevolucionController extends Controller
{
    //
    private $trazabilidad_repository = null;
    private $movimiento_repository = null;

    public function __construct(TrazabilidadRepository $trazabilidad_repository, MovimientoRepository $movimiento_repository)
    {

        $this->middleware('auth');
        $this->trazabilidad_repository = $trazabilidad_repository;
        $this->movimiento_repository = $movimiento_repository;
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


    public function devolucion($id)
    {
        $control_trazabilidad = Operacion::without('requisiciones')
            ->without('detalle_insumos')
            ->findOrFail($id);

        $detalle_insumos = DetalleInsumo::select('detalle_insumos.*',
            DB::raw('sum(cantidad-cantidad_utilizada) as devolucion'))
            ->where('id_control', $control_trazabilidad->id_control)
            ->groupBy('id_producto')
            ->groupBy('lote')
            ->get();


        $ubicaciones = Sector::actived()
            ->with('bodega')
            ->get();

        return view('produccion.devoluciones.devolucion', [
            'control' => $control_trazabilidad,
            'detalle_insumos' => $detalle_insumos,
            'ubicaciones' => $ubicaciones
        ]);

    }


    public function devolver($id, Request $request)
    {

        $usuario_autoriza = User::where('username', $request->get('user_acepted'))->first();
        $productos = $request->get('id_producto');
        $cantidades = $request->get('cantidad');
        $lotes = $lote = $request->get('lote');
        $ubicaciones = $request->get('ubicacion');
        $fechas_vencimiento = $request->get('fecha_vencimiento');

        try {
            DB::beginTransaction();
            $control_trazabilidad = Operacion::without('requisiciones')
                ->without('detalle_insumos')
                ->findOrFail($id);

            $control_trazabilidad->status = 4;
            $control_trazabilidad->save();
            $this->movimiento_repository->setUsuarioAutoriza($usuario_autoriza);
            $this->movimiento_repository->setIdsProductos($productos);
            $this->movimiento_repository->setCantidades($cantidades);
            $this->movimiento_repository->setFechasVencimiento($fechas_vencimiento);
            $this->movimiento_repository->setLotes($lotes);
            $this->movimiento_repository->setIdsUbicaciones($ubicaciones);
            $this->movimiento_repository->setNoDocumento($control_trazabilidad->id_control);
            $this->movimiento_repository->setTipoDocumento('TRAZABILIDAD');
            $this->movimiento_repository->ubicarProductos(3);

            DB::commit();
            return redirect()->route('produccion.devoluciones.index')
                ->with('success', 'Producto ubicado correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('produccion.devoluciones.index')
                ->withErrors(['Su peticion no ha podido ser procesada']);

        }


    }
}
