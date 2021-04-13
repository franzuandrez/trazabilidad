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
            Recepcion PT
        @endslot
        @slot('submenu')
            Asignar Ubicacion
        @endslot
    @endcomponent

    {!!Form::model($entrega,['method'=>'PATCH','id'=>'frm_ubicar','route'=>['produccion.update_recepcion_pt',$entrega->id]])!!}
    {{Form::token()}}

    <div class="col-lg-4 col-sm-4  col-md-12 col-xs-12">
        <div class="form-group">
            <label for="codigo">ENTREGA</label>
            <input type="text"
                   readonly
                   value="{{$entrega->id}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4  col-md-12 col-xs-12">
        <div class="form-group">
            <label for="codigo">CREADO POR </label>
            <input type="text"
                   readonly
                   value="{{$entrega->creado_por->nombre}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4  col-sm-4  col-md-12 col-xs-12">
        <div class="form-group">
            <label for="codigo">FECHA</label>
            <input type="text"
                   readonly
                   value="{{$entrega->fecha_hora->format('H:i:s d/m/Y')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="codigo_producto">NO. TARIMA</label>
        <div class="input-group">
            <input type="text"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)buscar_no_tarima(document.getElementById('codigo_producto'))"
                   name="codigo_producto"
                   class="form-control">
            <div class="input-group-btn">
                <a href="javascript:buscar_no_tarima(document.getElementById('codigo_producto'))"
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
    <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">

            <label for="unidad_medida">UNIDAD MEDIDA</label>
            <div class="form-group">
                <input type="text"
                       readonly
                       id="unidad_medida" name="unidad_medida"
                       class="form-control">
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
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
        <div id="ubicacion_a_asignar" style="display: none">
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
                    <th>TARIMA</th>
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
            <a href="{{url('produccion/recepcion_pt')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>
        </div>
    </div>
    @include('componentes.modal-ubicacion')
    @include('entregas.recepcion_pt.modal')
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

        function buscar_no_tarima(codigo) {

            let no_tarima = descomponerCodigoSSCCInput(codigo);
            let detalle = getRmiDetalle()
                .filter(e => e.no_tarima == no_tarima);


            if (detalle.length == 0) {
                alert("No. Tarima Invalida");
                return;
            }

            const total_unidades = [...new Set(getRmiDetalle()
                .filter(e => e.no_tarima == no_tarima).map((car) => car.unidad_medida))].length;

            if (total_unidades > 1) {
                $('#modal-unidades_medida').modal();
                mostrar_productos_en_tarima(detalle, no_tarima);
            } else {

                let producto = detalle[0];
                const cantidad = detalle.map(x => parseFloat(x.cantidad)).reduce((x, y) => (x + y), 0);
                console.log(producto);
                document.getElementById('lote').value = producto.control_trazabilidad.lote;
                document.getElementById('descripcion').value = producto.control_trazabilidad.producto.descripcion;
                document.getElementById('fecha_vencimiento').value = producto.control_trazabilidad.fecha_vencimiento;
                gl_cantidad_disponible = cantidad;
                gl_id_producto = producto.control_trazabilidad.producto.id_producto;
                tipo_producto = producto.control_trazabilidad.producto.tipo_producto;
                document.getElementById('ubicacion').readOnly = false;
                document.getElementById('ubicacion').value = "";
                document.getElementById('unidad_medida').disabled = true;
                document.getElementById('cantidad').value = cantidad;
                $('#unidad_medida').val(producto.unidad_medida);
                select_bodega();
            }


        }

        function mostrar_productos_en_tarima(detalle, no_tarima) {


            const tipo_producto = detalle[0].control_trazabilidad.producto.tipo_producto;
            const id_producto = detalle[0].control_trazabilidad.producto.id_producto;
            const descripcion = detalle[0].control_trazabilidad.producto.descripcion;
            const lote = detalle[0].control_trazabilidad.lote;
            const fecha_vencimiento = detalle[0].control_trazabilidad.fecha_vencimiento;
            const cantidad_unidades = detalle.filter(x => x.unidad_medida == 'UN').map(x => parseFloat(x.cantidad)).reduce((x, y) => (x + y), 0);
            const cantidad_cajas = detalle.filter(x => x.unidad_medida == 'CA').map(x => parseFloat(x.cantidad)).reduce((x, y) => (x + y), 0);
            $('#detalles_cantidades').empty();
            let rows =
                ` <tr>
                      <td>CA</td>
                      <td>${cantidad_cajas}</td>
                      <td>
                    <div class="form-group">
                            <input type="text"
                                   onkeydown="if(event.keyCode==13)buscar_ubicacion_from_modal(this,'CA','${tipo_producto}',${id_producto},${cantidad_cajas},'${descripcion}','${no_tarima}','${lote}','${fecha_vencimiento}')"
                                   class="form-control">
                        </div>
                    </td>
                    </tr>
                    <tr>
                      <td>UN</td>
                     <td>${cantidad_unidades}</td>
                      <td>
                 <div class="form-group">
                            <input type="text"
                                   onkeydown="if(event.keyCode==13)buscar_ubicacion_from_modal(this,'UN','${tipo_producto}',${id_producto},${cantidad_unidades},'${descripcion}','${no_tarima}','${lote}','${fecha_vencimiento}')"
                                   class="form-control">
                        </div>
                    </td>
                    </tr>
                `;

            $('#detalles_cantidades').append(rows);

        }

        function buscar_ubicacion_from_modal(e, un_medida, tipo, id_prod, cantidad, descripcion, tarima, lote, fecha_vencimiento) {
            buscar_ubicacion(e.value.trim(), un_medida, tipo, id_prod, cantidad, descripcion, tarima, lote, fecha_vencimiento);
            e.readOnly = true;
            e.value = "";
        }

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
                detalle = prod;

                prod = prod.control_trazabilidad;

                producto_lote = prod.id_producto + "-" + prod.lote + '-' + detalle.unidad_medida + '-' + detalle.no_tarima;

                cantidad = Array.prototype.slice.call(cantidades).filter(x => x.className == producto_lote).map(e => parseFloat(e.value)).reduce((x, y) => x + y, 0);

                if (parseFloat(detalle.cantidad) - cantidad > 0) {
                    existeProductoPendiente = true;
                }
            });


            return existeProductoPendiente;

        }

        function buscar_ubicacion(codigo_ubicacion = '', u_medida = '', tipo_prod = '', id_producto = 0, cantidad = 0, descripcion_prod = '', no_tarima = '', no_lote = '',
                                  fecha_venc = '') {


            let codigo_bodega = codigo_ubicacion == '' ? document.getElementById('ubicacion').value.trim() : codigo_ubicacion;
            let ubicacion = ubicaciones().find(e => e.codigo_barras == codigo_bodega);

            let unidad_medida = $('#unidad_medida').val();
            if (tipo_prod != '') {
                tipo_producto = tipo_prod;
                console.log(tipo_producto);
            }
            if (id_producto != 0) {
                gl_id_producto = id_producto;
            }

            if ((tipo_producto == 'MP' && codigo_bodega !== '4140754842000017') ||
                (tipo_producto == 'ME' && codigo_bodega !== '4140754842000024') ||
                (codigo_bodega !== '4140754842000031' && (tipo_producto == 'PT' && unidad_medida == 'CA')) ||
                (codigo_bodega !== '4140754842000208' && (tipo_producto == 'PT' && unidad_medida == 'UN'))

            ) {
                alert(" Bodega incorrecta");
                return;
            }

            if (u_medida != '') {
                unidad_medida = u_medida;
                console.log(unidad_medida);
                console.log(unidad_medida === "" || unidad_medida === "0");
            }
            if (unidad_medida === "" || unidad_medida === "0") {
                alert("Seleccione unidad de medida");
                return;
            }
            if (typeof ubicacion == 'undefined') {
                alert("Ubicacion no encontrada")
            } else {
                mostrar_ubicacion(ubicacion);
                document.getElementById('codigo_bodega').value = ubicacion.bodega.id_bodega;
                document.getElementById('codigo_ubicacion').value = ubicacion.id_sector;
                document.getElementById('ubicacion').readOnly = true;
                document.getElementById('ubicacion').value = ubicacion.descripcion;
                add(unidad_medida, cantidad, descripcion_prod, no_tarima, no_lote, fecha_venc);
            }


        }

        function ubicaciones() {

            let ubicaciones = [];
            ubicaciones = @json($ubicaciones);
            return ubicaciones;
        }

        function mostrar_ubicacion(ubicacion) {

            document.getElementById('ubicacion_a_asignar').style.display = 'block';
            document.getElementById('bodega_a_asignar').childNodes[2].data = " " + ubicacion.bodega.descripcion;
            document.getElementById('sector_a_asignar').childNodes[2].data = " " + ubicacion.descripcion;

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
            document.getElementById('ubicacion_a_asignar').style.display = 'none';
        }

        var gl_id_producto = 0;
        var gl_cantidad_disponible = 0;
        var tipo_producto = 'MP';

        function getRmiDetalle() {
            let rmiDetalle = [];
            rmiDetalle = @json($entrega->detalle);
            return rmiDetalle;
        }

        function select_bodega() {


            let unidad_medida = $('#unidad_medida').val();
            if (unidad_medida === "" || unidad_medida === "0") {
                alert("Seleccione unidad de medida");
                return;
            }
            if (unidad_medida === 'UN') {
                document.getElementById('ubicacion').value = '4140754842000208';
                buscar_ubicacion();
            } else {
                limpiar_ubicacion();
                document.getElementById('ubicacion').readOnly = false;
                document.getElementById('ubicacion').focus();

            }


        }

        function add(u_medida = '', cant = 0, descripcion_prod = '', tarima = '', no_lote = '', fecha_venc = '') {


            let lote = document.getElementById('lote').value.trim();

            if (no_lote != '') {
                lote = no_lote;
            }
            let cantidad = parseFloat(document.getElementById('cantidad').value.trim() === "" ? 0 : document.getElementById('cantidad').value.trim());

            if (cant != 0) {
                cantidad = cant;
                gl_cantidad_disponible = cantidad;
            }
            let descripcion_producto = document.getElementById('descripcion').value.trim();
            let unidad_medida = $('#unidad_medida').val();
            if (u_medida != '') {
                unidad_medida = u_medida;

            }
            let no_tarima = descomponerCodigoSSCCInput(document.getElementById('codigo_producto'));
            if (tarima != '') {
                no_tarima = tarima;
            }

            let cantidad_agregada = Array.prototype.slice.call(document.getElementsByClassName(gl_id_producto + "-" + lote + '-' + unidad_medida + '-' + no_tarima)).map(e => e.value).reduce((x, y) => parseFloat(x) + parseFloat(y), 0)

            if (unidad_medida === "" || unidad_medida === "0") {
                alert("Seleccione unidad de medida");
                return;
            }
            if (gl_id_producto == 0) {
                alert("producto no valido");
                return;
            }
            if (cantidad == "" || isNaN(cantidad)) {
                alert("Cantidad invalida");
                return;
            }

            if (gl_cantidad_disponible < cantidad + cantidad_agregada) {
                alert("La cantidad excede la existencia");
                return;
            }

            if (descripcion_prod != '') {
                descripcion_producto = descripcion_prod;
            }
            if (gl_id_producto == "" || descripcion_producto == "") {
                alert("Producto no válido");
                document.getElementById('codigo_producto').focus();
                return;
            }


            let nombre_bodega = document.getElementById('ubicacion').value;
            let fecha_vencimiento = document.getElementById('fecha_vencimiento').value;


            if (fecha_venc != '') {
                fecha_vencimiento = fecha_venc;
            }
            console.log(fecha_vencimiento);

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
                                <input type="hidden" value ='${cantidad}'  class="${gl_id_producto}-${lote}-${unidad_medida}-${no_tarima}"  name=cantidad[] >${cantidad}
                                <input type="hidden" value ='${codigo_ubicacion}'  name=ubicacion[] >
                                <input type="hidden" value ='${codigo_bodega}'  name=bodega[] >
                                <input type="hidden" value ='${fecha_vencimiento}'  name=fecha_vencimiento[] >
                            </td>
                            <td>
                                ${no_tarima}
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
            reset_unidad_medida();
            document.getElementById('cantidad').value = "";
        }

        function reset_unidad_medida() {
            document.getElementById('unidad_medida').value = "";
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
