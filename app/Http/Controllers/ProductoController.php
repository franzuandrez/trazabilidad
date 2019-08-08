<?php

namespace App\Http\Controllers;

use App\Dimensional;
use App\Presentacion;
use App\Producto;
use App\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index( Request $request){

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'codigo_barras' : $request->get('field');

        $productos = Producto::join('dimensionales','dimensionales.id_dimensional','=','productos.id_dimensional')
            ->join('presentaciones','presentaciones.id_presentacion','=','productos.id_presentacion')
            ->select('productos.*','presentaciones.descripcion as presentacion',
                'dimensionales.descripcion as dimensional')
            ->where(function ( $query ) use ( $search ){
                $query->where('productos.codigo_barras','LIKE','%'.$search.'%')
                    ->orwhere('productos.descripcion','LIKE','%'.$search.'%')
                    ->orwhere('presentaciones.descripcion','LIKE','%'.$search.'%')
                    ->orwhere('dimensionales.descripcion','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if($request->ajax()){
            return view('registro.productos.index',
                compact('search','sort','sortField','productos'));
        }else{
            return view('registro.productos.ajax',
                compact('search','sort','sortField','productos'));
        }


    }

    public function create(){

        $dimensionales = Dimensional::actived()->get();
        $presentaciones = Presentacion::actived()->get();
        $proveedores = Proveedor::actived()->get();


        return view('registro.productos.create',
            compact('dimensionales','presentaciones','proveedores'));


    }

    public function store( Request $request ){

        $producto = new Producto();
        $producto->codigo_barras = $request->get('codigo_barras');
        $producto->codigo_interno = $request->get('codigo_interno');
        $producto->descripcion = $request->get('descripcion');
        $producto->id_dimensional = $request->get('id_dimensional');
        $producto->id_presentacion= $request->get('id_presentacion');
        $producto->id_proveedor = $request->get('id_proveedor');
        $producto->tipo_producto = $request->get('tipo_producto');
        $producto->fecha_creacion = \Carbon\Carbon::now();
        $producto->estado = 1;
        $producto->creado_por= \Auth::user()->id;
        $producto->save();

        return redirect()->route('productos.index')
            ->with('success','Producto dado de alta correctamente');



    }


    public function edit( $id ){


        try{
            $producto = Producto::findOrFail($id);
            $dimensionales = Dimensional::actived()->get();
            $presentaciones = Presentacion::actived()->get();
            $proveedores = Proveedor::actived()->get();

            return view('registro.productos.edit',
                compact('producto','dimensionales','presentaciones','proveedores'));



        }catch(\Exception $ex){

            return redirect()->route('productos.index')
                ->withErrors(['error'=>'Producto no encontrado']);


        }
    }

    public function update( Request $request , $id ){

        try{

            $producto = Producto::findOrFail($id);
            //$producto->codigo_barras = $request->get('codigo_barras');
            //$producto->codigo_interno = $request->get('codigo_interno');
            $producto->descripcion = $request->get('descripcion');
            $producto->id_dimensional = $request->get('id_dimensional');
            $producto->id_presentacion= $request->get('id_presentacion');
            $producto->id_proveedor = $request->get('id_proveedor');
            $producto->tipo_producto = $request->get('tipo_producto');
            $producto->fecha_actualizacion = \Carbon\Carbon::now();
            $producto->update();

            return redirect()->route('productos.index')
                ->with('success','Producto actualizado correctamente');

        }catch(\Exception $ex ){


            return redirect()->route('productos.index')
                ->withErrors(['error'=>'Lo sentimos, su peticion no ha sido procesada']);
        }


    }

    public function show( $id ){


        try{
            $producto = Producto::findOrFail($id);
            $dimensionales = Dimensional::actived()->get();
            $presentaciones = Presentacion::actived()->get();
            $proveedores = Proveedor::actived()->get();

            return view('registro.productos.show',
                compact('producto','dimensionales','presentaciones','proveedores'));



        }catch(\Exception $ex){

            return redirect()->route('productos.index')
                ->withErrors(['error'=>'Producto no encontrado']);


        }
    }
}
