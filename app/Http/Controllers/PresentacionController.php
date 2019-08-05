<?php

namespace App\Http\Controllers;

use function foo\func;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Http\Request;
use App\Presentacion;

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
}
