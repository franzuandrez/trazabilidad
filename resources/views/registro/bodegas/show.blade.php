@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-building-o',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Bodegas
        @endslot
    @endcomponent



    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text" name="codigo_barras" value="{{$bodega->codigo_barras}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" value="{{$bodega->descripcion}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="telefono">TELEFONO</label>
            <input type="text" name="telefono" value="{{$bodega->telefono}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="largo">LARGO</label>
            <input type="text" name="largo" value="{{$bodega->largo}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ancho">ANCHO</label>
            <input type="text" name="ancho" value="{{$bodega->ancho}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="alto">ALTO</label>
            <input type="text" name="alto" value="{{$bodega->alto}}" readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_localidad">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker"  disabled>
                @foreach($localidades as $localidad)
                    @if($localidad->id_localidad == $bodega->id_localidad)
                        <option selected value="{{$localidad->id_localidad}}">{{$localidad->descripcion}}</option>
                    @else
                        <option value="{{$localidad->id_localidad}}">{{$localidad->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">ENCARGADO</label>
            <select name="id_encargado" class="form-control selectpicker" disabled>
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

            <a href="{{url('registro/bodegas')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>

@endsection
