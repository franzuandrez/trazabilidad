<?php

namespace App\Http\Controllers;

use App\Impresora;
use Illuminate\Http\Request;

class ImpresoraController extends Controller
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
        $sortField = $request->get('field') == null ? 'id' : $request->get('field');


        $impresoras = Impresora:: where(function ($query) use ($search) {
            $query->where('impresoras.id', 'LIKE', '%' . $search . '%')
                ->orWhere('impresoras.ip', 'LIKE', '%' . $search . '%')
                ->orWhere('impresoras.descripcion', 'LIKE', '%' . $search . '%');
        })
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {

            return view('registro.impresoras.index',
                [
                    'impresoras' => $impresoras,
                    'search' => $search,
                    'sort' => $sort,
                    'sortField' => $sortField
                ]
            );
        }
        return view('registro.impresoras.ajax',
            [
                'impresoras' => $impresoras,
                'search' => $search,
                'sort' => $sort,
                'sortField' => $sortField
            ]
        );
    }


    public function create()
    {


        return view('registro.impresoras.create');
    }

    public function store(Request $request)
    {

        try {

            $impresora = new Impresora();
            $impresora->ip = $request->ip;
            $impresora->descripcion = $request->descripcion;
            $impresora->save();

            return redirect()
                ->route('impresora.index')
                ->with('success', 'Impresora creada correctamente');

        } catch (\Exception $ex) {

            return redirect()
                ->back()
                ->withErrors(['Algo salió mal']);

        }

    }

    public function edit($id)
    {

        $impresora = Impresora::findOrFail($id);


        return view('registro.impresoras.edit', [
            'impresora' => $impresora
        ]);
    }

    public function update(Request $request, $id)
    {
        try {

            $impresora = Impresora::find($id);
            $impresora->ip = $request->ip;
            $impresora->descripcion = $request->descripcion;
            $impresora->save();


            \DB::table('tb_imprimir_corrugado')
                ->where('IMPRESO', 'N')
                ->update([
                    'impreso' => 'S'
                ]);

            return redirect()
                ->route('impresora.index')
                ->with('success', 'Impresora actualizada correctamente');

        } catch (\Exception $ex) {

            return redirect()
                ->back()
                ->withErrors(['Algo salió mal']);

        }
    }

    public function show($id)
    {

        $impresora = Impresora::findOrFail($id);


        return view('registro.impresoras.show   ', [
            'impresora' => $impresora
        ]);
    }


    public function destroy($id)
    {

        Impresora::destroy($id);
        return response()->json([
            'success' => true,
            'status' => 1
        ]);
    }
}
