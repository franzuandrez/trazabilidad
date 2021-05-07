<?php

namespace App\Http\Controllers;

use App\EntregaDet;
use App\Http\tools\GeneradorCodigos;
use App\Operacion;
use App\Tarima;
use Illuminate\Http\Request;

class TarimaController extends Controller
{
    //


    public function __construct()
    {

        $this->middleware('auth');
    }


    public function show(Request $request)
    {

        $tarima = GeneradorCodigos::searchSSCCPallet($request->get('no_tarima'));

        if ($tarima == null) {

            return response([
                'success' => false,
                'data' => 'No encontrado'
            ]);

        }


        if ($tarima->is_active === 0) {
            return response([
                'success' => false,
                'data' => 'tarima dada de baja'
            ]);
        }

        $pallet = Tarima::where('no_tarima', $request->get('no_tarima'))
            ->select('tarimas.*',
                'productos.descripcion as producto',
                \DB::raw('sum(cantidad_sscc_unidad_distribucion)as total_cajas_tarima'),
                \DB::raw('sum(cantidad_sscc_unidad_distribucion*cantidad)as total_unidad_tarima')
            )->join('productos', 'productos.id_producto', '=', 'tarimas.id_producto')
            ->groupBy('no_tarima')
            ->where('tarimas.estado', '>', 0)
            ->first();

        if (is_null($pallet)) {
            return response([
                'success' => false,
                'data' => 'tarima no encontrada'
            ]);


        }


        if ($pallet->reservado == 1) {
            return response([
                'success' => false,
                'data' => 'tarima tomada'
            ]);
        }


        return response([
            'success' => true,
            'data' => $pallet
        ]);


    }


    public function reservar_tarima(Request $request)
    {


        Tarima::where('no_tarima', $request->no_tarima)
            ->update([
                'reservado' => 1
            ]);

        Tarima::where('sscc_unidad_distribucion', $request->no_tarima)
            ->update([
                'reservado' => 1
            ]);

        return response([
            'success' => true,
            'data' => 'reservada'
        ]);
    }

    public function unidad_distribucion(Request $request)
    {
        $caja = GeneradorCodigos::searchSSCCCaja($request->get('sscc'));
        if ($caja == null) {
            return response([
                'success' => false,
                'data' => 'Unidad de distribucion no existente'
            ]);
        }
        if ($caja->is_active === 0) {
            return response([
                'success' => false,
                'data' => 'Unidad de distribucion dada de baja'
            ]);
        }


        $unidad_distribucion = Tarima::where(
            'sscc_unidad_distribucion',
            $request->get('sscc')
        )
            ->where('id_producto', $request->get('id_producto'))
            ->where('lote', $request->get('lote'))
            ->where('estado', '>', 0)
            ->first();

        if (is_null($unidad_distribucion)) {
            return response([
                'success' => false,
                'message' => 'Producto incorrecto'
            ], 200);;
        }

        if ($unidad_distribucion->reservado == 1) {
            return response([
                'success' => false,
                'data' => 'caja tomada'
            ]);
        }
        return response([
            'success' => true,
            'data' => $unidad_distribucion
        ]);

    }
}
