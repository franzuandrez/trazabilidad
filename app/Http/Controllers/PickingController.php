<?php

namespace App\Http\Controllers;

use App\Http\tools\Existencias;
use App\Requisicion;
use App\ReservaPicking;
use Illuminate\Http\Request;
use function foo\func;

class PickingController extends Controller
{
    //
    protected $productos;
    public function __construct( Existencias $exitencias )
    {
        $this->productos = $exitencias;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'fecha_ingreso' : $request->get('field');

        $requisiciones_pendientes = Requisicion::enReserva()
        ->select('requisicion_encabezado.*')
            ->join('users', 'users.id', '=', 'requisicion_encabezado.id_usuario_ingreso')
            ->where(function ($query) use ($search) {
                $query->where('requisicion_encabezado.no_orden_produccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('requisicion_encabezado.no_requision', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.nombre', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(15);



        if($request->ajax()){

            return view('produccion.picking.index',
                compact('requisiciones_pendientes','search','sort','sortField'));
        }else{

            return view('produccion.picking.ajax',
                compact('requisiciones_pendientes','search','sort','sortField'));
        }


    }


    public function despachar($id){


        $requisicion = Requisicion::findOrFail($id);



        if($requisicion->reservas->isEmpty()){

            $productos = $requisicion->detalle->groupBy('id_producto');


            foreach ( $productos as $producto  ){


                $cantidadEntrante = $producto->sum('cantidad');

                $prod = $this->productos->existencia($producto[0]->producto->codigo_barras);


                $lotes = $prod->pluck('total','lote');

                $lotesDisponibles =$this->getLotesDisponibles($lotes,$producto[0]->id_producto);



                foreach ($lotesDisponibles as $lote=>$cantidad ){

                    $reserva = new ReservaPicking();
                    $reserva->id_producto = $producto[0]->id_producto;
                    $reserva->lote = $lote;
                    $reserva->id_requisicion = $requisicion->id;
                    $reserva->id_bodega = $prod->where('lote',$lote)->first()->id_bodega;

                    if($cantidadEntrante >= $cantidad ){
                        $reserva->cantidad = $cantidad;
                        $reserva->save();
                        $cantidadEntrante = $cantidadEntrante - $cantidad;
                    }else{

                        $reserva->cantidad = $cantidadEntrante;

                        if($cantidadEntrante != 0){
                            $reserva->save();
                        }
                        $cantidadEntrante = 0;
                    }


                }

            }

        }


        return view('produccion.picking.despacho',compact('requisicion'));


    }



    public function leer( $id_reserva ){


        try {
            $reserva = ReservaPicking::findOrFail($id_reserva);
            $reserva->leido = 'S';
            $reserva->fecha_lectura = \Carbon\Carbon::now();
            $reserva->update();

            $response = 1;
        } catch (\Exception $e) {

            $response = 0;
        }

        return $response;

    }

    private function getLotesDisponibles($lotes , $id_producto){

        $lotesDisponibles = [];

        foreach ( $lotes as $lote=>$cantidad ){

            $total_en_reserva = ReservaPicking::where('lote',$lote)
                ->where('id_producto',$id_producto)
                ->enReserva()
                ->sum('cantidad');

            if($cantidad-$total_en_reserva != 0){
                $lotesDisponibles[$lote]=$cantidad-$total_en_reserva;
            }


        }


        return $lotesDisponibles;
    }
}
