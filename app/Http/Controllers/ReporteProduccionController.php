<?php

namespace App\Http\Controllers;

use App\Http\tools\Reportes;
use App\Requisicion;
use App\RequisicionDetalle;
use App\ReservaPicking;
use Carbon\Carbon;
use DB;

class ReporteProduccionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function reporte_requisicion($id)
    {

        $requisicion = Requisicion::where('requisicion_encabezado.id', $id)
            ->join('users', 'users.id', '=', 'requisicion_encabezado.id_usuario_ingreso')
            ->select(
                'no_requision as REQUISICION',
                'no_orden_produccion AS ORDEN PRODUCCION',
                'users.nombre  AS ELABORADOR',
                DB::raw("date_format(fecha_ingreso,'%d/%m/%Y %H:%i:%s') as FECHA"),
                DB::raw('
                if(requisicion_encabezado.estado="P","PROCESO",
                if(requisicion_encabezado.estado="R","PENDIENTE",
                if(requisicion_encabezado.estado="D","ARMADA",""))) AS ESTADO')
            )
            ->first();

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
