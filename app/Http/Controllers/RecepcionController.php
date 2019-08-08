<?php

namespace App\Http\Controllers;

use App\InspeccionVehiculo;
use App\Producto;
use App\Recepcion;
use Illuminate\Http\Request;
use DB;
class RecepcionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){



        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'orden_compra' : $request->get('field');



        $recepciones = Recepcion::join('proveedores','proveedores.id_proveedor','=','recepcion_encabezado.id_proveedor')
            ->join('productos','productos.id_producto','=','recepcion_encabezado.id_producto')
            ->where(function ( $query ) use ( $search ){
                $query->where('proveedores.razon_social','LIKE','%'.$search.'%')
                    ->orWhere('productos.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('recepcion_encabezado.orden_compra','LIKE','%'.$search.'%');

            })
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('recepcion.materia_prima.index',
                compact('recepciones','sort','sortField','search'));
        }else{

            return view('recepcion.materia_prima.ajax',
                compact('recepciones','sort','sortField','search'));
        }






    }

    public function create(){



        $productos = Producto::esMateriaPrima()->get();

        return view('recepcion.materia_prima.create',
            compact('productos'));


    }

    public function store( Request $request ){

        try {
            DB::beginTransaction();


            //Insertar recepcion encabezado.

            $recepcion = new Recepcion();
            $recepcion->id_producto = $request->get('id_producto');
            $recepcion->id_proveedor = $request->get('id_proveedor');
            $recepcion->fecha_ingreso = $request->get('fecha_ingreso');
            $recepcion->documento_proveedor = $request->get('documento_proveedor');
            $recepcion->orden_compra = $request->get('orden_compra');
            $recepcion->save();

            //Insertar inspeccion de vehiculos.

            $this->saveInspeccionVehiculo( $request , $recepcion->id_recepcion_enc );

            //Insertar inspeccion de empaque.




            //Insertar detalle de lote.



            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
        }


    }

    private function getValueCheched( $value  ){

        return $value != 1 ? 0 : 1;

    }

    private function saveInspeccionVehiculo( $request , $id_recepcion){

        $proveedor_aprobado = $this->getValueCheched($request->get('proveedor_aprobado'));
        $producto_acorde_compra = $this->getValueCheched($request->get('producto_acorde_compra'));
        $cantidad_acorde_compra= $this->getValueCheched($request->get('cantidad_acorde_compra'));
        $certificado_existente = $this->getValueCheched($request->get('certificado_existente'));
        $certificado_correspondiente_lote = $this->getValueCheched($request->get('certificado_correspondiente_lote'));
        $certificado_correspondiente_especificacion = $this->getValueCheched($request->get('certificado_correspondiente_especificacion'));
        $sin_polvo = $this->getValueCheched($request->get('sin_polvo'));
        $sin_material_ajeno = $this->getValueCheched($request->get('sin_material_ajeno'));
        $ausencia_plagas = $this->getValueCheched($request->get('ausencia_plagas'));
        $sin_humedad = $this->getValueCheched($request->get('sin_humedad'));
        $sin_oxido = $this->getValueCheched($request->get('sin_oxido'));
        $ausencia_olores_extranios = $this->getValueCheched($request->get('ausencia_olores_extranios'));
        $ausencia_material_extranio = $this->getValueCheched($request->get('ausencia_material_extranio'));
        $cerrado = $this->getValueCheched($request->get('cerrado'));
        $sin_agujeros = $this->getValueCheched($request->get('sin_agujeros'));
        $observaciones_vehiculo = $request->get('observaciones_vehiculo');

        $inspeccionVehiculo = new InspeccionVehiculo();
        $inspeccionVehiculo->id_recepcion_enc = $id_recepcion;
        $inspeccionVehiculo->proveedor_aprobado = $proveedor_aprobado;
        $inspeccionVehiculo->producto_acorde_compra = $producto_acorde_compra;
        $inspeccionVehiculo->cantidad_acorde_compra = $cantidad_acorde_compra;
        $inspeccionVehiculo->certificado_existente = $certificado_existente;
        $inspeccionVehiculo->certificado_correspondiente_lote = $certificado_correspondiente_lote;
        $inspeccionVehiculo->certificado_correspondiente_especificacion = $certificado_correspondiente_especificacion;
        $inspeccionVehiculo->sin_polvo = $sin_polvo;
        $inspeccionVehiculo->sin_material_ajeno = $sin_material_ajeno;
        $inspeccionVehiculo->ausencia_plagas = $ausencia_plagas;
        $inspeccionVehiculo->sin_humedad = $sin_humedad;
        $inspeccionVehiculo->sin_oxido = $sin_oxido;
        $inspeccionVehiculo->ausencia_olores_extranios = $ausencia_olores_extranios;
        $inspeccionVehiculo->ausencia_material_extranio = $ausencia_material_extranio;
        $inspeccionVehiculo->sin_agujeros = $sin_agujeros;
        $inspeccionVehiculo->cerrado = $cerrado;
        $inspeccionVehiculo->observaciones_vehiculo = $observaciones_vehiculo;
        $inspeccionVehiculo->save();




    }



}
