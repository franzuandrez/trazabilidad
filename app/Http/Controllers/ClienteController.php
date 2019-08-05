<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;


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

        $clientes = Cliente::select('id_cliente','razon_social','nit','direccion','telefono')
            ->where(function ($query) use ($search){
                $query->where('razon_social','LIKE','%'.$search.'%')
                    ->orWhere('nit','LIKE','%'.$search.'%')
                    ->orWhere('direccion','LIKE','%'.$search.'%');
            })
            ->orderBy($sortField,$sort)
            ->paginate(20);



        if ($request->ajax()) {
            return view('registro.clientes.index',
                compact('search','sort','sortField','clientes'));
        } else {

            return view('registro.clientes.ajax',
                compact('search','sort','sortField','clientes'));
        }

    }


}
