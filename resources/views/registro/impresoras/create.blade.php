@extends('layouts.admin')
@section('contenido')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-print',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Impresoras
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::open(array('url'=>'registro/impresoras/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=ip"">
                IP
            </label>
            <input
                required
                id="ip"
                type="text" name="ip" value="{{old('ip')}}"
                class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=descripcion"">
                DESCRIPCION
            </label>
            <input type="text"
                   required
                   name="descripcion" id="descripcion" value="{{old('ip')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/impresoras')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>


    {!!Form::close()!!}
@endsection
