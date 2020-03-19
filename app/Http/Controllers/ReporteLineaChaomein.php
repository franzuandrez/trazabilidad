<?php

namespace App\Http\Controllers;

use App\Http\tools\Reportes;
use App\Laminado_Det;
use App\Laminado_Enc;
use App\LineaChaomin;
use App\MezclaHarina_Det;
use App\MezclaHarina_Enc;
use App\PesoHumedoDet;
use App\PesoHumedoEnc;
use App\PesoSecoDet;
use App\PesoSecoEnc;
use App\PrecocidoDet;
use App\PrecocidoEnc;
use App\SecadoDet;
use App\SecadoEnc;
use App\VerificacionMateriaChaoDet;
use App\VerificacionMateriaChaoEnc;
use App\VerificacionMateriaDet;
use App\VerificacionMateriaEnc;
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


    public function reporte_verificacion_materias($id)
    {

        $reporte_encabezado = new Reportes();
        $mezcla_harina_enc = VerificacionMateriaEnc::where('verificacion_materias_enc.id_verificacion', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'verificacion_materias_enc.id_turno as TURNO',
                DB::raw("date_format(verificacion_materias_enc.fecha,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'verificacion_materias_enc.id_control')
            ->join('users', 'users.id', '=', 'verificacion_materias_enc.id_usuario')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('chaomin', 'chaomin.id_control', '=', 'control_trazabilidad.id_control')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'chaomin.id_presentacion')
            ->firstOrFail();


        $reporte_encabezado->setTitle('VERIFICACION DE MATERIA EN MEZCLADORA')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('VERIFICACION DE MATERIA EN MEZCLADORA')
            ->setExcept(['id_producto', 'lote', 'id_verificacion_det', 'id_verificacion_enc','fecha_hora']);


        $mezcla_harina_det = VerificacionMateriaDet::where('id_verificacion_enc', $id)
            ->select(
                'verificacion_materias_det.*',
                'users.nombre as id_usuario'
            )
            ->join('users', 'users.id', '=', 'verificacion_materias_det.id_usuario')
            ->get();



        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'MEZCLA HARINA' => $mezcla_harina_enc,

                    ],
                'details' => [
                    'DETALLE' => $mezcla_harina_det
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

    public function reporte_verificacion_materias_chao($id)
    {

        $reporte_encabezado = new Reportes();
        $mezcla_harina_enc = VerificacionMateriaChaoEnc::where('verificacion_materias_chao_enc.id_verificacion', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'verificacion_materias_chao_enc.id_turno as TURNO',
                DB::raw("date_format(verificacion_materias_chao_enc.fecha_hora,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'verificacion_materias_chao_enc.id_control')
            ->join('users', 'users.id', '=', 'verificacion_materias_chao_enc.id_usuario')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->firstOrFail();



        $reporte_encabezado->setTitle('VERIFICACION DE MATERIA PARA SOLUCION CHAO MEIN')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('VERIFICACION DE MATERIA PARA SOLUCION CHAO MEIN')
            ->setExcept(['id_producto', 'id_verificacion', 'id_verificacion_det','fecha','hora','producto']);


        $mezcla_harina_det = VerificacionMateriaChaoDet::where('id_verificacion', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'verificacion_materias_chao_det.*',
                'users.nombre as id_usuario'
            )
            ->join('users', 'users.id', '=', 'verificacion_materias_chao_det.id_usuario')
            ->join('productos', 'productos.id_producto', '=', 'verificacion_materias_chao_det.id_producto')
            ->get();



        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'MEZCLA HARINA' => $mezcla_harina_enc,

                    ],
                'details' => [
                    'DETALLE' => $mezcla_harina_det
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


    public function reporte_peso_humedo($id)
    {
        $reporte_encabezado = new Reportes();

        $peso_humedo = PesoHumedoEnc::where('id_peso_humedo', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'presentaciones.descripcion as PRESENTACION',
                'peso_humedo_enc.lote as LOTE',
                DB::raw("date_format(peso_humedo_enc.fecha_ingreso,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'peso_humedo_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('users', 'users.id', '=', 'peso_humedo_enc.id_usuario')
            ->join('chaomin', 'chaomin.id_control', '=', 'control_trazabilidad.id_control')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'chaomin.id_presentacion')
            ->firstOrFail();

        $reporte_encabezado->setTitle('CONTROL DE PESO HUMEDO DE PASTA PARA CHAO MEIN')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('CONTROL DE PESO HUMEDO DE PASTA PARA CHAO MEIN')
            ->setExcept(['producto', 'lote', 'id_peso_humedo_enc', 'id_peso_humedo_det']);

        $peso_humedo_det = PesoHumedoDet::where('id_peso_humedo_enc', $id)
            ->select('peso_humedo_det.*', 'users.nombre as id_usuario')
            ->join('users', 'users.id', '=', 'peso_humedo_det.id_usuario')
            ->get();
        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'PESO HUMEDO' => $peso_humedo,

                    ],
                'details' => [
                    'MUESTRA' => $peso_humedo_det
                ]
            ]
        );

        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.chaomein.peso_humedo',
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

    public function reporte_secado($id)
    {
        $reporte_encabezado = new Reportes();

        $peso_humedo = SecadoEnc::where('id_secado_enc', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'presentaciones.descripcion as PRESENTACION',
                'secado_enc.lote as LOTE',
                DB::raw("date_format(secado_enc.fecha_ingreso,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'secado_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('users', 'users.id', '=', 'secado_enc.id_usuario')
            ->join('chaomin', 'chaomin.id_control', '=', 'control_trazabilidad.id_control')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'chaomin.id_presentacion')
            ->firstOrFail();

        $reporte_encabezado->setTitle('CONTROL SECADO PARA CHAO MEIN')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('CONTROL SECADO  DE PASTA PARA CHAO MEIN')
            ->setExcept(['producto', 'lote', 'id_secado_enc', 'id_secado_det']);

        $peso_humedo_det = SecadoDet::where('id_secado_enc', $id)
            ->select('secado_det.*', 'users.nombre as id_usuario')
            ->join('users', 'users.id', '=', 'secado_det.id_usuario')
            ->get();
        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'SECADO' => $peso_humedo,

                    ],
                'details' => [
                    'MUESTRA' => $peso_humedo_det
                ]
            ]
        );

        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.chaomein.secado',
            [
                'reporte_encabezado' => $reporte_encabezado,
                'reporte_detalle' => $reporte_detalle
            ]
        )->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($reporte_encabezado->getTitle());
    }

    public function reporte_peso_seco($id)
    {

        $reporte_encabezado = new Reportes();
        $peso_seco = PesoSecoEnc::where('id_peso_seco', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'presentaciones.descripcion as PRESENTACION',
                'peso_seco_enc.lote as LOTE',
                DB::raw("date_format(peso_seco_enc.fecha_ingreso,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )
            ->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'peso_seco_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('users', 'users.id', '=', 'peso_seco_enc.id_usuario')
            ->join('chaomin', 'chaomin.id_control', '=', 'control_trazabilidad.id_control')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'chaomin.id_presentacion')
            ->firstOrFail();

        $reporte_encabezado->setTitle('CONTROL DE PESO SECO DE  CHAO MEIN')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('CONTROL DE PESO SECO DE  CHAO MEIN')
            ->setExcept(['producto', 'lote', 'id_peso_seco_enc', 'id_peso_seco_det']);

        $peso_seco_det = PesoSecoDet::where('id_peso_seco_enc', $id)
            ->select('peso_seco_det.*', 'users.nombre as id_usuario')
            ->join('users', 'users.id', '=', 'peso_seco_det.id_usuario')
            ->get();

        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'PESO SECO' => $peso_seco,

                    ],
                'details' => [
                    'MUESTRAS' => $peso_seco_det
                ]
            ]
        );

        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.chaomein.peso_seco',
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


    public function reporte_precocido($id)
    {
        $reporte_encabezado = new Reportes();
        $precocido = PrecocidoEnc::where('id_precocido_enc', $id)
            ->select(
                'productos.descripcion as PRODUCTO',
                'presentaciones.descripcion as PRESENTACION',
                'precocido_enc.lote as LOTE',
                DB::raw("date_format(precocido_enc.fecha_ingreso,'%d/%m/%Y %h:%i:%s') as FECHA"),
                'users.nombre as RESPONSABLE'
            )->join('control_trazabilidad', 'control_trazabilidad.id_control', '=', 'precocido_enc.id_control')
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('users', 'users.id', '=', 'precocido_enc.id_usuario')
            ->join('chaomin', 'chaomin.id_control', '=', 'control_trazabilidad.id_control')
            ->join('presentaciones', 'presentaciones.id_presentacion', '=', 'chaomin.id_presentacion')
            ->firstOrFail();

        $reporte_encabezado->setTitle('CONTROL DE PRECOCIDO  DE PASTA PARA CHAO MEIN')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('CONTROL DE PRECOCIDO DE PASTA PARA CHAO MEIN')
            ->setExcept(['id_producto', 'lote', 'id_precocido_det', 'id_precocido_enc', 'responsable']);


        $peso_humedo_det = PrecocidoDet::where('id_precocido_enc', $id)
            ->select('precocido_det.*', 'users.nombre as id_usuario')
            ->join('users', 'users.id', '=', 'precocido_det.id_usuario')
            ->get();
        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'PRECOCIDO' => $precocido,

                    ],
                'details' => [
                    'PRECOCEDORA' => $peso_humedo_det
                ]
            ]
        );


        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.chaomein.peso_humedo',
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
