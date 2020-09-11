<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntregaPTController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');


    }


    public function index_entrega_pt(Request $request)
    {


        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'id_producto' : $request->get('field');

        if ($request->ajax()) {
            return view('entregas.entrega_pt.index',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,

                ]);
        } else {
            return view('entregas.entrega_pt.ajax',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                ]);
        }

    }


    public function index_recepcion_pt(Request $request)
    {
        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'id_producto' : $request->get('field');

        if ($request->ajax()) {
            return view('entregas.recepcion_pt.index',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,

                ]);
        } else {
            return view('entregas.recepcion_pt.ajax',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                ]);
        }
    }

    public function create_entrega_pt()
    {


        return view('entregas.entrega_pt.create');
    }

    public function create_recepcion_pt()
    {

        return view('entregas.recepcion_pt.create');
    }

}
