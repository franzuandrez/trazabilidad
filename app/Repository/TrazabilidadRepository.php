<?php


namespace App\Repository;


use App\Asistencia;
use App\DetalleInsumo;
use App\EntregaDet;
use App\Http\tools\Impresiones;
use App\Operacion;
use App\OperariosInvolucrados;
use App\Producto;
use App\Requisicion;
use App\ReservaPicking;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Producto $producto
 * @property string $fecha_vencimiento
 * @property float $cantidad_utilizada
 * @property string $numero_orden_produccion
 * @property array $ids_colaboradores
 * @property array $ids_actividades
 * @property array $ids_insumos
 * @property array $colores
 * @property array $olores
 * @property array $impresiones
 * @property array $ausencia_material_extranios
 * @property array $cantidades_utilizadas;
 * @property Operacion|Model $control_trazabilidad
 * @property Requisicion $requisicion
 * @property string $lote
 * @property string $turno
 * @property float $cantidad_programada
 **/
class TrazabilidadRepository
{


    const STATUS_PROCESO_CREACION = 1;
    const STATUS_CREADA = 2;
    const STATUS_FINALIZADA = 3;
    const STATUS_DEVOLUCION = 4;


    private $producto = null;
    private $numero_orden_produccion = '';
    private $fecha_vencimiento = '';
    private $control_trazabilidad = null;
    private $ids_colaboradores = [];
    private $ids_actividades = [];
    private $ids_insumos = [];
    private $cantidades_utilizadas = [];
    private $cantidad_utilizada = 0;
    private $colores = [];
    private $olores = [];
    private $impresiones = [];
    private $ausencia_material_extranios = [];
    private $requisicion = null;
    private $lote = '';
    private $turno = '';
    private $cantidad_programada = '';

    /**
     * @return string
     */
    public function getLote(): string
    {
        return $this->lote;
    }

    /**
     * @param string $lote
     */
    public function setLote(string $lote): void
    {
        $this->lote = $lote;
    }

    /**
     * @return string
     */
    public function getTurno(): string
    {
        return $this->turno;
    }

    /**
     * @param string $turno
     */
    public function setTurno(string $turno): void
    {
        $this->turno = $turno;
    }

    /**
     * @return float
     */
    public function getCantidadProgramada(): float
    {
        return $this->cantidad_programada;
    }

    /**
     * @param float $cantidad_programada
     */
    public function setCantidadProgramada(float $cantidad_programada): void
    {
        $this->cantidad_programada = $cantidad_programada;
    }

    /**
     * @return Requisicion
     */
    public function getRequisicion()
    {
        return $this->requisicion;
    }


    public function setRequisicion($requisicion): void
    {
        $this->requisicion = $requisicion;
    }

    /**
     * @return float
     */
    public function getCantidadUtilizada()
    {
        return $this->cantidad_utilizada;
    }

    /**
     * @param float $cantidad_utilizada
     */
    public function setCantidadUtilizada($cantidad_utilizada): void
    {
        $this->cantidad_utilizada = $cantidad_utilizada;
    }

    /**
     * @return array
     */
    public function getCantidadesUtilizadas()
    {
        return $this->cantidades_utilizadas;
    }

    /**
     * @param array $cantidad_utilizadas
     */
    public function setCantidadesUtilizadas($cantidad_utilizadas): void
    {
        $this->cantidades_utilizadas = $cantidad_utilizadas;
    }


    /**
     * @return array
     */
    public function getIdsInsumos()
    {
        return $this->ids_insumos;
    }

    /**
     * @param array $ids_insumos
     */
    public function setIdsInsumos($ids_insumos): void
    {
        $this->ids_insumos = $ids_insumos;
    }

    /**
     * @return array
     */
    public function getColores()
    {
        return $this->colores;
    }

    /**
     * @param array $colores
     */
    public function setColores($colores): void
    {
        $this->colores = $colores;
    }

    /**
     * @return array
     */
    public function getOlores()
    {
        return $this->olores;
    }

    /**
     * @param array $olores
     */
    public function setOlores($olores): void
    {
        $this->olores = $olores;
    }

    /**
     * @return array
     */
    public function getImpresiones()
    {
        return $this->impresiones;
    }

    /**
     * @param array $impresiones
     */
    public function setImpresiones($impresiones): void
    {
        $this->impresiones = $impresiones;
    }

