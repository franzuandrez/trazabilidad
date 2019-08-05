<?php

namespace App\Http\Controllers;

use App\CategoriaCliente;
use App\TipoDocumento;
use Illuminate\Http\Request;

class CategoriaClienteController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index(Request $request){

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'id_categoria' : $request->get('field');

        $categorias = CategoriaCliente::actived()
            ->where(function($query) use ($search){

                $query->where('categoria_clientes.descripcion','LIKE','%'.$search.'%');

            })
            ->orderBy($sortField,$sort)
            ->paginate(20);


        if($request->ajax()){
            return view('registro.categoria_clientes.index',
                compact('search','sort','sortField','categorias'));

        }else{
            return view('registro.categoria_clientes.ajax',
                compact('search','sort','sortField','categorias'));
        }





    }

    public function create(){

        $tipos_documentos = TipoDocumento::all();

        return view('registro.categoria_clientes.create',compact('tipos_documentos'));

    }

    public function store(Request $request){

        $categoria = new CategoriaCliente();
        $categoria->descripcion = $request->get('descripcion');
        $categoria->tipo_documento = $request->get('tipo_documento');
        $categoria->impresion_recibo = $request->get('impresion_recibo');
        $categoria->save();

        return redirect()->route('categoria_clientes.index')
            ->with('success','Categoria dada de alta correctamente');


    }

    public function edit($id){

        try{

            $categoria = CategoriaCliente::findOrFail($id);
            $tipos_documentos = TipoDocumento::all();

            return view('registro.categoria_clientes.edit',compact('categoria','tipos_documentos'));

        }catch(\Exception $ex){

            return redirect()->route('categoria_clientes.index')
                ->withErrors(['error'=>'No se ha encontrado dicha categoria']);
        }

    }

    public function update(Request $request, $id){


        try{
            $categoria = CategoriaCliente::findOrFail($id);
            $categoria->descripcion = $request->get('descripcion');
            $categoria->tipo_documento = $request->get('tipo_documento');
            $categoria->impresion_recibo = $request->get('impresion_recibo');
            $categoria->update();

            return redirect()->route('categoria_clientes.index')
                ->with('success','Categoria de cliente actualizada correctamente');


        }catch(\Exception $ex){

            return redirect()->route('categoria_clientes.index')
                ->withErrors(['error'=>'No se ha encontrado dicha categoria']);

        }

    }

    public function show($id){

        try{

            $categoria = CategoriaCliente::findOrFail($id);
            $tipos_documentos = TipoDocumento::all();

            return view('registro.categoria_clientes.show',
                compact('categoria','tipos_documentos'));


        }catch (\Exception $ex){

            return redirect()->route('categoria_clientes.index')
                ->withErrors(['error'=>'No se ha encontrado dicha categoria']);
        }
    }



}
