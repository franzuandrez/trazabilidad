<?php


namespace App\Repository;


use App\DetalleInsumo;
use App\DetalleLotes;
use App\EntregaDet;
use App\EntregaEnc;
use App\Laminado_Enc;
use App\LineaChaomin;
use App\MezclaHarina_Enc;
use App\Movimiento;
use App\Operacion;
use App\PesoHumedoEnc;
use App\PesoSecoEnc;
use App\PrecocidoEnc;
use App\Producto;
use App\Recepcion;
use App\Requisicion;
use App\RequisicionDetalle;
use App\ReservaPicking;
use App\RMIEncabezado;
use App\SecadoEnc;
use App\VerificacionMateriaChaoEnc;
use App\VerificacionMateriaEnc;
use Spatie\Activitylog\Models\Activity;
use App\RMIDetalle;
use Carbon\Carbon;
use Illuminate\Support\Collection;


/**
 * @property Collection $requisiciones
 * @property Collection $recepciones
 * @property Collection $picking
 * @property Producto $productoTrazabilidad
 * @property Collection $asistencias
 * @property Operacion $control_trazabilidad
 * @property Collection $insumos
 * @property Collection $eventos
 **/
class ConsultaTrazabilidadRepository
{


    private $control_trazabilidad = null;
    private $insumos = null;
    private $asistencias = null;
    private $productoTrazabilidad = null;
    private $picking = null;
    private $requisiciones = null;
    private $recepciones = null;
    const FORMATO_FECHA = 'd M. Y';
    const CONTROL_TRAZABILIDAD_CODE = 'CT';
    const REQUISICION_CODE = 'REQ';
    const RECEPCION_CODE = 'REC';
    const CONTROL_CALIDAD_CODE = 'CCAL';
    const ASIGNACION_UBICACION_CODE = 'AUBI_REC';

    //CHAOMEIN
    const LIBERACION_LINEA_CHAO_MEIN = 'LIBERACION_LINEA_CHAO_MEIN';
    const VERIFICACION_MATERIAS_PRIMAS_EN_MEZCLADORA_CHAOMEIN = 'VERIFICACION_MATERIAS_PRIMAS_EN_MEZCLADORA';
    const MEZCLA_HARINA_CHAOMEIN = 'MEZCLA_HARINA';
    const LAMINADO_CHAOMEIN = 'LAMINADO';
    const PESO_HUMEDO_CHAOMEIN = 'PESO_HUMEDO';
    const SECADO_CHAOMEIN = 'SECADO';
    const PESO_SECO_CHAOMEIN = 'PESO_SECO';
    const PRECOCIDO_PASTA_CHAOMEIN = 'PRECOCIDO_PASTA';
    //SOPAS

    const LIBERACION_LINEA_SOPAS = 'LIBERACION_LINEA_SOPAS';
    const VERIFICACION_MATERIAS_PRIMAS_EN_MEZCLADORA_SOPAS = 'VERIFICACION_MATERIAS_PRIMAS_EN_MEZCLADORA_SOPAS';
    const VERIFICACION_MATERIAS_PRIMAS_SOLUCION_SOPAS = 'VERIFICACION_MATERIAS_PRIMAS_SOLUCION';
    const MEZCLADO_SOPAS = 'MEZCLADO_SOPAS';
    const LAMINADO_PRECOCCION_SOPAS = 'LAMINADO_PRECOCCION';
    const FRITURA_SOPAS = 'FRITURA';
    const PRECOCIDO_PASTA_SOPAS = 'PRECOCIDO_PASTA';


    //CONDIMENTOS

    const BASE_CONDIMENTOS = 'BASE_CONDIMENTOS';
    const PESO_CONDIMENTOS = 'PESO_CONDIMENTOS';


    //ENTREGA_PT
    const ENTREGA_PT = 'ENTREGA_PT';
    const RECEPCION_PT = 'RECEPCION_PT';
    const REQUISICION_PT = 'REQUISICION_PT';


    private $eventos = null;


    public function agregarEvento($evento)
    {

        $this->eventos = $this->eventos == null ? collect([]) : $this->eventos;
        $this->eventos->push($evento);
    }

    public function getEventos()
    {

        return $this->eventos;
    }

    /**
     * @return Collection
     */
    public function getRequisiciones(): Collection
    {
        return $this->requisiciones;
    }

    /**
     * @param Collection $requisiciones
     */
    public function setRequisiciones(Collection $requisiciones): void
    {
        $this->requisiciones = $requisiciones;
    }

