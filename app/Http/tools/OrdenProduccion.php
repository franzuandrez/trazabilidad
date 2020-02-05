<?php


namespace App\Http\tools;


use App\Correlativo;
use App\LineaChaomin;
use App\Requisicion;
use Carbon\Carbon;
use DB;

class OrdenProduccion
{


    public static function obtener_nueva_no_orden()
    {
        $no_orden_produccion = Correlativo::where('modulo', 'PRODUCCION')
            ->first();

        $posible_no_orden_produccion = $no_orden_produccion->prefijo . '-' . Carbon::now()->addDay()
                ->format('Ymd');

        $cantidad = Requisicion::where('no_orden_produccion', 'LIKE', '%' . $posible_no_orden_produccion . '%')->count();


        $no_orden_produccion = $no_orden_produccion->prefijo . '-' . Carbon::now()->addDay()
                ->format('Ymd');

        if ($cantidad > 0) {
            $no_orden_produccion = $no_orden_produccion . $cantidad;
        }

        return $no_orden_produccion;


    }


    public static function verificar_linea_chaomin($no_orden_produccion)
    {


        $controles = DB::table('control_trazabilidad_orden_produccion')
            ->where('no_orden_produccion', $no_orden_produccion)
            ->get();

        $linea_chamoin = LineaChaomin::with('control_trazabilidad.producto')
            ->without('control_trazabilidad.requisiciones')
            ->whereIn('id_control', $controles->pluck('id_control')->toArray())
            ->get();

        if (count($linea_chamoin) > 0) {
            $response = [
                'status' => 1,
                'message' => 'Linea chaomin iniciada',
                'data' => $linea_chamoin
            ];
        } else {
            $response = [
                'status' => 0,
                'message' => 'Linea no existente',
                'data' => ''
            ];
        }

        return $response;


    }


    public static function verificar_linea_chaomin_por_producto($no_orden_produccion, $id_producto)
    {
        $control = DB::table('control_trazabilidad_orden_produccion')
            ->where('no_orden_produccion', $no_orden_produccion)
            ->where('id_producto', $id_producto)
            ->first();

        $linea_chamoin = LineaChaomin::with('control_trazabilidad.producto')
            ->without('control_trazabilidad.requisiciones')
            ->where('id_control', $control->id_control)
            ->get();

        if ($linea_chamoin != null) {
            $response = [
                'status' => 1,
                'message' => 'Linea chaomin iniciada',
                'data' => $linea_chamoin
            ];

        } else {
            $response = [
                'status' => 0,
                'message' => 'Linea chaomin iniciada',
                'data' => $linea_chamoin
            ];
        }

        return $response;

    }
}