    /**
     * @return array
     */
    public function getAusenciaMaterialExtranios()
    {
        return $this->ausencia_material_extranios;
    }

    /**
     * @param array $ausencia_material_extranios
     */
    public function setAusenciaMaterialExtranios($ausencia_material_extranios): void
    {
        $this->ausencia_material_extranios = $ausencia_material_extranios;
    }

    /**
     * @return array
     */
    public function getIdsColaboradores(): array
    {
        return $this->ids_colaboradores;
    }

    /**
     * @param array $ids_colaboradores
     */
    public function setIdsColaboradores($ids_colaboradores = []): void
    {
        $this->ids_colaboradores = $ids_colaboradores;
    }

    /**
     * @return array
     */
    public function getIdsActividades()
    {
        return $this->ids_actividades;
    }

    /**
     * @param array $ids_actividades
     */
    public function setIdsActividades($ids_actividades = []): void
    {
        $this->ids_actividades = $ids_actividades;
    }


    /**
     * @return Operacion|null
     */
    public function getControlTrazabilidad()
    {
        return $this->control_trazabilidad;
    }


    public function setControlTrazabilidad($control_trazabilidad): void
    {
        $this->control_trazabilidad = $control_trazabilidad;
    }

    /**
     * @return string
     */
    public function getNumeroOrdenProduccion(): string
    {
        return $this->numero_orden_produccion;
    }

    /**
     * @param string $numero_orden_produccion
     */
    public function setNumeroOrdenProduccion(string $numero_orden_produccion): void
    {
        $this->numero_orden_produccion = $numero_orden_produccion;
    }


    /**
     * @return string
     */
    public function getFechaVencimiento(): string
    {
        return $this->fecha_vencimiento;
    }

    /**
     * @param string $fecha_vencimiento
     */
    public function setFechaVencimiento(string $fecha_vencimiento): void
    {
        $this->fecha_vencimiento = $fecha_vencimiento;
    }

    /**
     * @return Producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * @param Producto $producto
     */
    public function setProducto($producto): void
    {
        $this->producto = $producto;
    }


