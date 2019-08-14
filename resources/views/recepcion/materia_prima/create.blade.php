@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-sign-in',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Materia Prima
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'recepcion/materia_prima/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="producto">MATERIA PRIMA</label>
        <div class="input-group">
            <input type="text" id="producto"
                   name="producto"
                   onkeydown="getCodigoProducto()"
                   placeholder="BUSCAR..."
                   class="form-control">
            <span class="input-group-btn">
                <a href="javascript:buscar_producto();">
                    <button type="button"
                            class="btn btn-default"
                            id="buscar"
                            data-placement="top"
                            title="Buscar" data-toggle="tooltip"
                            data-loading-text="<i class='fa fa-refresh fa-spin '></i>">
                        <i class="fa fa-search"></i>
                    </button>
                </a>
                  <a href="javascript:limpiar()">
                   <button type="button" class="btn btn-default"
                           id="limpiar" data-placement="top"
                           title="Limpiar" data-toggle="tooltip">
                        <i class="fa fa-trash"></i>
                    </button>
                </a>
            </span>
        </div>
    </div>

    <input type="hidden" id="id_producto" name="id_producto">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_proveedor">PROVEEDOR</label>
            <input type="text" id="proveedor"
                   name="proveedor"
                   readonly
                   class="form-control">
        </div>
    </div>
    <input type="hidden" id="id_proveedor" name="id_proveedor">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="documento_proveedor">DOCUMENTO PROVEEDOR</label>
            <input type="text" name="documento_proveedor" value="{{old('documento_proveedor')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. ORDEN DE COMPRA</label>
            <input type="text" name="orden_compra" value="{{old('orden_compra')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1" data-toggle="tab" aria-expanded="false">
                        Documentos y Vehiculos
                    </a>
                </li>
                <li class="">
                    <a href="#tab_2" data-toggle="tab" aria-expanded="false">
                        Empaque y Etiqueta
                    </a>
                </li>
                <li class="">
                    <a href="#tab_3" data-toggle="tab" aria-expanded="true">
                        Detalles de lotes
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="proveedor_aprobado"
                                   value="1"
                                   name="proveedor_aprobado">
                            <label class="custom-control-label" for="proveedor_aprobado">Proveedor aprobado</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="producto_acorde_compra"
                                   value="1"
                                   id="producto_acorde_compra">
                            <label class="custom-control-label" for="producto_acorde_compra">Producto acorde con Orden
                                de Compra</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   value="1"
                                   name="cantidad_acorde_compra"
                                   id="cantidad_acorde_compra">
                            <label class="custom-control-label" for="cantidad_acorde_compra">Cantidad acorde con orden
                                de Compra</label>
                        </div>
                    </div>


                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <label for="nombre">Certificado de análisis</label>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="certificado_existente"
                                   value="1"
                                   id="certificado_existente">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="certificado_existente">Existente</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="certificado_correspondiente_lote"
                                   value="1"
                                   id="certificado_correspondiente_lote">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="certificado_correspondiente_lote">Correspondiente
                                a No. Lote</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="opcion6"
                                   name="certificado_correspondiente_especificacion"
                                   value="1"
                            >
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="certificado_correspondiente_especificacion">
                                De acuerdo a especificación
                            </label>
                        </div>

                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <label for="nombre">Limpieza interna de vehìculo</label>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                   id="sin_polvo"
                                   name="sin_polvo"
                                   value="1"
                            >
                            <label class="custom-control-label" style="font-weight: normal" for="sin_polvo">Sin polvo
                                y/o
                                suciedad</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="sin_material_ajeno"
                                   value="1"
                                   name="sin_material_ajeno">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_material_ajeno">Sin
                                Material
                                Ajeno</label>

                        </div>

                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <label for="nombre">Condiciones Internas vehiculos</label>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   value="1"
                                   name="ausencia_plagas"
                                   id="ausencia_plagas">
                            <label class="custom-control-label" style="font-weight: normal" for="ausencia_plagas">Ausencia
                                de
                                Plagas</label>

                        </div>
                        <div class="custom-control custom-checkbox">

                            <input type="checkbox"
                                   class="custom-control-input"
                                   value="1"
                                   id="sin_humedad"
                                   name="sin_humedad">

                            <label
                                    class="custom-control-label" style="font-weight: normal" for="sin_humedad">Sin
                                Humedad</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                   name="sin_oxido"
                                   value="1"
                                   id="sin_oxido">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_oxido">Sin
                                óxido</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="ausencia_olores_extranios"
                                   value="1"
                                   id="ausencia_olores_extranios">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="ausencia_olores_extranios">Ausencia de
                                olores extraños</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="ausencia_material_extranio"
                                   value="1"
                                   id="ausencia_material_extranio">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="ausencia_material_extranio">Ausencia de
                                material extraño</label>

                        </div>
                        <div class="custom-control custom-checkbox">

                            <input type="checkbox" class="custom-control-input"
                                   name="cerrado"
                                   value="1"
                                   id="cerrado"> <label
                                    class="custom-control-label" style="font-weight: normal" for="cerrado">Cerrado y
                                con llave</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                   name="sin_agujeros"
                                   value="1"
                                   id="sin_agujeros">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_agujeros">Sin
                                agujeros</label>

                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="observaciones_vehiculo">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
                            <input type="text" name="observaciones_vehiculo" value="{{old('observaciones_vehiculo')}}"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">


                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">

                        <label for="empaque">Empaque</label>

                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="no_golpeado"
                                   value="1"
                                   id="no_golpeado">
                            <label class="custom-control-label" style="font-weight: normal" for="no_golpeado">No
                                golpeado</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="sin_roturas"
                                   value="1"
                                   id="sin_roturas">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_roturas">Sin
                                rotulas</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="empaque_cerrado"
                                   id="empaque_cerrado">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="empaque_cerrado">Cerrado</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="seco_limpio"
                                   value="1"
                                   id="seco_limpio">
                            <label class="custom-control-label" style="font-weight: normal" for="seco_limpio">Seco y
                                Limpio</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   value="1"
                                   name="sin_material_extranio"
                                   id="sin_material_extranio">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_material_extranio">Sin
                                material
                                extraño</label>
                        </div>

                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   value="1"
                                   name="debidamente_identificado"
                                   id="debidamente_identificado">
                            <label class="custom-control-label" for="debidamente_identificado">Producto debidamente
                                identificado</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="debidamente_legible"
                                   value="1"
                                   id="debidamente_legible">
                            <label class="custom-control-label" for="debidamente_legible">Identificación de producto
                                legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   value="1"
                                   name="no_lote_presente"
                                   id="no_lote_presente">
                            <label class="custom-control-label" for="no_lote_presente">No. de lote presente</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="no_lote_legible"
                                   value="1"
                                   id="no_lote_legible">
                            <label class="custom-control-label" for="no_lote_legible">No. de lote legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="fecha_vencimiento_legible"
                                   value="1"
                                   id="fecha_vencimiento_legible">
                            <label class="custom-control-label" for="fecha_vencimiento_legible">Fecha de vencimiento
                                presente y
                                legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="fecha_vencimiento_vigente"
                                   value="1"
                                   id="fecha_vencimiento_vigente">
                            <label class="custom-control-label" for="fecha_vencimiento_vigente">Fecha de vencimiento
                                vigente</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="contenido_neto_declarado"
                                   value="1"
                                   id="contenido_neto_declarado">
                            <label class="custom-control-label" for="contenido_neto_declarado">Contenido Neto
                                declarado</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="observaciones_empaque">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
                            <input type="text" name="observaciones_empaque" value="{{old('observaciones_empaque')}}"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="codigo_producto">Codigo</label>
                            <input id="codigo_producto" type="text"
                                   onkeydown="cargarInfoCodigoBarras(this)"
                                   class="form-control">
                        </div>
                    </div>
                    <div class=" col-lg-3  col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Cantidad</label>
                            <input id="cantidad" type="text" onkeypress="return justNumbers(event);" name="descripcion"

                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">No. de Lote</label>
                            <input id="lote" type="text" onkeypress="return justNumbers(event);" name="descripcion"

                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-8 col-md-8 col-xs-10">
                        <div class="form-group">
                            <label>Fecha de Vencimiento</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input id="vencimiento" type="text" class="form-control pull-right" id="datepicker">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-md-2 col-xs-2">
                        <br>
                        <div class="form-group">
                            <button id="btnAdd" class="btn btn-default block" style="margin-top: 5px;" type="button">
                                <span class=" fa fa-plus"></span></button>
                        </div>
                    </div>


                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                            <thead style="background-color: #01579B;  color: #fff;">
                            <th>OPCION</th>
                            <th>CANTIDAD</th>
                            <th>NO. LOTE</th>
                            <th>FECHA VENCIMIENTO</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('recepcion/materia_prima')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>
    <div class="modal fade modal-slide-in-right" aria-hidden="true"
         role="dialog" tabindex="-1" id="not_found">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" align="center">PRODUCTO NO ENCONTRADO</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-check"></span>
                        ACEPTAR
                    </button>
                </div>
            </div>
        </div>

    </div>
    @include('recepcion.materia_prima.productos')
    {!!Form::close()!!}

