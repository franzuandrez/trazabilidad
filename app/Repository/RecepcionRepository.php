<?php


namespace App\Repository;


use App\DetalleLotes;
use App\Http\tools\Impresiones;
use App\InspeccionEmpaqueEtiqueta;
use App\InspeccionVehiculo;
use App\Recepcion;
use App\RMIDetalle;
use App\RMIEncabezado;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Auth;

/**
 * Class RecepcionRepository
 * @package App\Repository
 * @property Recepcion $recepcion_encabezado
 * @property string $observaciones
 * @property array $idsRmiDetalle
 * @property array $cantidad_impresiones
 * @property array $cantidades
 * @property array $lotes
 * @property array $idsProductos
 * @property array $fechas_vencimiento
 */
class RecepcionRepository
{


    private $recepcion_encabezado = null;
    private $observaciones = '';
    private $idsRmiDetalle = [];
    private $cantidad_impresiones = [];
    private $lotes = [];
    private $cantidades = [];
    private $idsProductos = [];
    private $fechas_vencimiento = [];


    public function setLotes($lotes)
    {
        $this->lotes = $lotes;
        return $this;
    }

    public function setCantidades($cantidades)
    {
        $this->cantidades = $cantidades;
        return $this;
    }

    public function setIdsProductos($ids)
    {
        $this->idsProductos = is_array($ids) ? $ids : [];
        return $this;
    }

    public function setFechasVencimiento($fechas)
    {
        $this->fechas_vencimiento = $fechas;
        return $this;
    }

    public function setRecepcionEncabezado(Recepcion $recepcion)
    {
        $this->recepcion_encabezado = $recepcion;
        return $this;
    }

    public function setObservacionesToRMIEncabezazdo($observaciones)
    {
        $this->$observaciones = $observaciones;
        $rmi_encabezado = $this->recepcion_encabezado->rmi_encabezado;
        $rmi_encabezado->observaciones = $this->$observaciones;
        $rmi_encabezado->id_usuario_calidad = Auth::id();
        $rmi_encabezado->save();

    }


    private function setCantidadImpresiones($cantidad_impresiones)
    {
        $this->cantidad_impresiones = $cantidad_impresiones;
    }

    private function setIdsRMIDetalle($ids)
    {
        $this->idsRmiDetalle = is_array($ids) ? $ids : [];
    }

    public function saveRecepcion(Request $request)
    {


        $this->setIdsProductos($request->get('id_producto'));
        $this->setLotes($request->get('no_lote'));
        $this->setCantidades($request->get('cantidad'));
        $this->setFechasVencimiento($request->get('fecha_vencimiento'));

        $this->recepcion_encabezado = $this->saveRecepcionEnc($request);
        $this->saveInspeccionVehiculo($request);
        $this->saveInspeccionEmpaque($request);
        $this->saveDetalleLotes();
        $this->saveRMIEncabezado('MP');
        $this->saveRMIDetalle('RAMPA');


    }

    public function saveInspeccionVehiculo(Request $request)
    {

        $proveedor_aprobado = $this->getValueCheched($request->get('proveedor_aprobado'));
        $producto_acorde_compra = $this->getValueCheched($request->get('producto_acorde_compra'));
        $cantidad_acorde_compra = $this->getValueCheched($request->get('cantidad_acorde_compra'));
        $certificado_existente = $this->getValueCheched($request->get('certificado_existente'));
        $certificado_correspondiente_lote = $this->getValueCheched($request->get('certificado_correspondiente_lote'));
        $certificado_correspondiente_especificacion = $this->getValueCheched($request->get('certificado_correspondiente_especificacion'));
        $sin_polvo = $this->getValueCheched($request->get('sin_polvo'));
        $sin_material_ajeno = $this->getValueCheched($request->get('sin_material_ajeno'));
        $ausencia_plagas = $this->getValueCheched($request->get('ausencia_plagas'));
        $sin_humedad = $this->getValueCheched($request->get('sin_humedad'));
        $sin_oxido = $this->getValueCheched($request->get('sin_oxido'));
        $ausencia_olores_extranios = $this->getValueCheched($request->get('ausencia_olores_extranios'));
        $ausencia_material_extranio = $this->getValueCheched($request->get('ausencia_material_extranio'));
        $cerrado = $this->getValueCheched($request->get('cerrado'));
        $sin_agujeros = $this->getValueCheched($request->get('sin_agujeros'));
        $observaciones_vehiculo = $request->get('observaciones_vehiculo');

        $inspeccionVehiculo = new InspeccionVehiculo();
        $inspeccionVehiculo->id_recepcion_enc = $this->recepcion_encabezado->id_recepcion_enc;
        $inspeccionVehiculo->proveedor_aprobado = $proveedor_aprobado;
        $inspeccionVehiculo->producto_acorde_compra = $producto_acorde_compra;
        $inspeccionVehiculo->cantidad_acorde_compra = $cantidad_acorde_compra;
        $inspeccionVehiculo->certificado_existente = $certificado_existente;
        $inspeccionVehiculo->certificado_correspondiente_lote = $certificado_correspondiente_lote;
        $inspeccionVehiculo->certificado_correspondiente_especificacion = $certificado_correspondiente_especificacion;
        $inspeccionVehiculo->sin_polvo = $sin_polvo;
        $inspeccionVehiculo->sin_material_ajeno = $sin_material_ajeno;
        $inspeccionVehiculo->ausencia_plagas = $ausencia_plagas;
        $inspeccionVehiculo->sin_humedad = $sin_humedad;
        $inspeccionVehiculo->sin_oxido = $sin_oxido;
        $inspeccionVehiculo->ausencia_olores_extranios = $ausencia_olores_extranios;
        $inspeccionVehiculo->ausencia_material_extranio = $ausencia_material_extranio;
        $inspeccionVehiculo->sin_agujeros = $sin_agujeros;
        $inspeccionVehiculo->cerrado = $cerrado;
        $inspeccionVehiculo->observaciones = $observaciones_vehiculo;
        $inspeccionVehiculo->save();


    }


