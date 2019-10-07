@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <style>

    </style>
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ubicar',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-arrow-right',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Ubicacion
        @endslot
    @endcomponent

    {!!Form::model($orden,['method'=>'PATCH','id'=>'frm_ubicar','route'=>['recepcion.ubicacion.ubicar',$orden->id_recepcion_enc]])!!}
    {{Form::token()}}


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. ORDEN DE COMPRA</label>
            <input type="text"
                   readonly
                   name="orden_compra"
                   value="{{$orden->orden_compra}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="codigo_producto">CODIGO PRODUCTO</label>
        <div class="input-group">
            <input type="text"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)buscar_producto(document.getElementById('codigo_producto'))"
                   name="codigo_producto"
                   class="form-control">
            <div class="input-group-btn">
                <a href="javascript:buscar_producto(document.getElementById('codigo_producto'))"
                >
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-search " aria-hidden="true"></i>
                    </button>
                </a>
                <a href="javascript:limpiar_producto()">
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="descripcion">PRODUCTO</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   id="descripcion"
                   name="descripcion"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="lote">LOTE</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   id="lote"
                   name="lote"
                   class="form-control">
        </div>
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    <div id="tab-ubicacion" class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="ubicacion">UBICACION</label>
        <div class="input-group">
            <input type="text"
                   readonly
                   id="ubicacion"
                   onkeydown="if(event.keyCode==13)buscar_ubicacion(document.getElementById('ubicacion').value,document.getElementById('icon-search'))"
                   name="ubicacion"
                   class="form-control">
            <div class="input-group-btn">
                <a href="javascript:buscar_ubicacion(document.getElementById('ubicacion').value,document.getElementById('icon-search'))"
                >
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-search " id="icon-search" aria-hidden="true"></i>
                    </button>

                </a>
                <a href="javascript:limpiar_ubicacion()">
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="cantidad">CANTIDAD</label>
        <div class="form-group">
            <input type="text"
                   id="cantidad"
                   onkeydown="if(event.keyCode==13 || event.keyCode==10)add()"
                   readonly
                   name="cantidad"
                   class="form-control">
        </div>
    </div>
    <input type="hidden" id="user_acepted" name="user_acepted">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <tr>
                    <th></th>
                    <th>DESCRIPCION</th>
                    <th>LOTE</th>
                    <th>CANTIDAD</th>
                    <th>UBICACION</th>
                </tr>
                </thead>
                <tbody id="detalles">
                </tbody>
            </table>
        </div>

    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default"
                    onclick="solicitar_credenciales()"
                    type="button">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('recepcion/ubicacion')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>
        </div>
    </div>
    @include('componentes.modal-ubicacion')
    @component('componentes.modal-verificacion',
        ['ruta'=>route('users.verificar'),
        'id_form'=>'frm_ubicar'
        ])
    @endcomponent
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            document.getElementById('codigo_producto').focus();
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

        });

        function solicitar_credenciales() {

            if (existe_producto_pendiente()) {
                alert("Orden incompleta, aún falta producto por ubicar");
            } else {
                $('#autorizacion').modal();
            }

        }

        function existe_producto_pendiente() {

            let cantidades = Array.prototype.slice.call(document.getElementsByName('cantidad[]'));


            let existeProductoPendiente = false;
            let cantidad = 0;

            let producto_lote = "";
            getRmiDetalle().forEach(function (prod) {
                producto_lote = prod.id_producto + "-" + prod.lote;
                cantidad = Array.prototype.slice.call(cantidades).filter(x => x.className == producto_lote).map(e => parseFloat(e.value)).reduce((x, y) => x + y, 0);
                if (parseFloat(prod.total) - cantidad > 0) {
                    existeProductoPendiente = true;
                }
            });


            return existeProductoPendiente;

        }

        function buscar_ubicacion(input, element = 0) {


            let search = element == 0 ? true : element.classList.contains('fa-search');

            if (search) {
                let codigo_barras = input == "" ? 0 : input;
                start_spinner();
                $.ajax({
                    url: "{{url('registro/ubicaciones/search')}}" + "/" + codigo_barras,
                    type: "get",
                    dataType: "json",
                    success: function (response) {

                        let ubicacion = response;
                        if (ubicacion.length == 0) {
                            alert("Ubicacion no encontrada");
                            stop_spinner("fa-search");
                        } else if (ubicacion[0].estado == 0) {
                            alert("Ubicacion no disponible");
                            stop_spinner("fa-search");
                        } else {
                            mostrar_ubicacion(ubicacion[0]);
                        }

                    },
                    error: function (e) {

                    }
                })
            } else {

                $('#modal-ubicacion').modal();
            }


        }

        function mostrar_ubicacion(ubicacion) {

            var tmr = setTimeout(function () {

                stop_spinner("fa-eye");
                var tmr_ = setTimeout(function () {

                    document.getElementById('ubicacion').readOnly = true;
                    document.getElementById('td-localidad').innerText = ubicacion.localidad.descripcion;
                    document.getElementById('td-id_localidad').value = ubicacion.localidad.id_localidad;
                    document.getElementById('td-bodega').innerText = ubicacion.bodega.descripcion;
                    document.getElementById('td-id_bodega').value = ubicacion.bodega.id_bodega;
                    document.getElementById('td-sector').innerText = ubicacion.sector.descripcion;
                    document.getElementById('td-id_sector').value = ubicacion.sector.id_sector;
                    document.getElementById('td-pasillo').innerText = ubicacion.pasillo.descripcion;
                    document.getElementById('td-id_pasillo').value = ubicacion.pasillo.id_pasillo;
                    document.getElementById('td-rack').innerText = ubicacion.rack.descripcion;
                    document.getElementById('td-id_rack').value = ubicacion.rack.id_rack;
                    document.getElementById('td-nivel').innerText = ubicacion.nivel.descripcion;
                    document.getElementById('td-id_nivel').value = ubicacion.nivel.id_nivel;
                    document.getElementById('td-posicion').innerText = ubicacion.posicion.descripcion;
                    document.getElementById('td-id_posicion').value = ubicacion.posicion.id_posicion;
                    document.getElementById('td-bin').innerText = ubicacion.bin.descripcion;
                    document.getElementById('td-id_bin').value = ubicacion.bin.id_bin;

                    document.getElementById('cantidad').readOnly = false;
                    document.getElementById('cantidad').focus();
                    clearTimeout(tmr_);
                }, 0);
                clearTimeout(tmr);
            }, 500);


        }

        function stop_spinner(icon) {

            document.getElementById("icon-search").classList.remove("fa-spin");
            document.getElementById("icon-search").classList.remove("fa-refresh");
            document.getElementById("icon-search").classList.remove("fa-eye");
            document.getElementById("icon-search").classList.add(icon);
        }

        function start_spinner() {
            document.getElementById('icon-search').classList.remove("fa-eye");
            document.getElementById("icon-search").classList.add("fa-spin");
            document.getElementById("icon-search").classList.add("fa-refresh");
            document.getElementById("icon-search").classList.remove("fa-search");
        }

        function cantidad_focus() {
            var tmr = setTimeout(function () {
                document.getElementById('cantidad').focus();
                clearTimeout(tmr)
            }, 350);

        }

        function limpiar_ubicacion() {
            stop_spinner("fa-search");
            document.getElementById('ubicacion').value = "";
            document.getElementById('ubicacion').focus();
            document.getElementById('ubicacion').readOnly = false;
            document.getElementById('cantidad').value = "";
            document.getElementById('cantidad').readOnly = true;
        }

        var gl_id_producto = 0;
        var gl_cantidad_disponible = 0;

        function buscar_producto(input) {

            let infoCodigoBarras = descomponerInput(input);
            let codigo_barras = infoCodigoBarras[1];
            let lote = infoCodigoBarras[3];

            let producto = getRmiDetalle().filter(e => e.producto.codigo_barras == codigo_barras).find(e => e.lote == lote);

            if (typeof producto != 'undefined') {
                document.getElementById('lote').value = producto.lote;
                document.getElementById('descripcion').value = producto.producto.descripcion;
                document.getElementById('ubicacion').focus();
                gl_cantidad_disponible = parseFloat(producto.total);
                gl_id_producto = producto.id_producto;

                document.getElementById('ubicacion').readOnly = false;
                document.getElementById('ubicacion').focus();
            } else {
                alert("Producto no encontrado");
            }


        }

        function descomponerInput(input) {

            var codigoBarras = input.value;
            var codigo, fecha_vencimiento, lote;
            if (codigoBarras.length <= 14) {
                codigo = codigoBarras;
                fecha_vencimiento = "";
                lote = "";
            } else {
                codigo = codigoBarras.substring(2, 16);
                fecha_vencimiento = codigoBarras.substring(18, 24);
                lote = codigoBarras.substring(26, codigoBarras.length);
            }


            return ["", codigo, fecha_vencimiento, lote];


        }

        function getRmiDetalle() {
            let rmiDetalle = [];
            rmiDetalle = @json($rmi_detalle);
            return rmiDetalle;
        }


        function add() {


            let lote = document.getElementById('lote').value;
            let cantidad = parseFloat(document.getElementById('cantidad').value);
            let descripcion_producto = document.getElementById('descripcion').value;

            let cantidad_agregada = Array.prototype.slice.call(document.getElementsByClassName(gl_id_producto + "-" + lote)).map(e => e.value).reduce((x, y) => parseFloat(x) + parseFloat(y), 0)

            if (gl_id_producto == 0) {
                alert("producto no valido");
                return;
            }
            if (cantidad == "") {
                alert("Cantidad invalida");
                return;
            }

            if (gl_cantidad_disponible < cantidad + cantidad_agregada) {
                alert("La cantidad excede la existencia");
                return;
            }


            let nombre_bodega = document.getElementById('td-bodega').innerText.toUpperCase();
            let nombre_sector = document.getElementById('td-sector').innerText.toUpperCase();
            let nombre_pasillo = document.getElementById('td-pasillo').innerText.toUpperCase();
            let nombre_rack = document.getElementById('td-rack').innerText.toUpperCase();
            let nombre_nivel = document.getElementById('td-nivel').innerText.toUpperCase();
            let nombre_posicion = document.getElementById('td-posicion').innerText.toUpperCase();
            let nombre_bin = document.getElementById('td-bin').innerText.toUpperCase();

            let id_bodega = document.getElementById('td-id_bodega').value;
            let id_sector = document.getElementById('td-id_sector').value;
            let id_pasillo = document.getElementById('td-id_pasillo').value;
            let id_rack = document.getElementById('td-id_rack').value;

            let ubicacion = id_bodega + id_sector + id_pasillo + id_rack;

            let codigo_ubicacion = document.getElementById('ubicacion').value;


            let row = '';
            let row_producto = `
                 <tr class="row-producto-added" id='${gl_id_producto}-${lote}-${codigo_ubicacion}'>
                            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
                            <td><input type="hidden" name="descripcion_producto[]" value="${descripcion_producto}" > ${descripcion_producto}</td>
                            <td>
                                <input type="hidden" value='${lote}' name=lote[]>${lote}</td>
                                <input type="hidden" value='${gl_id_producto}' name=id_producto[]>${lote}</td>
                            <td >
                                <input type="hidden" value ='${cantidad}'  class="${gl_id_producto}-${lote}"  name=cantidad[] >${cantidad}
                                <input type="hidden" value ='${codigo_ubicacion}'  name=ubicacion[] >
                            </td>
                            <td >
                                 <span class="label label-primary"><i class="fa fa-sort-numeric-desc"></i> ${nombre_nivel}</span>
                                 <span class="label label-primary"><i class="fa fa fa-ellipsis-v"></i> ${nombre_posicion}</span>
                                 <span class="label label-primary"><i class="fa fa-inbox"></i> ${nombre_bin}</span>
                            </td>
                 </tr>`;
            if (document.getElementById(ubicacion) == null) {
                row += `
                <tr id="${ubicacion}"  class="titulo-ubicacion">
                    <td colspan="5">
                        <span class="label label-primary"><i class="fa fa-building-o"></i> ${nombre_bodega}</span>
                        <strong>/</strong>
                        <span class="label label-primary "><i class="fa fa-square-o"></i> ${nombre_sector}</span>
                        <strong>/</strong>
                        <span class="label label-primary "><i class="fa fa-pause"></i> ${nombre_pasillo}</span>
                        <strong>/</strong>
                        <span class="label label-primary "><i class="fa fa-tasks"></i> ${nombre_rack}</span>
                    </td>
                </tr>`;
                row = row + row_producto;
                $("#detalles").append(row);
            } else {
                $('#' + ubicacion).after(row_producto);
            }
            limpiar();
            document.getElementById('codigo_producto').focus();
        }

        function limpiar() {
            limpiar_ubicacion();
            limpiar_producto();
        }

        function limpiar_producto() {
            document.getElementById('codigo_producto').value = "";
            document.getElementById('lote').value = "";
            document.getElementById('descripcion').value = "";
            document.getElementById('ubicacion').readOnly = true;
            document.getElementById('codigo_producto').focus();
        }

        function removeFromTable(element) {

            let td = $(element).parent();
            let row = td.parent();

            if (row.prev().hasClass('titulo-ubicacion')) {
                row.prev().remove();
            }
            row.remove();
        }
    </script>
@endsection
