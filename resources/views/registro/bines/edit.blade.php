@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-inbox',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Bines
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::model($bin,['method'=>'PATCH','route'=>['bines.update',$bin->id_bin]])!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad"
                    required
                    class="form-control selectpicker" id="localidades" onchange="cargarBodegas()">
                <option value="">Seleccionar LOCALIDAD</option>
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
            <select name="id_bodega"
                    required
                    id="bodegas" class="form-control selectpicker" onchange="cargarSectores()">
                <option value="">Seleccionar BODEGA</option>
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
            <select name="id_sector"
                    required
                    id="sectores" class="form-control selectpicker" onchange="cargarPasillos()">
                <option value="">Seleccionar SECTOR</option>
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
            <select name="id_pasillo"
                    required
                    id="pasillos" class="form-control selectpicker" onchange="cargarRacks()">
                <option value="">Seleccionar PASILLO</option>
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
                    required
                    class="form-control selectpicker"
                    onchange="cargarNiveles()"
            >
                <option value="">Seleccionar RACK</option>
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
                    required
                    class="form-control selectpicker"
                    onchange="cargarPosiciones()"
            >
                <option value="">Seleccionar NIVEL</option>
                @foreach( $rack->niveles as $nv )
                    @if($nivel->id_nivel  == $nv->id_nivel)
                        <option selected value="{{$nv->id_nivel}}">{{$nv->descripcion}}</option>
                    @else
                        <option value="{{$nv->id_nivel}}">{{$nv->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_posicion">POSICIONES</label>
            <select name="id_posicion"
                    id="posiciones"
                    class="form-control selectpicker"
                    required
            >
                <option value="">Seleccionar POSICION</option>
                @foreach( $nivel->posiciones as $pos )
                    @if( $pos->id_posicion == $bin->id_posicion )
                        <option  value="{{$pos->id_posicion}}"  selected >  {{$pos->descripcion}} </option>
                    @else
                        <option value="{{$pos->id_posicion}}">  {{$pos->descripcion}} </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">Codigo  Barras</label>
            <input type="text" name="codigo_barras" value="{{$bin->codigo_barras}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
              <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" value="{{$bin->descripcion}}" required
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('registro/bines ')}}">
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
                    let racks = $('#racks');
                    let niveles = $('#niveles');
                    let posiciones = $('#posiciones');
                    clearSelect(bodegas);
                    clearSelect(sectores);
                    clearSelect(pasillos);
                    clearSelect(racks);
                    clearSelect(niveles);
                    clearSelect(posiciones);
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
                    let racks = $('#racks');
                    let niveles = $('#niveles');
                    let posiciones = $('#posiciones');
                    clearSelect(sectores);
                    clearSelect(pasillos);
                    clearSelect(racks);
                    clearSelect(niveles);
                    clearSelect(posiciones);
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
                    let racks = $('#racks');
                    let niveles = $('#niveles');
                    let posiciones = $('#posiciones');
                    clearSelect(pasillos);
                    clearSelect(racks);
                    clearSelect(niveles);
                    clearSelect(posiciones);
                    response.pasillos.forEach(function (e) {
                        addToSelect(e.id_pasillo, e.descripcion, pasillos);
                    })
                },
                error: function (e) {

                }

            })


        }

        function cargarRacks() {

            let idPasillo = $('#pasillos option:selected').val();
            idPasillo = idPasillo == "" ? 0 : idPasillo;
            $.ajax({

                url: "{{url('registro/racks_by_pasillo/')}}" + "/" + idPasillo,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let racks = $('#racks');
                    let niveles = $('#niveles');
                    let posiciones = $('#posiciones');
                    clearSelect(racks);
                    clearSelect(niveles);
                    clearSelect(posiciones);
                    response.racks.forEach(function (e) {
                        addToSelect(e.id_rack, e.descripcion, racks);
                    })
                },
                error: function (e) {

                }

            })


        }

        function cargarNiveles() {

            let idRack = $('#racks option:selected').val();
            idRack = idRack == "" ? 0 : idRack;
            $.ajax({

                url: "{{url('registro/niveles_by_rack/')}}" + "/" + idRack,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let niveles = $('#niveles');
                    let posiciones = $('#posiciones');
                    clearSelect(niveles);
                    clearSelect(posiciones);
                    response.niveles.forEach(function (e) {
                        addToSelect(e.id_nivel, e.descripcion, niveles);
                    })
                },
                error: function (e) {

                }

            })


        }

        function cargarPosiciones() {


            let idNivel = $('#niveles option:selected').val();
            idNivel = idNivel == "" ? 0 : idNivel;
            $.ajax({

                url: "{{url('registro/posiciones_by_nivel/')}}" + "/" + idNivel,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let posiciones = $('#posiciones');
                    clearSelect(posiciones);
                    response.posiciones.forEach(function (e) {
                        addToSelect(e.id_posicion, e.descripcion, posiciones);
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