    public function saveInspeccionEmpaque(Request $request)
    {

        $no_golpeado = $this->getValueCheched($request->get('no_golpeado'));
        $sin_roturas = $this->getValueCheched($request->get('sin_roturas'));
        $cerrado = $this->getValueCheched($request->get('empaque_cerrado'));
        $seco_limpio = $this->getValueCheched($request->get('seco_limpio'));
        $sin_material_extranio = $this->getValueCheched($request->get('sin_material_extranio'));
        $debidamente_identificado = $this->getValueCheched($request->get('debidamente_identificado'));
        $debidamente_legible = $this->getValueCheched($request->get('debidamente_legible'));
        $no_lote_presente = $this->getValueCheched($request->get('no_lote_presente'));
        $no_lote_legible = $this->getValueCheched($request->get('no_lote_legible'));
        $fecha_vencimiento_legible = $this->getValueCheched($request->get('fecha_vencimiento_legible'));
        $fecha_vencimiento_vigente = $this->getValueCheched($request->get('fecha_vencimiento_vigente'));
        $contenido_neto_declarado = $this->getValueCheched($request->get('contenido_neto_declarado'));
        $observaciones = $request->get('observaciones_empaque');

        $inspeccionEmpaque = new InspeccionEmpaqueEtiqueta();
        $inspeccionEmpaque->no_golpeado = $no_golpeado;
        $inspeccionEmpaque->sin_roturas = $sin_roturas;
        $inspeccionEmpaque->cerrado = $cerrado;
        $inspeccionEmpaque->seco_limpio = $seco_limpio;
        $inspeccionEmpaque->sin_material_extranio = $sin_material_extranio;
        $inspeccionEmpaque->debidamente_identificado = $debidamente_identificado;
        $inspeccionEmpaque->identificacion_legible = $debidamente_legible;
        $inspeccionEmpaque->no_lote_presente = $no_lote_presente;
        $inspeccionEmpaque->no_lote_legible = $no_lote_legible;
        $inspeccionEmpaque->fecha_vencimiento_legible = $fecha_vencimiento_legible;
        $inspeccionEmpaque->fecha_vencimiento_vigente = $fecha_vencimiento_vigente;
        $inspeccionEmpaque->contenido_neto_declarado = $contenido_neto_declarado;
        $inspeccionEmpaque->observaciones = $observaciones;
        $inspeccionEmpaque->id_recepcion_enc = $this->recepcion_encabezado->id_recepcion_enc;
        $inspeccionEmpaque->save();
    }


    public function saveDetalleLotes()
    {


        if (is_iterable($this->idsProductos)) {
            foreach ($this->idsProductos as $key => $value) {
                DetalleLotes::create([
                    'id_producto' => $value,
                    'cantidad' => $this->cantidades[$key],
                    'no_lote' => $this->lotes[$key],
                    'fecha_vencimiento' => $this->fechas_vencimiento[$key],
                    'id_recepcion_enc' => $this->recepcion_encabezado->id_recepcion_enc
                ]);
            }
        }

    }

    public function saveRecepcionEnc($request)
    {
        $recepcion = new Recepcion();
        $recepcion->id_proveedor = $request->get('id_proveedor');
        $recepcion->fecha_ingreso = Carbon::now();
        $recepcion->documento_proveedor = $request->get('documento_proveedor');
        $recepcion->orden_compra = $request->get('orden_compra');
        $recepcion->usuario_recepcion = \Auth::user()->id;
        $recepcion->save();

        return $recepcion;
    }

