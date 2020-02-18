<?php

namespace App\Http\Controllers;

use App\Http\tools\Reportes;
use App\Laminado_Det;
use App\Laminado_Enc;
use App\LineaChaomin;
use App\MezclaHarina_Det;
use App\MezclaHarina_Enc;
use Carbon\Carbon;
use DB;

class ReporteLineaChaomein extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');

    }

    public function reporte_linea_chaomein($id)
    {

        $linea_encabezado = LineaChaomin::where('chaomin.id_chaomin', $id)
            ->without('presentacion')
            ->without('control_trazabilidad')
            ->select(
                'productos.descripcion as PRODUCTO',
                'chaomin.verificacion_codificacion_lote as LOTE',
                'presentaciones.descripcion as PRESENTACION',
                'users.nombre as RESPONSABLE',
                'chaomin.id_turno as TURNO'
            )
            ->join('productos', 'productos.id_producto', '=', 'chaomin.id_producto')
            ->join('users', 'users.id', '=', 'chaomin.responsable')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'chaomin.id_presentacion')
            ->first();

        $linea_detalle = LineaChaomin::where('chaomin.id_chaomin', $id)->first();

        $reporte_encabezado = new Reportes();
        $reporte_encabezado->setTitle("liberacion para linea chaomein")
            ->setCreatedAt(Carbon::now())
            ->setExcept([
                'id_chaomin',
                'id_producto',
                'responsable',
                'id_control',
                'id_presentacion',
                'no_orden_produccion',
                'id_turno',
                'estado',
                'fecha'
            ])
            ->setSubtitle("liberacion para linea chaomein");

        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'ENCABEZADO' => $linea_encabezado,
                        'DETALLE' => $linea_detalle,

                    ],
                'details' => [

                ]
            ]
        );

        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());

        $view = \View::make('reportes.chaomein.linea_chaomein',
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


    public function reporte_mezcla_harina($id)
    {


        $reporte_encabezado = new Reportes();
        $mezcla_harina_enc = MezclaHarina_Enc::where('enc_mezclaharina.id_Enc_mezclaharina', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'presentaciones.descripcion as PRESENTACION',
                'enc_mezclaharina.lote as LOTE',
                DB::raw("date_format(enc_mezclaharina.fecha_hora,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'enc_mezclaharina.id_control')
            ->join('users', 'users.id', '=', 'enc_mezclaharina.id_usuario')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('chaomin', 'chaomin.id_control', '=', 'control_trazabilidad.id_control')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'chaomin.id_presentacion')
            ->firstOrFail();

        $reporte_encabezado->setTitle('CONTROL DE MEZCLA DE HARINA Y SOLUCION DE CHAO MEIN')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('CONTROL DE MEZCLA DE HARINA Y SOLUCION DE CHAO MEIN')
            ->setExcept(['id_producto', 'lote', 'id_det_mezclaharina', 'id_Enc_mezclaharina']);


        $mezcla_harina_det = MezclaHarina_Det::where('id_Enc_mezclaharina', $id)
            ->select('det_mezclaharina.*', 'users.nombre as id_usuario')
            ->join('users', 'users.id', '=', 'det_mezclaharina.id_usuario')
            ->get();


        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'MEZCLA HARINA' => $mezcla_harina_enc,

                    ],
                'details' => [
                    'LAMINADORA CONTINUA' => $mezcla_harina_det
                ]
            ]
        );

        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.chaomein.mezcla_harina',
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

        $laminado_enc = Laminado_Enc::where('id_enc_laminado', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'presentaciones.descripcion as PRESENTACION',
                'laminado_enc.lote as LOTE',
                DB::raw("date_format(laminado_enc.fecha_ingreso,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'laminado_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('users', 'users.id', '=', 'laminado_enc.id_usuario')
            ->join('chaomin', 'chaomin.id_control', '=', 'control_trazabilidad.id_control')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'chaomin.id_presentacion')
            ->firstOrFail();

        $reporte_encabezado->setTitle('CONTROL DE LAMINADO DE CHAO MEIN')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('CONTROL DE LAMINADO DE CHAO MEIN')
            ->setExcept(['id_producto', 'lote_producto', 'id_enc_laminado', 'id_det_laminado']);

        $laminado_det = Laminado_Det::where('id_enc_laminado', $id)
            ->select('laminado_det.*', 'users.nombre as id_usuario')
            ->join('users', 'users.id', '=', 'laminado_det.id_usuario')
            ->get();

        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'LAMINADO' => $laminado_enc,

                    ],
                'details' => [
                    'LAMINADO' => $laminado_det
                ]
            ]
        );

        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.chaomein.mezcla_harina',
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
