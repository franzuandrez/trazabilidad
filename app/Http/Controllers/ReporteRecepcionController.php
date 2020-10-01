<?php

namespace App\Http\Controllers;

use App\Http\tools\Reportes;
use App\Recepcion;
use App\RMIDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReporteRecepcionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function reporte_recepcion($id, Request $request)
    {

        $reporte_encabezado = new Reportes();

        $recepcion = Recepcion::where('recepcion_encabezado.id_recepcion_enc', $id)
            ->join('proveedores', 'proveedores.id_proveedor', '=', 'recepcion_encabezado.id_proveedor')
            ->join('users', 'users.id', '=', 'recepcion_encabezado.usuario_recepcion')
            ->join('users as u', 'u.id', '=', 'recepcion_encabezado.id_usuario_calidad')
            ->select('proveedores.razon_social as id_proveedor',
                'recepcion_encabezado.orden_compra as DOCUMENTO',
                \DB::raw("date_format(fecha_ingreso,'%d/%m/%Y %H:%i:%s') as fecha_ingreso"),
                'recepcion_encabezado.id_recepcion_enc as id_recepcion_enc',
                'users.nombre as usuario_recepcion',
                'u.nombre as usuario_calidad'
            )->first();


        $reporte_encabezado
            ->setTitle("Recepcion de Bodega de Materia Prima y Material de empaque")
            ->setCreatedAt(CArbon::now())
            ->setFirmas([
                'Responsable de Ejecucion' => $recepcion->usuario_recepcion,
                'Encargado de Logistica' => $recepcion->usuario_calidad
            ])
            ->setSubtitle("Bodega de Materias primas")
            ->setExcept(
                ['id_inspeccion_documentos', 'id_inspeccion_empaque', 'id_recepcion_enc']
            );


        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'RECEPCION' => $recepcion,
                        'INSPECCION DE VEHICULOS' => $recepcion->inspeccion_vehiculos,
                        'INSPECCION EMPAQUE Y ETIQUETA' => $recepcion->inspeccion_empaque
                    ],
                'details' => [
                    'DETALLE LOTES' => $recepcion
                        ->detalle_lotes()
                        ->join('productos', 'productos.id_producto', '=', 'detalle_lotes.id_producto')
                        ->select('productos.descripcion as id_producto',
                            'detalle_lotes.cantidad as cantidad',
                            'detalle_lotes.no_lote',
                            \DB::raw("date_format(fecha_vencimiento,'%d/%m/%Y') as fecha_vencimiento"))
                        ->get()
                ]
            ]
        );
        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());


        $view = \View::make('reportes.recepcion.materia_prima',
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


    public function reporte_calidad($id, Request $request)
    {


        $recepcion = Recepcion::where('recepcion_encabezado.id_recepcion_enc', $id)
            ->join('proveedores', 'proveedores.id_proveedor', '=', 'recepcion_encabezado.id_proveedor')
            ->join('rmi_encabezado', 'rmi_encabezado.documento', '=', 'recepcion_encabezado.orden_compra')
            ->join('users', 'users.id', '=', 'recepcion_encabezado.usuario_recepcion')
            ->select('proveedores.razon_social as id_proveedor',
                'recepcion_encabezado.orden_compra as DOCUMENTO',
                \DB::raw("date_format(recepcion_encabezado.fecha_ingreso,'%d/%m/%Y %H:%i:%s') as fecha_ingreso"),
                'recepcion_encabezado.id_recepcion_enc as id_recepcion_enc',
                'users.nombre as usuario_recepcion',
                'rmi_encabezado.observaciones as OBSERVACIONES',
                'rmi_encabezado.id_rmi_encabezado as id_rmi_encabezado'
            )->first();

        $reporte_encabezado = new Reportes();

        $reporte_encabezado
            ->setTitle("Control de calidad")
            ->setCreatedAt(CArbon::now())
            ->setSubtitle("Bodega de Materias primas")
            ->setExcept(
                ['id_inspeccion_documentos', 'id_inspeccion_empaque', 'id_recepcion_enc', 'orden_compra', 'id_rmi_encabezado']
            );

        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'RECEPCION' => $recepcion

                        ,
                    ],
                'details' => [
                    'DETALLE' => RMIDetalle::where('id_rmi_encabezado', $recepcion->id_rmi_encabezado)
                        ->join('productos', 'productos.id_producto', '=', 'rmi_detalle.id_producto')
                        ->select(
                            'productos.descripcion as id_producto',
                            'lote',
                            'rmi_detalle.fecha_vencimiento as fecha_vencimiento',
                            'cantidad_entrante',
                            'cantidad',
                            \DB::raw('if(rampa=1,0.00,(cantidad - cantidad_entrante)) as RECHAZADO')
                        )
                        ->get()

                ]
            ]
        );


        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());
        $view = \View::make('reportes.recepcion.calidad',
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
