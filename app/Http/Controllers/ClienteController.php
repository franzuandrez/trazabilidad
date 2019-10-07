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

    private function getHeaders()
    {
        $headers = ['NIT', 'Nombre', 'Direccion', 'Telefono'];
        return $headers;
    }

    public function getExamples()
    {
        $examples = ['8760547-9', 'ER CORP. SA', 'Ciudad', '47809050'];
        return $examples;
    }

    public function index(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'razon_social' : $request->get('field');

        $clientes = Cliente::select('id_cliente','Codigo', 'razon_social', 'nit', 'direccion', 'telefono')
            ->where(function ($query) use ($search) {
                $query->where('razon_social', 'LIKE', '%' . $search . '%')
                    ->orWhere('nit', 'LIKE', '%' . $search . '%')
                    ->orWhere('codigo', 'LIKE', '%' . $search . '%')
                    ->orWhere('direccion', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(15);


        if ($request->ajax()) {
            return view('registro.clientes.index',
                compact('search', 'sort', 'sortField', 'clientes'));
        } else {

            $headers = $this->getHeaders();
            $examples = $this->getExamples();
            return view('registro.clientes.ajax',
                compact('search', 'sort', 'sortField', 'clientes', 'headers', 'examples'));
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

        $existeCliente = Cliente::where('codigo', $request->get('codigo'))
            ->exists();

        if ($existeCliente) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['Codigo ya existente']);
        }


        $cliente = new Cliente();
        $cliente->Codigo = $request->get('codigo');
        $cliente->razon_social = $request->get('razon_social');
        $cliente->nit = $request->get('nit');
        $cliente->telefono = $request->get('telefono');
        $cliente->direccion = $request->get('direccion');
        $cliente->id_categoria = $request->get('id_categoria_cliente');
        $cliente->email = $request->get('email');
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

            $existeCliente = Cliente::where('codigo', $request->get('codigo'))
                ->where('id_cliente','<>',$id)
                ->exists();

            if ($existeCliente) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['Codigo ya existente']);
            }
            $cliente = Cliente::findOrFail($id);
            $cliente->razon_social = $request->get('razon_social');
            $cliente->Codigo = $request->get('codigo');
            $cliente->nit = $request->get('nit');
            $cliente->telefono = $request->get('telefono');
            $cliente->direccion = $request->get('direccion');
            $cliente->id_categoria = $request->get('id_categoria_cliente');
            $cliente->email = $request->get('email');
            $cliente->lunes = $lunes;
            $cliente->martes = $martes;
            $cliente->miercoles = $miercoles;
            $cliente->jueves = $jueves;
            $cliente->viernes = $viernes;
            $cliente->sabado = $sabado;
            $cliente->domingo = $domingo;
            $cliente->update();
            return redirect()->route('clientes.index')
                ->with('success', 'Cliente actualizado correctamente');

        } catch (\Exception $ex) {

            return redirect()->route('clientes.index')
                ->withErrors(['error' => 'Cliente no encontrado']);
        }


    }

    public function show($id)
    {

        try {

            $cliente = Cliente::findOrFail($id);
            $categorias = CategoriaCliente::actived()->get();

            return view('registro.clientes.show', compact('categorias', 'cliente'));

        } catch (\Exception $ex) {

            return redirect()->route('clientes.index')
                ->withErrors(['error' => 'Cliente no encontrado']);
        }
    }

    public function importar(Request $request)
    {


        $total = 0;
        $file = $request->file('archivo_importar');


        try {
            $cargar = Excel::load($file, function ($reader) {
                $results = $reader->noHeading()->get();
                $results = $results->slice(1);


                foreach ($results as $key => $value) {


                    if (Cliente::where('codigo', $value[0])->exists() ) {

                        $cliente = Cliente::where('codigo', $value[0])->first();
                        $cliente->nit = $value[1];
                        $cliente->razon_social = $value[2];
                        $cliente->direccion = $value[3];
                        $cliente->telefono = $value[4];
                        $cliente->email = $value[5];
                        $cliente->update();
                    } else {
                        $arr[] = [
                            'codigo' => $value[0],
                            'nit' => $value[1],
                            'razon_social' => $value[2],
                            'direccion' => $value[3],
                            'telefono' => $value[4],
                            'email' => $value[5],
                            'id_categoria' => 1
                        ];
                    }
                }
                if (!empty($arr)) {
                    Cliente::insert($arr);
                }

            });

            $total = $cargar->parsed->count() - 1;

        } catch (\PHPExcel_Reader_Exception $e) {

            return redirect()->route('clientes.index')
                ->withErrors(['Archivo no valido']);

        } catch (\Exception $e) {

            return redirect()->route('clientes.index')
                ->withErrors(['No ha sido posible cargar los clientes']);
        }

        return redirect()->route('clientes.index')
            ->with('success', 'Un total de ' . $total . ' clientes cargados correctamente');

    }

    private function getValueCheched($value)
    {

        return $value != 1 ? 0 : 1;

    }


}
