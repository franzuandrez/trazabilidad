@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa a-sort-numeric-desc',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Niveles
        @endslot
    @endcomponent


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker" id="localidades" disabled
                    onchange="cargarBodegas()">
                @foreach($localidades as $loc)
                    @if($loc->id_localidad == $localidad->id_localidad)
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
            <select name="id_bodega" id="bodegas" class="form-control selectpicker" disabled
                    onchange="cargarSectores()">
                <option value="">SELECCIONAR BODEGA</option>
                @foreach( $localidad->bodegas as $bod )

                    @if($bod->id_bodega = $bodega->id_bodega)
                        <option value="{{$bodega->id_bodega}}" selected>  {{ $bodega->descripcion }} </option>
                    @else
                        <option value="{{$bodega->id_bodega}}">  {{ $bodega->descripcion }} </option>
                    @endif

                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">SECTOR</label>
            <select name="id_sector" id="sectores" class="form-control selectpicker" disabled
                    onchange="cargarPasillos()">
                <option value="">SELECCIONAR SECTOR</option>
                @foreach( $bodega->sectores as $sec)
                    @if($sec->id_sector = $sector->id_sector)
                        <option value="{{$sec->id_sector}}" selected>  {{ $sec->descripcion }} </option>
                    @else
                        <option value="{{$sec->id_sector}}">  {{ $sec->descripcion }} </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">PASILLOS</label>
            <select name="id_pasillo" id="pasillos" class="form-control selectpicker" disabled
                    onchange="cargarRacks()">
                <option value="">SELECCIONAR PASILLO</option>
                @foreach( $sector->pasillos as $pass)
                    @if($pass->id_pasillo = $pasillo->id_pasillo)
                        <option value="{{$pass->id_pasillo}}" selected>  {{ $pass->descripcion }} </option>
                    @else
                        <option value="{{$pass->id_pasillo}}">  {{ $pass->descripcion }} </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_rack">RACKS</label>
            <select name="id_rack" id="racks" class="form-control selectpicker" disabled>
                <option value="">SELECCIONAR RACK</option>
                @foreach( $pasillo->racks as $rc )
                    @if($rc->id_rack == $nivel->id_rack)
                        <option selected value="{{$rc->id_rack}}"> {{ $rc->descripcion  }} </option>
                    @else
                        <option  value="{{$rc->id_rack}}"> {{ $rc->descripcion  }} </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text" name="codigo_barras" value="{{$nivel->codigo_barras}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" value="{{$nivel->descripcion}}" readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/niveles')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>

@endsection

