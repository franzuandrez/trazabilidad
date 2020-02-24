<?php

namespace App\Http\Controllers;

use App\Http\tools\Reportes;
use App\MezclaSopaDet;
use App\MezclaSopaEnc;
use App\PesoHumedoDet;
use Carbon\Carbon;
use DB;

class ReporteLineaSopas extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function reporte_mezclado_sopas($id)
    {
        $reporte_encabezado = new Reportes();

        $mezclado_sopas = MezclaSopaEnc::where('id_mezclado', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'presentaciones.descripcion as PRESENTACION',
                'mezclado_sopas_enc.lote as LOTE',
                DB::raw("date_format(mezclado_sopas_enc.fecha_hora,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'mezclado_sopas_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('users', 'users.id', '=', 'mezclado_sopas_enc.id_usuario')
            ->join('sopas', 'sopas.id_control', '=', 'control_trazabilidad.id_control')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'sopas.id_presentacion')
            ->firstOrFail();

        $reporte_encabezado->setTitle('CONTROL MEZCLADO DE SOPAS INSTANTANEAS')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('CONTROL MEZCLADO DE SOPAS INSTANTANEAS')
            ->setExcept(['fecha_hora', 'lote', 'id_mezclado_sopas_det', 'id_mezclado_sopas_enc','id_usuario']);

        $mezclado_sopas_det = MezclaSopaDet::where('id_mezclado_sopas_enc', $id)
            ->select('mezclado_sopas_det.*', 'users.nombre as USUARIO')
            ->join('users', 'users.id', '=', 'mezclado_sopas_det.id_usuario')
            ->get();

        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'MEZLCADO' => $mezclado_sopas,

                    ],
                'details' => [
                    'LAMINADORA CONTINUA' => $mezclado_sopas_det
                ]
            ]
        );
        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.sopas.mezclado_sopas',
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
