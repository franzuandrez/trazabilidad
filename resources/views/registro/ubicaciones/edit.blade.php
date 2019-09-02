@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-inbox',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Ubicaciones
        @endslot
    @endcomponent
    @component('componentes.alert-error')
    @endcomponent
    {!!Form::model($ubicacion,['method'=>'PATCH','route'=>['ubicaciones.update',$ubicacion->id_ubicacion]])!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker"
                    id="localidades"
                    required
                    onchange="cargarBodegas()">
                @foreach($localidades as $localidad)
                    @if($localidad->id_localidad == $ubicacion->id_localidad)
                        <option selected value="{{$localidad->id_localidad}}">{{$localidad->descripcion}}</option>
                    @else
                        <option value="{{$localidad->id_localidad}}">{{$localidad->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">BODEGA</label>
            <select name="id_bodega" id="bodegas" required class="form-control selectpicker"
                    onchange="cargarSectores()">
                <option value="">SELECCIONAR BODEGA</option>
                @foreach( $ubicacion->localidad->bodegas as $bodega )
                    @if($ubicacion->id_bodega == $bodega->id_bodega)
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
            <label for="id_encargado">SECTOR</label>
            <select name="id_sector" id="sectores" required class="form-control selectpicker"
                    onchange="cargarPasillos()">
                <option value="">SELECCIONAR SECTOR</option>
                @foreach( $ubicacion->bodega->sectores as $sector)
                    @if($sector->id_sector == $ubicacion->id_sector)
                        <option selected value="{{$sector->id_sector}}">{{$sector->descripcion}}</option>
                    @else
                        <option value="{{$sector->id_sector}}">{{$sector->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">PASILLOS</label>
            <select name="id_pasillo" id="pasillos" required class="form-control selectpicker" onchange="cargarRacks()">
                <option value="">SELECCIONAR PASILLO</option>
                @foreach( $ubicacion->sector->pasillos as $pasillo )
                    @if($pasillo->id_pasillo == $ubicacion->id_pasillo)
                        <option selected value="{{$pasillo->id_pasillo}}" >{{$pasillo->descripcion}}</option>
                    @else
                        <option value="{{$pasillo->id_pasillo}}" >{{$pasillo->descripcion}}</option>
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
                <option value="">SELECCIONAR RACK</option>
                @foreach( $ubicacion->pasillo->racks as $rack )
                    @if($rack->id_rack == $ubicacion->id_rack)
                        <option selected value="{{$rack->id_rack}}" >{{$rack->descripcion}}</option>
                    @else
                        <option value="{{$rack->id_rack}}" >{{$rack->descripcion}}</option>
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
                <option value="">SELECCIONAR NIVEL</option>
                @foreach( $ubicacion->rack->niveles as $nivel )
                    @if($nivel->id_nivel == $ubicacion->id_nivel)
                        <option selected value="{{$nivel->id_nivel}}" >{{$nivel->descripcion}}</option>
                    @else
                        <option value="{{$nivel->id_nivel}}" >{{$nivel->descripcion}}</option>
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
                    required
                    onchange="cargarBines()"
                    class="form-control selectpicker"
            >
                <option value="">SELECCIONAR POSICION</option>
                @foreach( $ubicacion->nivel->posiciones as $posicion )
                    @if($posicion->id_posicion == $posicion->id_posicion)
                        <option selected value="{{$posicion->id_posicion}}" >{{$posicion->descripcion}}</option>
                    @else
                        <option value="{{$posicion->id_posicion}}" >{{$posicion->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_bin">BINES</label>
            <select name="id_bin"
                    id="bines"
                    required
                    onchange="cargarCodigoInterno()"
                    class="form-control selectpicker"
            >
                <option value="">SELECCIONAR BIN</option>
                @foreach( $ubicacion->posicion->bines as $bin )
                    @if($bin->id_bin == $bin->id_bin)
                        <option selected value="{{$bin->id_bin}}" >{{$bin->descripcion}}</option>
                    @else
                        <option value="{{$bin->id_bin}}" >{{$bin->descripcion}}</option>
                    @endif
                @endforeach
            </select>
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
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/ubicaciones')}}">
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
        var listLocalidades = @json($localidades);
        var listBodegas = @json($ubicacion->localidad->bodegas);
        var listSectores = @json($ubicacion->bodega->sectores);
        var listPasillos = @json($ubicacion->sector->pasillos);
        var listRacks = @json($ubicacion->pasillo->racks);
        var listNiveles =@json($ubicacion->rack->niveles) ;
        var listPosiciones = @json($ubicacion->nivel->posiciones);
        var listBines = @json($ubicacion->posicion->bines);

        function mostrarCodigoBarras(value, cant, pos) {

            let codigo = document.getElementById('codigo_barras').value.substr(0, pos);
            let newValue = "";
            if (value != "") {
                newValue = String(value).padStart(cant, "0");
            }

            document.getElementById('codigo_barras').value = codigo + newValue;
        }

        function cargarBodegas() {


            let idLocalidad = $('#localidades option:selected').val();
            idLocalidad = idLocalidad == "" ? 0 : idLocalidad;
            $('.loading').show();
            $.ajax({

                url: "{{url('registro/bodegas_by_localidad/')}}" + "/" + idLocalidad,
                type: "get",
                dataType: "json",
                success: function (response) {
                    listBodegas = response.bodegas;
                    let bodegas = $('#bodegas');
                    let sectores = $('#sectores');
                    let pasillos = $('#pasillos');
                    let racks = $('#racks');
                    let niveles = $('#niveles');
                    let posiciones = $('#posiciones');
                    let bines = $('#bines');
                    clearSelect(bodegas);
                    clearSelect(sectores);
                    clearSelect(pasillos);
                    clearSelect(racks);
                    clearSelect(niveles);
                    clearSelect(posiciones);
                    clearSelect(bines);
                    mostrarCodigoBarras(idLocalidad, 2, 0);

                    response.bodegas.forEach(function (e) {
                        addToSelect(e.id_bodega, e.descripcion, bodegas);
                    })
                    $('.loading').hide();
                },
                error: function (e) {

                }

            })


        }

        function cargarSectores() {


            let idBodega = $('#bodegas option:selected').val();
            idBodega = idBodega == "" ? 0 : idBodega;
            $('.loading').show();
            $.ajax({

                url: "{{url('registro/sectores_by_bodega/')}}" + "/" + idBodega,
                type: "get",
                dataType: "json",
                success: function (response) {
                    listSectores = response.sectores;
                    let sectores = $('#sectores');
                    let pasillos = $('#pasillos');
                    let racks = $('#racks');
                    let niveles = $('#niveles');
                    let posiciones = $('#posiciones');
                    let bines = $('#bines');
                    clearSelect(sectores);
                    clearSelect(pasillos);
                    clearSelect(racks);
                    clearSelect(niveles);
                    clearSelect(posiciones);
                    clearSelect(bines);
                    let codigoInterno = "";
                    if (idBodega != 0) {
                        codigoInterno = listBodegas.find(bod => bod.id_bodega == idBodega).codigo_interno;
                    }
                    mostrarCodigoBarras(codigoInterno, 2, 2);
                    response.sectores.forEach(function (e) {
                        addToSelect(e.id_sector, e.descripcion, sectores);
                    })
                    $('.loading').hide();
                },
                error: function (e) {

                }

            })


        }

        function cargarPasillos() {


            let idSector = $('#sectores option:selected').val();
            idSector = idSector == "" ? 0 : idSector;
            $('.loading').show();
            $.ajax({

                url: "{{url('registro/pasillos_by_sector/')}}" + "/" + idSector,
                type: "get",
                dataType: "json",
                success: function (response) {

                    listPasillos = response.pasillos;
                    let pasillos = $('#pasillos');
                    let racks = $('#racks');
                    let niveles = $('#niveles');
                    let posiciones = $('#posiciones');
                    let bines = $('#bines');
                    clearSelect(pasillos);
                    clearSelect(racks);
                    clearSelect(niveles);
                    clearSelect(posiciones);
                    clearSelect(bines);

                    let codigoInterno = "";
                    if (idSector != 0) {
                        codigoInterno = listSectores.find(sec => sec.id_sector == idSector).codigo_interno;
                    }
                    mostrarCodigoBarras(codigoInterno, 2, 4);
                    response.pasillos.forEach(function (e) {
                        addToSelect(e.id_pasillo, e.descripcion, pasillos);
                    });
                    $('.loading').hide();
                },
                error: function (e) {

                }

            })


        }

        function cargarRacks() {

            let idPasillo = $('#pasillos option:selected').val();
            idPasillo = idPasillo == "" ? 0 : idPasillo;
            $('.loading').show();
            $.ajax({

                url: "{{url('registro/racks_by_pasillo/')}}" + "/" + idPasillo,
                type: "get",
                dataType: "json",
                success: function (response) {

                    listRacks = response.racks;
                    let racks = $('#racks');
                    let niveles = $('#niveles');
                    let posiciones = $('#posiciones');
                    let bines = $('#bines');
                    clearSelect(racks);
                    clearSelect(niveles);
                    clearSelect(posiciones);
                    clearSelect(bines);

                    let codigoInterno = "";
                    if (idPasillo != 0) {
                        codigoInterno = listPasillos.find(pas => pas.id_pasillo == idPasillo).codigo_interno;
                    }
                    mostrarCodigoBarras(codigoInterno, 2, 6);
                    response.racks.forEach(function (e) {
                        addToSelect(e.id_rack, e.descripcion, racks);
                    })
                    $('.loading').hide();
                },
                error: function (e) {

                }

            })


        }

        function cargarNiveles() {

            let idRack = $('#racks option:selected').val();
            idRack = idRack == "" ? 0 : idRack;
            $('.loading').show();
            $.ajax({

                url: "{{url('registro/niveles_by_rack/')}}" + "/" + idRack,
                type: "get",
                dataType: "json",
                success: function (response) {

                    listNiveles = response.niveles;
                    let niveles = $('#niveles');
                    let posiciones = $('#posiciones');
                    let bines = $("#bines");
                    clearSelect(niveles);
                    clearSelect(posiciones);
                    clearSelect(bines)

                    let codigoInterno = "";
                    if (idRack != 0) {
                        codigoInterno = listRacks.find(sec => sec.id_rack == idRack).codigo_interno;
                    }

                    mostrarCodigoBarras(codigoInterno, 2, 8);
                    response.niveles.forEach(function (e) {
                        addToSelect(e.id_nivel, e.descripcion, niveles);
                    });
                    $('.loading').hide();
                },
                error: function (e) {

                }

            })


        }

        function cargarPosiciones() {


            let idNivel = $('#niveles option:selected').val();
            idNivel = idNivel == "" ? 0 : idNivel;
            $('.loading').show();
            $.ajax({

                url: "{{url('registro/posiciones_by_nivel/')}}" + "/" + idNivel,
                type: "get",
                dataType: "json",
                success: function (response) {
                    listPosiciones = response.posiciones;
                    let posiciones = $('#posiciones');
                    let bines = $("#bines");
                    clearSelect(posiciones);
                    clearSelect(bines);

                    let codigoInterno = "";
                    if (idNivel != 0) {
                        codigoInterno = listNiveles.find(sec => sec.id_nivel == idNivel).codigo_interno;
                    }

                    mostrarCodigoBarras(codigoInterno, 1, 10);
                    response.posiciones.forEach(function (e) {
                        addToSelect(e.id_posicion, e.descripcion, posiciones);
                    });
                    $('.loading').hide();
                },
                error: function (e) {

                }

            })


        }

        function cargarBines() {

            let idPosicion = $('#posiciones option:selected').val();
            idPosicion = idPosicion == "" ? 0 : idPosicion;
            $('.loading').show();
            $.ajax({
                url: "{{url('registro/bines_by_posicion/')}}" + "/" + idPosicion,
                type: "get",
                dataType: "json",
                success: function (response) {
                    listBines = response.bines;
                    let bines = $('#bines');
                    clearSelect(bines);
                    let codigoInterno = "";
                    if (idPosicion != 0) {
                        codigoInterno = listPosiciones.find(sec => sec.id_posicion == idPosicion).codigo_interno;
                    }
                    mostrarCodigoBarras(codigoInterno, 1, 12);
                    response.bines.forEach(function (e) {
                        addToSelect(e.id_bin, e.descripcion, bines);
                    });
                    $('.loading').hide();
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

        function cargarCodigoInterno() {
            $('.loading').show();
            let idBin = $('#bines option:selected').val();
            let codigoInterno = "";
            if (idBin != "") {
                codigoInterno = listBines.find(bin => bin.id_bin == idBin).codigo_interno;
            }
            mostrarCodigoBarras(codigoInterno, 1, 14);
            $('.loading').hide();
        }


    </script>
@endsection
