<?php

namespace App\Http\Controllers;

use App\Http\tools\Reportes;
use App\LineaChaomin;
use Carbon\Carbon;

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

}
