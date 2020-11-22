@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-th-large',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Materia Prima
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::open(array('url'=>'recepcion/materia_prima/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="producto">Materia Prima</label>
        <div class="input-group">
            <input type="text" id="producto"
                   name="producto"
                   placeholder="BUSCAR..."
                   class="form-control">
            <span class="input-group-btn">
                <a href="javascript:buscar_producto();">
                    <button type="button"
                            class="btn btn-primary"
                            id="buscar"
                            data-placement="top"
                            title="Buscar" data-toggle="tooltip"
                            data-loading-text="<i class='fa fa-refresh fa-spin '></i>">
                        <i class="fa fa-search"></i>
                    </button>
                </a>
                  <a href="javascript:limpiar()">
                   <button type="button" class="btn btn-primary"
                           id="limpiar" data-placement="top"
                           title="Limpiar" data-toggle="tooltip">
                        <i class="fa fa-trash"></i>
                    </button>
                </a>
            </span>
        </div>
    </div>

    <input type="hidden" id="id_producto" name="id_producto">
    @include('componentes.loading')
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_proveedor">Proveedor</label>
            <select name="id_proveedor" id="proveedores" class="form-control selectpicker">

                @if(old('id_proveedor'))
                    <option selected
                            value="{{old('id_proveedor')}}">{{$proveedores->where('id_proveedor',old('id_proveedor'))->first()->nombre_comercial}}</option>
                @else
                    <option value=""> SELECCIONE PROVEEDOR</option>
                @endif
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">Numero Documento</label>
            <input type="text" required
                   data-index="2"
                   name="orden_compra" value="{{old('orden_compra')}}"
                   class="form-control">
        </div>
    </div>
    <hr>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">


        <div class="tab-pane active" id="tab_3">
            <div class="col-lg-8 col-sm-10 col-md-12 col-xs-12">
                <label for="codigo_producto">Codigo</label>
                <div class="input-group">
                    <input id="codigo_producto" type="text"
                           onkeydown="if(event.keyCode==13)cargarInfoCodigoBarras(this)"
                           class="form-control">

                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary"
                                onclick="cargarInfoCodigoBarras(document.getElementById('codigo_producto'))"
                        >
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-primary"
                                onclick="limpiarProducto()"
                        >
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

            </div>

            <input id="id_producto" type="hidden"
                   name="id_producto"
                   class="form-control">
            <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre_producto">Producto</label>
                    <input id="nombre_producto" type="text"
                           readonly
                           class="form-control">
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">No. Lote</label>
                    <input id="lote" type="text"
                           onkeydown="if(event.keyCode==13)document.getElementById('vencimiento').focus()"
                           name="descripcion"

                           class="form-control">
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Fecha de Vencimiento</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="vencimiento"
                               onkeydown="if(event.keyCode==13)document.getElementById('cantidad').focus()"
                               type="text" class="form-control pull-right" id="datepicker">
                    </div>

                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                <label for="nombre">Cantidad</label>
                <div class="input-group">
                    <input id="cantidad" type="number"
                           onkeydown="if(event.keyCode==13)addToTable()"
                           onkeypress="return justNumbers(event);" name="descripcion"
                           class="form-control">

                    <div class="input-group-btn">
                        <button id="btnAdd"
                                onclick="addToTable();"
                                class="btn btn-primary block"  type="button">
                            <span class=" fa fa-plus"></span></button>
                    </div>
                </div>

            </div>



            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                    <thead style="background-color: #f7b633;  color: #fff;">
                    <th>Accion</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>No. Lote</th>
                    <th>Fecha Vencimiento</th>
                    </thead>
                    <tbody id="body-detalles">
                    @if(old('id_producto'))
                        @foreach( old('id_producto') as $key => $prod )
                            <tr>
                                <td>
                                    <button onclick=removeFromTable(this) type="button" class="btn btn-warning">
                                        x
                                    </button>
                                </td>
                                <td>
                                    <input type="hidden" value="{{old('id_producto')[$key]}}"
                                           name="id_producto[]">
                                    <input type="hidden" value="{{old('descripcion_producto')[$key]}}"
                                           name="descripcion_producto[]">
                                    {{old('descripcion_producto')[$key]}}
                                </td>
                                <td>
                                    <input type="hidden" value="{{old('cantidad')[$key]}}" name="cantidad[]">
                                    {{old('cantidad')[$key]}}
                                </td>
                                <td>
                                    <input type="hidden" value="{{old('no_lote')[$key]}}" name="no_lote[]">
                                    {{old('no_lote')[$key]}}
                                </td>
                                <td>
                                    <input type="hidden" value="{{old('fecha_vencimiento')[$key]}}"
                                           name="fecha_vencimiento[]">
                                    {{old('fecha_vencimiento')[$key]}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>


            </div>
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-primary" name="Bt_guardar" disabled id="Bt_guardar"
                    onclick="$('form').submit()"
                    type="button">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('recepcion/materia_prima ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
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
                    <button type="button"
                            class="btn btn-primary" data-dismiss="modal"><span class="fa fa-check"></span>
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
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment-with-locales.js')}}"></script>
    <script src="{{asset('js-brc/tools/lectura_codigo.js')}}"></script>
    <script>
        var formato = 'D/M/Y';

        $('.date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            setDate: new Date()

        });
        $(document).ready(function () {


            $("#btnLimpiar").click(function () {
                limpiarProducto();
            });


            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#producto').keydown(function (event) {
                if (event.keyCode == 13) {
                    getCodigoProducto();
                }
            })

        });
    </script>
    <script>
        function limpiarProducto() {
            document.getElementById('id_producto').value = "";
            document.getElementById('codigo_producto').value = "";
            document.getElementById('nombre_producto').value = "";
            document.getElementById('lote').value = "";
            document.getElementById('vencimiento').value = "";
            document.getElementById('cantidad').value = "";
            document.getElementById('codigo_producto').focus();
        }

        function cargarProveedores(proveedores) {
            limpiarSelectProveedores()
            let option = '';
            var total = proveedores.length;

            proveedores.forEach(function (e) {
                if (total == 1) {
                    option += `<option  selected value='${e.id_proveedor}'>${e.nombre_comercial}</option>`;
                    document.getElementById('documento_proveedor').focus();
                } else {
                    option += `<option   value='${e.id_proveedor}'>${e.nombre_comercial}</option>`;
                }
            });
            $('#proveedores').append(option);
            $('#proveedores').selectpicker('refresh');

        }

        function limpiarSelectProveedores() {
            $('#proveedores').find('option:not(:first)').remove();
            $('#proveedores').selectpicker('refresh');
        }

        let productosAgregados = [];

        function addToTable() {


            if ($("#id_producto").val() == "") {
                alert("Producto invalido");
                return;
            }
            if ($("#lote").val() == "") {
                alert("Lote en blanco");
                $("#lote").focus();
                return;
            }
            if ($("#vencimiento").val() == "") {
                alert("Fecha de vencimiento en blanco");
                $("#vencimiento").focus();
                return;
            }

            if ($("#cantidad").val() == "" || $("#cantidad").val() == 0) {
                alert("Cantidad invalida");
                $("#cantidad").focus();
                return;
            }

            if ($("#cantidad").val() != "" && $("#lote").val() != "" && $("#vencimiento").val() != "" && $("#id_producto").val() != "") {
                let cantidad = $("#cantidad");

                if (cantidad.val() == 0) {
                    alert("La cantidad debe ser mayor a cero");
                    return;
                }
                let lote = $("#lote");
                let fecha = $("#vencimiento");
                let codigo_producto = $("#codigo_producto");
                let nombre_producto = $("#nombre_producto");
                let id_producto = $("#id_producto");

                let isFechaVencimientoValida = moment(fecha.val(), formato).isValid() && moment(fecha.val(), formato).isAfter(moment());

                if (!isFechaVencimientoValida) {
                    alert("La fecha de vencimiento no es válida.");
                    return;
                }

                let existeLoteValido = findLote(id_producto.val(), lote.val().toUpperCase(), cantidad.val(), fecha.val());
                if (existeLoteValido == 0) { //No existe, lo agrego

                    let row =
                        `<tr class="row-producto-added" id='${id_producto.val()}-${lote.val().toUpperCase()}'>
                            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
                            <td><input type="hidden" name="descripcion_producto[]" value="${nombre_producto.val()}" > <input type="hidden" value='${id_producto.val()}' name=id_producto[]>${nombre_producto.val()}</td>
                            <td><input type="hidden" value='${cantidad.val()}' name=cantidad[]>${parseFloat(cantidad.val()).toLocaleString('en', {
                            minimumFractionDigits: 3,
                            maximumFractionDigits: 3
                        })}</td>
                            <td ><input type="hidden" value ='${lote.val().toUpperCase()}'  name=no_lote[] >${lote.val().toUpperCase()}</td>
                            <td ><input type="hidden" value ='${moment(fecha.val(), formato).format('Y-MM-DD')}'  name=fecha_vencimiento[] >${fecha.val()}</td>
                            </tr>`;
                    let producto = productosAgregados.find(producto => producto.id_producto == id_producto.val());
                    if (typeof producto != 'undefined') {
                        //agrego el lote
                        producto.lotes.push(lote.val().toUpperCase());
                    } else {
                        //agrego un nuevo registro
                        productosAgregados.push({
                            id_producto: id_producto.val(),
                            lotes: [lote.val().toUpperCase()]
                        });
                    }

                    $("#detalles").append(row);
                    document.getElementById('Bt_guardar').disabled = false;

                    limpiarProducto();
                } else if (existeLoteValido == 1) { //Existe y tiene la fecha valida.
                    limpiarProducto();
                } else {//Existe y la fecha es invalida
                    fecha.focus();
                }
                $('#proveedores').find('option:not(:selected)').remove();
                $('#proveedores').selectpicker('refresh');

            }
        }

        function removeFromTable(element) {
            //Removemos la fila
            let td = $(element).parent();
            let row = td.parent();
            row.remove();
            let tdNext = td.next();
            let tdNextNext = tdNext.next();

            let id_producto = row[0].id.split('-')[0];
            let no_lote = row[0].id.split('-')[1];

            let producto = productosAgregados.find(p => p.id_producto == id_producto);
            let lotes = producto.lotes;

            var index = lotes.indexOf(no_lote);
            if (index > -1) {
                lotes.splice(index, 1);
            }
            validacion_checks();

        }

        function justNumbers(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        }

        var allProducts = null;


        function buscar_producto(searchValue = null) {

            let productoElement = document.getElementById('producto');

            if (searchValue == null) {
                searchValue = productoElement.value;
            }
            searchValue = descomponerString(searchValue)[1];

            $('.loading').show();
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
                        allProducts = productos;
                        cargarProductos(productos);
                        mostrarProductosCargados();
                    }
                    $('.loading').hide();

                },
                error: function (e) {
                    console.error(e);
                    alert(e);
                    $('.loading').hide();

                }

            })

        }


        function limpiar() {
            limpiarSelectProveedores();
            document.getElementById('id_producto').value = "";
            document.getElementById('producto').value = "";
            document.getElementById('producto').readOnly = false;
            document.getElementById('buscar').disabled = false;
            $("#body-detalles").empty();
            productosAgregados = [];
            $('#proveedores').find('option').remove();
            $('#proveedores').append('<option value="">SELECCIONE PROVEEDOR </option>')
            $('#proveedores').selectpicker('refresh');
        }


        function cargarProductos(productos) {

            $("#tbody-productos").empty();
            let row = "";

            productos.forEach(function (producto) {

                row += `<tr>
                    <td><input  onclick="habilitar()" type='radio' name='id_prod' value='${producto.id_producto}'  ></td>
                    <td> ${producto.codigo_barras} </td>
                    <td> ${producto.descripcion} </td>

                </tr> `;

            })

            $('#tbody-productos').append(row);

        }

        function cargarProducto(producto) {

            let productoElement = document.getElementById('producto');
            let idProductoElement = document.getElementById('id_producto');


            let btnBuscar = document.getElementById('buscar');
            if (Array.isArray(producto)) {
                idProductoElement.value = producto[0];
                productoElement.value = producto[1];
                productoElement.readOnly = true;
                btnBuscar.disabled = true;
                let proveedores = allProducts.find(p => p.id_producto == producto[0]).proveedores;
                cargarProveedores(proveedores);
            } else if (typeof producto === 'object') {
                idProductoElement.value = producto.id_producto;
                productoElement.value = producto.descripcion;
                productoElement.readOnly = true;
                btnBuscar.disabled = true;
                cargarProveedores(producto.proveedores);
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
            return [id_prod, descripcion];
        }


        function cargarInfoCodigoBarras(input) {


            let infoCodigoBarras = descomponerInput(input);
            if (infoCodigoBarras[1] == "") {
                alert("codigo de barras no valido");
                return;
            }
            mostrarInfoCodigoBarras(infoCodigoBarras);


        }

        function mostrarInfoCodigoBarras(infoCodigoBarras) {

            let producto = buscar_producto_by_codigo(infoCodigoBarras);


        }

        function buscar_producto_by_codigo(infoCodigoBarras) {
            const POSICION_CODIGO = 1;
            const POSICION_FECHA = 2;
            const POSICION_LOTE = 3;

            let fecha = infoCodigoBarras[POSICION_FECHA];
            let codigo = infoCodigoBarras[POSICION_CODIGO];
            let lote = infoCodigoBarras[POSICION_LOTE];
            $('.loading').show();
            $.ajax({

                url: "{{url('registro/productos/search')}}" + "/" + codigo,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let productos = response;
                    let totalProductos = productos.length;

                    if (totalProductos == 0) {
                        mostrarAlertaNotFound();
                    } else {

                        let producto = productos[0];

                        var id_proveedor = $('#proveedores').val();
                        var proveedor = productos[0].proveedores.find(function (element) {
                            return element.id_proveedor == id_proveedor
                        });

                        if (typeof proveedor != 'undefined') {

                            if (lote != "") {
                                document.getElementById('nombre_producto').value = producto.descripcion;
                                document.getElementById('lote').value = lote;
                                document.getElementById('vencimiento').value = getDate(fecha);
                                document.getElementById('id_producto').value = producto.id_producto;
                                document.getElementById('cantidad').focus();
                            } else {
                                document.getElementById('nombre_producto').value = producto.descripcion;
                                document.getElementById('id_producto').value = producto.id_producto;
                                document.getElementById('lote').focus();
                            }

                        } else {
                            alert(" El producto no coincide con el proveedor ");
                        }


                    }

                    $('.loading').hide();
                },
                error: function (e) {
                    alert("Producto invalido");
                    console.log(e);
                    $('.loading').hide();
                }

            })


        }

        function getDate(date) {
            var anio = "20" + date.substring(0, 2);
            var mes = date.substring(2, 4);
            var dia = date.substring(4);
            var newDate = dia + "/" + mes + "/" + anio;

            return newDate

        }

        function getCodigoProducto() {
            const POSICION_CODIGO = 1;
            var inputMateriaPrima = document.getElementById('producto');

            var infoCodigoBarras = descomponerInput(inputMateriaPrima);

            var codigo_producto = infoCodigoBarras[POSICION_CODIGO]
            console.log(codigo_producto);
            buscar_producto(codigo_producto);


        }

        /**
         *
         * @param id_producto
         * @param lote
         * @param nuevaCantidad
         *
         *
         *
         * Acumula la cantidad en caso de existir ya un producto con su lote
         */

        function findLote(id_producto, lote, nuevaCantidad, fecha_vencimiento) {
            var existe = 0;
            var producto = productosAgregados.find(p => p.id_producto == id_producto);
            const POSICION_CANTIDAD = 2;
            const POSICION_FECHA = 4;


            if (typeof producto != 'undefined') {

                var no_lote = producto.lotes.find(no_lote => no_lote == lote.toUpperCase());
                //Verifico si existe el producto con el lote.
                if (typeof no_lote != 'undefined') {

                    let row = document.getElementById(id_producto + '-' + lote.toUpperCase());


                    var inputCantidad = row.children[POSICION_CANTIDAD].firstChild;
                    var inputFechaVencimiento = row.children[POSICION_FECHA].firstChild;

                    if (inputFechaVencimiento.value == fecha_vencimiento) {
                        var cantidad = parseFloat(inputCantidad.value);
                        cantidad = parseFloat(nuevaCantidad) + parseFloat(cantidad);
                        inputCantidad.value = cantidad;
                        row.children[POSICION_CANTIDAD].lastChild.textContent = cantidad;
                        existe = 1;
                    } else {
                        alert("La fecha de vencimiento no corresponde con el lote.");
                        existe = 2;
                    }

                }

            }


            return existe;
        }

        function prueba(e) {
            console.log(e);
        }

        function validacion_checks() {
            var detalleNoVacio = document.getElementById('body-detalles').children.length != 0;

            if (detalleNoVacio == true) {
                $("#Bt_guardar").attr('disabled', false);
            } else {
                $("#Bt_guardar").attr('disabled', true);
            }
        }
    </script>
@endsection
