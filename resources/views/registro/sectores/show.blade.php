@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-square-o',
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
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker" disabled id="localidades" onchange="cargarBodegas()">
                <option value="">SELECCIONAR LOCALIDAD</option>
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
            <label for="id_encargado">AREA</label>
            <select name="id_bodega" id="bodegas"  disabled class="form-control selectpicker">
                <option value="">SELECCIONE AREA</option>
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
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text" name="codigo_barras"  readonly value="{{$sector->codigo_barras}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" readonly value="{{$sector->descripcion}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="inventario_disponible">¿TOMAR COMO INVENTARIO DISPONIBLE?</label>
            <select name="inventario_disponible"
                    required
                    disabled
                    class="form-control selectpicker">
                <option value="0" {{$sector->sistema==0?'selected':''}}>SI</option>
                <option value="1" {{$sector->sistema==1?'selected':''}}>NO</option>

            </select>
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
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
@endsection


