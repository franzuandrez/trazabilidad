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
    'submenu_icon'=>'fa fa fa-building-o',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Asignar Ubicacion
        @endslot
    @endcomponent

    {!!Form::model($orden,['method'=>'PATCH','id'=>'frm_ubicar','route'=>['recepcion.ubicacion.ubicar',$orden->id_recepcion_enc]])!!}
    {{Form::token()}}


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO.DOCUMENTO</label>
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
                <a href="javascript:limpiar()">
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

    <input type="hidden"
           readonly
           id="fecha_vencimiento"
           class="form-control">
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="ubicacion">UBICACION</label>
        <div class="form-group">
            <input type="text"
                   id="ubicacion"
                   readonly
                   name="ubicacion"
                   onkeydown="if(event.keyCode==13)buscar_ubicacion()"
                   class="form-control">
        </div>
        <div id="ubicacion_a_asignar"   style="display: none">
            <span class="label label-primary" id="bodega_a_asignar">
                <i class="fa fa-building-o"></i>
                AREA
            </span>
            <strong>/</strong>
            <span class="label label-primary" id="sector_a_asignar">
                <i class="fa fa-square-o"></i>
                BODEGA
            </span>
        </div>
        <br>

    </div>
    <input id="codigo_bodega" type="hidden" value="">
    <input id="codigo_ubicacion" type="hidden" value="">
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
    <script src="{{asset('js-brc/tools/lectura_codigo.js')}}"></script>
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

        function buscar_ubicacion() {

            let codigo_bodega = document.getElementById('ubicacion').value;
            let ubicacion = ubicaciones().find(e => e.codigo_barras == codigo_bodega);

            if (typeof ubicacion == 'undefined') {
                alert("Ubicacion no encontrada")
            } else {
                mostrar_ubicacion(ubicacion);
                document.getElementById('codigo_bodega').value = ubicacion.bodega.id_bodega;
                document.getElementById('codigo_ubicacion').value = ubicacion.id_sector;
                document.getElementById('ubicacion').readOnly = true;
                document.getElementById('ubicacion').value = ubicacion.descripcion;
                document.getElementById('cantidad').readOnly = false;
                document.getElementById('cantidad').focus();
            }


        }

        function ubicaciones() {

            let ubicaciones = [];
            ubicaciones = @json($ubicaciones);
            return ubicaciones;
        }

        function mostrar_ubicacion(ubicacion) {

            document.getElementById('ubicacion_a_asignar').style.display = 'block';
            document.getElementById('bodega_a_asignar').childNodes[2].data =" "+ubicacion.bodega.descripcion;
            document.getElementById('sector_a_asignar').childNodes[2].data =" "+ubicacion.descripcion;

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
            //stop_spinner("fa-search");
            document.getElementById('ubicacion').value = "";
            document.getElementById('ubicacion').focus();
            document.getElementById('ubicacion').readOnly = false;
            document.getElementById('cantidad').value = "";
            document.getElementById('cantidad').readOnly = true;
            document.getElementById('ubicacion').readOnly = true;
            document.getElementById('ubicacion_a_asignar').style.display = 'none';
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
                document.getElementById('fecha_vencimiento').value = producto.fecha_vencimiento;
                document.getElementById('ubicacion').focus();
                gl_cantidad_disponible = parseFloat(producto.total);
                gl_id_producto = producto.id_producto;

                document.getElementById('ubicacion').readOnly = false;
                document.getElementById('ubicacion').focus();
            } else {
                alert("Producto no encontrado");
            }


        }


        function getRmiDetalle() {
            let rmiDetalle = [];
            rmiDetalle = @json($rmi_detalle);
            return rmiDetalle;
        }


        function add() {


            let lote = document.getElementById('lote').value.trim();
            let cantidad = parseFloat(document.getElementById('cantidad').value.trim() == "" ? 0 : document.getElementById('cantidad').value.trim());
            let descripcion_producto = document.getElementById('descripcion').value.trim();

            let cantidad_agregada = Array.prototype.slice.call(document.getElementsByClassName(gl_id_producto + "-" + lote)).map(e => e.value).reduce((x, y) => parseFloat(x) + parseFloat(y), 0)

            if (gl_id_producto == 0) {
                alert("producto no valido");
                return;
            }
            if (cantidad == ""|| isNaN(cantidad) ) {
                alert("Cantidad invalida");
                return;
            }

            if (gl_cantidad_disponible < cantidad + cantidad_agregada) {
                alert("La cantidad excede la existencia");
                return;
            }

            if (gl_id_producto == "" || descripcion_producto == "") {
                alert("Producto no válido");
                document.getElementById('codigo_producto').focus();
                return;
            }


            let nombre_bodega = document.getElementById('ubicacion').value;
            let fecha_vencimiento = document.getElementById('fecha_vencimiento').value;

            let codigo_ubicacion = document.getElementById('codigo_ubicacion').value;
            let codigo_bodega = document.getElementById('codigo_bodega').value;

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
                                <input type="hidden" value ='${codigo_bodega}'  name=bodega[] >
                                <input type="hidden" value ='${fecha_vencimiento}'  name=fecha_vencimiento[] >
                            </td>

                 </tr>`;
            if (document.getElementById(codigo_ubicacion) == null) {
                row += `
                <tr id="${codigo_ubicacion}"  class="titulo-ubicacion">
                    <td colspan="4">
                        <span class="label label-primary"><i class="fa fa-square-o"></i> ${nombre_bodega}</span>
                    </td>
                </tr>`;
                row = row + row_producto;
                $("#detalles").append(row);
            } else {
                $('#' + codigo_ubicacion).after(row_producto);
            }
            limpiar();
            document.getElementById('codigo_producto').focus();
            document.getElementById('ubicacion_a_asignar').style.display = 'none';
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
