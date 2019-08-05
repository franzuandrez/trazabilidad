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
}
