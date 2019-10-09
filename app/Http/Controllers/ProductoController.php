<?php

namespace App\Http\Controllers;

use App\Dimensional;
use App\Http\Requests\ProductoRequest;
use App\Presentacion;
use App\Producto;
use App\Proveedor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductoController extends Controller
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
        $sortField = $request->get('field') == null ? 'id_producto' : $request->get('field');

        $productos = Producto::leftjoin('dimensionales', 'dimensionales.id_dimensional', '=', 'productos.id_dimensional')
            ->leftjoin('presentaciones', 'presentaciones.id_presentacion', '=', 'productos.id_presentacion')
            ->select('productos.*', 'presentaciones.descripcion as presentacion',
                'dimensionales.descripcion as dimensional')
            ->where(function ($query) use ($search) {
                $query->where('productos.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orwhere('productos.codigo_interno', 'LIKE', '%' . $search . '%')
                    ->orwhere('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orwhere('presentaciones.descripcion', 'LIKE', '%' . $search . '%')
                    ->orwhere('dimensionales.descripcion', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        $tipos_productos = [
            'MP' => 'MATERIA PRIMA',
            'ME' => 'MATERIAL EMPAQUE',
            'PT' => 'PRODUCTO TERMINADO',
            'MIX' => 'MIXTO'
        ];


        if ($request->ajax()) {
            return view('registro.productos.index',
                compact('search', 'sort', 'sortField', 'productos', 'tipos_productos'));
        } else {
            $headers = $this->getHeaders();
            $examples = $this->getExamples();

            return view('registro.productos.ajax',
                compact('search', 'sort', 'sortField', 'productos', 'tipos_productos', 'headers', 'examples'));
        }


    }

    public function create()
    {

        $dimensionales = Dimensional::actived()->get();
        $presentaciones = Presentacion::actived()->get();
        $proveedores = Proveedor::actived()->get();


        return view('registro.productos.create',
            compact('dimensionales', 'presentaciones', 'proveedores'));


    }

    public function store(ProductoRequest $request)
    {

        $existeCodigoBarras = Producto::actived()
            ->where('codigo_barras', $request->get('codigo_barras'))
            ->exists();

        if ($existeCodigoBarras) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['El codigo de barras ya existe']);
        }

        $existeCodigoInterno = Producto::actived()
            ->where('codigo_interno', $request->get('codigo_interno'))
            ->exists();

        if ($existeCodigoInterno) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['El codigo Interno ya existe']);
        }


        $producto = new Producto();
        $producto->codigo_barras = $request->get('codigo_barras');
        $producto->codigo_interno = $request->get('codigo_interno');
        $producto->descripcion = $request->get('descripcion');
        $producto->id_dimensional = $request->get('id_dimensional');
        $producto->id_presentacion = $request->get('id_presentacion');
        $producto->tipo_producto = $request->get('tipo_producto');
        $producto->fecha_creacion = \Carbon\Carbon::now();
        $producto->estado = 1;
        $producto->creado_por = \Auth::user()->id;
        $producto->save();

        return redirect()->route('productos.index')
            ->with('success', 'Producto dado de alta correctamente');


    }


    public function edit($id)
    {



        try {
            $producto = Producto::findOrFail($id);
            $dimensionales = Dimensional::actived()->get();
            $presentaciones = Presentacion::actived()->get();


            return view('registro.productos.edit',
                compact('producto', 'dimensionales', 'presentaciones'));


        } catch (\Exception $ex) {

            return redirect()->route('productos.index')
                ->withErrors(['error' => 'Producto no encontrado']);


        }
    }

    public function update(ProductoRequest $request, $id)
    {
        $existeCodigoInterno = Producto::actived()
            ->where('codigo_interno', $request->get('codigo_interno'))
            ->where('id_producto', '<>', $id)
            ->exists();

        if ($existeCodigoInterno) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['El codigo Interno ya existe']);
        }

        try {

            $producto = Producto::findOrFail($id);
            $producto->codigo_interno = $request->get('codigo_interno');
            $producto->descripcion = $request->get('descripcion');
            $producto->id_dimensional = $request->get('id_dimensional');
            $producto->id_presentacion = $request->get('id_presentacion');
            $producto->tipo_producto = $request->get('tipo_producto');
            $producto->fecha_actualizacion = \Carbon\Carbon::now();
            $producto->update();

            return redirect()->route('productos.index')
                ->with('success', 'Producto actualizado correctamente');

        } catch (\Exception $ex) {


            return redirect()->route('productos.index')
                ->withErrors(['error' => 'Lo sentimos, su peticion no ha sido procesada']);
        }


    }

    public function show($id)
    {


        try {
            $producto = Producto::findOrFail($id);
            $dimensionales = Dimensional::actived()->get();
            $presentaciones = Presentacion::actived()->get();
            $proveedores = Proveedor::actived()->get();

            return view('registro.productos.show',
                compact('producto', 'dimensionales', 'presentaciones', 'proveedores'));


        } catch (\Exception $ex) {

            return redirect()->route('productos.index')
                ->withErrors(['error' => 'Producto no encontrado']);


        }
    }

    public function destroy($id)
    {

        try {
            $producto = Producto::findOrFail($id);
            $producto->estado = 0;
            $producto->update();
            return response()->json(['success' => 'Producto dado de baja correctamente']);

        } catch (\Exception $ex) {

            return response()->json(
                ['error' => 'En este momento no es posible procesar su petición',
                    'mensaje' => $ex->getMessage()
                ]
            );

        }
    }

    private function getHeaders()
    {
        $headers = ['Codigo ', ' Descripcion', 'Presentacion'];

        return $headers;

    }

    private function getExamples()
    {
        $examples = ['754842100014', 'AJO DESHIDRATADO EN POLVO', 'Saco'];

        return $examples;
    }

    public function search($search)
    {

        $productos = Producto::esMateriaPrima()
            ->where(function ($query) use ($search) {
                $query->where('productos.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%');
            })
            ->with('proveedores')
            ->with('presentacion')
            ->get();

        if ($productos->isEmpty()) {
            $productos = [];
        }
        return response()->json($productos);
    }

    public function importar(Request $request)
    {

        $tipo_producto = $request->get('opcion');

        $extensionesValidas = ['xlsx', 'xls'];
        $file = $request->file('archivo_importar');
        $total = 0;

        if (!in_array($file->extension(), $extensionesValidas)) {
            return redirect()
                ->back()
                ->withErrors(['El archivo debe ser formato Excel']);
        }
        try {

            $cargar = Excel::load($file, function ($reader) use ($tipo_producto) {

                $results = $reader->noHeading()->get();

                $results = $results->slice(1);
                $results = $results->where(0, '<>', null);
                foreach ($results as $key => $value) {


                    $formatoExcel = $this->getFormato($value);

                    if ($formatoExcel == "0") {
                        return redirect()->back()->withErrors(['Formato de excel no valido']);
                    } else {
                        $codigo_barras = $value[0];
                        $codigo_barras = str_pad($codigo_barras, 14, "0", STR_PAD_LEFT);
                        $existeProducto = Producto::where('codigo_barras', $codigo_barras)->exists();
                        if ($tipo_producto == "MIX") {
                            $tipo_producto_asignado = $value[6];
                        } else {
                            $tipo_producto_asignado = $tipo_producto;
                        }
                        if ($tipo_producto_asignado == "PP") {
                            $tipo_producto_asignado = "PT";
                        }
                        if ($existeProducto) {

                            $producto = Producto::where('codigo_barras', $codigo_barras)->first();
                            $producto->descripcion = $value[1];
                            $producto->tipo_producto = $tipo_producto_asignado;
                            $producto->update();
                        } else {

                            if ($formatoExcel == "A" && ( $tipo_producto_asignado =="PT" )) {
                                $id_dimensional = $this->getIdDimensional($value[3]);
                                $existeDimensional = $id_dimensional != null;
                                if (!$existeDimensional) {
                                    $id_dimensional = $this->saveDimensional($value[5]);
                                }
                                $id_presentacion = null;
                            } else if ($formatoExcel == "B" || $formatoExcel == "C") {

                                $id_dimensional = $this->getIdDimensional($value[5]);
                                $existeDimensional = $id_dimensional != null;
                                if (!$existeDimensional) {
                                    $id_dimensional = $this->saveDimensional($value[5], $value[4], $value[3]);
                                }
                                $id_presentacion = $this->getIdPresentacion($value[3]);
                                $existePresentacion = $id_presentacion != null;
                                if (!$existePresentacion) {
                                    $id_presentacion = $this->savePresentacion($value[3]);
                                }

                            }else{
                                return redirect()
                                    ->route('productos.index')
                                    ->withErrors(['El número de las columnas no concide con ninguno de los formatos establecidos']);
                            }

                            $codigo_interno = $value[1];
                            $producto = new Producto();
                            $producto->codigo_barras = $codigo_barras;
                            $producto->codigo_interno = $codigo_interno;
                            $producto->descripcion = $value[2];
                            $producto->id_presentacion = $id_presentacion;
                            $producto->tipo_producto = $tipo_producto_asignado;
                            $producto->id_dimensional = $id_dimensional;
                            $producto->fecha_creacion = Carbon::now();
                            $producto->creado_por = \Auth::user()->id;
                            $producto->save();

                        }
                    }
                }


            });
            $total = $cargar->parsed->count() - 1;

            return redirect()->route('productos.index')
                ->with('success', 'Productos cargados correctamente.');
        } catch (\PHPExcel_Reader_Exception $e) {

            return redirect()->route('productos.index')
                ->withErrors(['Archivo no valido']);

        } catch (\Exception $e) {

            return redirect()->route('productos.index')
                ->withErrors(['No ha sido posible cargar los Productos']);
        }


    }

    private function getIdPresentacion($descripcion)
    {

        $id_presentacion = null;
        $presentacion = Presentacion::where('descripcion', $descripcion)
            ->first();

        if ($presentacion != null) {
            $id_presentacion = $presentacion->id_presentacion;
        }

        return $id_presentacion;

    }

    private function getIdDimensional($unidad_medida)
    {
        $id_dimensional = null;
        $dimensional = Dimensional::where('unidad_medida', $unidad_medida)
            ->first();

        if ($dimensional != null) {
            $id_dimensional = $dimensional->id_dimensional;
        }

        return $id_dimensional;
    }

    private function saveDimensional($unidad_medida, $cantidad = 1, $descripcion = "")
    {


        $dimensional = new Dimensional();
        $dimensional->descripcion = $descripcion;
        $dimensional->unidad_medida = $unidad_medida;
        $dimensional->factor = $cantidad;
        $dimensional->save();

        return $dimensional->id_dimensional;

    }

    private function savePresentacion($descripcion)
    {

        $presentacion = new Presentacion();
        $presentacion->descripcion = $descripcion;
        $presentacion->creado_por = \Auth::user()->id;
        $presentacion->save();

        return $presentacion->id_presentacion;
    }


    /*
     *  FORMATO A - [ CODIGO_BARRAS , CODIGO_INTERNO , DESCRIPCION , UNIDAD_MEDIDA  ]
     *
     * FORMATO B - [CODIGO_BARRAS - CODIGO_INTERNO , DESCRIPCION , PRESENTACION(CAJA,SACO), PRESENTACION(NUMERO), UNIDAD_MEDIDA ]
     *
     * FORMATO C - [CODIGO_BARRAS - CODIGO_INTERNO , DESCRIPCION , PRESENTACION(CAJA,SACO), PRESENTACION(NUMERO), UNIDAD_MEDIDA - CLASIFICACION]
     *
     * 0 - desconocido
     * */
    private function getFormato($row)
    {
        if ($row->count() == 4) {
            return "A";
        } else if ($row->count() == 6) {
            return "B";
        } else if ($row->count() == 7) {
            return "C";
        } else {
            return "0";
        }

    }


    private function importarFormatoB($row, $tipo_producto = null, $dimensional, $presentacion)
    {

        $codigo_barras = $row[0];
        $codigo_interno = $row[1];
        $descripcion = $row[2];

        $existeProducto = Producto::where('codigo_barras', $codigo_barras)->exists();

        if ($existeProducto) {
            $producto = Producto::where('codigo_barras', $codigo_barras)->first();
            $producto->descripcion = $descripcion;
            $producto->update();

        } else {
            $producto = new Producto();
            $producto->codigo_barras = $codigo_barras;
            $producto->codigo_interno = $codigo_interno;
            $producto->descripcion = $descripcion;
            $producto->tipo_producto = $tipo_producto;
            $producto->id_dimensional = $dimensional->id_dimensional;
            $producto->id_presentacion = $dimensional->id_dimensional;
            $producto->fecha_creacion = Carbon::now();
            $producto->creado_por = \Auth::user()->id;
            $producto->save();

        }

    }
}
