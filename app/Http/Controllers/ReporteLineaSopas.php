<?php

namespace App\Http\Controllers;

use App\FrituraSopasDet;
use App\FrituraSopasEnc;
use App\Http\tools\Reportes;
use App\LaminadoSopasDet;
use App\LaminadoSopasEnc;
use App\MezclaSopaDet;
use App\MezclaSopaEnc;
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
            ->setExcept(['fecha_hora', 'lote', 'id_mezclado_sopas_det', 'id_mezclado_sopas_enc', 'id_usuario']);

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


    public function reporte_laminado($id)
    {
        $reporte_encabezado = new Reportes();

        $laminado = LaminadoSopasEnc::where('id_laminado_sopas_enc', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'presentaciones.descripcion as PRESENTACION',
                'laminado_sopas_enc.lote as LOTE',
                DB::raw("date_format(laminado_sopas_enc.fecha_hora,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'laminado_sopas_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('users', 'users.id', '=', 'laminado_sopas_enc.id_usuario')
            ->join('sopas', 'sopas.id_control', '=', 'control_trazabilidad.id_control')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'sopas.id_presentacion')
            ->firstOrFail();

        $reporte_encabezado->setTitle('REGISTRO DE PARAMETROS EN LAMINADO Y PRECOCCION DE SOPAS INSTANTANEAS')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('REGISTRO DE PARAMETROS EN LAMINADO Y PRECOCCION DE SOPAS INSTANTANEAS')
            ->setExcept(['fecha_hora', 'lote', 'id_laminado_sopas_enc', 'id_laminado_sopas_det', 'id_usuario']);

        $laminado_sopas_det = LaminadoSopasDet::where('id_laminado_sopas_enc', $id)
            ->select('laminado_sopas_det.*', 'users.nombre as USUARIO')
            ->join('users', 'users.id', '=', 'laminado_sopas_det.id_usuario')
            ->get();

        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'LAMINADO' => $laminado,

                    ],
                'details' => [
                    'DETALLE' => $laminado_sopas_det
                ]
            ]
        );

        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.sopas.laminado',
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


    public function reporte_fritura($id)
    {

        $reporte_encabezado = new Reportes();

        $fritura = FrituraSopasEnc::where('id_frutura_sopas_enc', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'presentaciones.descripcion as PRESENTACION',
                'fritura_sopas_enc.lote as LOTE',
                DB::raw("date_format(fritura_sopas_enc.fecha_hora,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'fritura_sopas_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('users', 'users.id', '=', 'fritura_sopas_enc.id_usuario')
            ->join('sopas', 'sopas.id_control', '=', 'control_trazabilidad.id_control')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'sopas.id_presentacion')
            ->firstOrFail();

        $reporte_encabezado->setTitle('REGISTRO DE PARAMETROS EN FRITURA  DE SOPAS INSTANTANEAS')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('REGISTRO DE PARAMETROS EN FRITURA  DE SOPAS INSTANTANEAS')
            ->setExcept(['fecha_hora', 'lote', 'id_fritura_sopas_enc', 'id_fritura_sopas_det', 'id_usuario']);

        $fritura_detalle = FrituraSopasDet::where('id_fritura_sopas_enc', $id)
            ->select('fritura_sopas_det.*', 'users.nombre as USUARIO')
            ->join('users', 'users.id', '=', 'fritura_sopas_det.id_usuario')
            ->get();


        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'FRITURA' => $fritura,

                    ],
                'details' => [
                    'DETALLE' => $fritura_detalle
                ]
            ]
        );

        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.sopas.fritura',
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
