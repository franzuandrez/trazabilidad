<?php

namespace App\Http\Controllers;

use App\Localidad;
use App\User;
use Illuminate\Http\Request;

class LocalidadController extends Controller
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


        $localidades = Localidad::join('users','users.id','=','localidades.id_encargado')
            ->select('localidades.*','users.nombre as encargado')
            ->actived()
            ->where(function ($query)use($search){
                $query->where('codigo_barras','LIKE','%'.$search.'%')
                ->orWhere('descripcion','LIKE','%'.$search.'%')
                ->orWhere('direccion','LIKE','%'.$search.'%')
                ->orWhere('username','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if($request->ajax()){
            return view('registro.localidades.index',compact('search','sort','sortField','localidades'));
        }else{
            return view('registro.localidades.ajax',compact('search','sort','sortField','localidades'));
        }





    }

    public function create(){

        $encargados = User::actived()->get();


        return view('registro.localidades.create',compact('encargados'));
    }

    public function store(Request $request){



        $localidad = new Localidad();
        $localidad->codigo_barras = $request->get('codigo_barras');
        $localidad->descripcion = $request->get('descripcion');
        $localidad->direccion = $request->get('direccion');
        $localidad->id_encargado = $request->get('id_encargado');
        $localidad->save();

        return redirect()->route('localidades.index')
            ->with('success','Localidad dada de alta correctamente');

    }

    public function edit($id){

        try{

            $localidad = Localidad::findOrFail($id);
            $encargados = User::actived()->get();

            return view('registro.localidades.edit',compact('localidad','encargados'));

        }catch (\Exception $ex){

            return redirect()->route('localidades.index')
                ->withErrors(['error'=>'Localidad no encontrada']);
        }

    }

    public function update( Request $request ,$id){
        try{

            $localidad = Localidad::findOrFail($id);
            $localidad->codigo_barras = $request->get('codigo_barras');
            $localidad->descripcion = $request->get('descripcion');
            $localidad->direccion = $request->get('direccion');
            $localidad->id_encargado = $request->get('id_encargado');
            $localidad->update();

            return redirect()->route('localidades.index')
            ->with('success','Localidad actualizada correctamente');


        }catch (\Exception $ex){

            return redirect()->route('localidades.index')
                ->withErrors(['error'=>'Localidad no encontrada']);
        }

    }

    public function show($id){
        try{

            $localidad = Localidad::findOrFail($id);
            $encargados = User::actived()->get();

            return view('registro.localidades.show',compact('localidad','encargados'));

        }catch (\Exception $ex){

            return redirect()->route('localidades.index')
                ->withErrors(['error'=>'Localidad no encontrada']);
        }
    }
}
