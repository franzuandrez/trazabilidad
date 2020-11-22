@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-square-o',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Sectores
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::model($sector,['method'=>'PATCH','route'=>['sectores.update',$sector->id_sector]])!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad"
                    required
                    class="form-control selectpicker" id="localidades" onchange="cargarBodegas()">
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
            <select name="id_bodega"
                    required
                    id="bodegas" class="form-control selectpicker">
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
            <input type="text"
                   required
                   name="codigo_barras" value="{{$sector->codigo_barras}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
              <label for="descripcion">Descripcion</label>
            <input type="text"
                   required
                   name="descripcion" value="{{$sector->descripcion}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">ENCARGADO</label>
            <select name="id_encargado"
                    required
                    class="form-control selectpicker">
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
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('registro/sectores ')}}">
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
                    clearSelect(bodegas);
                    response.bodegas.forEach(function (e) {
                        addToSelect(e.id_bodega, e.descripcion, bodegas);
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
