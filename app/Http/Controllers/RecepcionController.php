<?php

namespace App\Http\Controllers;

use App\DetalleLotes;
use App\Http\Requests\MateriaPrimaRequest;
use App\Impresion;
use App\InspeccionEmpaqueEtiqueta;
use App\InspeccionVehiculo;
use App\Producto;
use App\Proveedor;
use App\Recepcion;
use App\Movimiento;
use App\RMIDetalle;
use App\RMIEncabezado;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mockery\Instantiator;
use App\Http\Tools\Impresiones;

class RecepcionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {


        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'orden_compra' : $request->get('field');


        $recepciones = Recepcion::join('proveedores', 'proveedores.id_proveedor', '=', 'recepcion_encabezado.id_proveedor')
            ->select('recepcion_encabezado.*', 'proveedores.nombre_comercial as proveedor')
            ->where(function ($query) use ($search) {
                $query->where('proveedores.nombre_comercial', 'LIKE', '%' . $search . '%')
                    ->orWhere('recepcion_encabezado.orden_compra', 'LIKE', '%' . $search . '%');

            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('recepcion.materia_prima.index',
                compact('recepciones', 'sort', 'sortField', 'search'));
        } else {

            return view('recepcion.materia_prima.ajax',
                compact('recepciones', 'sort', 'sortField', 'search'));
        }


    }

    public function create()
    {


        $productos = Producto::esMateriaPrima()->get();
        $proveedores = Proveedor::all();

        return view('recepcion.materia_prima.create',
            compact('productos', 'proveedores'));


    }

    public function store(MateriaPrimaRequest $request)
    {


        try {
            DB::beginTransaction();

            //Insertar recepcion encabezado.

            $recepcion = new Recepcion();
            $recepcion->id_proveedor = $request->get('id_proveedor');
            $recepcion->fecha_ingreso = Carbon::now();
            $recepcion->documento_proveedor = $request->get('documento_proveedor');
            $recepcion->orden_compra = $request->get('orden_compra');
            $recepcion->usuario_recepcion = \Auth::user()->id;
            $recepcion->save();


            $this->saveInspeccionVehiculo($request, $recepcion->id_recepcion_enc);


            $this->saveInspeccionEmpaque($request, $recepcion->id_recepcion_enc);


            $this->saveDetalleLotes($request, $recepcion->id_recepcion_enc);

            $id_rmi_encabezado = $this->saveRMIEncabezado($recepcion->orden_compra, 'MP');

            $this->saveRMIDetalle($request,$id_rmi_encabezado,'RAMPA');

            DB::commit();

            return redirect()->route('recepcion.materia_prima.index')
                ->with('success', 'Materia prima ingresada corrrectamente');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('recepcion.materia_prima.index')
                ->withErrors(['Lo sentimos, su peticion no puede ser procesada en este momento ']);

        }


    }

    private function getValueCheched($value)
    {

        return $value != 1 ? 0 : 1;

    }

    private function saveInspeccionVehiculo($request, $id_recepcion)
    {

        $proveedor_aprobado = $this->getValueCheched($request->get('proveedor_aprobado'));
        $producto_acorde_compra = $this->getValueCheched($request->get('producto_acorde_compra'));
        $cantidad_acorde_compra = $this->getValueCheched($request->get('cantidad_acorde_compra'));
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
        $inspeccionVehiculo->observaciones = $observaciones_vehiculo;
        $inspeccionVehiculo->save();


    }

