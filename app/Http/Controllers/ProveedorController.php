<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Proveedor;
use App\ReferenciasComerciales;

class ProveedorController extends Controller
{
    //

    public function  index(Request $request){

        $search = $request->get('search')==null?'':$request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'username' : $request->get('field');

        $proveedores = Proveedor::select('razon_social','nombre_comercial','nit','direccion_planta','estado')
            ->actived()
            ->where(function ($query)use($search){
                $query->where('razon_social','LIKE','%'.$search.'%')
                    ->orwhere('nombre_comercial','LIKE','%'.$search.'%')
                    ->orwhere('direccion_planta','LIKE','%'.$search.'%')
                    ->orwhere('nit','LIKE','%'.$search.'%');
            })
            ->paginate(20);


        if($request->ajax()){

            return view('registro.proveedores.index',
                compact('search','sort','sortField','proveedores'));

        }else{
            return view('registro.proveedores.ajax',
                compact('search','sort','sortField','proveedores'));

        }



    }

    public function create(){

        return view('registro.proveedores.create');
    }

    public function store(Request $request){




        try{

            DB::beginTransaction();

            $programa_bpm_implementado =$this->getValueChecked($request->get('programa_bpm_implementado'));
            $otros_programas = $this->getValueChecked($request->get('otros_programas'));
            $sistema_haccp = $this->getValueChecked($request->get('sistema_haccp'));
            $programa_capacitacion = $this->getValueChecked($request->get('programa_capacitacion'));
            $sistema_trazabilidad = $this->getValueChecked($request->get('sistema_trazabilidad'));
            $sistema_calidad_auditado_intermamente = $this->getValueChecked($request->get('sistema_calidad_auditado_intermamente'));
            $sistema_calidad_auditado_por_terceros = $this->getValueChecked($request->get('sistema_calidad_auditado_por_terceros'));
            $certificaciones = $this->getValueChecked($request->get('certificaciones'));


            $proveedor = new Proveedor();
            $proveedor->razon_social =$request->get('razon_social');
            $proveedor->nombre_comercial =$request->get('nombre_comercial');
            $proveedor->nit = $request->get('nit');
            $proveedor->direccion_fiscal = $request->get('direccion_fiscal');
            $proveedor->direccion_planta = $request->get('direccion_planta');
            $proveedor->nombre_contacto = $request->get('nombre_contacto');
            $proveedor->puesto_contacto= $request->get('puesto_contacto');
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

            $referencias_comerciales = $request->get('empresa');

            foreach($referencias_comerciales as $key=>$ref){

                $referencia_comercial = new ReferenciasComerciales();
                $referencia_comercial->nombre_empresa = $ref;
                $referencia_comercial->telefono = $request->get('telefono')[$key];
                $referencia_comercial->direccion = $request->get('direccion')[$key];
                $referencia_comercial->contacto =$request->get('contacto')[$key];
                $referencia_comercial->id_proveedor = $id_proveedor;
                $referencia_comercial->save();
            }




            DB::commit();

            return redirect()
                ->route('proveedores.index')
                ->with('success','Proveedor creado correctamente');


        }catch(\Exception $ex){


            DB::rollback();
            dd($ex);
            return redirect()
                ->route('proveedores.index')
                ->with('error','Error, no se ha podido crear  ');

        }


    }


    private function getValueChecked($value){

        if($value == null || $value == ""){
            return 0;
        }else{
            return $value;
        }

    }
}
