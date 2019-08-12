@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-spoon',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Mezcla Harina
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/mezcla_harina/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label>Fecha</label>

            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input id="fecha" type="text" class="form-control pull-right" id="datepicker">
            </div>

        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="presentacion">RESPONSABLES</label>
            <select name="id_presentacion" class="form-control selectpicker" id="presentacion">
                <option value="">SELECCIONAR RESPONSABLE</option>
                @foreach($responsables as $responsable)
                    <option value="{{$responsable->id}}">{{$responsable->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lotes">LOTES DE LOS PRODUCTOS</label>
            <input type="text" name="lotes" value="{{old('lotes')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="">
            <div class="tab-content">
            </div>
            <div class="tab-pane" id="tab_3">
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="producto">PRODUCTO</label>
                        <input id="producto" type="text" name="producto"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">HORA CARGA</label>
                        <input id="hora_carga" type="text" name="descripcion"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">HORA DESCARGA</label>
                        <input id="hora_descarga" type="text" name="descripcion"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">LBS DE SOLUCIÓN (158.4 A 168.5)</label>
                        <input id="solucion" type="text" name="descripcion"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">PH (8-11 PPM)</label>
                        <input id="ph" type="text" name="descripcion"

                               class="form-control">
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">OBSERVACIONES</label>
                        <input id="observacion" type="text" name="descripcion"

                               class="form-control">
                    </div>
                </div>

                <div class="col-lg-2 col-sm-4 col-md-2 col-xs-2">
                    <br>
                    <div class="form-group">
                        <button id="btnAdd" class="btn btn-default block" style="margin-top: 5px;" type="button">
                            <span class=" fa fa-plus"></span></button>
                    </div>
                </div>


                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                        <thead style="background-color: #01579B;  color: #fff;">
                        <th>OPCION</th>
                        <th>PRODUCTO</th>
                        <th>HORA CARGA</th>
                        <th>HORA DESCARGA</th>
                        <th>LBS DE SOLUCION (158.4 A 168.5)</th>
                        <th>PH 8-11 PPM</th>
                        <th>OBSERVACIONES</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
                        <input type="text" name="observacion_correctiva" value="{{old('observacion_correctiva')}}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="observacion_correctiva">RESPONSABLE:</label>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="puesto">PUESTO</label>
                        <input type="text" name="puesto" value="{{old('puesto')}}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">NOMBRE</label>
                        <input type="text" name="nombre" value="{{old('nombre')}}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="firma">FIRMA</label>
                        <input type="text" name="firma" value="{{old('firma')}}"
                               class="form-control">
                    </div>
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
            <a href="{{url('control/mezcla_harina')}}">
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
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            setDate: new Date()

        });
        $(document).ready(function () {

            $("#btnAdd").click(function () {
                addToTable();
            });

        });
    </script>
    <script>
        function cargarProveedores() {
            //NOT IMPLEMENTED
        }

        function addToTable() {
            if ($("#producto").val() != "" && $("#hora_carga").val() != "" && $("#hora_descarga").val() != "" && $("#solucion").val() != "" && $("#ph").val() != "" && $("#observacion").val() != "") {
                let producto = $("#producto");
                let hora_carga = $("#hora_carga");
                let hora_descarga = $("#hora_descarga");
                let solucion = $("#solucion");
                let ph = $("#ph");
                let observacion = $("#observacion");
                //removeFromTareas(tarea);
                //removeFromSelect(vendedor);
                let row =
                    `<tr>
            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
            <td><input type="hidden" value='${producto.val()}' name=producto[]>${producto.val()}</td>
            <td ><input type="hidden" value ='${hora_carga.val()}'  name=hora_carga[] >${hora_carga.val()}</td>
            <td ><input type="hidden" value ='${hora_descarga.val()}'  name=hora_descarga[] >${hora_descarga.val()}</td>
            <td ><input type="hidden" value ='${solucion.val()}'  name=solucion[] >${solucion.val()}</td>
            <td ><input type="hidden" value ='${ph.val()}'  name=ph[] >${ph.val()}</td>
            <td ><input type="hidden" value ='${observacion.val()}'  name=observacion[] >${observacion.val()}</td>
            </tr>`;

                $("#detalles").append(row);
                producto.val('');
                hora_carga.val('');
                hora_descarga.val('');
                solucion.val('');
                ph.val('');
                observacion.val('');
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

        function buscar_producto() {

            let productoElement = document.getElementById('producto');

            $.ajax({

                url: "{{url('registro/productos/search')}}" + "/" + productoElement.value,
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
    </script>
@endsection