@endsection
@section('scripts')

    <script>
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            setDate: new Date()

        });
        $(document).ready(function () {

            $("#btnAdd").click(function () {
                addToTable();
            });

            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

        });
    </script>
    <script>
        function cargarProveedores() {
            //NOT IMPLEMENTED
        }

        function addToTable() {
            if ($("#cantidad").val() != "" && $("#lote").val() != "" && $("#vencimiento").val() != "") {
                let cantidad = $("#cantidad");
                let lote = $("#lote");
                let fecha = $("#vencimiento");
                let codigo_producto = $("#codigo_producto");

                //removeFromTareas(tarea);
                //removeFromSelect(vendedor);
                let row =
                    `<tr>
            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
            <td><input type="hidden" value='${cantidad.val()}' name=cantidad[]>${cantidad.val()}</td>
            <td ><input type="hidden" value ='${lote.val()}'  name=no_lote[] >${lote.val()}</td>
            <td ><input type="hidden" value ='${fecha.val()}'  name=fecha_vencimiento[] >${fecha.val()}</td>
            </tr>`;

                $("#detalles").append(row);
                cantidad.val('');
                lote.val('');
                fecha.val('');
                codigo_producto.val('');
                codigo_producto.focus();
            } else {
                $('#modal-default').modal('show');
                return false;
            }
        }

        function removeFromTable(element) {
            //Removemos la fila
            let td = $(element).parent();
            td.parent().remove();
            let tdNext = td.next();
            let tdNextNext = tdNext.next();
        }

        function justNumbers(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        }

        function buscar_producto(searchValue = null) {

            let productoElement = document.getElementById('producto');

            if (searchValue == null) {
                searchValue = productoElement.value;
            }

            $.ajax({

                url: "{{url('registro/productos/search')}}" + "/" + searchValue,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let productos = response;
                    let totalProductos = productos.length;

                    if (totalProductos == 0) {

                        mostrarAlertaNotFound();

                    } else if (totalProductos == 1) {

                        cargarProducto(productos[0]);

                    } else {

                        cargarProductos(productos);
                        mostrarProductosCargados();
                    }


                },
                error: function (e) {

                    console.error(e);
                }

            })

        }


        function limpiar() {

            document.getElementById('id_producto').value = "";
            document.getElementById('producto').value = "";
            document.getElementById('proveedor').value = "";
            document.getElementById('id_proveedor').value = "";
            document.getElementById('producto').readOnly = false;
            document.getElementById('buscar').disabled = false;
        }

        function cargarProductos(productos) {

            $("#tbody-productos").empty();
            let row = "";
            productos.forEach(function (producto) {

                row += `<tr>
                    <td><input  onclick="habilitar()" type='radio' name='id_prod' value='${producto.id_producto}'  ></td>
                    <td> ${producto.codigo_barras} </td>
                    <td> ${producto.descripcion} </td>
                    <td><input type='hidden' name="id_prov" value='${producto.proveedor.id_proveedor}'  >  ${producto.proveedor.razon_social} </td>
                </tr> `;

            })

            $('#tbody-productos').append(row);
        }

        function cargarProducto(producto) {

            let productoElement = document.getElementById('producto');
            let idProductoElement = document.getElementById('id_producto');
            let proveedorElement = document.getElementById('proveedor');
            let idProveedorElement = document.getElementById('id_proveedor');
            let btnBuscar = document.getElementById('buscar');
            if (Array.isArray(producto)) {
                idProductoElement.value = producto[0];
                productoElement.value = producto[1];
                idProveedorElement.value = producto[2];
                proveedorElement.value = producto[3];
                productoElement.readOnly = true;
                btnBuscar.disabled = true;

            } else if (typeof producto === 'object') {
                idProductoElement.value = producto.id_producto;
                productoElement.value = producto.descripcion;
                proveedorElement.value = producto.proveedor.razon_social;
                idProveedorElement.value = producto.proveedor.id_proveedor;
                productoElement.readOnly = true;
                btnBuscar.disabled = true;
            }

        }

        function mostrarProductosCargados() {

            setTimeout(function () {
                $('#modal-productos').modal();
            }, 1000);
        }

        function mostrarAlertaNotFound() {
            $('#not_found').modal();
        }

        function habilitar() {

            document.getElementById('aceptar_producto').disabled = false;

        }

        function setProducto() {

            let infoProd = getProductoSelected();
            if (infoProd.length != 0) {
                cargarProducto(infoProd);
            } else {


            }


        }

        function getProductoSelected() {
            var productos = document.getElementsByName('id_prod');
            var id_prod = null;
            var descripcion = null;
            var id_prov = null;
            var razon_social = null;

            var arrayProductos = Object.keys(productos).map(function (key) {
                return [Number(key), productos[key]];
            });


            arrayProductos.forEach(function (prod) {
                if (prod[1].checked) {
                    var childrens = prod[1].parentElement.parentElement.children;
                    id_prod = childrens[0].firstChild.value;
                    descripcion = childrens[2].innerText;
                    razon_social = childrens[3].innerText;
                    id_prov = childrens[3].firstChild.value;

                }
            });
            return [id_prod, descripcion, id_prov, razon_social];
        }

        function descomponerInput(input) {

            var codigoBarras = input.value;
            var removerParentesis = codigoBarras.replace(/\([0-9]*\)/g, '-');
            var codigoSplited = removerParentesis.split('-');


            return codigoSplited;


        }

        function cargarInfoCodigoBarras(input) {

            let infoCodigoBarras = descomponerInput(input);

            if(event.keycode == 13){
                mostrarInfoCodigoBarras(infoCodigoBarras);
            }


        }

        function mostrarInfoCodigoBarras( infoCodigoBarras ) {
            const POSICION_FECHA = 2;
            const POSICION_LOTE = 3;

            let fecha = infoCodigoBarras[POSICION_FECHA];
            document.getElementById('lote').value = infoCodigoBarras[POSICION_LOTE];
            fecha = getDate(fecha);
            document.getElementById('vencimiento').value = fecha;
            document.getElementById('cantidad').focus();
        }

        function getDate(date) {

            var anio = "20" + date.substring(0, 2);
            var mes = date.substring(2, 4);
            var dia = date.substring(4);
            var newDate = anio + "-" + mes + "-" + dia;

            return newDate

        }

        function getCodigoProducto() {

            const POSICION_CODIGO = 1;
            var inputMateriaPrima = document.getElementById('producto');

            var infoCodigoBarras = descomponerInput(inputMateriaPrima);

            const codigo_producto = infoCodigoBarras[POSICION_CODIGO]
            if (event.keyCode == 13) {
                buscar_producto(codigo_producto);
            }

        }
    </script>
@endsection
