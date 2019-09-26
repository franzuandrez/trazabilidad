@extends('layouts.admin')

@section('contenido')
    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-cogs',
    'submenu_icon'=>'fa-cog',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Usuarios
        @endslot
        @slot('submenu')
            Administrar
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    <div class="panel-body">
        {!!Form::model($user,['method'=>'PATCH','route'=>['users.update',$user->id],'files'=> true])!!}
        {{Form::token()}}




        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">USUARIO</label>
                <input type="text" name="username" value="{{$user->username}}"  class="form-control" >
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="apellido">NOMBRE</label>
                <input type="text" name="nombre" value="{{$user->nombre}}"  class="form-control" >
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="text" name="email" value="{{$user->email}}"  class="form-control" >
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="roles">ROLES</label>
                <select  name="id_rol" id= "roles" class="form-control select2" style="width: 100%;">

                    @foreach($roles as $rol)
                        @if($userRole[0]->id == $rol->id)
                            <option selected value="{{$rol->id}}">{{$rol->name}}</option>
                        @else
                            <option  value="{{$rol->id}}">{{$rol->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

    </div>


    <div class="panel-body">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <button class="btn btn-default" type="submit" ><span class=" fa fa-check"></span> GUARDAR</button>
                <a href="{{url('users')}}"><button class="btn btn-default" type="button" ><span class="  fa fa-remove"></span> CANCELAR</button></a>

            </div>
        </div>
    </div>
    {!!Form::close()!!}



@endsection
