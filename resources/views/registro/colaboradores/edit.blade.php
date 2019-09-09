@extends('layouts.admin')
@section('contenido')
    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-male',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Colaboradores
        @endslot
    @endcomponent


    {!!Form::model($colaborador,['method'=>'PATCH','route'=>['colaboradores.update',$colaborador->id_colaborador]])!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=codigo_barras"">
                CODIGO
            </label>
            <input type="text" name="codigo_barras" value="{{$colaborador->codigo_barras}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="nombre">NOMBRE</label>
            <input type="text" name="nombre" value="{{$colaborador->nombre}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="apellido">APELLIDO</label>
            <input type="text" name="apellido" value="{{$colaborador->apellido}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="telefono">TELEFONO</label>
            <input type="text" name="telefono" value="{{$colaborador->telefono}}" required
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/colaboradores')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>

    {!!Form::close()!!}
@endsection
