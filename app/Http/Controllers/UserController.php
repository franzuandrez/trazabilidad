<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function logout(){
        Auth::logout();
    }

    public function index(Request $request){

        $search = $request->get('search')==null?'':$request->get('search');
        $sort = $request->get('sort') == null ? 'desc' : ($request->get('sort'));
        $sortField = $request->get('field') == null ? 'username' : $request->get('field');

        $users = User::active()
            ->where('email','LIKE','%'.$search.'%')
            ->orderBy($sortField,$sort)
            ->paginate(20);

        if($request->ajax()){

            return view('registro.users.index',compact('search','sort','sortField','users'));
        }else{

            return view('registro.users.ajax',compact('search','sort','sortField','users'));
        }








    }
}
