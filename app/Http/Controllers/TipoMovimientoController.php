<?php

namespace App\Http\Controllers;

use App\TipoMovimiento;
use Illuminate\Http\Request;

class TipoMovimientoController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index( Request $request){


        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'descripcion' : $request->get('field');

        $tipos = TipoMovimiento::actived()
            ->where('descripcion','LIKE','%'.$search.'%')
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if ($request->ajax()) {

            return view('registro.tipo_movimientos.index',
                compact('search','sort','sortField','tipos'));

        }else{

            return view('registro.tipo_movimientos.ajax',
                compact('search','sort','sortField','tipos'));
        }


    }

    public function create(){



        return view('registro.tipo_movimientos.create');

    }

    public function store( Request $request){

        $tipoMovimiento = new TipoMovimiento();
        $tipoMovimiento->descripcion = $request->get('descripcion');
        $tipoMovimiento->factor = $request->get('factor');
        $tipoMovimiento->save();

        return redirect()->route('tipo_movimientos.index')
            ->with('success','Tipo movimiento creado correctamente');
    }

    public function edit( $id ){

        try {
            $tipoMovimiento = TipoMovimiento::findOrFail($id);

            return view('registro.tipo_movimientos.edit',compact('tipoMovimiento'));

        } catch (\Exception $e) {

            return redirect()->route('tipo_movimientos.index')
                ->withErrors(['error','Tipo de movimiento no encontrado']);
        }

    }

    public function update( Request $request , $id ){

        try {
            $tipoMovimiento = TipoMovimiento::findOrFail($id);
            $tipoMovimiento->descripcion = $request->get('descripcion');
            $tipoMovimiento->factor = $request->get('factor');
            $tipoMovimiento->update();
            return redirect()->route('tipo_movimientos.index')
                ->with('success','Tipo movimiento actualizado correctamente');

        } catch (\Exception $e) {

            return redirect()->route('tipo_movimientos.index')
                ->withErrors(['error','Tipo de movimiento no encontrado']);

        }
    }
}
