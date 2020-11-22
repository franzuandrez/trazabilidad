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
    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-truck',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Proveedores
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::model($proveedor,['method'=>'PATCH','route'=>['proveedores.update',$proveedor->id_proveedor]])!!}
    {{Form::token()}}
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="codigo">Codigo</label>
                <input type="text"
                       readonly
                       name="codigo" required value="{{$proveedor->codigo_proveedor}}" id="codigo"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Razon Social</label>
                <input type="text" name="razon_social" required value="{{$proveedor->razon_social}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre Comercial</label>
                <input type="text" name="nombre_comercial" required value="{{$proveedor->nombre_comercial}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">NIT</label>
                <input type="text" name="nit" value="{{$proveedor->nit}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Direccion Fiscal</label>
                <input type="text" name="direccion_fiscal" value="{{$proveedor->direccion_fiscal}}" required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Direccion de Planta</label>
                <input type="text" name="direccion_planta" value="{{$proveedor->direccion_planta}}" required
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Telefono de Contacto</label>
                <input type="text" name="telefono_contacto" value="{{$proveedor->telefono_contacto}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Correo electrónico</label>
                <input type="text" name="email" value="{{$proveedor->email}}" required
                       class="form-control">
            </div>
        </div>


    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="page-header" id="productos-provee">
            <h2>
                <small>&nbsp;&nbsp; PRODUCTOS
                </small>
            </h2>
        </div>

        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
            <label for="producto">Producto</label>
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
                        type="button" class="btn btn-primary">
                        <i class="fa fa-search"
                           id="icon_search"
                           data-loading-text="<i class='fa fa-refresh fa-spin '></i>"
                           aria-hidden="true"></i>
                    </button>
                    <button type="button"
                            id="btn_agregar"
                            onclick="addToTableProductos()"
                            onkeydown="if(event.keyCode==13)addToTableProductos()"
                            class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                    <button type="button"
                            id="btn_limpiar"
                            onclick="limpiar()"
                            onkeydown="if(event.keyCode==13)limpiar()"
                            class="btn btn-primary">
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
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>Accion</th>
                <th>Producto</th>

                </thead>
                <tbody>
                @foreach( $proveedor->productos as $producto )
                    <tr>

                        <td>
                            <button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button>
                        </td>

                        <td>
                            <input type="hidden" value="{{$producto->id_producto}}" name="productos[]">
                            {{$producto->descripcion}}
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @include('registro.proveedores.productos')

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('registro/proveedores ')}}">
                <button class="btn btn-primary" type="button">
                    <span class=" fa fa-close"></span> Cancelar
                </button>
            </a>


        </div>
    </div>
    {!!Form::close()!!}
    </div>
    </div>
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span></button>
                    <h4 class="modal-title">Advertencia</h4>
                </div>
                <div class="modal-body">
                    <p>Complete todo los campos...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
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
