<?php

namespace App\Http\Controllers;

use App\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
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
        $sortField = $request->get('field') == null ? 'codigo_barras' : $request->get('field');

        $niveles = Nivel::join('racks', 'racks.id_rack', '=', 'nivel.id_rack')
            ->select('nivel.*', 'racks.descripcion as rack')
            ->actived()
            ->where(function ($query) use ($search) {

                $query->where('nivel.codigo_barras', 'LIKE', '%' . $search . '%')
                    ->orwhere('nivel.descripcion', 'LIKE', '%' . $search . '%')
                    ->orwhere('racks.descripcion', 'LIKE', '%' . $search . '%');

            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('registro.niveles.index',compact('search','sort','sortField','niveles'));

        } else {
            return view('registro.niveles.ajax',compact('search','sort','sortField','niveles'));

        }
    }
}
