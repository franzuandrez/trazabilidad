<?php

namespace App\Http\Controllers;

use App\Dimensional;
use App\Presentacion;
use App\Producto;
use App\Proveedor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
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

        $productos = Producto::leftjoin('dimensionales','dimensionales.id_dimensional','=','productos.id_dimensional')
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

    public function destroy( $id ){

        try{
            $producto = Producto::findOrFail($id);
            $producto->estado = 0;
            $producto->update();
            return response()->json(['success'=>'Producto dado de baja correctamente']);

        }catch ( \Exception $ex ){

            return response()->json(
                ['error'=>'En este momento no es posible procesar su petición',
                    'mensaje'=>$ex->getMessage()
                ]
            );

        }
    }


    public function search( $search ){

        $productos = Producto::esMateriaPrima()
            ->where(function ( $query ) use ( $search ){
                $query->where('productos.codigo_barras','LIKE','%'.$search.'%')
                    ->orWhere('productos.descripcion','LIKE','%'.$search.'%');
            })
            ->with('proveedores')
            ->with('presentacion')
            ->get();

        if($productos->isEmpty()){
            $productos = [];
        }
        return response()->json($productos);
    }

    public function importar( Request $request ){


        $file = $request->file('archivo_importar');

        try {
            Excel::load($file, function ($reader) {

                $results = $reader->noHeading()->get();
                $results = $results->slice(1);
                foreach ($results as $key => $value) {


                   $id_presentacion = $this->getIdPresentacion($value[2]);
                   $existePresentacion = $id_presentacion != null;

                   if(!$existePresentacion){
                       $id_presentacion = $this->savePresentacion($value[2]);
                   }


                    $existeProducto = Producto::where('codigo_barras', $value[0])->exists();

                    if ($existeProducto) {

                        $producto = Producto::where('codigo_barras', $value[0])->first();
                        $producto->descripcion =  $value[1];
                        $producto->update();

                    } else {
                       $producto = new Producto();
                       $producto->codigo_barras = $value[0];
                       $producto->codigo_interno  =$value[0];
                       $producto->descripcion = $value[1];
                       $producto->id_presentacion = $id_presentacion;
                       $producto->tipo_producto = 'MP';
                       $producto->fecha_creacion =Carbon::now();
                       $producto->creado_por = \Auth::user()->id;
                       $producto->save();

                    }

                }


            });
            return redirect()->route('productos.index')
                ->with('success', 'Productos cargados correctamente.');
        } catch (\PHPExcel_Reader_Exception $e) {

            return redirect()->route('productos.index')
                ->withErrors(['Archivo no valido']);

        }catch (\Exception $e ){

            return redirect()->route('productos.index')
                ->withErrors(['No ha sido posible cargar los Productos']);
        }



    }

    private function getIdPresentacion( $descripcion ){

        $id_presentacion = null;
        $presentacion = Presentacion::where('descripcion',$descripcion)
            ->first();

        if($presentacion!=null){
            $id_presentacion = $presentacion->id_presentacion;
        }

        return $id_presentacion;

    }

    private function savePresentacion( $descripcion ){

        $presentacion  = new Presentacion();
        $presentacion->descripcion = $descripcion;
        $presentacion->creado_por = \Auth::user()->id;
        $presentacion->save();

        return $presentacion->id_presentacion;
    }
}
