<?php

namespace App\Http\Controllers;

use App\Bin;
use App\Localidad;
use Illuminate\Http\Request;

class BinController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index(Request $request){

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'codigo_barras' : $request->get('field');

        $bines  = Bin::join('posiciones','posiciones.id_posicion','=','bines.id_posicion')
            ->select('bines.*','posiciones.descripcion as posicion')
            ->actived()
            ->where(function ( $query )  use  ( $search ){
                $query->where('bines.codigo_barras','LIKE','%'.$search.'%')
                    ->orwhere('bines.descripcion','LIKE','%'.$search.'%')
                    ->orwhere('posiciones.descripcion','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if($request->ajax()){
            return view('registro.bines.index',
                compact('bines','search','sort','sortField'));
        }else{
            return view('registro.bines.ajax',
                compact('bines','search','sort','sortField'));

        }

    }

    public function create(){

        $localidades  = Localidad::actived()->get();
        return view('registro.bines.create',compact('localidades'));

    }

    public function store(Request $request){

        $bin = new Bin();
        $bin->codigo_barras = $request->get('codigo_barras');
        $bin->descripcion = $request->get('descripcion');
        $bin->id_posicion = $request->get('id_posicion');
        $bin->save();

        return redirect()->route('bines.index')
            ->with('success','Bin dado de alta corretamente');


    }

    public function edit($id){

        try{

            $bin = Bin::findOrFail($id);

            $posicion = $bin->posicion;
            $nivel = $posicion->nivel;
            $rack = $nivel->rack;
            $pasillo = $nivel->rack->pasillo;
            $sector = $pasillo->sector;
            $bodega = $sector->bodega;
            $localidad = $bodega->localidad;


            $localidades = Localidad::actived()->get();


            return view('registro.bines.edit',
                compact('pasillo','bodega','sector',
                    'nivel','localidades','localidad','posicion','rack','bin'));


        }catch(\Exception $ex){

            return redirect()->route('posiciones.index')
                ->withErrors(['error'=>'Posicion no encontrada']);
        }
    }


    public function update(Request $request , $id){

        try{
            $bin = Bin::findOrFail($id);
            $bin->codigo_barras = $request->get('codigo_barras');
            $bin->descripcion = $request->get('descripcion');
            $bin->id_posicion = $request->get('id_posicion');
            $bin->update();

            return redirect()->route('bines.index')
                ->with('success','Bin actualizado corretamente');



        }catch (\Exception $ex){

            return redirect()->route('bines.index')
                ->withErrors(['error'=>'No ha sido posible procesar su petición']);


        }


    }

    public function show($id){

        try{

            $bin = Bin::findOrFail($id);

            $posicion = $bin->posicion;
            $nivel = $posicion->nivel;
            $rack = $nivel->rack;
            $pasillo = $nivel->rack->pasillo;
            $sector = $pasillo->sector;
            $bodega = $sector->bodega;
            $localidad = $bodega->localidad;


            $localidades = Localidad::actived()->get();


            return view('registro.bines.show',
                compact('pasillo','bodega','sector',
                    'nivel','localidades','localidad','posicion','rack','bin'));


        }catch(\Exception $ex){

            return redirect()->route('posiciones.index')
                ->withErrors(['error'=>'Posicion no encontrada']);
        }
    }

    public function destroy( $id ){

        try{

            $bin = Bin::findOrFail($id);
            $bin->estado = 0;
            $bin ->update();
            return response()->json(['success'=>'Bin dado de baja correctamente']);

        }catch(\Exception $ex){
            return response()->json(
                ['error'=>'En este momento no es posible procesar su petición',
                    'mensaje'=>$ex->getMessage()
                ]
            );

        }
    }


}
