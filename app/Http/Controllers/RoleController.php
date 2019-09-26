<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolRequest;
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

    public function store(RolRequest $request){

        $role = Role::create([
            'name'=>$request->input('name'),
            'descripcion'=>$request->input('descripcion')
        ]);
        $role->syncPermissions($request->input('permission'));



        return redirect()->route('roles.index')
            ->with('success','Rol creado exitosamente');


    }

    public function edit($id){

        $role = Role::find($id);

        $menus= Permission::where('orden_menu','!=','0')
            ->orderBy('orden_menu','ASC')->get();

        $opciones = Permission::where('id_menu','!=','0')
            ->get();

        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('registro.roles.edit',compact('role','menus','opciones','rolePermissions'));




    }

    public function update($id, RolRequest $request){

        $role = Role::find($id);


        $role->name = $request->input('name');
        $role->descripcion= $request->input('descripcion');
        $role->save();


        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
            ->with('success','Rol actualizado correctamente');


    }

    public function destroy($id){

        $role = Role::find($id);
        $role->estado = '0';
        $role->update();

        return redirect()->route('roles.index')
            ->with('success','Rol dado de baja correctamente');


    }

    public function show($id){

        $role = Role::find($id);

        $menus= Permission::where('orden_menu','!=','0')
            ->orderBy('orden_menu','ASC')->get();
        $opciones = Permission::where('id_menu','!=','0')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();


        return view('registro.roles.show',compact('role','menus','opciones','rolePermissions'));


    }
}