    private function saveInspeccionEmpaque($request, $id_recepcion)
    {


        $no_golpeado = $this->getValueCheched($request->get('no_golpeado'));
        $sin_roturas = $this->getValueCheched($request->get('sin_roturas'));
        $cerrado = $this->getValueCheched($request->get('empaque_cerrado'));
        $seco_limpio = $this->getValueCheched($request->get('seco_limpio'));
        $sin_material_extranio = $this->getValueCheched($request->get('sin_material_extranio'));
        $debidamente_identificado = $this->getValueCheched($request->get('debidamente_identificado'));
        $debidamente_legible = $this->getValueCheched($request->get('debidamente_legible'));
        $no_lote_presente = $this->getValueCheched($request->get('no_lote_presente'));
        $no_lote_legible = $this->getValueCheched($request->get('no_lote_legible '));
        $fecha_vencimiento_legible = $this->getValueCheched($request->get('fecha_vencimiento_legible'));
        $fecha_vencimiento_vigente = $this->getValueCheched($request->get('fecha_vencimiento_vigente'));
        $contenido_neto_declarado = $this->getValueCheched($request->get('contenido_neto_declarado'));
        $observaciones = $request->get('observaciones_empaque');

        $inspeccionEmpaque = new InspeccionEmpaqueEtiqueta();
        $inspeccionEmpaque->no_golpeado = $no_golpeado;
        $inspeccionEmpaque->sin_roturas = $sin_roturas;
        $inspeccionEmpaque->cerrado = $cerrado;
        $inspeccionEmpaque->seco_limpio = $seco_limpio;
        $inspeccionEmpaque->sin_material_extranio = $sin_material_extranio;
        $inspeccionEmpaque->debidamente_identificado = $debidamente_identificado;
        $inspeccionEmpaque->identificacion_legible = $debidamente_legible;
        $inspeccionEmpaque->no_lote_presente = $no_lote_presente;
        $inspeccionEmpaque->no_lote_legible = $no_lote_legible;
        $inspeccionEmpaque->fecha_vencimiento_legible = $fecha_vencimiento_legible;
        $inspeccionEmpaque->fecha_vencimiento_vigente = $fecha_vencimiento_vigente;
        $inspeccionEmpaque->contenido_neto_declarado = $contenido_neto_declarado;
        $inspeccionEmpaque->observaciones = $observaciones;
        $inspeccionEmpaque->id_recepcion_enc = $id_recepcion;
        $inspeccionEmpaque->save();


    }

    private function saveDetalleLotes($request, $id_recepcion)
    {


        $productos = $request->get('id_producto');

        if (is_iterable($productos)) {


            foreach ($productos as $key => $value) {

                $detalleLote = DetalleLotes::create([
                    'id_producto' => $value,
                    'cantidad' => $request->get('cantidad')[$key],
                    'no_lote' => $request->get('no_lote')[$key],
                    'fecha_vencimiento' => $request->get('fecha_vencimiento')[$key],
                    'id_recepcion_enc' => $id_recepcion
                ]);
            }
        }

    }

    private function saveMovimientos($request, $recepcion)
    {

        $productos = $request->get('id_producto');
        if (is_iterable($productos)) {

            foreach ($productos as $key => $value) {

                $movimiento = new Movimiento();
                $movimiento->numero_documento = $recepcion->orden_compra;
                $movimiento->usuario = Auth::user()->id;
                $movimiento->tipo_movimiento = 1; //Entrada
                $movimiento->cantidad = $request->get('cantidad')[$key];
                $movimiento->id_producto = $value;
                $movimiento->fecha_hora_movimiento = Carbon::now();
                $movimiento->ubicacion = 0;
                $movimiento->lote = $request->get('no_lote')[$key];;
                $movimiento->fecha_vencimiento = $request->get('fecha_vencimiento')[$key];
                $movimiento->clave_autorizacion = '1234';
                $movimiento->estado = 1;
                $movimiento->save();
            }
        }


    }

    private function saveRMIEncabezado($documento, $tipo_documento)
    {

        $rmi_encabezado = new RMIEncabezado();
        $rmi_encabezado->fecha_ingreso = \Carbon\Carbon::now();
        $rmi_encabezado->usuario_ingreso = Auth::user()->id;
        $rmi_encabezado->documento = $documento;
        $rmi_encabezado->tipo_documento = $tipo_documento;
        $rmi_encabezado->estado = 'R';
        $rmi_encabezado->save();

        return $rmi_encabezado->id_rmi_encabezado;

    }

    private function saveRMIDetalle($request, $id_rmi_encabezado,$ubicacion)
    {
        $productos = $request->get('id_producto');

        if (is_iterable($productos)) {

            $valueUbicacion = $this->getValueEstado($ubicacion);
            foreach ($productos as $key => $value) {

                $detalleLote = RMIDetalle::create([
                    'id_producto' => $value,
                    'cantidad' => $request->get('cantidad')[$key],
                    'lote' => $request->get('no_lote')[$key],
                    'fecha_vencimiento' => $request->get('fecha_vencimiento')[$key],
                    'id_rmi_encabezado' => $id_rmi_encabezado,
                    'rampa'=>$valueUbicacion[0],
                    'control'=>$valueUbicacion[1],
                    'mp'=>$valueUbicacion[2]
                ]);
            }

        }


    }

