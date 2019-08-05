<?php

namespace App\Http\Controllers;

use App\Dimensional;
use Illuminate\Http\Request;

class DimensionalController extends Controller
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
        $sortField = $request->get('field') == null ? 'descripcion' : $request->get('field');

        $dimensionales = Dimensional::actived()
            ->where(function ($query) use ($search) {

                $query->where('descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('factor', 'LIKE', '%' . $search . '%')
                    ->orWhere('unidad_medida', 'LIKE', '%' . $search . '%');

            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {

            return view('registro.dimensionales.index',
                compact('search','sort','sortField','dimensionales'));
        } else {

            return view('registro.dimensionales.ajax',
                compact('search','sort','sortField','dimensionales'));
        }

    }


    public function create(){


        return view('registro.dimensionales.create');

    }

    public function store(Request $request){

        $dimensional = new Dimensional();
        $dimensional->descripcion = $request->get('descripcion');
        $dimensional->unidad_medida=$request->get('unidad_medida');
        $dimensional->factor = $request->get('factor');
        $dimensional->save();

        return redirect()->route('dimensionales.index')
            ->with('success','Dimensional dada de alta correctamente');

    }

    public function edit($id){

        try{

            $dimensional = Dimensional::findOrFail($id);

            return view('registro.dimensionales.edit',compact('dimensional'));


        }catch(\Exception $ex){

            return redirect()->route('dimensionales.index')
                ->with('error','Dimensional no encontrada');
        }
    }

    public function update(Request $request, $id){

        try{

            $dimensional = Dimensional::findOrFail($id);
            $dimensional->descripcion = $request->get('descripcion');
            $dimensional->unidad_medida = $request->get('unidad_medida');
            $dimensional->factor = $request->get('factor');
            $dimensional->update();


            return redirect()->route('dimensionales.index')
                ->with('success','Dimensional actualizada correctamente');



        }catch(\Exception $ex){

            return redirect()->route('dimensionales.index')
                ->with('error','Dimensional no encontrada');
        }

    }

    public function show($id){

        try{

            $dimensional = Dimensional::findOrFail($id);

            return view('registro.dimensionales.show',compact('dimensional'));


        }catch(\Exception $ex){

            return redirect()->route('dimensionales.index')
                ->with('error','Dimensional no encontrada');
        }

    }
}
