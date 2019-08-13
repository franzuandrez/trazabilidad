<?php

namespace App\Http\Controllers;

use App\CategoriaCliente;
use App\Cliente;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ClienteController extends Controller
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
        $sortField = $request->get('field') == null ? 'razon_social' : $request->get('field');

        $clientes = Cliente::select('id_cliente', 'razon_social', 'nit', 'direccion', 'telefono')
            ->where(function ($query) use ($search) {
                $query->where('razon_social', 'LIKE', '%' . $search . '%')
                    ->orWhere('nit', 'LIKE', '%' . $search . '%')
                    ->orWhere('direccion', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);


        if ($request->ajax()) {
            return view('registro.clientes.index',
                compact('search', 'sort', 'sortField', 'clientes'));
        } else {

            return view('registro.clientes.ajax',
                compact('search', 'sort', 'sortField', 'clientes'));
        }

    }

    public function create()
    {

        $categorias = CategoriaCliente::actived()->get();
        return view('registro.clientes.create', compact('categorias'));

    }

    public function store(Request $request)
    {

        $lunes = $this->getValueCheched($request->get('lunes'));
        $martes = $this->getValueCheched($request->get('martes'));
        $miercoles = $this->getValueCheched($request->get('miercoles'));
        $jueves = $this->getValueCheched($request->get('jueves'));
        $viernes = $this->getValueCheched($request->get('viernes'));
        $sabado = $this->getValueCheched($request->get('sabado'));
        $domingo = $this->getValueCheched($request->get('domingo'));

        $cliente = new Cliente();
        $cliente->razon_social = $request->get('razon_social');
        $cliente->nit = $request->get('nit');
        $cliente->telefono = $request->get('telefono');
        $cliente->direccion = $request->get('direccion');
        $cliente->id_categoria = $request->get('id_categoria_cliente');
        $cliente->lunes = $lunes;
        $cliente->martes = $martes;
        $cliente->miercoles = $miercoles;
        $cliente->jueves = $jueves;
        $cliente->viernes = $viernes;
        $cliente->sabado = $sabado;
        $cliente->domingo = $domingo;
        $cliente->latitud = $request->get('latitud');
        $cliente->longitud = $request->get('longitud');
        $cliente->save();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente dado de alta correctamente');

    }

    public function edit($id)
    {


        try {

            $cliente = Cliente::findOrFail($id);
            $categorias = CategoriaCliente::actived()->get();

            return view('registro.clientes.edit', compact('categorias', 'cliente'));

        } catch (\Exception $ex) {

            return redirect()->route('clientes.index')
                ->withErrors(['error' => 'Cliente no encontrado']);
        }


    }

    public function update(Request $request, $id)
    {

        try {
            $lunes = $this->getValueCheched($request->get('lunes'));
            $martes = $this->getValueCheched($request->get('martes'));
            $miercoles = $this->getValueCheched($request->get('miercoles'));
            $jueves = $this->getValueCheched($request->get('jueves'));
            $viernes = $this->getValueCheched($request->get('viernes'));
            $sabado = $this->getValueCheched($request->get('sabado'));
            $domingo = $this->getValueCheched($request->get('domingo'));

            $cliente = Cliente::findOrFail($id);
            $cliente->razon_social = $request->get('razon_social');
            $cliente->nit = $request->get('nit');
            $cliente->telefono = $request->get('telefono');
            $cliente->direccion = $request->get('direccion');
            $cliente->id_categoria = $request->get('id_categoria_cliente');
            $cliente->lunes = $lunes;
            $cliente->martes = $martes;
            $cliente->miercoles = $miercoles;
            $cliente->jueves = $jueves;
            $cliente->viernes = $viernes;
            $cliente->sabado = $sabado;
            $cliente->domingo = $domingo;
            $cliente->update();
            return redirect()->route('clientes.index')
                ->with('success','Cliente actualizado correctamente');

        } catch (\Exception $ex) {

            return redirect()->route('clientes.index')
                ->withErrors(['error' => 'Cliente no encontrado']);
        }


    }

    public function show($id){

        try {

            $cliente = Cliente::findOrFail($id);
            $categorias = CategoriaCliente::actived()->get();

            return view('registro.clientes.show', compact('categorias', 'cliente'));

        } catch (\Exception $ex) {

            return redirect()->route('clientes.index')
                ->withErrors(['error' => 'Cliente no encontrado']);
        }
    }

    public function importar(Request $request){


        $file = $request->file('archivo_importar');


        $data =Excel::load($file)->get();

        if($data->count()){

            foreach ( $data as $key => $value ){

                $isConsumidorFinal = strtoupper($value->nit)!="C/F" || strtoupper($value->nit)!="CF";

                if(Cliente::where('nit',$value->nit)->exists() && !$isConsumidorFinal){

                    $cliente = Cliente::where('nit',$value->nit)->first();
                    $cliente->razon_social = $value->cliente;
                    $cliente->direccion = $value->direccion;
                    $cliente->telefono = $value->telefono;
                    $cliente->update();
                }else{
                    $arr[] = [
                        'nit'=>$value->nit,
                        'razon_social'=>$value->cliente,
                        'direccion'=>$value->direccion,
                        'telefono'=>$value->telefono,
                        'id_categoria'=>1
                    ];
                }
            }

            if(!empty($arr)){
                Cliente::insert($arr);
            }


        }

        return redirect()->route('clientes.index')
            ->with('success','Clientes cargados correctamente');

    }

    private function getValueCheched($value)
    {

        return $value != 1 ? 0 : 1;

    }


}
