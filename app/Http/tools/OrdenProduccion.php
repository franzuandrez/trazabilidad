<?php


namespace App\Http\tools;


use App\Correlativo;
use App\Requisicion;
use Carbon\Carbon;

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
}
