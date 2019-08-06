@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-building',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Localidades
        @endslot
    @endcomponent



    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text" readonly name="codigo_barras" value="{{$localidad->codigo_barras}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text"  readonly name="descripcion" value="{{$localidad->descripcion}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="direccion">DIRECCION</label>
            <input type="text" readonly name="direccion" value="{{$localidad->direccion}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">ENCARGADO</label>
            <select name="id_encargado"  disabled class="form-control selectpicker">
                @foreach($encargados as $encargado)
                    @if($localidad->id_encargado == $encargado->id)
                        <option selected value="{{$encargado->id}}">{{$encargado->nombre}}</option>
                    @else
                        <option value="{{$encargado->id}}">{{$encargado->nombre}}</option>
                    @endif

                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/localidades')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>
        </div>
    </div>

@endsection
