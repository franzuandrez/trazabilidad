<?php

namespace App\Http\Controllers;

use App\Proveedor;
use http\Exception\UnexpectedValueException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logout(Request $request)
    {


        \Auth::logout();
        return redirect('login');
    }

    public function index(Request $request)
    {

        $search = $request->get('search') == null ? '' : $request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'username' : $request->get('field');

        $users = User::join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('users.*', 'roles.name as rol')
            ->actived()
            ->where('email', 'LIKE', '%' . $search . '%')
            ->orwhere('nombre', 'LIKE', '%' . $search . '%')
            ->orwhere('username', 'LIKE', '%' . $search . '%')
            ->orderBy($sortField, $sort)
            ->paginate(20);

        if ($request->ajax()) {

            return view('registro.users.index', compact('search', 'sort', 'sortField', 'users'));
        } else {

            return view('registro.users.ajax', compact('search', 'sort', 'sortField', 'users'));
        }


    }

    public function create()
    {

        $roles = Role::where('estado', '1')->get();

        return view('registro.users.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('id_rol'));

        return redirect()->route('users.index')->with('success', 'Usuario dado de alta correctamente');


    }

    public function edit($id)
    {

        try {
            $user = User::find($id);
            $roles = Role::where('estado', '1')->get();
            $userRole = $user->roles->all();
            return view('registro.users.edit', compact('user', 'roles', 'userRole'));
        } catch (\Exception $e) {

            return redirect()->route('users.index')
                ->withErrors(['error' => 'Usuario no encontrado']);

        }


    }

    public function update($id, Request $request)
    {

        $input = $request->all();
        if (!empty($input['password'])) {

            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));

        }

        try {
            $user = User::findOrFail($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->input('id_rol'));

            return redirect()->route('users.index')
                ->with('success', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {

            return redirect()->route('users.index')
                ->withErrors(['error'=>'Su petición no puede ser procesada en este momento']);
        }

    }

    public function destroy($id)
    {

        $user = User::find($id);
        $user->estado = '0';
        $user->update();

        //return redirect()->route('users.index')->with('success','Usuario dado de baja correctamente');


    }

    public function show($id)
    {

        try {
            $user = User::findOrFail($id);
            $roles = Role::where('estado', '1')->get();
            $userRole = $user->roles->all();
            return view('registro.users.show', compact('user', 'roles', 'userRole'));
        } catch (\Exception $ex) {

            return redirect()->route('users.index')
                ->withErrors(['error' => 'Usuario no encontrado']);

        }


    }


    public function editPassword($id)
    {

        try {
            $user = User::find($id);
            $roles = Role::where('estado', '1')->get();
            $userRole = $user->roles->all();
            return view('registro.users.cambiar_contrasena', compact('user', 'roles', 'userRole'));
        } catch (\Exception $e) {

            return redirect()->route('users.index')
                ->withErrors(['error'=>'Usuario no encontrado']);
        }

    }

    public function updatePassword(Request $request, $id)
    {

        $input = $request->all();

        if ($this->validatePass($request)) {

            try {
                $input['password'] = Hash::make($input['password']);
                $user = User::findOrFail($id);
                $user->password = $input['password'];
                $user->update();

                return redirect()->route('users.index')
                    ->with('success', 'Contraseña Actualizada correctamente');
            } catch (\Exception $e) {

                return redirect()->route('users.index')
                    ->withErrors(['error'=>'Su petición no puede ser procesada en este momento']);

            }
        } else {
            return redirect()->route('users.index')
                ->with('error', 'No se pudo actualizar la contraseña');
        }

    }

    private function validatePass($request)
    {

        return Hash::check($request->get('admin_pass'), \Auth::user()->password);


    }

    public function verificar(Request $request){

        $user = $request->get('usuario');
        $pass = $request->get('pass');
        $usuario = User::where('username',$user)
            ->first();

        if(Hash::check($pass, $usuario->password)){
            $rolePermissions = DB::table("role_has_permissions")
                ->where("role_has_permissions.role_id",$usuario->roles[0]->id)
                ->get();


            $estaAutorizado =  $rolePermissions->search(function ($item,$key){
                    return $item->permission_id == 47;
                }) != false;


            if($estaAutorizado){
                $response = 1;
            }else{
                $response = 0;
            }
        }else{
            $response = 0;
        }



        return $response ;






    }

}
