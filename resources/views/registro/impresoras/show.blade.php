@extends('layouts.admin')
@section('contenido')
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-print',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Impresoras
        @endslot
    @endcomponent

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=ip"">
                IP
            </label>
            <input
                required
                id="ip"
                type="text" name="ip" value="{{$impresora->ip}}" readonly
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
                   name="descripcion" id="descripcion" value="{{$impresora->descripcion}}" readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('registro/impresoras')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>


@endsection
