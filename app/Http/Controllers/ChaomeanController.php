<?php

namespace App\Http\Controllers;

use App\Sector;
use Illuminate\Http\Request;

class ChaomeanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'codigo_barras' : $request->get('field');


        $sectores = Sector::join('bodegas','bodegas.id_bodega','=','sectores.id_bodega')
            ->join('users','users.id','=','sectores.id_sector')
            ->select('sectores.*','bodegas.descripcion as bodega','users.nombre as encargado')
            ->actived()
            ->where(function ($query) use ($search){

                $query->where('sectores.codigo_barras','LIKE','%'.$search.'%')
                    ->orWhere('sectores.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('bodegas.descripcion','LIKE','%'.$search.'%')
                    ->orWhere('users.nombre','LIKE','%'.$search.'%');

            })
            ->orderBy($sortField,$sort)
            ->paginate(20);


        if($request->ajax()){

            return view('control.chaomin.index',compact('sectores','search','sort','sortField'));

        }else{
            return view('control.chaomin.ajax',compact('sectores','search','sort','sortField'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
