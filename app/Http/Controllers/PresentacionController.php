<?php

namespace App\Http\Controllers;


use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Http\Request;
use App\Presentacion;
use Illuminate\Support\Facades\Auth;
class PresentacionController extends Controller
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

        $presentaciones = Presentacion::select('id_presentacion','codigo_barras','descripcion','estado')
            ->actived()
            ->where(function ($query) use ($search){

                $query->where('codigo_barras','LIKE','%'.$search.'%')
                    ->orwhere('descripcion','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);


        if($request->ajax()){

            return view('registro.presentaciones.index',
                compact('presentaciones','sort','sortField','search'));
        }else{
            return view('registro.presentaciones.ajax',
                compact('presentaciones','sort','sortField','search'));
        }
    }


    public function create(){

        return view('registro.presentaciones.create');
    }

    public function store(Request $request){


        $presentacion = new Presentacion();
        $presentacion->codigo_barras = $request->get('codigo_barras');
        $presentacion->descripcion = $request->get('descripcion');
        $presentacion->creado_por = Auth::user()->id;
        $presentacion->save();


        return redirect()->route('presentacion.index')
            ->with('success','Presentacion creada correctamente');


    }

    public function edit($id){


        try{
            $presentacion = Presentacion::findOrFail($id);

            return view('registro.presentaciones.edit',compact('presentacion'));

        }catch(\Exception $ex){

            return redirect()->route('presentacion.index')
                ->with('error','Presentacion no encontrada');

        }



    }

    public function update(Request $request,$id){

        try{

            $presentacion = Presentacion::findOrFail($id);
            $presentacion->codigo_barras = $request->get('codigo_barras');
            $presentacion->descripcion = $request->get('descripcion');
            $presentacion->update();

            return redirect()->route('presentacion.index')
                ->with('success','Presentacion actulizada correctamente');

        }catch(\Exception $ex){

            return redirect()->route('presentacion.index')
                ->with('error','Presentacion no encontrada');
        }

    }
}
