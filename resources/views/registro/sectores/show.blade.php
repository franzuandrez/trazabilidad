@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-square-o',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Sectores
        @endslot
    @endcomponent

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker" disabled id="localidades" onchange="cargarBodegas()">
                <option value="">Seleccionar LOCALIDAD</option>
                @foreach($localidades as $localidad)
                    @if($localidad->id_localidad == $idLocalidad)
                        <option value="{{$localidad->id_localidad}}" selected>{{$localidad->descripcion}}</option>
                    @else
                        <option value="{{$localidad->id_localidad}}">{{$localidad->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">Bodega</label>
            <select name="id_bodega" id="bodegas"  disabled class="form-control selectpicker">
                <option value="">SELECCIONE Bodega</option>
                @foreach($bodegas as $bodega)
                    @if($bodega->id_bodega == $sector->id_bodega)
                        <option selected value="{{$bodega->id_bodega}}">{{$bodega->descripcion}}</option>
                    @else
                        <option value="{{$bodega->id_bodega}}">{{$bodega->descripcion}}</option>
                    @endif
                @endforeach

            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">Codigo  Barras</label>
            <input type="text" name="codigo_barras"  readonly value="{{$sector->codigo_barras}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
              <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" readonly value="{{$sector->descripcion}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">ENCARGADO</label>
            <select name="id_encargado"  disabled class="form-control selectpicker">
                @foreach($encargados as $encargado)
                    @if($encargado->id == $sector->id_encargado)
                        <option value="{{$encargado->id}}" selected>{{$encargado->nombre}}</option>
                    @else
                        <option value="{{$encargado->id}}">{{$encargado->nombre}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('registro/sectores')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
@endsection


