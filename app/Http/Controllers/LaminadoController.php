<?php

namespace App\Http\Controllers;

use App\Recepcion;
use App\User;
use Illuminate\Http\Request;

class LaminadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'orden_compra' : $request->get('field');


        $recepciones = Recepcion::join('proveedores', 'proveedores.id_proveedor', '=', 'recepcion_encabezado.id_proveedor')
            ->join('productos', 'productos.id_producto', '=', 'recepcion_encabezado.id_producto')
            ->select('recepcion_encabezado.*', 'productos.descripcion as producto', 'proveedores.razon_social as proveedor')
            ->where(function ($query) use ($search) {
                $query->where('proveedores.razon_social', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('recepcion_encabezado.orden_compra', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('control.laminado.index',
                compact('recepciones', 'sort', 'sortField', 'search'));
        } else {

            return view('control.laminado.ajax',
                compact('recepciones', 'sort', 'sortField', 'search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $responsables = User::actived()->get();

        return view('control.laminado.create',
            compact('responsables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
