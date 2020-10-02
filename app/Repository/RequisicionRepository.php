<?php


namespace App\Repository;


use App\Requisicion;
use App\RequisicionDetalle;
use Carbon\Carbon;
use Auth;
use DB;

/**
 * @property string $no_orden_requisicion
 * @property string $no_orden_produccion
 * @property array $cantidades_a_reservar
 * @property array $ids_productos_a_reservar
 * @property Requisicion $requisicion
 **/
class RequisicionRepository
{

    const ESTADO_ORDEN_EXISTENTE = 0;
    const ESTADO_ORDEN_NUEVA = 1;
    const ESTADO_EXISTOSO = 1;
    const ESTADO_FALLO = 0;

    private $no_orden_requisicion = '';
    private $no_orden_produccion = '';
    private $requisicion = null;
    private $cantidades_a_reservar = [];
    private $ids_productos_a_reservar = [];

    public function setOrdenRequisicion($no_orden_requisicion)
    {
        $this->no_orden_requisicion = $no_orden_requisicion;
        return $this;
    }

    public function setNumeroOrdenProduccion($no_orden_prod)
    {
        $this->no_orden_produccion = $no_orden_prod;
        return $this;
    }

    public function setRequisicion($requisicion)
    {
        $this->requisicion = $requisicion;
        return $this;
    }

    public function setCantidadesAReservar($cantidades_a_reservar)
    {
        $this->cantidades_a_reservar = $cantidades_a_reservar;
        return $this;
    }

    public function setIdsProductosAReservar($prods_a_reservar)
    {
        $this->ids_productos_a_reservar = $prods_a_reservar;
        return $this;
    }

    public function get_mis_requisiciones_proceso_mp()
    {
        $requisiciones = Requisicion::enProceso()
            ->esMateriaPrima()
            ->where('id_usuario_ingreso', Auth::user()->id)
            ->get();
        return $requisiciones;
    }

    public function get_mis_requisiciones_proceso_pt()
    {
        $requisiciones = Requisicion::with('detalle_pt')
            ->enProceso()
            ->esProductoTerminado()
            ->where('id_usuario_ingreso', Auth::user()->id)
            ->get();

        return $requisiciones;
    }


    /**
     * @return array
     */
    public function verificar_orden_requisicion()
    {
        $requisicion = $this->get_requisicion_by_numero_requisicion();
        $existe_requisicion = $requisicion != null;


        if ($existe_requisicion) {
            $response = [self::ESTADO_ORDEN_EXISTENTE, $this->requisicion->estado];
        } else {
            $this->crear_nueva_requisicion();
            $response = [self::ESTADO_ORDEN_NUEVA, $this->requisicion->id];
        }

        return $response;

    }

    /**
     * @param int $id
     * @return array
     */
    public function verificar_orden_produccion(int $id)
    {


        $requisicion = $this->get_requisicion_by_numero_produccion();
        $existe_requisicion = $requisicion != null;
        if ($existe_requisicion) {
            $response = [self::ESTADO_ORDEN_EXISTENTE, $requisicion->estado];
        } else {
            $this->requisicion = $this->get_requisicion_by_id($id);
            $this->asigar_orden_produccion();
            $response = [self::ESTADO_ORDEN_NUEVA, $this->requisicion->id];
        }
        return $response;
    }

    public function get_requisicion_by_id($id)
    {
        $this->requisicion = Requisicion::findOrFail($id);

        return $this->requisicion;
    }

    private function get_requisicion_by_numero_requisicion()
    {

        if ($this->no_orden_requisicion != '') {
            $this->requisicion = Requisicion::where('no_requision', $this->no_orden_requisicion)
                ->first();
        }


        return $this->requisicion;
    }

    private function get_requisicion_by_numero_produccion()
    {

        if ($this->no_orden_produccion != '') {
            $this->requisicion = Requisicion::where('no_orden_produccion', $this->no_orden_produccion)
                ->first();
        }

        return $this->requisicion;
    }

    private function crear_nueva_requisicion()
    {
        $requisicion = new Requisicion();
        $requisicion->no_requision = $this->no_orden_requisicion;
        $requisicion->id_usuario_ingreso = Auth::user()->id;
        $requisicion->fecha_ingreso = Carbon::now();
        $requisicion->save();
        $this->requisicion = $requisicion;

    }

