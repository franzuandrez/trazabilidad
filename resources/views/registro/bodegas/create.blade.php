@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-building',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Localidades
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'registro/bodegas/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text" name="codigo_barras" value="{{old('codigo_barras')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" value="{{old('descripcion')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="telefono">TELEFONO</label>
            <input type="text" name="telefono" value="{{old('telefono')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="largo">LARGO</label>
            <input type="text" name="largo" value="{{old('largo')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ancho">ANCHO</label>
            <input type="text" name="ancho" value="{{old('ancho')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="alto">ALTO</label>
            <input type="text" name="alto" value="{{old('alto')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_localidad">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker">
                <option value="">SELECCIONAR LOCALIDAD</option>
                @foreach($localidades as $localidad)
                    <option value="{{$localidad->id_localidad}}">{{$localidad->descripcion}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">ENCARGADO</label>
            <select name="id_encargado" class="form-control selectpicker">
                <option value="">SELECCIONAR ENCARGADO</option>
                @foreach($encargados as $encargado)
                    <option value="{{$encargado->id}}">{{$encargado->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/bodegas')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
@endsection