    private function getValueEstado( $ubicacion = 'RAMPA' ){


        if($ubicacion == 'RAMPA' ){
            return  [1,0,0];
        }else if($ubicacion =='CONTROL'){
            return  [0,1,0];
        }else if($ubicacion =='MP'){
            return [0,0,1];
        }

    }

    public function show($id)
    {

        try {
            $recepcion = Recepcion::findOrFail($id);


            return view('recepcion.materia_prima.show', compact('recepcion'));
        } catch (\Exception $e) {

            return redirect()->route('recepcion.materia_prima.index')
                ->withErrors(['errors' => ' Recepcion no encontrada ']);

        }


    }

    public function edit($id)
    {

        try {
            $recepcion = Recepcion::findOrFail($id);


            return view('recepcion.materia_prima.edit', compact('recepcion'));
        } catch (\Exception $e) {
            return redirect()->route('recepcion.materia_prima.index')
                ->withErrors(['errors' => ' Recepcion no encontrada ']);
        }


    }

    public function update(Request $request, $id)
    {


        try {

            DB::beginTransaction();
            $recepcion = Recepcion::findOrFail($id);

            if (is_iterable($request->get('id_producto'))) {
                $recepcion->estado = 'T';
            }
            $recepcion->update();
            $this->saveDetalleLotes($request, $recepcion->id_recepcion_enc);
            $this->saveRMIDetalle($request,$recepcion->rmi_encabezado->id_rmi_encabezado,'RAMPA');


            DB::commit();

            return redirect()->route('recepcion.materia_prima.index')
                ->with('success', 'Materia prima ingresada corrrectamente');

        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('recepcion.materia_prima.index')
                ->withErrors(['errors' => 'Lo sentimos, su peticion no puede ser procesada en este momento ']);

        }


    }


    public function transito(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'orden_compra' : $request->get('field');

        $movimientos_en_transito = Recepcion::join('movimientos', 'movimientos.numero_documento', '=', 'recepcion_encabezado.orden_compra')
            ->join('proveedores', 'proveedores.id_proveedor', '=', 'recepcion_encabezado.id_proveedor')
            ->join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
            ->select('recepcion_encabezado.*')
            ->transito()
            ->where(function ($query) use ($search) {
                $query->where('proveedores.nombre_comercial', 'LIKE', '%' . $search . '%')
                    ->orWhere('recepcion_encabezado.orden_compra', 'LIKE', '%' . $search . '%');
            })
            ->groupBy('recepcion_encabezado.orden_compra')
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {
            return view('recepcion.transito.index',
                compact('movimientos_en_transito', 'search', 'sort', 'sortField'));
        } else {
            return view('recepcion.transito.ajax',
                compact('movimientos_en_transito', 'search', 'sort', 'sortField'));
        }


    }


    public function ingreso_transito($id)
    {

        try {
            $recepcion = Recepcion::findOrFail($id);

            $movimientos = Movimiento::join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
                ->select('movimientos.*', DB::raw('sum(cantidad * factor) as total'))
                ->where('numero_documento', $recepcion->orden_compra)
                ->where('ubicacion', 0)
                ->orderBy('movimientos.id_movimiento', 'asc')
                ->groupBy('lote', 'id_producto')
                ->having(DB::raw('sum(cantidad * factor)'), '>', 0)
                ->get();


            return view('recepcion.transito.ingreso', compact('recepcion', 'movimientos'));
        } catch (\Exception $e) {


            return redirect()->route('recepcion.transito.index')
                ->withErrors(['Recepcion no encontrada']);
        }


    }