    private function asigar_orden_produccion()
    {

        $this->requisicion->no_orden_produccion = $this->no_orden_produccion;
        $this->requisicion->update();

    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function reservar_productos()
    {

        $total_ids_productos = count($this->ids_productos_a_reservar);
        $total_cantidades = count($this->cantidades_a_reservar);
        $reservas = collect([]);
        if ($total_ids_productos == $total_cantidades) {
            foreach ($this->ids_productos_a_reservar as $key => $id_producto) {
                $requisicion_detalle = new RequisicionDetalle();
                $requisicion_detalle->id_requisicion_encabezado = $this->requisicion->id;
                $requisicion_detalle->orden_requisicion = $this->requisicion->no_requision;
                $requisicion_detalle->orden_produccion = $this->requisicion->no_orden_produccion;
                $requisicion_detalle->id_producto = $id_producto;
                $requisicion_detalle->cantidad = $this->cantidades_a_reservar[$key];
                $requisicion_detalle->estado = 'P';
                $requisicion_detalle->save();
                $reservas->push($requisicion_detalle);

            }
        }

        return $reservas;


    }


    public function deshacer_reservas(array $ids)
    {

        try {
            RequisicionDetalle::destroy($ids);
            $response = [self::ESTADO_EXISTOSO];
        } catch (\Exception $e) {
            $response = [self::ESTADO_FALLO];
        }

        return $response;
    }

    public function get_total_producto_en_reserva($productos)
    {

        $totalEnRequisiciones = RequisicionDetalle::whereIn('id_producto', $productos)
            ->where(function ($query) {
                $query->reservado()
                    ->orWhere
                    ->proceso();
            })
            ->sum('cantidad');

        return $totalEnRequisiciones;
    }


    public function borrar_requision_en_proceso()
    {

        $requisicion = $this->borrar_requisicion_encabezado();
        $this->borrar_requisicion_detalle($requisicion->id);

    }

    private function borrar_requisicion_encabezado()
    {
        $requisicionABorrar = Requisicion::deUsuarioRecepcion(Auth::user()->id)
            ->enProceso()
            ->first();

        $requisicion = $requisicionABorrar;
        $requisicionABorrar->delete();

        return $requisicion;
    }

    private function borrar_requisicion_detalle($id_req_enc)
    {
        DB::table('requisicion_detalle')
            ->where('id_requisicion_encabezado', $id_req_enc)
            ->delete();
        DB::table('detalle_requisicion_pt')->where('id_requisicion', $id_req_enc)->delete();
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function dar_baja_requisicion()
    {

        $response = [
            'status' => self::ESTADO_FALLO,
            'message' => 'La requisicion ya inicio el proceso de picking'
        ];
        $es_posible_dar_bajar = !$this->es_proceso_de_lectura__iniciado();
        if ($es_posible_dar_bajar) {
            try {
                DB::beginTransaction();
                $this->dar_baja_requisicio_nencabezado();
                $this->dar_baja_requisicion_detalle();
                $response = [
                    'status' => self::ESTADO_EXISTOSO,
                    'message' => 'Requisicion dada de baja correctamente'
                ];
                DB::commit();
            } catch (\Exception $exception) {
                $response = [
                    'status' => self::ESTADO_FALLO,
                    'message' => $exception->getMessage()
                ];
                DB::rollBack();
            }

        }

        return $response;

    }

    private function dar_baja_requisicio_nencabezado()
    {

        $this->requisicion->estado = 'B';
        $this->requisicion->update();

    }

    private function dar_baja_requisicion_detalle()
    {
        DB::table('requisicion_detalle')
            ->where('id_requisicion_encabezado', $this->requisicion->id)
            ->update(['estado' => 'B']);

    }

    private function total_productos_leidos()
    {
        $total_leidas = $this
            ->requisicion
            ->reservas()
            ->where('leido', 'S')
            ->count();

        return $total_leidas;

    }

    private function es_proceso_de_lectura__iniciado()
    {
        $total_leidas = $this->total_productos_leidos();

        return $total_leidas > 0;
    }

    public function finalizar_proceso_de_creacion(int $id)
    {


        try {
            DB::beginTransaction();
            $this->finalizar_proceso_de_creacion_encabezado($id);
            $this->finalizar_proceso_de_creacion_detalle();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
        }

    }

    private function finalizar_proceso_de_creacion_encabezado(int $id)
    {

        $operacion = $this->get_requisicion_by_id($id);
        $operacion->estado = 'R';
        $operacion->fecha_actualizacion = Carbon::now();
        $operacion->update();


    }

    private function finalizar_proceso_de_creacion_detalle()
    {
        DB::table('requisicion_detalle')
            ->where('id_requisicion_encabezado', $this->requisicion->id)
            ->update(['estado' => 'R']);

    }

    public function getOrdenesSugeridas()
    {

        $ordenes_sugeridas = Requisicion::where('estado', '=', 'D')
            ->whereBetween('fecha_ingreso', [
                Carbon::yesterday(),
                Carbon::tomorrow()
            ])
            ->get();

        return $ordenes_sugeridas;
    }


}
