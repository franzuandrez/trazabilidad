@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-map-marker',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Ubicaciones
        @endslot
    @endcomponent


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_localidad">LOCALIDAD</label>
            <input type="text"
                   name="localidades"
                   required
                   id="localidades"
                   readonly
                   value="{{$ubicacion->localidad->descripcion}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_bodega">BODEGA</label>
            <input type="text"
                   name="bodegas"
                   required
                   id="bodegas"
                   readonly
                   value="{{$ubicacion->bodega->descripcion}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_sector">SECTOR</label>
            <input type="text"
                   name="sectores"
                   required
                   id="sectores"
                   readonly
                   value="{{$ubicacion->sector->descripcion}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_pasillo">PASILLOS</label>
            <input type="text"
                   name="pasillos"
                   required
                   id="pasillos"
                   readonly
                   value="{{$ubicacion->pasillo->descripcion}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_rack">RACKS</label>
            <input type="text"
                   name="racks"
                   required
                   id="racks"
                   readonly
                   value="{{$ubicacion->rack->descripcion}}"
                   class="form-control">

        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_posicion">NIVELES</label>
            <input type="text"
                   name="posiciones"
                   required
                   id="posiciones"
                   readonly
                   value="{{$ubicacion->nivel->descripcion}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_posicion">POSICIONES</label>
            <input type="text"
                   name="posiciones"
                   required
                   id="posiciones"
                   readonly
                   value="{{$ubicacion->posicion->descripcion}}"
                   class="form-control">

        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_bin">BINES</label>
            <input type="text"
                   name="bines"
                   required
                   id="bines"
                   readonly
                    value="{{$ubicacion->bin->descripcion}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text"
                   name="codigo_barras"
                   required
                   id="codigo_barras"
                   readonly
                   value="{{$ubicacion->codigo_barras}}"
                   class="form-control">
        </div>
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/ubicaciones')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
@endsection
