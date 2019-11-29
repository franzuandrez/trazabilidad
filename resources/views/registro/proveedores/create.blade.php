@extends('layouts.admin')
@section('style')
    <style>
        .page-header {
            margin-top: 20px;
            margin-bottom: 02px;
            padding-bottom: 0;
        }
    </style>
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-users',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Proveedores
        @endslot
    @endcomponent

    @include('componentes.alert-error')

    {!!Form::open(array('url'=>'registro/proveedores/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

        <div class="page-header">
            <h2>
                <small>&nbsp;&nbsp; INFORMACIÓN COMERCIAL .</small>
            </h2>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="codigo">CODIGO</label>
                <input type="text" name="codigo"
                       readonly
                       value="{{$correlativo}}"
                       required value="{{old('codigo')}}" id="codigo"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">RAZON SOCIAL</label>
                <input type="text" name="razon_social" required value="{{old('razon_social')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">NOMBRE COMERCIAL</label>
                <input type="text" name="nombre_comercial" required value="{{old('nombre_comercial')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">NIT</label>
                <input type="text" name="nit" value="{{old('nit')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIRECCION FISCAL</label>
                <input type="text" name="direccion_fiscal" value="{{old('direccion_fiscal')}}" required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIRECCION PLANTA</label>
                <input type="text" name="direccion_planta" required value="{{old('direccion_planta')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">NOMBRE CONTACTO</label>
                <input type="text" name="nombre_contacto" value="{{old('nombre_contacto')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">TELEFONO DE CONTACTO</label>
                <input type="text" name="telefono_contacto" value="{{old('telefono_contacto')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">E-MAIL</label>
                <input type="text" name="email" required value="{{old('email')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">REGIMEN TRIBUTARIO</label>
                <input type="text" name="regimen_tributario" value="{{old('regimen_tributario')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">PATENTE DE COMERCIO</label>
                <input type="text" name="patente_comercio" value="{{old('patente_comercio')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">PATENTE DE SOCIEDAD</label>
                <input type="text" name="patente_sociedad" value="{{old('patente_sociedad')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIAS DE CREDITO</label>
                <input type="text" name="dias_credito" value="{{old('dias_credito')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">MONTO DE CREDITO</label>
                <input type="text" name="monto_credito" value="{{old('monto_credito')}}"
                       class="form-control">
            </div>
        </div>

    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

        <div class="page-header">
            <h2>
                <small>&nbsp;&nbsp; INFORMACIÓN BÁSICA DE CALIDAD</small>
            </h2>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="programa_bpm_implementado" value="1"
                       name="programa_bpm_implementado">
                <label class="custom-control-label" for="programa_bpm_implementado">¿Cuenta con Programa de BPM
                    implementadas, documentadas y evaluadas?</label>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" value="1" class="custom-control-input" id="otros_programas"
                       name="otros_programas">
                <label class="custom-control-label" for="otros_programas">¿Cuenta con otros Programas
                    Prerrequisito implementados, documentados y evaluados?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" value="1" class="custom-control-input" id="sistema_haccp" name="sistema_haccp">
                <label class="custom-control-label" for="sistema_haccp">¿Cuenta con Sistema HACCP Iplementado,
                    Documentado y evaluado?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="programa_capacitacion" value="1"
                       name="programa_capacitacion">
                <label class="custom-control-label" for="programa_capacitacion">¿Cuenta con un Programa de
                    Capacitación implementado documentado y evaluado?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="sistema_trazabilidad" value="1"
                       name="sistema_trazabilidad">
                <label class="custom-control-label" for="sistema_trazabilidad">¿Cuenta con un Sistema de
                    Trazabilidad implementado, documentado y evaluado?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="sistema_calidad_auditado_intermamente" value="1"
                       name="sistema_calidad_auditado_intermamente">
                <label class="custom-control-label" for="sistema_calidad_auditado_intermamente">¿Su Sistema de
                    Calidad y/o sus componentes es auditado internamente?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="sistema_calidad_auditado_por_terceros" value="1"
                       name="sistema_calidad_auditado_por_terceros">
                <label class="custom-control-label" for="sistema_calidad_auditado_por_terceros">¿Su Sistema de
                    Calidad y/o sus componentes es auditado por terceros?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="certificaciones" value="1"
                       name="certificaciones">
                <label class="custom-control-label" for="certificaciones">Certificaciones.</label>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="page-header" id="datos-reclamante">
            <h2>
                <small>&nbsp;&nbsp; REFERENCIAS COMERCIALES.</small>
            </h2>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="rc_empresa">EMPRESA</label>
                <input id="rc_empresa" type="text" name="rc_empresa" value="{{old('rc_empresa')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="rc_telefono">TELEFONO</label>
                <input id="rc_telefono" type="text" name="rc_telefono" value="{{old('rc_telefono')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIRECCION</label>
                <input id="rc_direccion" type="text" name="rc_direccion" value="{{old('rc_direccion')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-10">
            <div class="form-group">
                <label for="rc_contacto">CONTACTO</label>
                <input id="rc_contacto" type="text" name="rc_contacto" value="{{old('rc_contacto')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-2">
            <br>
            <div class="form-group">
                <button id="btnAddReferencias" class="btn btn-default block" style="margin-top: 5px;"
                        type="button"><span class=" fa fa-plus"></span></button>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <table id="detalle_referencias"
                   class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <th>OPCION</th>
                <th>EMPRESA</th>
                <th>TELEFONO</th>
                <th>DIRECCION</th>
                <th>CONTACTO</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="observaciones">OBSERVACIONES</label>
                <input id="observaciones" type="text" name="observaciones" value="{{old('observaciones')}}"
                       class="form-control">
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="page-header" id="productos-provee">
            <h2>
                <small>&nbsp;&nbsp; PRODUCTOS QUE PROVEE .</small>
            </h2>
        </div>
        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
            <label for="producto">PRODUCTO</label>
            <div class="input-group">
                <input type="text" id="producto"
                       name="producto"
                       onkeydown="if(event.keyCode==13)getCodigoProducto()"
                       placeholder="BUSCAR..."
                       class="form-control">
                <div class="input-group-btn">
                    <button
                        onclick="buscar_producto()"
                        onkeydown="if(event.keyCode==13)buscar_producto()"
                        type="button" class="btn btn-default">
                        <i class="fa fa-search"
                           id="icon_search"
                           data-loading-text="<i class='fa fa-refresh fa-spin '></i>"
                           aria-hidden="true"></i>
                    </button>
                    <button type="button"
                            id="btn_agregar"
                            onclick="addToTableProductos()"
                            onkeydown="if(event.keyCode==13)addToTableProductos()"
                            class="btn btn-default">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                    <button type="button"
                            id="btn_limpiar"
                            onclick="limpiar()"
                            onkeydown="if(event.keyCode==13)limpiar()"
                            class="btn btn-default">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <input type="hidden" id="id_producto">
        </div>

        <br>
        <br>
        <br>
        <br>


        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-10" style="display: none">
            <div class="form-group">
                <label for="presentacion">PRESENTACION</label>
                <input id="presentacion" type="text" name="presentacion" value="" readonly
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <table id="detalle_productos"
                   class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>OPCION</th>
                <th>PRODUCTO</th>

                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
    @include('registro.proveedores.productos')
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/proveedores')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
    </div>
    </div>



@section('scripts')
    <script>
        $("#btnAddReferencias").click(function () {
            addToTableComerciales();
        });
        $("#btnAddProductos").click(function () {
            addToTableProductos();
        });
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        function start_spin(id, icon) {
            $('#' + id).button('loading');
            document.getElementById(id).classList.remove(icon)
        }

        function stop_spin(id, icon) {

            setTimeout(function () {
                $('#' + id).button('reset');
                document.getElementById(id).classList.add(icon)
            }, 1000);

        }

        function limpiar() {
            document.getElementById('id_producto').value = "";
            document.getElementById('producto').value = "";
            document.getElementById('producto').readOnly = false;
        }

        function addToTableComerciales() {
            if ($("#rc_empresa").val() != "" && $("#rc_telefono").val() != "" && $("#rc_direccion").val() != "" && $("#rc_contacto").val() != "") {
                let empresa = $("#rc_empresa");
                let telefono = $("#rc_telefono");
                let direccion = $("#rc_direccion");
                let contacto = $("#rc_contacto");

                let row =
                    `<tr>
            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
            <td><input type="hidden" value='${empresa.val()}' name=empresa[]>${empresa.val()}</td>
            <td><input type="hidden" value='${telefono.val()}' name=telefono[]>${telefono.val()}</td>
            <td ><input type="hidden" value ='${direccion.val()}'  name=direccion[] >${direccion.val()}</td>
            <td ><input type="hidden" value ='${contacto.val()}'  name=contacto[] >${contacto.val()}</td>
            </tr>`;

                $("#detalle_referencias").append(row);
                empresa.val('');
                telefono.val('');
                direccion.val('');
                contacto.val('');
            } else {
                $('#modal-default').modal('show');
                return false;
            }
        }

        function addToTableProductos() {
            var producto = $('#producto');


            var id_producto = $('#id_producto');

            if (producto.val() != "" && id_producto.val() != "") {
                let row =
                    `<tr>
                    <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
                    <td><input type="hidden" value='${id_producto.val()}' name=productos[]>${producto.val()}</td>

                    </tr>`;

                $("#detalle_productos").append(row);

            } else {
                alert("Producto no encontrado");
            }

            producto.val('');

            id_producto.val('');
            document.getElementById('producto').readOnly = false;
            document.getElementById('producto').focus();


        }

        function getCodigoProducto() {

            var producto = document.getElementById('producto').value;


            if (event.keyCode == 13) {
                buscar_producto(producto);
            }
        }

        function buscar_producto(searchValue = null) {

            let productoElement = document.getElementById('producto');

            if (searchValue == null) {
                searchValue = productoElement.value;
                if (searchValue === "") {
                    mostrarAlertaNotFound();
                    return;
                }
            }
            start_spin('icon_search', 'fa-search');
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

                    stop_spin('icon_search', 'fa-search');

                },
                error: function (e) {
                    stop_spin('icon_search', 'fa-search');
                    alert("Error, revise conexión");
                    console.error(e);
                }

            })

        }

        function removeFromTable(element) {

            let td = $(element).parent();
            td.parent().remove();

            let tdNext = td.next();
            let tdNextNext = tdNext.next();

        }

        function cargarProducto(producto) {

            document.getElementById('id_producto').value = producto.id_producto;
            document.getElementById('producto').value = producto.descripcion;
            document.getElementById('producto').readOnly = true;
            document.getElementById('btn_agregar').focus();
        }

        function mostrarProductosCargados() {

            setTimeout(function () {
                $('#modal-productos').modal();
            }, 1000);
        }

        function mostrarAlertaNotFound() {
            alert("Producto no encontrado");
        }

        function seleccionar(id, element) {

            if (element.tagName != "INPUT") {
                document.getElementById('producto_item_' + id).checked = !document.getElementById('producto_item_' + id).checked;
                habilitar();
            }
        }

        function cargarProductos(productos) {

            $("#tbody-productos").empty();
            let row = "";
            productos.forEach(function (producto) {
                row += `<tr  onclick="seleccionar('${producto.id_producto}',event.target)" >
                    <td><input  onclick="habilitar()" type='radio' name='id_prod' value='${producto.id_producto}' id="producto_item_${producto.id_producto}" ></td>
                    <td> ${producto.codigo_barras} </td>
                    <td> ${producto.descripcion} </td>
                </tr> `;
            })

            $('#tbody-productos').append(row);
        }

        function setProducto() {

            let infoProd = getProductoSelected();
            if (infoProd.length != 0) {
                document.getElementById('producto').value = infoProd[1];
                document.getElementById('id_producto').value = infoProd[0];

                addToTableProductos();
            }
        }

        function habilitar() {

            document.getElementById('aceptar_producto').disabled = false;

        }

        function deshabilitar() {
            document.getElementById('aceptar_producto').disabled = true;
        }

        function getProductoSelected() {
            var productos = document.getElementsByName('id_prod');
            var id_prod = null;
            var descripcion = null;
            var presentacion = null;

            var arrayProductos = Object.keys(productos).map(function (key) {
                return [Number(key), productos[key]];
            });

            arrayProductos.forEach(function (prod) {
                if (prod[1].checked) {
                    var childrens = prod[1].parentElement.parentElement.children;
                    id_prod = childrens[0].firstChild.value;
                    descripcion = childrens[2].innerText;


                }
            });
            return [id_prod, descripcion, presentacion];
        }

    </script>
@endsection
@endsection
