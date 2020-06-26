<?php

namespace App\Http\Controllers;

use App\Http\tools\Impresiones;
use App\Impresion;
use Illuminate\Http\Request;

class ReimpresionController extends Controller
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
        $sortField = $request->get('field') == null ? 'CORRELATIVO' : $request->get('field');

        $impresiones = Impresion::NoReimpresion()
            ->where(function ($query) use ($search) {
                $query->where('DESCRIPCION_PRODUCTO', 'LIKE', '%' . $search . '%')
                    ->orWhere('CODIGO_BARRAS', 'LIKE', '%' . $search . '%')
                    ->orWhere('LOTE', 'LIKE', '%' . $search . '%')
                    ->orWhere('CODIGO_DUN', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {
            return view('reimpresion.index',
                [
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField,
                    'impresiones' => $impresiones
                ]
            );
        }
        return view('reimpresion.ajax',
            [
                'search' => $search,
                'sort' => $sort,
                'sortField' => $sortField,
                'impresiones' => $impresiones
            ]

        );


    }


    public function reimprimir(Request $request)
    {

        $id_impresion = $request->id;
        $cantidad = $request->cantidad;

        $impresion = Impresion::find($id_impresion);

        Impresiones::reimprimir($impresion, $cantidad);

        return response()->json([
            'status' => 1,
            'Guardado correctamente'
        ]);
    }
}