    /**
     * @return Collection
     */
    public function getRecepciones(): Collection
    {
        return $this->recepciones;
    }

    /**
     * @param Collection $recepciones
     */
    public function setRecepciones(Collection $recepciones): void
    {
        $this->recepciones = $recepciones;
    }

    /**
     * @return Collection
     */
    public function getPicking(): Collection
    {
        return $this->picking;
    }

    /**
     * @param Collection $picking
     */
    public function setPicking(Collection $picking): void
    {
        $this->picking = $picking;
    }

    /**
     * @return Producto
     */
    public function getProductoTrazabilidad(): Producto
    {
        return $this->productoTrazabilidad;
    }

    /**
     * @param Producto $productoTrazabilidad
     */
    public function setProductoTrazabilidad(Producto $productoTrazabilidad): void
    {
        $this->productoTrazabilidad = $productoTrazabilidad;
    }

    /**
     * @return Collection
     */
    public function getAsistencias(): Collection
    {
        return $this->asistencias;
    }

    /**
     * @param Collection $asistencias
     */
    public function setAsistencias(Collection $asistencias): void
    {
        $this->asistencias = $asistencias;
    }

    /**
     * @return Operacion|null
     */
    public function getControlTrazabilidad()
    {
        return $this->control_trazabilidad;
    }

    /**
     * @param Operacion $control_trazabilidad
     */
    public function setControlTrazabilidad(Operacion $control_trazabilidad): void
    {
        $this->control_trazabilidad = $control_trazabilidad;
    }

    /**
     * @return Collection
     */
    public function getInsumos(): Collection
    {
        return $this->insumos;
    }

    /**
     * @param Collection $insumos
     */
    public function setInsumos(Collection $insumos): void
    {
        $this->insumos = $insumos;
    }

    private function getControlTrazabilidadByLote($lote)
    {
        return Operacion::whereLote($lote)
            ->with('asistencias')
            ->with('producto')
            ->with('creado_por')
            ->first();
    }


    public function getTrazabilidadHaciaAdelanteByProducto($lote)
    {

        $productos = DetalleLotes::with('recepcion')
            ->whereNoLote($lote)
            ->get();

        $id_productos = $productos->pluck('id_producto')->toArray();
        $lotes = $productos->pluck('no_lote')->toArray();

        $movimientos = $this->getMovimientos($id_productos, $lotes
            , null, 'asc');


        $insumos = DetalleInsumo::whereIn('detalle_insumos.id_producto', $id_productos)
            ->whereIn('detalle_insumos.lote', $lotes)
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'detalle_insumos.id_control')
            ->get();


