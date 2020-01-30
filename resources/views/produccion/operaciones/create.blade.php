@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa fa-hand-rock-o  ',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Requisiciones
        @endslot
    @endcomponent
    @include('componentes.alert-error')
    {!!Form::open(array('url'=>'produccion/requisiciones/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    @if(!$requisicion->isEmpty() &&  Session::get('importacion')==null )
        <div class="modal fade modal-slide-in-right in" aria-hidden="false" role="dialog" tabindex="-1"
             onclick="eliminarRequisicionPendiente(event)"
             id="requision_pendiente" style="display: block; padding-right: 17px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" align="center">REQUISICION NO. {{$requisicion[0]->no_requision}}
                            PENDIENTE</h4>
                        <div class="modal-body" align="center">
                            ¿DESEA CONTINUAR?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnCargarRequisicionPendiente"
                                onclick="cargarRequisicionPendiente()" class="btn btn-default">
                            <span class=" fa fa-check" id="spanCargarRequisicionPendiente"></span> SI
                        </button>
                        <button type="button" class="btn btn-default"
                                id="btnEliminarRequisionPendiente"
                                data-dismiss="modal"><span
                                id="spanEliminarRequisicionPendiente"
                                class="fa fa-remove"></span> NO
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{Session::get('importar')}}
    <input name="id_requisicion" type="hidden" id="id_requisicion">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_requisicion">NO.REQUISION</label>
            <input type="text"
                   name="no_requisicion"
                   id="no_requisicion"
                   onkeydown="if(event.keyCode==13)validarRequisicion()"
                   value="{{old('no_requision')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_orden_produccion">NO.ORDEN PRODUCCION</label>
            <input type="text"
                   name="no_orden_produccion"
                   readonly
                   onkeydown="if(event.keyCode==13)validarOrdenProduccion()"
                   id="no_orden_produccion"
                   value="{{$no_orden_produccion}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#crear" data-toggle="tab" aria-expanded="false">
                    INGRESAR
                </a>
            </li>
            <li class="">
                <a href="#importar" data-toggle="tab" aria-expanded="false">
                    IMPORTAR
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="crear">
                <br>
                <div class="col-lg-6 col-sm-4 col-md-4 col-xs-12">
                    <label for="codigo_producto">CODIGO PRODUCTO</label>
                    <div class="input-group">
                        <input type="text"
                               name="codigo_producto"
                               readonly
                               id="codigo_producto"
                               onkeydown="if(event.keyCode==13)buscar_existencia()"
                               value="{{old('codigo_producto')}}"
                               class="form-control">
                        <div class="input-group-btn">
                            <button id="btnBuscar"
                                    onclick="buscar_existencia()"
                                    class="btn btn-default " type="button">
                                <span class=" fa fa-search"></span></button>
                            <button id="btnLimpiar"
                                    onclick="limpiar()"
                                    class="btn btn-default " type="button">
                                <span class=" fa fa-trash"></span></button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-4  col-xs-12">
                    <div class="form-group">
                        <label for="existencia">EXISTENCIA</label>
                        <input type="text" name="existencia" id="existencia" readonly value="{{old('existencia')}}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 col-md-2 col-sm-4  col-xs-12">
                    <div class="form-group">
                        <label for="descripcion">DESCRIPCION</label>
                        <input type="text" name="descripcion" id="descripcion" readonly value="{{old('descripcion')}}"
                               class="form-control">
                        <input type="hidden" name="id_producto" id="id_producto" readonly value="{{old('id_producto')}}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">
                    <label for="cantidad">CANTIDAD</label>
                    <div class="input-group">
                        <input type="number" name="cantidad" id="cantidad"
                               onkeydown="if(event.keyCode==13)agregarProducto()"
                               readonly
                               value="{{old('cantidad')}}"
                               class="form-control">
                        <div class="input-group-btn">
                            <button
                                onclick="agregarProducto()"
                                class="btn btn-default " type="button">
                                <span class=" fa fa-plus"></span></button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane " id="importar">

                <div class="col-lg-push-5 col-lg-4  col-md-push-5 col-md-4  ">

                    <input type="file" name="file_requisiones">
                    <a class="btn btn-app" onclick="javascript:importar()">
                        <i class="fa fa-upload"></i>
                        IMPORTAR
                    </a>

                </div>

            </div>
        </div>
    </div>

    @include('componentes.loading')
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #01579B;  color: #fff;">
            <th>OPCION</th>
            <th>CANTIDAD</th>
            <th>CODIGO PRODUCTO</th>
            <th>PRODUCTO</th>
            <th>UNIDAD MEDIDA</th>
            </thead>
            <tbody id="body-detalles">
            </tbody>
        </table>
    </div>
    @component('componentes.alert-no-selecction',
    ['mensaje'=>'Producto sin existencias'])

    @endcomponent
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('produccion/requisiciones')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>
        </div>
    </div>
    {!!Form::close()!!}
    <form id="frm_importar" style="display: none !important;"
          enctype="multipart/form-data"
          method="POST" action="{{url('produccion/requisiciones/importar')}}">
        <input name="id_requisicion_importar" id="id_requisicion_importar" type="hidden">
        {{Form::token()}}
    </form>
@endsection
@section('scripts')
    <script>

        @if(Session::get('importacion')!=null)
        cargarRequisicionPendiente();
        @endif

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        $('#requision_pendiente').modal('toggle');

        function importar() {


            let isFileSelected = document.getElementsByName('file_requisiones')[0].files.length > 0;
            let id_requisicion = document.getElementById('id_requisicion').value;
            if (id_requisicion === "") {
                alert("No. Requisición no válida");
                document.getElementById('no_requisicion').focus();
                return;
            }

            if (isFileSelected) {
                var file = document.getElementsByName('file_requisiones')[0];
                var cln = file.cloneNode(true);
                document.getElementById('id_requisicion_importar').value = id_requisicion;
                document.getElementById("frm_importar").appendChild(cln);
                $('#frm_importar').submit();
            } else {
                alert("Debe seleccionar un arhivo");
            }

        }

        function limpiar() {
            document.getElementById('codigo_producto').value = "";
            document.getElementById('descripcion').value = "";
            document.getElementById('id_producto').value = "";
            document.getElementById('cantidad').value = "";
            document.getElementById('cantidad').readOnly = true;
            document.getElementById('existencia').value = "";
        }

        function buscar_existencia() {
            let search = document.getElementById('codigo_producto').value;
            getExistencias(search)
        }

        var existencia = [];
        var totalEnReserva = 0;

        function getExistencias(search) {

            $('.loading').show();
            $.ajax({
                url: "{{url('movimientos/existencia/productos')}}" + "?search=" + search + "&ubicacion=1",
                type: "get",
                dataType: "json",
                success: function (response) {

                    let noEncontrado = response.length == 0;

                    if (noEncontrado) {
                        document.getElementById('no_selecction_mensaje').innerText = 'Producto no encontrado';
                        alertInexitencia();
                        document.getElementById('descripcion').value = "";
                        document.getElementById('cantidad').readOnly = true;

                    } else {
                        let sinExistencias = response.map(e => e.total).reduce((x, y) => parseFloat(x) + parseFloat(y), 0) === 0;
                        if (sinExistencias) {
                            document.getElementById('no_selecction_mensaje').innerText = 'Producto sin existencias';
                            alertInexitencia();
                            document.getElementById('descripcion').value = "";
                            document.getElementById('cantidad').readOnly = true;
                        } else {
                            existencia = response;
                            document.getElementById('descripcion').value = response[0].producto.descripcion;
                            document.getElementById('id_producto').value = response[0].producto.id_producto;
                            document.getElementById('cantidad').readOnly = false;
                            document.getElementById('cantidad').focus();
                            document.getElementById('existencia').value = getTotalExistencia() + " " + response[0].producto.unidad_medida;
                        }


                    }
                    $('.loading').hide();
                },
                error: function (e) {
                    console.error(e);
                    $('.loading').hide();
                }
            })
        }

        function cargarLotes(existencias, lotesEntrantes) {

            let row = '';

            for (var i = 0; i < existencias.length; i++) {

                if (lotesEntrantes[i] > 0) {
                    row += ` <tr>
                    <td>
                        <input type="hidden" name="id_producto[]"   value="${existencias[i].producto.id_producto}">
                        <input type="hidden" name="cantidad_entrante[]"  value="${lotesEntrantes[i]}" >
                        <input type="hidden" name="no_lote[]"   value="${existencias[i].lote}">
                    </td>
                    <td> ${lotesEntrantes[i]}</td>
                    <td>${existencias[i].producto.descripcion}</td>
                    <td>${existencias[i].lote}</td>
                    </tr>    `;
                }
            }
            $('#body-detalles').append(row);

        }

        function alertInexitencia() {
            $('#errorToEdit').modal();
        }

        function getTotalExistencia() {

            let total = 0;
            if (existencia.length > 0) {
                total = existencia.map(e => e.total).reduce((accum, curr) => parseInt(accum) + parseInt(curr));
            }

            return total;
        }

        async function agregarProducto() {
            let id_producto = document.getElementById('id_producto').value;
            let id_requisicion = document.getElementById('id_requisicion').value;
            let cantidad = document.getElementById('cantidad').value;
            if (cantidad == "") {
                alert("Cantidad invalida");
                return;
            }


            let cantidadAgregada = await getTotalEnReserva(id_producto);


            cantidad = parseInt(cantidad);

            if (cantidad + cantidadAgregada > getTotalExistencia()) {
                alert("Cantidad insuficiente");
                document.getElementById('cantidad').value = "";
            } else {
                insertarProducto(id_producto, cantidad, id_requisicion);
                document.getElementById('codigo_producto').focus()
            }


        }

        function getTotalPorLote(total) {

            let lotes = existencia.map(prod => parseInt(prod.total));
            let entrante = [];
            let nuevoTotal = parseInt(total);
            for (var i = 0; i < lotes.length; i++) {

                if (lotes[i] <= nuevoTotal) {
                    entrante.push(lotes[i]);
                    nuevoTotal = nuevoTotal - lotes[i];
                } else {
                    entrante.push(nuevoTotal);
                    nuevoTotal = 0;
                }

            }

            return entrante;

        }

        function getCantidadAgregada(id_producto) {
            let productos = document.getElementsByName('id_producto[]');
            let sum = 0;
            for (var i = 0; i < productos.length; i++) {

                if (productos[i].value == id_producto) {
                    sum = sum + parseInt(document.getElementsByName('id_producto[]')[i].nextSibling.nextSibling.value);
                }
            }

            return sum;
        }

        function limpiarProductoAgregados(id_producto) {
            Array.prototype.slice.call(document.getElementsByName('id_producto[]')).forEach(function (e) {
                if (e.value == id_producto) {
                    e.parentNode.parentNode.remove();
                }
            })

        }

        function removeFromTable(id) {
            $('.loading').show();
            $.ajax({
                    url: "{{url('produccion/requisiciones/borrar_de_reserva')}}",
                    type: "post",
                    dataType: "json",
                    data: {id: id},
                    success: function (response) {
                        let destroyed = response[0] == 1;
                        if (destroyed) {
                            $('#prod-' + id).remove();
                            console.log(id);
                        } else {
                            alert("Algo salió mal");
                        }
                        $('.loading').hide();

                    }, error: function (e) {
                        alert(e);
                        $('.loading').hide();
                    }
                }
            )


        }

        function cargarProducto(producto, cantidad, id) {

            let row = ` <tr id="prod-${id}">
                    <td>
                       <button onclick=removeFromTable(${id}) type="button" class="btn btn-warning">x</button>
                        <input type="hidden" name="id_producto[]"   value="${producto.id_producto}">
                        <input type="hidden" name="cantidad[]"   value="${cantidad}">
                    </td>
                    <td>${cantidad}</td>
                    <td>${producto.codigo_barras}</td>
                    <td>${producto.descripcion}</td>
                    <td>${producto.unidad_medida}</td>
                    </tr>    `;

            $('#body-detalles').append(row);
        }

        function validarRequisicion() {
            $('.loading').show();
            let no_requisicion = document.getElementById('no_requisicion').value;
            $.ajax({
                url: "{{url('produccion/requisiciones/validar_requisicion/')}}" + "/" + no_requisicion,
                type: "get",
                dataType: "json",
                success: function (response) {
                    let isNew = response[0] == 1;

                    if (isNew) {
                        document.getElementById('id_requisicion').value = response[1];
                        document.getElementById('no_orden_produccion').focus();
                        document.getElementById('no_orden_produccion').readOnly = false;
                        document.getElementById('no_requisicion').readOnly = true;

                        document.getElementById('codigo_producto').focus();
                        document.getElementById('codigo_producto').readOnly = false;
                        document.getElementById('no_orden_produccion').readOnly = true;
                        validarOrdenProduccion();
                    } else {
                        let estaEnProceso = response[1].toUpperCase() == "P";
                        if (estaEnProceso) {
                            alert("Orden de requisicion en proceso");
                        } else {
                            alert("Orden de requisicion existente");
                        }
                    }
                    $('.loading').hide();
                }

            })


        }

        function validarOrdenProduccion() {
            $('.loading').show();
            let no_orden_produccion = document.getElementById('no_orden_produccion').value;
            let id_requision = document.getElementById('id_requisicion').value;
            $.ajax({
                url: "{{url('produccion/requisiciones/validar_orden_produccion/')}}" + "/" + no_orden_produccion + "/" + id_requision,
                type: "get",
                dataType: "json",
                success: function (response) {
                    let isNew = response[0] == 1;

                    if (isNew) {
                        document.getElementById('codigo_producto').focus();
                        document.getElementById('codigo_producto').readOnly = false;
                        document.getElementById('no_orden_produccion').readOnly = true;
                    } else {
                        let estaEnProceso = response[1].toUpperCase() == "P";
                        if (estaEnProceso) {
                            alert("Orden de Produccion en proceso");
                        } else {
                            alert("Orden de Produccion existente");
                        }
                    }
                    $('.loading').hide();
                }

            })
        }

        function insertarProducto(id_producto, cantidad, id_requisicion) {
            $('.loading').show();
            $.ajax({
                url: "{{url('produccion/requisiciones/reservar')}}",
                type: "post",
                dataType: "json",
                data: {id: id_requisicion, cantidad: cantidad, id_producto: id_producto},
                success: function (response) {

                    let inserted = response[0] == 1;
                    if (inserted) {
                        let id = response[1];
                        cargarProducto(existencia[0].producto, cantidad, id);
                        limpiar();
                        existencia.splice(0, existencia.length);
                    } else {
                        alert("Algo salió mal");
                    }
                    $('.loading').hide();

                }

            })

        }

        function getTotalEnReserva(id_producto) {
            $('.loading').show();
            return $.ajax({
                url: "{{url('produccion/requisiciones/en_reserva')}}" + "/" + id_producto,
                type: "get",
                dataType: "json",
                success: function (response) {

                    $('.loading').hide();
                }, error: function (e) {
                    $('.loading').hide();
                }
            })

        }

        function setRequisicionPendiente() {
            let req = [];
            req = @json($requisicion);
            if (req.length != 0) {
                document.getElementById('id_requisicion').value = req[0].id;
                if (req[0].no_orden_produccion == null) {
                    document.getElementById('no_requisicion').readOnly = true;
                    document.getElementById('no_requisicion').value = req[0].no_requision;
                    document.getElementById('no_orden_produccion').readOnly = false;
                    document.getElementById('no_orden_produccion').focus();
                } else {
                    document.getElementById('no_orden_produccion').readOnly = true;
                    document.getElementById('no_orden_produccion').value = req[0].no_orden_produccion;
                    document.getElementById('no_requisicion').readOnly = true;
                    document.getElementById('no_requisicion').value = req[0].no_requision;
                    document.getElementById('codigo_producto').readOnly = false;
                    document.getElementById('codigo_producto').focus();
                    req[0].detalle.forEach(function (e) {
                        cargarProducto(e.producto, e.cantidad, e.id);
                    });
                }
            }


        }

        function cargarRequisicionPendiente() {
            $('#requision_pendiente').modal('hide');
            $('.loading').show();
            setTimeout(function () {
                $('.loading').hide();
                setRequisicionPendiente();
            }, 1000)
        }

        function eliminarRequisicionPendiente(event) {

            let id = $(event.originalTarget).attr('id');

            if (typeof id == 'undefined') {
                id = $(event.target).attr('id');
            }
            if (id == "requision_pendiente" || id == "spanEliminarRequisicionPendiente" || id == "btnEliminarRequisionPendiente") {
                $('.loading').show();
                $.ajax({
                    url: "{{url('produccion/requisiciones/borrar_reservas')}}",
                    type: "get",
                    dataType: "JSON",
                    success: function (response) {

                        $('.loading').hide();
                        if (response[0] == 0) {
                            alert("Algo salio mal");
                        } else {
                            document.getElementById('no_requisicion').focus();
                            window.location.reload();
                        }

                    },
                    error: function (e) {
                        $('.loading').hide();
                    }
                })
            }
        }
    </script>
@endsection
