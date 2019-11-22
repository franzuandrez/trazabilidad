<?php

namespace App\Http\Controllers;

use App\Correlativo;
use App\Proveedor;
use App\ReferenciasComerciales;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProveedorController extends Controller
{
    //


    public function __construct()
    {

        $this->middleware('auth');
    }

    private function getHeaders()
    {

        $headers = ['Codigo', 'Razon Social', 'Nombre Comercial', 'Correo', 'Direccion', 'Telefono'];
        return $headers;

    }

    private function getExamples()
    {

        $examples = ['116316416146464', 'FLEXAPRINT, S.A. ', 'FLEXAPRINT, S.A.', 'silvia@flexaprint.com', 'Ciudad', '12345678'];
        return $examples;
    }


    public function index(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'asc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'nombre_comercial' : $request->get('field');

        $proveedores = Proveedor::select('id_proveedor', 'codigo_proveedor', 'razon_social', 'nombre_comercial', 'nit', 'direccion_planta', 'estado')
            ->actived()
            ->where(function ($query) use ($search) {
                $query->where('razon_social', 'LIKE', '%' . $search . '%')
                    ->orwhere('nombre_comercial', 'LIKE', '%' . $search . '%')
                    ->orwhere('direccion_planta', 'LIKE', '%' . $search . '%')
                    ->orwhere('nit', 'LIKE', '%' . $search . '%')
                    ->orwhere('codigo_proveedor', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {

            return view('registro.proveedores.index',
                ['search' => $search, 'sort' => $sort, 'sortField' => $sortField, 'proveedores' => $proveedores]);

        } else {
            $headers = $this->getHeaders();
            $examples = $this->getExamples();

            return view('registro.proveedores.ajax',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'proveedores' => $proveedores,
                    'headers' => $headers,
                    'examples' => $examples
                ]);

        }


    }

    public function create()
    {

        $correlativo = $this->getCorrelativo();

        return view('registro.proveedores.create', ['correlativo' => $correlativo]);
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

            $codigo = $this->getCorrelativo();
            $this->actualizarCorrelativo($codigo);
            $existeProveedor = Proveedor::where('codigo_proveedor', $codigo)
                ->where('estado', 1)
                ->exists();

            if ($existeProveedor) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['El codigo ya existe']);
            }


            $proveedor = new Proveedor();
            $proveedor->codigo_proveedor = $request->get('codigo');
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


            $this->guardarReferenciasComerciales($proveedor, $request);


            $this->gurdarProductos($proveedor, $request->get('productos'));

            DB::commit();

            return redirect()
                ->route('proveedores.index')
                ->with('success', 'Proveedor creado correctamente');


        } catch (\Exception $ex) {


            DB::rollback();


            return redirect()
                ->route('proveedores.index')
                ->withErrors(['error' => 'Lo sentimos, su petición no fue procesada']);

        }


    }

    public function edit($id)
    {

        try {

            $proveedor = Proveedor::findOrFail($id);


            return view('registro.proveedores.edit', ['proveedor' => $proveedor]);


        } catch (\Exception $ex) {


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

            $existeProveedor = Proveedor::where('codigo_proveedor', $request->get('codigo'))
                ->where('estado', 1)
                ->where('id_proveedor', '<>', $id)
                ->exists();

            if ($existeProveedor) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['El codigo ya existe']);
            }

            $proveedor = Proveedor::findOrFail($id);
            $proveedor->codigo_proveedor = $request->get('codigo');
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

            $this->gurdarProductos($proveedor, $request->get('productos'));

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

    private function gurdarProductos($proveedor, $productos)
    {


        $proveedor->productos()->sync($productos);


    }

    public function show($id)
    {

        try {

            $proveedor = Proveedor::findOrFail($id);


            return view('registro.proveedores.show', ['proveedor' => $proveedor]);


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
            return response()->json(['success' => 'Proveedor dado de baja exitosamente']);

        } catch (\Exception $ex) {

            return response()->json(
                ['error' => 'En este momento no es posible procesar su petición',
                    'mensaje' => $ex->getMessage()
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

    public function importar(Request $request)
    {

        $file = $request->file('archivo_importar');


        try {
            Excel::load($file, function ($reader) {

                $results = $reader->noHeading()->get();
                $results = $results->slice(1);

                foreach ($results as $key => $value) {

                    $existeProveedor = Proveedor::where('codigo_proveedor', $value[0])->exists();

                    if ($existeProveedor) {

                        $proveedor = Proveedor::where('codigo_proveedor', $value[0])->first();
                        $proveedor->razon_social = $value[1];
                        $proveedor->nombre_comercial = $value[2];
                        $proveedor->email = $value[3];
                        $proveedor->direccion_planta = $value[4];
                        $proveedor->telefono_contacto = $value[5];
                        $proveedor->update();

                    } else {
                        if ($value[1] != null && $value[2] != null) {

                            $proveedor = new Proveedor();
                            $proveedor->codigo_proveedor = $value[0];
                            $proveedor->razon_social = $value[1];
                            $proveedor->nombre_comercial = $value[2];
                            $proveedor->email = $value[3];
                            $proveedor->direccion_planta = $value[4];
                            $proveedor->telefono_contacto = $value[5];
                            $proveedor->save();
                            $this->actualizarCorrelativo($value[0]);
                        }


                    }

                }


            });
            return redirect()->route('proveedores.index')
                ->with('success', 'Proveedores cargados correctamente.');
        } catch (\PHPExcel_Reader_Exception $e) {

            return redirect()->route('proveedores.index')
                ->withErrors(['Archivo no valido']);

        } catch (\Exception $e) {

            return redirect()->route('proveedores.index')
                ->withErrors(['No ha sido posible cargar los Proveedores']);
        }


    }

    public function productos($id)
    {

        try {
            $proveedor = Proveedor::findOrFail($id);

            return view('registro.proveedores.detalle-productos', ['proveedor' => $proveedor]);

        } catch (\Exception $e) {

            return redirect()->route('proveedores.index')
                ->withErrors(['Proveedor no encontrado']);
        }

    }


    private function getCorrelativo()
    {


        $correlativo = Correlativo::where('modulo', 'PROVEEDORES')
            ->first();

        if ($correlativo == null) {
            $siguiente = 'PROV01';
        } else {
            if (intval($correlativo->correlativo) < 10) {
                $siguiente = $correlativo->prefijo . '0' . intval($correlativo->correlativo);
            } else {
                $siguiente = $correlativo->prefijo . (intval($correlativo->correlativo + 1));
            }
        }


        return $siguiente;


    }


    private function actualizarCorrelativo($codigo)
    {

        $codigo = strtoupper($codigo);
        $correlativoEntrante = explode('PROV', $codigo)[1];

        $correlativoActual = Correlativo::where('modulo', 'PROVEEDORES')
            ->first();

        if ($correlativoActual == null) {
            $correlativo = new Correlativo();
            $correlativo->prefijo = 'PROV';
            $correlativo->correlativo = '1';
            $correlativo->modulo = 'PROVEEDORES';
            $correlativo->id_empresa = 1;
            $correlativo->save();
        } else {
            if ($correlativoEntrante > $correlativoActual->correlativo) {
                $correlativoActual->correlativo = $correlativoEntrante;
                $correlativoActual->update();
            }
        }


    }


}
