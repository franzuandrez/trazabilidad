@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'crear',
    'menu_icon'=>'fa-cogs',
    'submenu_icon'=>'fa-user',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Usuarios
        @endslot
        @slot('submenu')
            Administrar
        @endslot
    @endcomponent
    @include('componentes.alert-error')
    <div class="panel-body">
        {!!Form::open(array('url'=>'users/create','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}




        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Usuario</label>
                <input type="text" name="username" value="{{old('username')}}"  class="form-control" >
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="apellido">Nombre</label>
                <input type="text" name="nombre" value="{{old('nombre')}}"  class="form-control" >
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="text" name="email" value="{{old('email')}}"  class="form-control" >
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Contraseña</label>
                <input type="password" name="password" value="{{old('password')}}"  class="form-control" >
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" value=""  class="form-control" >
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="roles">Roles</label>
                <select  name="id_rol" id= "roles" class="form-control select2" style="width: 100%;">
                    <option value="">SELECCIONE ROL</option>
                    @foreach($roles as $rol)
                        <option value="{{$rol->id}}">{{$rol->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


    </div>


    <div class="panel-body">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary" type="submit"><span class=" fa fa-check"></span> Guardar</button>
                <a href="{{url('users')}}"><button  class="btn btn-primary" type="button"><span class="  fa fa-remove"></span> Cancelar</button></a>

            </div>
        </div>
    </div>
    {!!Form::close()!!}


@endsection
