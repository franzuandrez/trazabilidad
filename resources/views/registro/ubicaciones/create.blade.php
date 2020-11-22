@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa   fa-map-marker',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Ubicaciones
        @endslot
    @endcomponent
    @component('componentes.alert-error')
    @endcomponent
    {!!Form::open(array('url'=>'registro/ubicaciones/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker"
                    id="localidades"
                    required
                    onchange="cargarBodegas()">
                <option value="">Seleccionar LOCALIDAD</option>
                @foreach($localidades as $localidad)
                    <option value="{{$localidad->id_localidad}}">{{$localidad->descripcion}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">BODEGA</label>
            <select name="id_bodega" id="bodegas" required class="form-control selectpicker"
                    onchange="cargarSectores()">
                <option value="">Seleccionar BODEGA</option>

            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">SECTOR</label>
            <select name="id_sector" id="sectores" required class="form-control selectpicker"
                    onchange="cargarPasillos()">
                <option value="">Seleccionar SECTOR</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">PASILLOS</label>
            <select name="id_pasillo" id="pasillos" required class="form-control selectpicker" onchange="cargarRacks()">
                <option value="">Seleccionar PASILLO</option>
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
                <option value="">Seleccionar POSICION</option>
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
                <option value="">Seleccionar BIN</option>
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">Codigo  Barras</label>
            <input type="text"
                   name="codigo_barras"
                   required
                   id="codigo_barras"
                   readonly
                   value="{{old('codigo_barras')}}"
                   class="form-control">
        </div>
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('registro/ubicaciones ')}}">
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
        var listLocalidades = [];
        var listBodegas = [];
        var listSectores = [];
        var listPasillos = [];
        var listRacks = [];
        var listNiveles = [];
        var listPosiciones = [];
        var listBines = [];

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
