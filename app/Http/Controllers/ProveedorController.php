<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use DB;
use App\Proveedor;
use App\ReferenciasComerciales;
use Maatwebsite\Excel\Facades\Excel;

class ProveedorController extends Controller
{
    //

    public function index(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'razon_social' : $request->get('field');

        $proveedores = Proveedor::select('id_proveedor', 'razon_social', 'nombre_comercial', 'nit', 'direccion_planta', 'estado')
            ->actived()
            ->where(function ($query) use ($search) {
                $query->where('razon_social', 'LIKE', '%' . $search . '%')
                    ->orwhere('nombre_comercial', 'LIKE', '%' . $search . '%')
                    ->orwhere('direccion_planta', 'LIKE', '%' . $search . '%')
                    ->orwhere('nit', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {

            return view('registro.proveedores.index',
                compact('search', 'sort', 'sortField', 'proveedores'));

        } else {
            return view('registro.proveedores.ajax',
                compact('search', 'sort', 'sortField', 'proveedores'));

        }


    }

    public function create()
    {

        return view('registro.proveedores.create');
    }

    public function store(Request $request)
    {

        try {

            DB::beginTransaction();

            $programa_bpm_implementado = $this->getValueChecked($request->get('programa_bpm_implementado'));
            $otros_programas = $this->getValueChecked($request->get('otros_programas'));
            $sistema_haccp = $this->getValueChecked($request->get('sistema_haccp'));
            $programa_capacitacion = $this->getValueChecked($request->get('programa_capacitacion'));
            $sistema_trazabilidad = $this->getValueChecked($request->get('sistema_trazabilidad'));
            $sistema_calidad_auditado_intermamente = $this->getValueChecked($request->get('sistema_calidad_auditado_intermamente'));
            $sistema_calidad_auditado_por_terceros = $this->getValueChecked($request->get('sistema_calidad_auditado_por_terceros'));
            $certificaciones = $this->getValueChecked($request->get('certificaciones'));


            $proveedor = new Proveedor();
            $proveedor->razon_social = $request->get('razon_social');
            $proveedor->nombre_comercial = $request->get('nombre_comercial');
            $proveedor->nit = $request->get('nit');
            $proveedor->direccion_fiscal = $request->get('direccion_fiscal');
            $proveedor->direccion_planta = $request->get('direccion_planta');
            $proveedor->nombre_contacto = $request->get('nombre_contacto');
            $proveedor->puesto_contacto = $request->get('puesto_contacto');
            $proveedor->telefono_contacto = $request->get('telefono_contacto');
            $proveedor->email = $request->get('email');
            $proveedor->regimen_tributario = $request->get('regimen_tributario');
            $proveedor->patente_comercio = $request->get('patente_comercio');
            $proveedor->patente_sociedad = $request->get('patente_sociedad');
            $proveedor->dias_credito = $request->get('dias_credito');
            $proveedor->monto_credito = $request->get('monto_credito');
            $proveedor->programa_bpm_implementado = $programa_bpm_implementado;
            $proveedor->otros_programas = $otros_programas;
            $proveedor->sistema_haccp = $sistema_haccp;
            $proveedor->programa_capacitacion = $programa_capacitacion;
            $proveedor->sistema_trazabilidad = $sistema_trazabilidad;
            $proveedor->sistema_calidad_auditado_intermamente = $sistema_calidad_auditado_intermamente;
            $proveedor->sistema_calidad_auditado_por_terceros = $sistema_calidad_auditado_por_terceros;
            $proveedor->certificaciones = $certificaciones;
            $proveedor->observaciones = $request->get('observaciones');
            $proveedor->save();


            $id_proveedor = $proveedor->id_proveedor;



            $this->guardarReferenciasComerciales($proveedor,$request);



            $this->gurdarProductos( $proveedor, $request->get('productos') );

            DB::commit();

            return redirect()
                ->route('proveedores.index')
                ->with('success', 'Proveedor creado correctamente');


        } catch (\Exception $ex) {


            DB::rollback();

            dd($ex);
            return redirect()
                ->route('proveedores.index')
                ->withErrors(['error'=>'Lo sentimos, su petición no fue procesada']);

        }


    }

    public function edit($id)
    {

        try {

            $proveedor = Proveedor::findOrFail($id);


            return view('registro.proveedores.edit', compact('proveedor'));


        } catch (\Exception $ex) {

            dd($ex);
            return redirect()->route('proveedores.index')
                ->with('error', 'Proveedor no encontrado');
        }


    }


    public function update(Request $request, $id)
    {

        try {


            $programa_bpm_implementado = $this->getValueChecked($request->get('programa_bpm_implementado'));
            $otros_programas = $this->getValueChecked($request->get('otros_programas'));
            $sistema_haccp = $this->getValueChecked($request->get('sistema_haccp'));
            $programa_capacitacion = $this->getValueChecked($request->get('programa_capacitacion'));
            $sistema_trazabilidad = $this->getValueChecked($request->get('sistema_trazabilidad'));
            $sistema_calidad_auditado_intermamente = $this->getValueChecked($request->get('sistema_calidad_auditado_intermamente'));
            $sistema_calidad_auditado_por_terceros = $this->getValueChecked($request->get('sistema_calidad_auditado_por_terceros'));
            $certificaciones = $this->getValueChecked($request->get('certificaciones'));

            DB::beginTransaction();

            $proveedor = Proveedor::findOrFail($id);
            $proveedor->razon_social = $request->get('razon_social');
            $proveedor->nombre_comercial = $request->get('nombre_comercial');
            $proveedor->nit = $request->get('nit');
            $proveedor->direccion_fiscal = $request->get('direccion_fiscal');
            $proveedor->direccion_planta = $request->get('direccion_planta');
            $proveedor->nombre_contacto = $request->get('nombre_contacto');
            $proveedor->puesto_contacto = $request->get('puesto_contacto');
            $proveedor->telefono_contacto = $request->get('telefono_contacto');
            $proveedor->email = $request->get('email');
            $proveedor->regimen_tributario = $request->get('regimen_tributario');
            $proveedor->patente_comercio = $request->get('patente_comercio');
            $proveedor->patente_sociedad = $request->get('patente_sociedad');
            $proveedor->dias_credito = $request->get('dias_credito');
            $proveedor->monto_credito = $request->get('monto_credito');
            $proveedor->programa_bpm_implementado = $programa_bpm_implementado;
            $proveedor->otros_programas = $otros_programas;
            $proveedor->sistema_haccp = $sistema_haccp;
            $proveedor->programa_capacitacion = $programa_capacitacion;
            $proveedor->sistema_trazabilidad = $sistema_trazabilidad;
            $proveedor->sistema_calidad_auditado_intermamente = $sistema_calidad_auditado_intermamente;
            $proveedor->sistema_calidad_auditado_por_terceros = $sistema_calidad_auditado_por_terceros;
            $proveedor->certificaciones = $certificaciones;
            $proveedor->observaciones = $request->get('observaciones');
            $proveedor->update();

            $this->borrarReferenciasComerciales($proveedor);
            //Insertar nuevas rerecenias comerciales.
            $this->guardarReferenciasComerciales($proveedor, $request);

            $this->gurdarProductos($proveedor,$request->get('productos'));

            DB::commit();

            return redirect()->route('proveedores.index')
                ->with('success', 'Proveedor Actualizado correctamente');

        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->route('proveedores.index')
                ->with('error', 'En este momento no es posible procesar su petición');

        }


    }

    private function borrarReferenciasComerciales($proveedor)
    {
        $proveedor->referencias_comerciales()->delete();
    }

    private function guardarReferenciasComerciales($proveedor, $request)
    {

        $id_proveedor = $proveedor->id_proveedor;
        $referencias_comerciales = $request->get('empresa');

        if (is_iterable($referencias_comerciales)) {

            foreach ($referencias_comerciales as $key => $ref) {

                $referencia_comercial = new ReferenciasComerciales();
                $referencia_comercial->nombre_empresa = $ref;
                $referencia_comercial->telefono = $request->get('telefono')[$key];
                $referencia_comercial->direccion = $request->get('direccion')[$key];
                $referencia_comercial->contacto = $request->get('contacto')[$key];
                $referencia_comercial->id_proveedor = $id_proveedor;
                $referencia_comercial->save();
            }
        }


    }

    private function gurdarProductos( $proveedor ,$productos ){


        $proveedor->productos()->attach($productos);


    }

    public function show($id)
    {

        try {

            $proveedor = Proveedor::findOrFail($id);


            return view('registro.proveedores.show', compact('proveedor'));


        } catch (\Exception $ex) {


            return redirect()->route('proveedores.index')
                ->with('error', 'En este momento no es posible procesar su petición');

        }

    }

    public function destroy($id)
    {

        try {

            $proveedor = Proveedor::findOrFail($id);
            $proveedor->estado = 0;
            $proveedor->update();
            return response()->json(['success'=>'Proveedor dado de baja exitosamente']);

        } catch (\Exception $ex) {

            return response()->json(
                ['error'=>'En este momento no es posible procesar su petición',
                    'mensaje'=>$ex->getMessage()
                ]
            );

        }

    }

    private function getValueChecked($value)
    {

        if ($value == null || $value == "") {
            return 0;
        } else {
            return $value;
        }

    }

    public function importar(Request $request ){

        $file = $request->file('archivo_importar');


        try {
            Excel::load($file, function ($reader) {

                $results = $reader->get();

                foreach ($results as $key => $value) {

                    $existeProveedor = Proveedor::where('codigo_proveedor', $value->codigo)->exists();

                    if ($existeProveedor) {

                        $proveedor = Proveedor::where('codigo_proveedor', $value->codigo)->first();
                        $proveedor->razon_social = $value->razon_social;
                        $proveedor->nombre_comercial = $value->nombre_comercial;
                        $proveedor->email = $value->correo;
                        $proveedor->direccion_planta = $value->direccion;
                        $proveedor->telefono;
                        $proveedor->update();

                    } else {
                        $proveedor = new Proveedor();
                        $proveedor->codigo_proveedor = $value->codigo;
                        $proveedor->razon_social = $value->razon_social;
                        $proveedor->nombre_comercial = $value->nombre_comercial;
                        $proveedor->email = $value->correo;
                        $proveedor->direccion_planta = $value->direccion;
                        $proveedor->telefono;
                        $proveedor->save();

                    }

                }


            });
            return redirect()->route('proveedores.index')
                ->with('success', 'Proveedores cargados correctamente.');
        } catch (\PHPExcel_Reader_Exception $e) {

            return redirect()->route('proveedores.index')
                ->withErrors(['Archivo no valido']);

        }catch (\Exception $e ){

            return redirect()->route('proveedores.index')
                ->withErrors(['No ha sido posible cargar los clientes']);
        }


    }
}
