@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-tasks',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Racks
        @endslot
    @endcomponent



    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker" id="localidades"  disabled onchange="cargarBodegas()">
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
            <select name="id_bodega" id="bodegas" class="form-control selectpicker" disabled  onchange="cargarSectores()">
                <option value="">Seleccionar BODEGA</option>
                @foreach($localidad->bodegas as $bod)
                    @if($bod->id_bodega == $bodega->id_bodega)
                        <option selected value="{{$bod->id_bodega}}">{{$bod->descripcion}}</option>
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
            <select name="id_sector" id="sectores" class="form-control selectpicker"  disabled onchange="cargarPasillos()">
                <option value="">Seleccionar SECTOR</option>
                @foreach($bodega->sectores as $sec)
                    @if($sec->id_sector == $sector->id_sector)
                        <option selected value="{{$sec->id_sector}}">{{$sec->descripcion}}</option>
                    @else
                        <option value="{{$sec->id_sector}}">{{$sec->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">PASILLOS</label>
            <select name="id_pasillo" id="pasillos" class="form-control selectpicker" disabled>
                <option value="">Seleccionar PASILLO</option>
                @foreach($sector->pasillos as $pasillo )
                    @if($pasillo->id_pasillo == $rack->id_pasillo)
                        <option selected value="{{$pasillo->id_pasillo}}"> {{$pasillo->descripcion }}</option>
                    @else
                        <option value="{{$pasillo->id_pasillo}}"> {{$pasillo->descripcion }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">Codigo  Barras</label>
            <input type="text" name="codigo_barras" value="{{$rack->codigo_barras}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
              <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" value="{{$rack->descripcion}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LADO</label>
            <select name="lado" id="lado" class="form-control selectpicker" disabled>
                @if($rack->lado == 'A')
                    <option selected value="A">A</option>
                    <option value="B">B</option>
                @else
                    <option value="A">A</option>
                    <option selected value="B">B</option>
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('registro/racks')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>

        </div>
    </div>
@endsection

