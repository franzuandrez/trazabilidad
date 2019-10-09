@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-ellipsis-v',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Posiciones
        @endslot
    @endcomponent


    {!!Form::model($posicion,['method'=>'PATCH','route'=>['posiciones.update',$posicion->id_posicion]])!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker"
                    id="localidades" onchange="cargarBodegas()"
                    disabled
            >
                <option value="">SELECCIONAR LOCALIDAD</option>
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
            <select name="id_bodega" id="bodegas"
                    class="form-control selectpicker"
                    onchange="cargarSectores()"
                    disabled
            >
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
            <select name="id_sector" id="sectores"
                    class="form-control selectpicker"
                    onchange="cargarPasillos()"
                    disabled
            >
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
            <select name="id_pasillo" id="pasillos"
                    class="form-control selectpicker"
                    onchange="cargarRacks()"
                    disabled
            >
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
            <select name="id_rack" id="racks"
                    class="form-control selectpicker"
                    onchange="cargarNiveles()"
                    disabled
            >
                <option value="">SELECCIONAR RACK</option>
                @foreach( $pasillo->racks as $rc )
                    @if($rc->id_rack == $nivel->id_rack)
                        <option selected value="{{$rc->id_rack}}"> {{ $rc->descripcion  }} </option>
                    @else
                        <option value="{{$rc->id_rack}}"> {{ $rc->descripcion  }} </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_nivel">NIVELES</label>
            <select name="id_nivel"
                    id="niveles"
                    class="form-control selectpicker"
                    disabled
            >
                <option value="">SELECCIONAR NIVEL</option>
                @foreach( $rack->niveles as $nv )
                    @if($nivel->id_nivel  == $nv->id_nivel)
                        <option selected value="{{$nv->id_nivel}}">{{$nv->descripcion}}</option>
                    @else
                        <option  value="{{$nv->id_nivel}}">{{$nv->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text" name="codigo_barras" value="{{$posicion->codigo_barras}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" value="{{$posicion->descripcion}}" readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('registro/posiciones')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
@endsection
