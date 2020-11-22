@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-pause',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Pasillos
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::model($pasillo,['method'=>'PATCH','route'=>['pasillos.update',$pasillo->id_pasillo]])!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad"
                    required
                    class="form-control selectpicker" id="localidades" onchange="cargarBodegas()">
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
            <select name="id_bodega"
                    required
                    id="bodegas" class="form-control selectpicker" onchange="cargarSectores()">
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
            <select name="id_sector"
                    required
                    id="sectores" class="form-control selectpicker">
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
            <input type="text"
                   required
                   name="codigo_barras" value="{{$pasillo->codigo_barras}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
              <label for="descripcion">Descripcion</label>
            <input type="text"
                   required
                   name="descripcion" value="{{$pasillo->descripcion}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">ENCARGADO</label>
            <select name="id_encargado"
                    required
                    class="form-control selectpicker">
                <option value="">Seleccionar ENCARGADO</option>
                @foreach($encargados as $encargado)
                    @if($encargado->id == $pasillo->id_encargado )
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
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('registro/pasillos ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
            </button>
            </a>


        </div>
    </div>
    {!!Form::close()!!}
@endsection

@section('scripts')
    <script>
        function cargarBodegas() {


            let idLocalidad = $('#localidades option:selected').val();
            idLocalidad = idLocalidad == "" ? 0 : idLocalidad;
            $.ajax({

                url: "{{url('registro/bodegas_by_localidad/')}}" + "/" + idLocalidad,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let bodegas = $('#bodegas');
                    let sectores = $('#sectores');
                    clearSelect(bodegas);
                    clearSelect(sectores);
                    response.bodegas.forEach(function (e) {
                        addToSelect(e.id_bodega, e.descripcion, bodegas);
                    })
                },
                error: function (e) {

                }

            })


        }

        function cargarSectores() {


            let idBodega = $('#bodegas option:selected').val();
            idBodega = idBodega == "" ? 0 : idBodega;
            $.ajax({

                url: "{{url('registro/sectores_by_bodega/')}}" + "/" + idBodega,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let sectores = $('#sectores');
                    clearSelect(sectores);
                    response.sectores.forEach(function (e) {
                        addToSelect(e.id_sector, e.descripcion, sectores);
                    })
                },
                error: function (e) {

                }

            })


        }

        function clearSelect(select) {

            $(select).find('option:not(:first)').remove();
            $(select).selectpicker('refresh');
        }

        function addToSelect(value, txt, select) {

            let option = `<option value='${value}'>${txt}</option>`;
            $(select).append(option);
            $(select).selectpicker('refresh');
        }

    </script>
@endsection
