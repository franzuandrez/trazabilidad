<?php


namespace App\Repository;


use App\Operacion;
use App\Producto;
use App\Recepcion;
use App\RMIEncabezado;
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
     * @return Operacion
     */
    public function getControlTrazabilidad(): Operacion
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


    public function getTrazabilidadHaciaAtras($lote)
    {
        $trazabilidad = Operacion::whereLote($lote)
            ->with('asistencias')
            ->with('producto')
            ->with('creado_por')
            ->first();

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
                if (count($item) == 2) {
                    return $item[1];
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


    private function getEvento($tipo, $fecha, $evento)
    {

        return (object)[
            'tipo' => $tipo,
            'fecha' => $fecha,
            'evento' => $evento
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
