@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-ellipsis-v',
    'operation_icon'=>'fa-pencil',])
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
            <select name="id_localidad" class="form-control selectpicker" id="localidades" onchange="cargarBodegas()">
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
            <select name="id_bodega" id="bodegas" class="form-control selectpicker" onchange="cargarSectores()">
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
            <select name="id_sector" id="sectores" class="form-control selectpicker" onchange="cargarPasillos()">
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
            <select name="id_pasillo" id="pasillos" class="form-control selectpicker" onchange="cargarRacks()">
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
            <input type="text" name="codigo_barras" value="{{$posicion->codigo_barras}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" value="{{$posicion->descripcion}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/posiciones')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
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
                    clearSelect(bodegas);
                    clearSelect(sectores);
                    clearSelect(pasillos);
                    clearSelect(racks);
                    clearSelect(niveles);
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
                    clearSelect(sectores);
                    clearSelect(pasillos);
                    clearSelect(racks);
                    clearSelect(niveles);
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
                    clearSelect(pasillos);
                    clearSelect(racks);
                    clearSelect(niveles);
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
                    clearSelect(racks);
                    clearSelect(niveles);
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
                    clearSelect(niveles);
                    response.niveles.forEach(function (e) {
                        addToSelect(e.id_nivel, e.descripcion, niveles);
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
