@extends('layouts.admin')
@section('contenido')
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-male',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Colaboradores
        @endslot
    @endcomponent


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=codigo_barras"">
                CODIGO
            </label>
            <input type="text" name="codigo_barras" value="{{$colaborador->codigo_barras}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="nombre">NOMBRE</label>
            <input type="text" name="nombre" value="{{$colaborador->nombre}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="apellido">APELLIDO</label>
            <input type="text" name="apellido" value="{{$colaborador->apellido}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="telefono">TELEFONO</label>
            <input type="text" name="telefono" value="{{$colaborador->telefono}}" readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/colaboradores')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>

@endsection