        return [
            'productos' => $productos,
            'movimientos' => $movimientos,
            'insumos' => $insumos,


        ];


    }

    private function getEventosMovimientos($productos, $lotes, $fecha = null)
    {
        $eventos = Movimiento::with('responsable')
            ->whereIn('id_producto', $productos)
            ->whereIn('lote', $lotes);

        if ($fecha != null) {
            $eventos = $eventos->where('fecha_hora_movimiento', '<=', $fecha);
        }

        $eventos = $eventos->orderBy('fecha_hora_movimiento', 'desc')
            ->groupBy(\DB::raw('CONCAT(tipo_documento,numero_documento)'))
            ->get();

        return $eventos;
    }

    private function getMovimientos($productos, $lotes, $fecha = null, $order = 'desc')
    {

        $movimientos = Movimiento::select('movimientos.*',
            'tipo_movimiento.descripcion as movimiento',
            'tipo_movimiento.factor',
            'sectores.descripcion as bodega')
            ->join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
            ->join('sectores', 'sectores.id_sector', '=', 'movimientos.id_sector')
            ->whereIn('id_producto', $productos)
            ->whereIn('lote', $lotes);

        if ($fecha != null) {
            $movimientos = $movimientos->where('fecha_hora_movimiento', '<=', $fecha);
        }

        $movimientos = $movimientos->orderBy('fecha_hora_movimiento', $order)
            ->get();

        return $movimientos;
    }

    public function getTrazabilidadHaciaAtrasByProducto($lote)
    {
        $trazabilidad = $this->getControlTrazabilidadByLote($lote);


        if ($trazabilidad == null) {
            return [
                'insumos' => [],
                'controles' => []
            ];
        }

        $insumos = $trazabilidad->detalle_insumos->pluck('lote', 'id_producto');

        $eventos = $this->getEventosMovimientos($insumos->keys(), $insumos->values(), $trazabilidad->created_at);

        $movimientos = $this->getMovimientos($insumos->keys(), $insumos->values(), $trazabilidad->created_at);


        $this->setControlTrazabilidad($trazabilidad);
        $insumos = $trazabilidad->detalle_insumos;
        $this->agregarEntregaPT();
        $this->agregarRecepcionPT();
        $this->agregarRequisicionPT();
        $this->agregarControlesChaoMein();
        $this->agregarControlesSopas();
        $this->agregarControlerCondimentos();


        return [
            'insumos' => ($eventos->map(function ($item) use ($insumos, $movimientos) {
                return [
                    'event' => $item,
                    'movements' => $insumos->map(function ($e) use ($item, $movimientos) {
                        return $movimientos->whereIn('lote', $e->lote)
                            ->where('numero_documento', $item->numero_documento)
                            ->where('tipo_documento', $item->tipo_documento)
                            ->first();
                    })
                ];

            })),
            'controles' => $this->getEventos() == null ? [] : $this->getEventos()->sortByDesc('fecha'),

        ];


    }


    private function agregarEntregaPT()
    {


        $trazabilidad = $this->getControlTrazabilidad();


        $entrega_pt = EntregaDet::without('control_trazabilidad')
            ->with('entrega_pt_enc')
            ->whereIdControl($trazabilidad->id_control)->first();

        if ($entrega_pt != null) {
            $evento = $this
                ->getEvento(self::ENTREGA_PT,
                    $entrega_pt->entrega_pt_enc->fecha_hora,
                    $entrega_pt->entrega_pt_enc,
                    'produccion/entrega_pt/' . $entrega_pt->entrega_pt_enc->id);
            $this->agregarEvento($evento);
        }


    }

    private function agregarRecepcionPT()
    {

        $trazabilidad = $this->getControlTrazabilidad();


        $entrega_pt = EntregaDet::without('control_trazabilidad')
            ->with('entrega_pt_enc')
            ->whereIdControl($trazabilidad->id_control)->first();

        if ($entrega_pt != null) {
            if ($entrega_pt->entrega_pt_enc->fecha_recepcion != null) {
                $evento = $this
                    ->getEvento(self::RECEPCION_PT,
                        $entrega_pt->entrega_pt_enc->fecha_recepcion,
                        $entrega_pt->entrega_pt_enc,
                        'produccion/entrega_pt/' . $entrega_pt->entrega_pt_enc->id);
                $this->agregarEvento($evento);
            }
        }
    }

    private function agregarRequisicionPT()
    {
        $trazabilidad = $this->getControlTrazabilidad();

        $reservas = ReservaPicking::without('producto')
            ->without('bodega')
            ->without('ubicacion')
            ->whereLote($trazabilidad->lote)
            ->whereIdProducto($trazabilidad->id_producto)
            ->where('leido', 'S')
            ->get();


        $requisiciones = Requisicion::whereIn('id', $reservas->pluck('id_requisicion')->toArray())
            ->get();

        foreach ($requisiciones as $requi) {
            $evento = $this
                ->getEvento(self::REQUISICION_PT,
                    $requi->fecha_ingreso,
                    $requi,
                    'produccion/requisiciones/reporte/' . $requi->id);
            $this->agregarEvento($evento);
        }


    }


    private function agregarControlesChaoMein()
    {

        $trazabilidad = $this->getControlTrazabilidad();

        $linea_chaomein = LineaChaomin::whereIdControl($trazabilidad->id_control)->first();


        if ($linea_chaomein != null) {
            $evento = $this
                ->getEvento(self::LIBERACION_LINEA_CHAO_MEIN,
                    $linea_chaomein->fecha,
                    $linea_chaomein,
                    'control/chaomin/reporte/' . $linea_chaomein->id_chaomin

                );
            $this->agregarEvento($evento);
        }

        $verificacion_materias_primas = VerificacionMateriaEnc::whereIdControl($trazabilidad->id_control)->first();

        if ($verificacion_materias_primas != null) {
            $evento = $this
                ->getEvento(self::VERIFICACION_MATERIAS_PRIMAS_EN_MEZCLADORA_CHAOMEIN,
                    $verificacion_materias_primas->fecha,
                    $verificacion_materias_primas,
                    'control/verificacion_materias/reporte/' . $verificacion_materias_primas->id_verificacion
                );
            $this->agregarEvento($evento);
        }

        $mezcla_harina = MezclaHarina_Enc::whereIdControl($trazabilidad->id_control)->first();
        if ($mezcla_harina != null) {
            $evento = $this
                ->getEvento(self::MEZCLA_HARINA_CHAOMEIN,
                    $mezcla_harina->fecha_hora,
                    $mezcla_harina,
                    'control/mezcla_harina/reporte/' . $mezcla_harina->id_Enc_mezclaharina
                );
            $this->agregarEvento($evento);
        }

        $laminado = Laminado_Enc::whereIdControl($trazabilidad->id_control)->first();
        if ($laminado != null) {
            $evento = $this
                ->getEvento(self::LAMINADO_CHAOMEIN,
                    $laminado->fecha_ingreso,
                    $laminado,
                    'control/laminado/reporte/' . $laminado->id_enc_laminado
                );
            $this->agregarEvento($evento);
        }
        $peso_humedo = PesoHumedoEnc::whereIdControl($trazabilidad->id_control)->first();
        if ($peso_humedo != null) {
            $evento = $this
                ->getEvento(self::PESO_HUMEDO_CHAOMEIN,
                    $peso_humedo->fecha_ingreso,
                    $peso_humedo,
                    'control/peso_humedo/reporte/' . $peso_humedo->id_peso_humedo);
            $this->agregarEvento($evento);
        }
        $secado = SecadoEnc::whereIdControl($trazabilidad->id_control)->first();

        if ($secado != null) {
            $evento = $this
                ->getEvento(self::SECADO_CHAOMEIN,
                    $secado->fecha_ingreso,
                    $secado,
                    'control/secado/reporte/' . $secado->id_secado_enc);
            $this->agregarEvento($evento);
        }

        $peso_seco = PesoSecoEnc::whereIdControl($trazabilidad->id_control)->first();
        if ($peso_humedo != null) {
            $evento = $this
                ->getEvento(self::PESO_SECO_CHAOMEIN,
                    $peso_seco->fecha_ingreso,
                    $peso_seco,
                    'control/peso_seco/reporte/' . $peso_seco->id_peso_seco);
            $this->agregarEvento($evento);
        }

        $precocido = PrecocidoEnc::whereIdControl($trazabilidad->id_control)->first();
        if ($precocido != null) {
            $evento = $this
                ->getEvento(self::PRECOCIDO_PASTA_CHAOMEIN,
                    $precocido->fecha_ingreso,
                    $precocido, 'control/precocido/reporte/' . $precocido->id_precocido_enc);
            $this->agregarEvento($evento);
        }

    }

    private function agregarControlesSopas()
    {

        $trazabilidad = $this->getControlTrazabilidad();

        $verificacion_materias_primas = VerificacionMateriaChaoEnc::whereIdControl($trazabilidad->id_control)->first();

        if ($verificacion_materias_primas != null) {
            $evento = $this
                ->getEvento(self::VERIFICACION_MATERIAS_PRIMAS_EN_MEZCLADORA_SOPAS,
                    $verificacion_materias_primas->fecha_hora,
                    $verificacion_materias_primas);
            $this->agregarEvento($evento);
        }

    }

    private function agregarControlerCondimentos()
    {

    }

    public function getTrazabilidadHaciaAtras($lote)
    {
        $trazabilidad = $this->getControlTrazabilidadByLote($lote);

        if ($trazabilidad == null) {
            return [];
        }


        $this->setControlTrazabilidad($trazabilidad);
        $this->setInsumos($trazabilidad->detalle_insumos);
        $this->setAsistencias($trazabilidad->asistencias);
        $this->setProductoTrazabilidad($trazabilidad->producto);
        $this->setRequisiciones($trazabilidad->requisiciones()->with('usuario_ingreso')->get());
        $picking = $this->getPickingByRequisiciones();
        $this->setPicking($picking);
        $recepciones = $this->getRecepcionesByInsumos();
        $this->setRecepciones($recepciones);

        $trazabilidadHaciaAtras = $this->trazabilidadHaciAtrasFormat();

        return $trazabilidadHaciaAtras;


    }


    private function agregarEventoControlTrazabilidad()
    {

        $evento = $this
            ->getEvento(self::CONTROL_TRAZABILIDAD_CODE,
                $this->getControlTrazabilidad()->created_at,
                $this->getControlTrazabilidad());

        $this->agregarEvento($evento);
    }

    private function agregarEventosRequisiciones()
    {
        foreach ($this->getRequisiciones() as $requisicion) {
            $evento = $this
                ->getEvento(self::REQUISICION_CODE,
                    $requisicion->fecha_ingreso,
                    $requisicion);
            $this->agregarEvento($evento);
        }
    }

    private function agregarEventoRecepciones()
    {
        foreach ($this->getRecepciones() as $recepcion) {
            $evento = $this
                ->getEvento(self::RECEPCION_CODE,
                    $recepcion->fecha_ingreso,
                    $recepcion);
            $this->agregarEvento($evento);
        }
    }

    private function getEventosOrdenadosPorFecha()
    {
        return $this->getEventos()->sortByDesc(function ($item) {
            return $item->fecha->getTimestamp();
        })
            ->values()
            ->groupBy(function ($item) {
                return $item->fecha->format(self::FORMATO_FECHA);
            });
    }

    private function agregarEventoControlCalidad($control_calidad_and_asignaciones)
    {
        $calidad = $control_calidad_and_asignaciones['fechas']
            ->map(function ($item) {
                return $item->first();
            });

        foreach ($calidad as $control_calidad) {

            $rmi_encabezado = $control_calidad_and_asignaciones['rmi_encabezados']->where('id_rmi_encabezado', $control_calidad->subject_id)->first();
            $evento = $this
                ->getEvento(self::CONTROL_CALIDAD_CODE,
                    $control_calidad->created_at,
                    [
                        'control_calidad' => $rmi_encabezado,
                        'fecha' => $control_calidad
                    ]);
            $this->agregarEvento($evento);
        }

    }

    private function agregarEventoAsignacion($control_calidad_and_asignaciones)
    {


        $asignaciones = $control_calidad_and_asignaciones['fechas']
            ->map(function ($item) {
                if (count($item) > 1) {
                    return $item->last();
                }
            });

        foreach ($asignaciones as $asignacion) {
            $rmi_encabezado = $control_calidad_and_asignaciones['rmi_encabezados']->where('id_rmi_encabezado', $asignacion->subject_id)->first();
            $evento = $this
                ->getEvento(self::ASIGNACION_UBICACION_CODE,
                    $asignacion->created_at,
                    [
                        'asignacion' => $rmi_encabezado,
                        'fecha' => $asignacion
                    ]);
            $this->agregarEvento($evento);
        }
    }

    private function agregarEventoControlCalidadAndAsignacion()
    {

        $control_calidad_and_asignaciones = $controles_de_calidad = $this->getControlCalidadAndAsignacionUbicacion();


        $this->agregarEventoAsignacion($control_calidad_and_asignaciones);
        $this->agregarEventoControlCalidad($control_calidad_and_asignaciones);

    }

    private function getControlCalidadAndAsignacionUbicacion()
    {

        $rmi_encabezados = ($this->getRecepciones()->pluck('rmi_encabezado'));
        $fechas = Activity::
        with('causer')->
        where('subject_type', RMIEncabezado::class)
            ->where('description', 'updated')
            ->whereIn('subject_id', $rmi_encabezados->pluck('id_rmi_encabezado'))
            ->orderBy('id', 'asc')
            ->get()
            ->groupBy('subject_id');


        return [
            'rmi_encabezados' => $rmi_encabezados,
            'fechas' => $fechas
        ];
    }

    private function trazabilidadHaciAtrasFormat()
    {


        $this->agregarEventoControlTrazabilidad();
        $this->agregarEventosRequisiciones();
        $this->agregarEventoControlCalidadAndAsignacion();
        $this->agregarEventoRecepciones();

        $eventos = $this->getEventosOrdenadosPorFecha();

        return $eventos;
    }


    private function getEvento($tipo, $fecha, $evento, $url = '')
    {

        $url = url('') . '/' . $url;
        if (!($fecha instanceof Carbon)) {
            $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $fecha);
        }

        return (object)[
            'tipo' => $tipo,
            'fecha' => $fecha,
            'evento' => $evento,
            'url' => $url
        ];
    }

    private function getPickingByRequisiciones()
    {
        $picking = $this->getControlTrazabilidad()
            ->requisiciones
            ->map(function ($item) {
                return $item->reservas;
            });

        return $picking;
    }


    private function getRecepcionesByInsumos()
    {
        $insumos = $this->getControlTrazabilidad()
            ->detalle_insumos->map(function ($item) {
                return (object)[
                    'id_producto' => $item->id_producto,
                    'lote' => $item->lote,
                ];
            });

        $rmi_detalle = RMIDetalle::  with('rmi_encabezado')
            ->whereIn('id_producto', $insumos->pluck('id_producto'))
            ->whereIn('lote', $insumos->pluck('lote'))
            ->get()
            ->map(function ($item) {
                return $item->rmi_encabezado->documento;
            })
            ->toArray();

        $recepciones = Recepcion::whereIn('orden_compra', $rmi_detalle)->get();

        return $recepciones;
    }


}