    public function saveRMIDetalle($ubicacion)
    {


        if (is_iterable($this->idsProductos)) {
            $valueUbicacion = $this->getValueEstado($ubicacion);
            foreach ($this->idsProductos as $key => $value) {
                RMIDetalle::create([
                    'id_producto' => $value,
                    'cantidad' => $this->cantidades[$key],
                    'lote' => $this->lotes[$key],
                    'fecha_vencimiento' => $this->fechas_vencimiento[$key],
                    'id_rmi_encabezado' => $this->recepcion_encabezado->rmi_encabezado->id_rmi_encabezado,
                    'rampa' => $valueUbicacion[0],
                    'control' => $valueUbicacion[1],
                    'mp' => $valueUbicacion[2]
                ]);
            }

        }


    }


    public function getMovimientosRmiDetalle()

    {
        $rmi_encabezado = $this->recepcion_encabezado->rmi_encabezado;
        $paso_calidad = $rmi_encabezado->rampa == "0";
        $id_rmi = $rmi_encabezado->id_rmi_encabezado;

        $detalle = $this->getRmiDetalle($id_rmi);
        if (!$paso_calidad) {
            $detalle = $detalle->estaEnRampa();
        }
        $detalle = $detalle->get();

        return $detalle;


    }

    private function getRmiDetalle($id_encabezado)
    {
        $detalle = RMIDetalle::select('*', DB::raw('sum(cantidad) as total'))
            ->where('id_rmi_encabezado', $id_encabezado)
            ->groupBy('id_producto')
            ->groupBy('lote');

        return $detalle;

    }

    private function saveRMIEncabezado($tipo_documento)
    {

        $rmi_encabezado = new RMIEncabezado();
        $rmi_encabezado->fecha_ingreso = \Carbon\Carbon::now();
        $rmi_encabezado->usuario_ingreso = Auth::user()->id;
        $rmi_encabezado->documento = $this->recepcion_encabezado->orden_compra;
        $rmi_encabezado->tipo_documento = $tipo_documento;
        $rmi_encabezado->estado = 'R';
        $rmi_encabezado->save();

        return $rmi_encabezado->id_rmi_encabezado;

    }


    private function completarPuntoControlCalidad($completo = false)
    {
        if ($completo) {
            $rmi_encabezado = $this->recepcion_encabezado->rmi_encabezado;
            $rmi_encabezado->rampa = 0;
            $rmi_encabezado->control = 1;
            $rmi_encabezado->update();
        }
    }

    private function getValueCheched($value)
    {

        return $value != 1 ? 0 : 1;

    }

    private function getValueEstado($ubicacion = 'RAMPA')
    {


        if ($ubicacion == 'RAMPA') {
            return [1, 0, 0];
        } else if ($ubicacion == 'CONTROL') {
            return [0, 1, 0];
        } else if ($ubicacion == 'MP') {
            return [0, 0, 1];
        }
        return [0, 0, 0];

    }

    public function setEstadoByIdProducto($value)
    {

        $estado = 'R';
        if (is_iterable($value)) {
            $estado = 'T';
        }
        $recepcion = $this->recepcion_encabezado;
        $recepcion->estado = $estado;
        $recepcion->update();

    }


    public function ingresarToControlCalidad(Request $request)
    {

        $this->setIdsRMIDetalle($request->get('id_movimiento'));
        $this->setCantidadImpresiones($request->get('imprimir'));
        $cantidadesEntrantes = $request->get('cantidad_entrante');
        $diferencias = $request->get('diferencia');
        $total_pendiente = 0;

        $movimientosRepository = new MovimientoRepository();

        foreach ($this->idsRmiDetalle as $key => $mov) {
            $rmi_detalle = RMIDetalle::find($mov);
            if ($diferencias[$key] > 0) {
                $movimientosRepository->setProducto($rmi_detalle->producto)
                    ->setLote($rmi_detalle->lote)
                    ->setUsuarioAutoriza(Auth::user())
                    ->setFechaVencimiento($rmi_detalle->fecha_vencimiento)
                    ->setObservaciones($this->observaciones)
                    ->setTipoDocumento('RECEPCION')
                    ->setNoDocumento($rmi_detalle->rmi_encabezado->documento)
                    ->setCantidad($diferencias[$key]);
                $movimientosRepository->ingresar_bodega_desecho();
            }
            if ($cantidadesEntrantes[$key] > 0) {
                $movimientosRepository->ingresar_control_calidad($rmi_detalle, $cantidadesEntrantes[$key]);
            } else {
                $total_pendiente++;
            }
        }
        $isOrdenCompleta = $total_pendiente == 0;
        $this->completarPuntoControlCalidad($isOrdenCompleta);
        $this->imprimir();
        return $this->idsRmiDetalle;
    }

    private function imprimir()
    {
        Impresiones::imprimirFromRMIDetalle($this->idsRmiDetalle, 'R', $this->cantidad_impresiones);
    }

}