    /**
     * @param $search
     * @param $sortField
     * @param $sort
     * @param array $extras
     * @return \Illuminate\Database\Query\Builder
     */
    public function searchControlesDeTrazabilidad($search, $sortField, $sort, $extras = [])
    {

        $operaciones = Operacion::join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->where(function ($query) use ($search, $extras) {
                $query->where('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.codigo_interno', 'LIKE', '%' . $search . '%')
                    ->orWhereIn('control_trazabilidad.id_control', $extras)
                    ->orWhere('control_trazabilidad.lote', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort);

        return $operaciones;

    }


    public function getRequisicionByNoOrdenProduccion($orden_produccion)
    {
        $requisicion = Requisicion::select('estado', 'id', 'no_requision', 'no_orden_produccion')
            ->where('no_orden_produccion', $orden_produccion)
            ->first();

        $this->setRequisicion($requisicion);
        return $this->getRequisicion();
    }

    public function buscarOrdenProduccion($orden_produccion, $id_producto, $id_control)
    {

        $requision = $this->getRequisicionByNoOrdenProduccion($orden_produccion);

        if ($requision == null) {
            $response = [
                'status' => 0,
                'message' => 'No existe orden de produccion',
                'data' => []
            ];
        } else {
            $existe_control_trazabilidad = $this->estaElControlTrazabilidadIniciadoById($id_control);

            $this->setNumeroOrdenProduccion($orden_produccion);
            $this->setProducto(Producto::find($id_producto));
            if ($existe_control_trazabilidad) {
                $response = [
                    'status' => 1,
                    'message' => 'Orden de produccion agregada correctamente',
                    'data' => [
                        $this->getRequisicion(),
                        $this->getControlTrazabilidad()
                    ]
                ];
            } else {
                $this->crearControlTrazabilidad();
                $response = [
                    'status' => 1,
                    'message' => 'Nueva orden de produccion ',
                    'data' => [
                        $this->getRequisicion(),
                        $this->getControlTrazabilidad()
                    ]
                ];
            }
            $this->agregarOrdenProduccionSiNoExiste();
        }
        return $response;
    }

    public function getIdsDeControlByOrdenProduccion($search)
    {
        $id_control = DB::table('control_trazabilidad_orden_produccion')
            ->where('no_orden_produccion', 'LIKE', '%' . $search . '%')
            ->get()
            ->pluck('id_control')
            ->toArray();

        return $id_control;
    }


    public function calcularFechaVencimiento()
    {

        if ($this->getProducto() != null) {

            $fecha_vencimiento = Carbon::now()
                ->addDays($this->getProducto()->dias_vencimiento + 1)
                ->format('d/m/Y');
            $this->setFechaVencimiento($fecha_vencimiento);

        }
        return $this->getFechaVencimiento();
    }

    public function getIdControlTrazabilidad($id_producto)
    {


        $ordenes = [$this->getNumeroOrdenProduccion()];
        $ids = DB::table('control_trazabilidad_orden_produccion')
            ->select('id_control')
            ->whereIn('no_orden_produccion', $ordenes)
            ->where('id_producto', $id_producto)
            ->first();
        if ($ids != null) {
            $ids = $ids->id_control;
        }

        return [$ids];
    }


    public function estaElControlTrazabilidadIniciadoByProducto($id_producto)
    {
        $id_control = $this->getIdControlTrazabilidad($id_producto);
        $control_trazabilidad = $this->getControlTrazabilidadById($id_control);

        $orden_produccion_iniciada = $control_trazabilidad != null;
        return $orden_produccion_iniciada;
    }

    public function estaElControlTrazabilidadIniciadoById($id_control)
    {
        $control_trazabilidad = $this->getControlTrazabilidadById($id_control);
        $existe_control_trazabilidad = $control_trazabilidad != null;
        return $existe_control_trazabilidad;

    }

    public function getControlTrazabilidadById($id_control)
    {
        $id_control = is_array($id_control) ? $id_control : [$id_control];
        $control_trazabilidad =
            Operacion::with('producto')
                ->whereIn('id_control', $id_control)
                ->first();

        $this->setControlTrazabilidad($control_trazabilidad);
        return $this->getControlTrazabilidad();

    }

    public function getControlTrazabilidadByLote($lote)
    {
        $control_trazabilidad = Operacion::whereLote($lote)
            ->with('producto')
            ->first();

        $this->setControlTrazabilidad($control_trazabilidad);
        return $control_trazabilidad;
    }


    public function marcarEntregado()
    {

        $control_trazabilidad = $this->getControlTrazabilidad();
        $control_trazabilidad->esta_entregado = 1;
        $control_trazabilidad->save();


    }

    public function cerrarControlTrazabilidad()
    {

    }

    public function registrarOperariosInvolucrados()
    {
        $actividades = $this->getIdsActividades();

        if (is_iterable($actividades)) {
            foreach ($actividades as $key => $id_actividad) {
                $id_operario = $this->getIdsColaboradores()[$key];
                $this->nuevaAsignacionOperarioAndActividad($id_operario, $id_actividad);
            }
        }
    }


    public function nuevaAsignacionOperarioAndActividad($id_operario, $id_actividad)
    {
        $operario_involucrado = new OperariosInvolucrados();
        $operario_involucrado->id_colaborador = $id_operario;
        $operario_involucrado->id_actividad = $id_actividad;
        $operario_involucrado->id_control = $this->getControlTrazabilidad()->id_control;
        $operario_involucrado->fecha_hora_asociacion = Carbon::now();
        $operario_involucrado->save();
    }

    public function saveInsumos()
    {

        $insumos = $this->getIdsInsumos();


        if (is_iterable($insumos)) {

            foreach ($insumos as $key => $id_insumo) {
                $color = $this->getColores()[$key];
                $olor = $this->getOlores()[$key];
                $imprimir = $this->getImpresiones()[$key];
                $ausencia_me = $this->getAusenciaMaterialExtranios()[$key];
                $this->saveInsumo($id_insumo, $color, $olor, $imprimir, $ausencia_me);
            }
        }
    }

    public function saveInsumo($id_insumo, $color, $olor, $imprimir, $ausencia_me)
    {
        $detalle_insumo = DetalleInsumo::find($id_insumo);
        $detalle_insumo->color = $color;
        $detalle_insumo->olor = $olor;
        $detalle_insumo->impresion = $imprimir;
        $detalle_insumo->ausencia_material_extranio = $ausencia_me;
        $detalle_insumo->save();
    }

    public function finalizarAsistencia($id_control, $id_colaborador, $id_actividad)
    {
        $fecha_finalizacion = Carbon::now();;
        $asistencia = Asistencia::where('id_control', $id_control)
            ->where('id_colaborador', $id_colaborador)
            ->where('id_actividad', $id_actividad)
            ->firstOrFail();
        $asistencia->fecha_hora_fin = $fecha_finalizacion;
        $asistencia->update();

        return $fecha_finalizacion;
    }

    public function crearControlTrazabilidad()
    {


        $this->calcularFechaVencimiento();
        $operacion = new Operacion();
        $operacion->id_producto = $this->getProducto()->id_producto;
        $operacion->fecha_vencimiento = Carbon::createFromFormat('d/m/Y', $this->getFechaVencimiento())->format('Y-m-d');
        $operacion->no_orden_produccion = $this->getNumeroOrdenProduccion();
        $operacion->id_usuario = Auth::user()->id;
        $operacion->status = self::STATUS_PROCESO_CREACION;
        $operacion->save();
        $this->setControlTrazabilidad($operacion);

        return $this->getControlTrazabilidad();
    }

    public function agregarOrdenProduccionSiNoExiste()
    {

        $estaAgregadaLaOrdenProduccion = DB::table('control_trazabilidad_orden_produccion')
            ->where('id_control', $this->getControlTrazabilidad()->id_control)
            ->where('no_orden_produccion', $this->getNumeroOrdenProduccion())
            ->exists();
        if (!$estaAgregadaLaOrdenProduccion) {
            DB::table('control_trazabilidad_orden_produccion')
                ->insert([
                    'id_control' => $this->getControlTrazabilidad()->id_control,
                    'no_orden_produccion' => $this->getNumeroOrdenProduccion(),
                    'id_requisicion' => $this->getRequisicion()->id,
                    'id_producto' => $this->getProducto()->id_producto
                ]);
        }

    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verificarProximoLote($request)
    {
        $orden_produccion = explode(",", $request->get('no_orden_produccion'));
        $codigo_barras = $request->get('codigo_barras');
        $lote = $request->get('lote');
        $productoRepository = new ProductoRepository();
        $this->setControlTrazabilidad(Operacion::find($request->id_control));
        $producto = $productoRepository->buscarProductoByCodigoBarras($codigo_barras);
        $this->setProducto($producto);

        $response = $this->esElProximoLoteAVencer($lote);

        return response()->json($response);
    }

    public function esElProximoLoteAVencer($lote)
    {

        $resultProximoLoteAvencer = $this->getProximoLoteAVencer();

        if ($resultProximoLoteAvencer['siguiente_lote'] == null) {
            $response = [
                'status' => 0,
                'message' => 'No hay en existencia  ',
                'data' => $resultProximoLoteAvencer
            ];
        } else {
            if ($resultProximoLoteAvencer['siguiente_lote']->lote == $lote) {
                $response = [
                    'status' => 1,
                    'message' => 'Lote correcto',
                    'data' => $resultProximoLoteAvencer
                ];
            } else {
                $response = [
                    'status' => 0,
                    'message' => 'Lote no proximo a vencer',

                ];
            }
        }
        return $response;

    }

    public function verificarExistenciaLoteMateriaPrimaOrMaterialEmpaque($request)
    {

        $proximoLote = $this->verificarProximoLote($request)->getData();


        if ($proximoLote->status == 1) {
            $cantidad_solicitada = $request->get('cantidad');
            $reserva = $proximoLote->data->reserva_insumo;
            $no_orden_produccion = explode(',', $request->no_orden_produccion);
            $cantidad_reservada = $reserva == null ? 0 : floatval($reserva->cantidad);
            $cantidad_siguiente_lote = $proximoLote->data->siguiente_lote->cantidad;
            $cantidad_disponible = $this->getCantidadLteDisponible($cantidad_siguiente_lote, $cantidad_reservada);
            $es_cantidad_suficiente = $cantidad_disponible >= $cantidad_solicitada;

            if ($es_cantidad_suficiente) {
                $id_control = $request->id_control;
                $lote = $proximoLote->data->siguiente_lote->lote;
                $fecha_vencimiento = $proximoLote->data->siguiente_lote->fecha_vencimiento;
                $this->getControlTrazabilidadById($id_control);
                $insumo = $this->saveNuevoInsumo($cantidad_solicitada, $lote, $fecha_vencimiento);
                $response = [
                    'status' => 1,
                    'message' => 'Ingresado correctamente',
                    'data' => $insumo
                        ->with('producto')
                        ->orderBy('id_detalle_insumo', 'desc')
                        ->first()
                ];

            } else {
                $response = [
                    'status' => 0,
                    'message' => 'La cantidad  tiene un excedente',
                    'data' => [
                        $cantidad_siguiente_lote,
                        $cantidad_reservada,
                        $cantidad_disponible
                    ]
                ];
            }

        } else {
            $response = $proximoLote;
        }

        return response()->json($response);

    }


    private function getCantidadLteDisponible($cantidad_siguiente_lote, $cantidad_insumo_reservado)
    {
        return floatval(
            $cantidad_siguiente_lote - $cantidad_insumo_reservado
        );
    }

    public function getProximoLoteAVencer()
    {
        $insumos_reservados = $this->getInsumosReservados();
        $reservasPicking = $this->getReservasPicking();


        $siguiente_lote = [
            'reserva_insumo' => $insumos_reservados->first(),
            'siguiente_lote' => $reservasPicking->first()
        ];

        if ($insumos_reservados != null) {
            foreach ($reservasPicking as $reserva_picking) {
                $lote_reservado_en_insumos = $insumos_reservados->where('lote', $reserva_picking->lote)->first();
                $existe_lote_reservado_en_insumos = $lote_reservado_en_insumos != null;
                if ($existe_lote_reservado_en_insumos) {
                    $esta_lote_picking_consumido = floatval($reserva_picking->cantidad) == floatval($lote_reservado_en_insumos->cantidad);
                    if (!$esta_lote_picking_consumido) {
                        $siguiente_lote = [
                            'reserva_insumo' => $lote_reservado_en_insumos,
                            'siguiente_lote' => $reserva_picking
                        ];
                        break;
                    }
                } else {
                    $siguiente_lote = [
                        'reserva_insumo' => $lote_reservado_en_insumos,
                        'siguiente_lote' => $reserva_picking
                    ];
                    break;
                }
            }
        }
        return $siguiente_lote;
    }


    public function getIdsRequisiciones()
    {


        $ids = DB::table('control_trazabilidad_orden_produccion')
            ->select('id_requisicion')
            ->where('id_control', $this->getControlTrazabilidad()->id_control)
            ->get()
            ->pluck('id_requisicion')
            ->toArray();;

        return $ids;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getReservasPicking()
    {
        if ($this->getProducto() == null) {
            return collect([]);
        }
        $requisiciones = $this->getIdsRequisiciones();

        $reservas = ReservaPicking::whereIn('id_requisicion', $requisiciones)
            ->select('reserva_lotes.*', DB::raw('sum(cantidad) as cantidad'))
            ->where('id_producto', $this->getProducto()->id_producto)
            ->groupBy('id_producto')
            ->groupBy('lote')
            ->orderBy('fecha_vencimiento', 'asc')
            ->get();

        return $reservas;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getInsumosReservados()
    {
        if ($this->getProducto() == null) {
            return collect([]);
        }
        $insumos_reservaos = DetalleInsumo::where('id_producto', $this->getProducto()->id_producto)
            ->whereNull('cantidad_utilizada')
            ->where('id_control', $this->getControlTrazabilidad()->id_control)
            ->select('id_producto', 'lote', DB::raw('sum(cantidad) as cantidad'))
            ->orderBy('fecha_vencimiento', 'desc')
            ->groupBy('lote')
            ->groupBy('id_producto')
            ->get();

        return $insumos_reservaos;
    }

    /**
     * @param $cantidad_solicitada
     * @param $lote
     * @param $fecha_vencimiento
     * @return DetalleInsumo
     */
    public function saveNuevoInsumo($cantidad_solicitada, $lote, $fecha_vencimiento)
    {
        $detalle_insumo = new DetalleInsumo();
        $detalle_insumo->id_control = $this->getControlTrazabilidad()->id_control;
        $detalle_insumo->id_producto = $this->getProducto()->id_producto;
        $detalle_insumo->color = 0;
        $detalle_insumo->olor = 0;
        $detalle_insumo->impresion = 0;
        $detalle_insumo->ausencia_material_extranio = 0;
        $detalle_insumo->lote = $lote;
        $detalle_insumo->fecha_vencimiento = $fecha_vencimiento;
        $detalle_insumo->cantidad = $cantidad_solicitada;
        $detalle_insumo->save();

        return $detalle_insumo;
    }


    /**
     * @param $lote
     * @param $codigo_producto
     * @return array
     */
    public function getControlTrazabilidadOfProductoProceso($lote, $codigo_producto)
    {
        $productoRepository = new ProductoRepository();

        $producto_pp = $productoRepository->buscarProductoPP($codigo_producto);
        $control = Operacion::where('id_producto', $producto_pp->id_producto)
            ->where('lote', $lote)
            ->firstOrFail();

        return [
            'control' => $control,
            'producto' => $producto_pp
        ];

    }

    public function marcarIniciadoControlTrazabilidad()
    {
        $control_trazabilidad = $this->getControlTrazabilidad();
        if ($control_trazabilidad->status == self::STATUS_PROCESO_CREACION) {
            $control_trazabilidad->status = self::STATUS_CREADA;
            $control_trazabilidad->save();
        }
    }

    public function verificarExistenciaLoteProductoProceso($codigo_producto, $lote, $cantidad)
    {


        $controlTrazabilidad = $this
            ->getControlTrazabilidadOfProductoProceso($lote, $codigo_producto);

        $this
            ->setProducto($controlTrazabilidad['producto']);


        $insumo = $this
            ->getInsumosReservados()
            ->where('lote', $lote)
            ->first();


        $cantidad_reservada = $insumo == null ? 0 : $insumo->cantidad;


        $cantidad_disponible = $controlTrazabilidad['control']->cantidad_programada - $cantidad_reservada;

        if ($cantidad <= $cantidad_disponible) {

            $insumo = $this
                ->saveNuevoInsumo($cantidad, $lote, $controlTrazabilidad['control']->fecha_vencimiento);


            $response = [
                'status' => 1,
                'message' => 'Ingresado correctamente',
                'data' => $insumo
                    ->with('producto')
                    ->orderBy('id_detalle_insumo', 'desc')
                    ->first()
            ];
        } else {
            $response = [
                'status' => 0,
                'message' => 'La cantidad tiene un excedente',
                'data' => ''
            ];
        }

        return $response;

    }


    public function finalizarControlTrazabilidad()
    {
        $this->registrarCantidadProducidaSiExiste();
        $producto_devolver = $this->registarCantidadUtilizadas();
        $control_trazabilidad = $this->getControlTrazabilidad();

        if ($control_trazabilidad->status == self::STATUS_CREADA) {

            if ($producto_devolver) {
                $control_trazabilidad->status = self::STATUS_DEVOLUCION;
            } else {
                $control_trazabilidad->status = self::STATUS_FINALIZADA;
            }
            $control_trazabilidad->save();
        }


    }

    public function registrarCantidadProducidaSiExiste()
    {

        $cantidad = $this->getCantidadUtilizada();
        if ($cantidad != "" && $cantidad != 0 && $cantidad != null) {
            $control_trazabilidad = $this->getControlTrazabilidad();
            if ($control_trazabilidad != null) {
                $control_trazabilidad->cantidad_producida = $cantidad;
                $control_trazabilidad->save();
            }
        }
    }

    public function registarCantidadUtilizadas(): bool
    {
        $productos_por_devolver = 0;
        $insumos = $this->getIdsInsumos();
        foreach ($insumos as $key => $insumo) {
            $detalle = DetalleInsumo::find($insumo);
            if ($detalle->cantidad != $this->getCantidadesUtilizadas()[$key]) {
                $productos_por_devolver++;
            }
            $detalle->cantidad_utilizada = $this->getCantidadesUtilizadas()[$key];
            $detalle->save();
        }
        return $productos_por_devolver == 0;
    }


    public function saveControlTrazabilidad()
    {
        //TODO revisar refactorización
        $control_trazabilidad = $this->getControlTrazabilidad();
        $control_trazabilidad->lote = $this->getLote();
        $control_trazabilidad->cantidad_programada = $this->getCantidadProgramada();
        $control_trazabilidad->id_turno = $this->getTurno();
        $control_trazabilidad->fecha_vencimiento = Carbon::createFromFormat('d/m/Y', $this->getFechaVencimiento())->format('Y-m-d');;
        $control_trazabilidad->save();
    }


}
