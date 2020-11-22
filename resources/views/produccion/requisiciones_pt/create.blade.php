@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa  fa fa-file-text ',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Requisiciones PT
        @endslot
    @endcomponent
    @include('componentes.alert-error')
    {!!Form::open(array('url'=>'produccion/requisicion_pt/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    @if(!$requisicion->isEmpty() &&  Session::get('importacion')==null )
        <div class="modal fade modal-slide-in-right in" aria-hidden="false" role="dialog" tabindex="-1"
             onclick="eliminarRequisicionPendiente(event)"
             id="requision_pendiente" style="display: block; padding-right: 17px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" align="center">REQUISICION - FACTURA
                            NO. {{$requisicion[0]->no_requision}}
                            PENDIENTE</h4>
                        <div class="modal-body" align="center">
                            ¿DESEA CONTINUAR?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnCargarRequisicionPendiente"
                                onclick="cargarRequisicionPendiente()" class="btn btn-primary">
                            <span class=" fa fa-check" id="spanCargarRequisicionPendiente"></span> SI
                        </button>
                        <button type="button" class="btn btn-primary"
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
            <label for="no_requisicion">FACTURA</label>
            <input type="text"
                   name="no_requisicion"
                   id="no_requisicion"
                   readonly
                   value="{{old('no_requision')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cliente">CLIENTE</label>
            <input type="text"
                   name="cliente"
                   id="cliente"
                   readonly
                   value="{{old('cliente')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cliente_ref_2">REFERENCIA</label>
            <input type="text"
                   name="cliente_ref_2"
                   id="cliente_ref_2"
                   readonly
                   value="{{old('cliente_ref_2')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text"
                   name="direccion"
                   id="direccion"
                   readonly
                   value="{{old('direccion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="tab-content">
            <div class="col-lg-push-5 col-lg-4  col-md-push-5 col-md-4  ">
                <input type="file" name="file_requisiones">
                <a class="btn btn-app" onclick="javascript:importar()">
                    <i class="fa fa-upload"></i>
                    IMPORTAR
                </a>
            </div>

        </div>
    </div>

    @include('componentes.loading')
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #f7b633;  color: #fff;">
            <th>Cantidad</th>
            <th>CODIGO PRODUCTO</th>
            <th>Producto</th>
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
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('produccion/requisicion_pt ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
            </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
    <form id="frm_importar" style="display: none !important;"
          enctype="multipart/form-data"
          method="POST" action="{{url('produccion/requisicion_pt/importar')}}">
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


        function alertInexitencia() {
            $('#errorToEdit').modal();
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


            cantidad = parseFloat(cantidad);

            if (cantidad + cantidadAgregada > getTotalExistencia()) {
                alert("Cantidad insuficiente");
                document.getElementById('cantidad').value = "";
            } else {
                insertarProducto(id_producto, cantidad, id_requisicion);
                document.getElementById('codigo_producto').focus()
            }


        }

        function getTotalPorLote(total) {

            let lotes = existencia.map(prod => parseFloat(prod.total));
            let entrante = [];
            let nuevoTotal = parseFloat(total);
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
                    sum = sum + parseFloat(document.getElementsByName('id_producto[]')[i].nextSibling.nextSibling.value);
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


        function cargarProducto(producto, cantidad, id,unidad_medida) {

            let row = ` <tr id="prod-${id}">
                    <td>${cantidad}</td>
                    <td>${producto.codigo_barras}</td>
                    <td>${producto.descripcion}</td>
                    <td>${unidad_medida}</td>
                    </tr>    `;

            $('#body-detalles').append(row);
        }


        function setRequisicionPendiente() {
            let req = [];
            req = @json($requisicion);

            if (req.length != 0) {
                document.getElementById('id_requisicion').value = req[0].id;
                if (req[0].no_requision == null) {
                    document.getElementById('no_requisicion').readOnly = true;
                    document.getElementById('no_requisicion').value = req[0].no_requision;
                } else {
                    document.getElementById('no_requisicion').readOnly = true;
                    document.getElementById('no_requisicion').value = req[0].no_requision;
                    console.log(req[0].detalle_pt);
                    document.getElementById('cliente').value = req[0].detalle_pt.cliente_ref_1;
                    document.getElementById('cliente_ref_2').value = req[0].detalle_pt.cliente_ref_2;
                    document.getElementById('direccion').value = req[0].detalle_pt.direccion;
                    console.log(req[0].detalle_pt);

                    req[0].detalle.forEach(function (e) {
                        cargarProducto(e.producto, e.cantidad, e.id,e.unidad_medida);
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
