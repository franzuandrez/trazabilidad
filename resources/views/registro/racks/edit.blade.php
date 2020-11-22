@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-tasks',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Racks
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::model($rack,['method'=>'PATCH','route'=>['racks.update',$rack->id_rack]])!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad"
                    required
                    class="form-control selectpicker" id="localidades" onchange="cargarBodegas()">
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
                    required
                    class="form-control selectpicker" onchange="cargarSectores()">
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
            <select name="id_sector" id="sectores"
                    required
                    class="form-control selectpicker" onchange="cargarPasillos()">
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
            <select name="id_pasillo"
                    required
                    id="pasillos" class="form-control selectpicker">
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
            <input type="text" name="codigo_barras" value="{{$rack->codigo_barras}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
              <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" value="{{$rack->descripcion}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LADO</label>
            <select name="lado" id="lado"
                    required
                    class="form-control selectpicker">
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
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('registro/racks ')}}">
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
                    let pasillos = $('#pasillos');
                    clearSelect(bodegas);
                    clearSelect(sectores);
                    clearSelect(pasillos);
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
                    let pasillos = $('#pasillos');
                    clearSelect(sectores);
                    clearSelect(pasillos);
                    response.sectores.forEach(function (e) {
                        addToSelect(e.id_sector, e.descripcion, sectores);
                    })
                },
                error: function (e) {

                }

            })


        }

        function cargarPasillos() {


            let idSector = $('#sectores option:selected').val();
            idSector = idSector == "" ? 0 : idSector;
            $.ajax({

                url: "{{url('registro/pasillos_by_sector/')}}" + "/" + idSector,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let pasillos = $('#pasillos');
                    clearSelect(pasillos);
                    response.pasillos.forEach(function (e) {
                        addToSelect(e.id_pasillo, e.descripcion, pasillos);
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
