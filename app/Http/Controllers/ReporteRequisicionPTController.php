<?php

namespace App\Http\Controllers;

use App\Http\tools\Reportes;
use App\Requisicion;
use App\RequisicionDetalle;
use App\ReservaPicking;
use Carbon\Carbon;
use DB;

class ReporteRequisicionPTController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function reporte_requisicion_documento($documento)
    {
        $id = Requisicion::whereNoOrdenProduccion($documento)->first()->id;

        return $this->reporte_requisicion($id);
    }

    public function reporte_requisicion($id)
    {

        $requisicion = Requisicion::where('requisicion_encabezado.id', $id)
            ->join('users', 'users.id', '=', 'requisicion_encabezado.id_usuario_ingreso')
            ->join('detalle_requisicion_pt', 'detalle_requisicion_pt.id_requisicion', '=', 'requisicion_encabezado.id')
            ->select(
                'no_requision as FACTURA',
                'users.nombre  AS ELABORADOR',
                'detalle_requisicion_pt.cliente_ref_1 AS CLIENTE',
                'detalle_requisicion_pt.direccion  AS DIRECCION',
                DB::raw("date_format(fecha_ingreso,'%d/%m/%Y %H:%i:%s') as FECHA")

            )
            ->first();

        if ($requisicion == null) {
            return redirect()
                ->back()
                ->withErrors(['Reporte no disponible']);
        }

        $detalle_requisicion = ReservaPicking::where('id_requisicion', $id)
            ->join('productos', 'productos.id_producto', '=', 'reserva_lotes.id_producto')
            ->join('users', 'users.id', '=', 'reserva_lotes.id_usuario_picking')
            ->select(
                'productos.codigo_interno as id_producto',
                'reserva_lotes.cantidad as cantidad',
                'reserva_lotes.lote as lote',
                'reserva_lotes.fecha_vencimiento',
                DB::raw("date_format(reserva_lotes.fecha_vencimiento,'%d/%m/%Y') as fecha_vencimiento"),
                'reserva_lotes.ubicacion'
            )->get();

        if ($detalle_requisicion->isEmpty()) {
            $detalle_requisicion = RequisicionDetalle::where('id_requisicion_encabezado', $id)
                ->join('productos', 'productos.id_producto', '=', 'requisicion_detalle.id_producto')
                ->select(
                    'productos.codigo_interno as id_producto',
                    'requisicion_detalle.cantidad as cantidad'
                )->get();
        }


        $reporte_encabezado = new Reportes();

        $reporte_encabezado
            ->setTitle("REQUISICION")
            ->setCreatedAt(CArbon::now())
            ->setExcept(['ubicacion'])
            ->setSubtitle("Manual de operaciones de produccion");
        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'REQUISICION' => $requisicion
                        ,
                    ],
                'details' => [
                    'DETALLE' => $detalle_requisicion

                ]
            ]
        );

        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.produccion.requisicion',
            [
                'reporte_encabezado' => $reporte_encabezado,
                'reporte_detalle' => $reporte_detalle
            ]
        )->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('A4', 'vertical');
        return $pdf->stream($reporte_encabezado->getTitle());
    }

}
