<?php


namespace App\Repository;


use App\EntregaDet;
use App\EntregaEnc;
use App\Http\tools\GeneradorCodigos;
use App\ImpresionCorrugado;
use App\Operacion;
use App\Tarima;
use Carbon\Carbon;
use Exception;
use Throwable;
use DB;

class EntregaRepository
{


    private $trazabilidad_repository;

    public function __construct(TrazabilidadRepository $trazabilidad_repository)
    {
        $this->trazabilidad_repository = $trazabilidad_repository;
    }

    /**
     * @param $request
     * @return string
     * @throws Exception
     */
    public function agregar_producto($request)

    {


        try {


            DB::beginTransaction();


            $entrega_det = null;

            $entrega = EntregaEnc::where('id_control', $request->get('id_control'))->first();
            $es_nuevo = $entrega == null;
            if ($es_nuevo) {
                $entrega = new EntregaEnc();
                $entrega->id_usuario = \Auth::id();
                $entrega->fecha_hora = Carbon::now();
                $entrega->id_control = $request->get('id_control');
                $entrega->save();
            }

            $entrega_det = EntregaDet::where('id_control', $request->get('id_control'))
                ->where('unidad_medida', $request->get('unidad_medida'))
                ->where('no_tarima', $request->get('no_tarima'))
                ->where('sscc', $request->get('sscc'))
                ->first();
            $es_nuevo = $entrega_det == null;
            if ($es_nuevo) {
                $entrega_det = new EntregaDet();
            }
            $entrega_det->id_enc = $entrega->id;
            $entrega_det->id_control = $request->get('id_control');
            $entrega_det->cantidad = $es_nuevo ? $request->get('cantidad') : ($entrega_det->cantidad + $request->get('cantidad'));
            $entrega_det->unidad_medida = $request->get('unidad_medida');
            $entrega_det->no_tarima = $request->get('no_tarima');
            $entrega_det->sscc = $request->get('sscc');
            $entrega_det->fecha_hora = Carbon::now();
            $entrega_det->id_usuario = \Auth::id();
            $entrega_det->save();

            $trazabilidad = Operacion::find($entrega_det->id_control);

            $tarima = new Tarima();
            $tarima->id_producto = $trazabilidad->producto->id_producto;
            $tarima->no_tarima = $request->get('no_tarima');
            $tarima->cantidad_sscc_unidad_distribucion = $entrega_det->cantidad;
            $tarima->cantidad = $entrega_det->unidad_medida == 'UN' ? 1 : ($entrega_det->cantidad * $trazabilidad->producto->cantidad_unidades);
            $tarima->sscc_unidad_distribucion = $request->get('sscc');
            $tarima->estado = 1;
            $tarima->unidad_medida = $request->get('unidad_medida');
            $tarima->lote = $trazabilidad->lote;
            $tarima->save();


            DB::commit();

        } catch (Exception $e) {
            report($e);
            DB::rollBack();


        }

        return $entrega_det;
    }


    public function getTotalUnidadesEntregadas($id_control)
    {
        $unidad_detalle = EntregaDet::select(\DB::raw('sum(cantidad) as cantidad'))
            ->where('unidad_medida', 'UN')
            ->where('id_control', $id_control)
            ->groupBy('id_control')
            ->first();
        return $unidad_detalle == null ? 0 : $unidad_detalle->cantidad;
    }

    public function getTotalCajasEntregadas($id_control)
    {

        $caja_detalle = EntregaDet::select(\DB::raw('sum(cantidad) as cantidad'))
            ->where('unidad_medida', 'CA')
            ->where('id_control', $id_control)
            ->groupBy('id_control')
            ->first();
        return $caja_detalle == null ? 0 : $caja_detalle->cantidad;
    }

    public function existeSSCCEntregado($sscc)
    {
        return EntregaDet::
        where('sscc', $sscc)
            ->exists();

    }

    public function getDetalleEntregaByTarima($tarima)
    {
        return EntregaDet:: where('no_tarima', $tarima)
            ->first();
    }
}
