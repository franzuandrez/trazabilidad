<?php

namespace App\Http\Controllers;


use App\Http\tools\Reportes;
use App\Operacion;
use Carbon\Carbon;
use DB;
use Symfony\Component\HttpFoundation\Request;

class ReporteControlTrazabilidadController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function reporte_control_trazabilidad($id, Request $Request)
    {

        $control_trazabilidad = Operacion::where('id_control', $id)
            ->join('productos', 'productos.id_producto', '=', 'control_trazabilidad.id_producto')
            ->join('users', 'users.id', '=', 'control_trazabilidad.id_usuario')
            ->select(
                'control_trazabilidad.id_control',
                'control_trazabilidad.id_turno',
                'control_trazabilidad.lote',
                DB::raw(
                    "(select GROUP_CONCAT(no_orden_produccion)as no_orden_produccion 
                    from  control_trazabilidad_orden_produccion where id_control = control_trazabilidad.id_control )
                    as no_orden_produccion "
                ),
                'productos.descripcion as id_producto', 'users.nombre as id_usuario'
            )
            ->first();

        $reporte_encabezado = new Reportes();
        $reporte_encabezado
            ->setTitle('Control de Trazabilidad')
            ->setCreatedAt(Carbon::now())
            ->setSubtitle('Control de Trazabilidad')
            ->setExcept(['id', 'id_control', 'id_detalle_insumo']);


        $reporte_detalle = $reporte_encabezado->mapers(
            [
                'headers' =>
                    [
                        'PRODUCCION' => $control_trazabilidad,

                    ],
                'details' => [
                    'INSUMOS' => $control_trazabilidad
                        ->detalle_insumos()
                        ->select('productos.descripcion as id_producto',
                            'detalle_insumos.color',
                            'detalle_insumos.olor',
                            'detalle_insumos.impresion',
                            'detalle_insumos.ausencia_material_extranio',
                            'detalle_insumos.cantidad',
                            'detalle_insumos.lote',
                            DB::raw("date_format(detalle_insumos.fecha_vencimiento,'%d/%m/%Y') as fecha_vencimiento")

                        )
                        ->join('productos', 'productos.id_producto', '=', 'detalle_insumos.id_producto')
                        ->get()
                    ,
                    'OPERARIOS INVOLUCRADOS' => $control_trazabilidad
                        ->asistencias()
                        ->select(
                            DB::raw('concat(colaboradores.nombre,"  ",colaboradores.apellido) as id_colaborador'),
                            'actividades.descripcion as id_actividad',
                            DB::raw('date_format(actividades_colaboradores.fecha_hora_asociacion ,"%d/%m/%Y %H:%i:%s") as INICIO'),
                            DB::raw('date_format(actividades_colaboradores.fecha_hora_fin ,"%d/%m/%Y %H:%i:%s") as FIN')

                        )
                        ->join('colaboradores', 'colaboradores.id_colaborador', '=', 'actividades_colaboradores.id_colaborador')
                        ->join('actividades', 'actividades.id_actividad', '=', 'actividades_colaboradores.id_actividad')
                        ->get()
                ]
            ]
        );
        $reporte_encabezado->setHeader($reporte_detalle['headers']->first());

        $view = \View::make('reportes.produccion.control_trazabilidad',
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

}
