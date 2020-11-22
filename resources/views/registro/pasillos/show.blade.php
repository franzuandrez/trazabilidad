@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-pause',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Pasillos
        @endslot
    @endcomponent

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker"
                    id="localidades" onchange="cargarBodegas()" disabled>
                <option value="">Seleccionar LOCALIDAD</option>
                @foreach($localidades as $loc)
                    @if($localidad->id_localidad == $loc->id_localidad)
                        <option selected value="{{$loc->id_localidad}}">{{$loc->descripcion}}</option>
                    @else
                        <option value="{{$loc->id_localidad}}">{{$loc->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">BODEGA</label>
            <select name="id_bodega" id="bodegas" class="form-control selectpicker" onchange="cargarSectores()" disabled>
                <option value="">Seleccionar BODEGA</option>
                @foreach( $localidad->bodegas as $bod )
                    @if($bod->id_bodega == $bodega->id_bodega)
                        <option value="{{$bod->id_bodega}}" selected>{{$bod->descripcion}}</option>
                    @else
                        <option value="{{$bod->id_bodega}}">{{$bod->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">SECTOR</label>
            <select name="id_sector" id="sectores" class="form-control selectpicker" disabled>
                <option value="">Seleccionar SECTOR</option>
                @foreach( $bodega->sectores as $sec  )
                    @if($sec->id_sector == $pasillo->id_sector)
                        <option value="{{  $sec->id_sector }}" selected> {{ $sec->descripcion }}</option>
                    @else
                        <option value="{{  $sec->id_sector }}"> {{ $sec->descripcion }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">Codigo  Barras</label>
            <input type="text" name="codigo_barras" value="{{$pasillo->codigo_barras}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
              <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" readonly value="{{$pasillo->descripcion}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">ENCARGADO</label>
            <select name="id_encargado" disabled class="form-control selectpicker">
                <option value="">Seleccionar ENCARGADO</option>
                @foreach($encargados as $encargado)
                    @if($encargado->id == $pasillo->id_encargado )
                        <option selected value="{{$encargado->id}}">{{$encargado->nombre}}</option>
                    @else
                        <option  value="{{$encargado->id}}">{{$encargado->nombre}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/pasillos')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
@endsection