    public function ingresar(Request $request, $id)
    {


        $recepcion = Recepcion::findOrFail($id);


        $idsMovimiento = [];
        if (count($request->get('id_movimiento')) > 0) {
            $idsMovimiento = $request->get('id_movimiento');
        }
        $cantidadesEntrantes = $request->get('cantidad_entrante');
        $numero_documento = $recepcion->orden_compra;
        $isSaved = $this->guardarMovimientos(
            1,
            0,
            $idsMovimiento,
            $cantidadesEntrantes,
            $numero_documento);


        $noProductoRestante = $this->totalProductoPorBodega(0, $recepcion->orden_compra) == 0;

        if ($noProductoRestante) {
            $recepcion->estado = 'MP';
            $recepcion->update();
        }

        $impresiones = $request->get('imprimir');


        Impresiones::imprimir($idsMovimiento, '192.168.0.179', 'D', $impresiones);

        if ($isSaved) {

            return redirect()->route('recepcion.transito.index')
                ->with('success', 'Productos ingresados correctamente');
        } else {

            return redirect()->route('recepcion.transito.index')
                ->withErrors(['No ha sido posible ingresar el producto']);
        }

    }

    private function guardarMovimientos($bodega_destino,
                                        $bodega_origen,
                                        $ids = [],
                                        $cantidades = [],
                                        $numero_documento)
    {


        try {
            DB::beginTransaction();


            $movimientos = Movimiento::whereIn('id_movimiento', $ids)
                ->orderBy('id_movimiento', 'asc')
                ->get();


            foreach ($movimientos as $key => $mov) {


                $cantidad = $cantidades[$key];
                $lote = $mov->lote;
                $fecha_vencimiento = $mov->fecha_vencimiento;
                $movimiento = new Movimiento();
                $movimiento->numero_documento = $numero_documento;
                $movimiento->usuario = \Auth::user()->id;
                $movimiento->tipo_movimiento = 2;
                $movimiento->cantidad = $cantidad;
                $movimiento->id_producto = $mov->id_producto;
                $movimiento->fecha_hora_movimiento = Carbon::now();
                $movimiento->ubicacion = $bodega_origen; //ORIGEN
                $movimiento->lote = $lote;
                $movimiento->fecha_vencimiento = $fecha_vencimiento;
                $movimiento->clave_autorizacion = $mov->clave_autorizacion;
                $movimiento->estado = 2;
                $movimiento->save();


                $movimiento = new Movimiento();
                $movimiento->numero_documento = $numero_documento;
                $movimiento->usuario = \Auth::user()->id;
                $movimiento->tipo_movimiento = 1;
                $movimiento->cantidad = $cantidad;
                $movimiento->id_producto = $mov->id_producto;
                $movimiento->fecha_hora_movimiento = Carbon::now();
                $movimiento->ubicacion = $bodega_destino; //DESTINO
                $movimiento->lote = $lote;
                $movimiento->fecha_vencimiento = $fecha_vencimiento;
                $movimiento->clave_autorizacion = $mov->clave_autorizacion;
                $movimiento->estado = 1;
                $movimiento->save();


            }
            DB::commit();

            return true;

        } catch (\Exception $e) {

            DB::rollback();

            return false;
        }


    }

    private function totalProductoPorBodega($id_bodega, $orden)
    {

        $movimientos = Movimiento::join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
            ->select((DB::raw('sum(factor * cantidad) as total')))
            ->where('numero_documento', $orden)
            ->where('ubicacion', $id_bodega)
            ->groupBy('id_producto')
            ->groupBy('lote')
            ->get();


        $movimientos = $movimientos->where('total', '>', 0)->count();
        return $movimientos;

    }

    public function show_transito($id)
    {
        try {
            $recepcion = Recepcion::findOrFail($id);

            $movimientos = Movimiento::join('tipo_movimiento', 'tipo_movimiento.id_movimiento', '=', 'movimientos.tipo_movimiento')
                ->select('movimientos.*', DB::raw('sum(cantidad * factor) as total'))
                ->where('numero_documento', $recepcion->orden_compra)
                ->where('ubicacion', 0)
                ->orderBy('movimientos.id_movimiento', 'asc')
                ->groupBy('lote', 'id_producto')
                ->having(DB::raw('sum(cantidad * factor)'), '>', 0)
                ->get();

            return view('recepcion.transito.show', compact('recepcion', 'movimientos'));
        } catch (\Exception $e) {


            return redirect()->route('recepcion.transito.index')
                ->withErrors(['Recepcion no encontrada']);
        }

    }
}
