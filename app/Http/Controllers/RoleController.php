<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request){


        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'name' : $request->get('field');



        $roles = Role::where(function ($query)use($search){
            $query->where('name','LIKE','%'.$search.'%')
                ->orwhere('descripcion','LIKE','%'.$search.'%');

        });
        $roles = $roles->where('estado','1')
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if($request->ajax()){
            return view('registro.roles.index',compact('sort','sortField','search','roles'));
        }else{
            return view('registro.roles.ajax',compact('sort','sortField','search','roles'));
        }




    }


    public function create(){

        $menus = Permission::where('orden_menu','!=','0')
            ->orderBy('orden_menu','ASC')
            ->get();
        $opciones = Permission::where('id_menu','!=','0')
            ->get();

        return view('registro.roles.create',compact('menus','opciones'));

    }

    public function store(Request $request){

        $role = Role::create([
            'name'=>$request->input('name'),
            'descripcion'=>$request->input('descripcion')
        ]);
        $role->syncPermissions($request->input('permission'));



        return redirect()->route('roles.index')
            ->with('success','Rol creado exitosamente');


    }
}
