@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-sign-in',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Materia Prima
        @endslot
    @endcomponent

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. REQUISICION</label>
            <input type="text"
                   readonly
                   name="no_requisicion"
                   value="{{$requisicion->no_requision}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_producto">CODIGO PRODUCTO</label>
            <input type="text"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)cargarInfoCodigoBarras(this)"
                   name="codigo_producto"
                   class="form-control">
        </div>
    </div>
    <input type="hidden" name="id_producto" id="id_producto">
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text"
                   readonly
                   name="descripcion"
                   id="descripcion"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>
            <input type="text"
                   readonly
                   name="lote"
                   id="lote"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad">CANTIDAD</label>
            <input type="text"
                   readonly
                   id="cantidad"
                   name="cantidad"
                   onkeydown="if(event.keyCode==13)agregar()"
                   class="form-control">
        </div>
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
        <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <th></th>
                <th>PRODUCTO</th>
                <th>LOTE</th>
                <th>CANTIDAD</th>
                <th>BODEGA</th>
                </thead>
                <tbody>
                @foreach( $requisicion->reservas as $reserva  )
                    <tr id="{{$reserva->id_producto}}-{{$reserva->lote}}-{{$reserva->id_bodega}}">
                        <td>
                            @if($reserva->leido == 'N')
                                <span class="label label-warning"
                                      id="span-{{$reserva->id_reserva}}"
                                      title="Pendiente"
                                      data-toggle="tooltip">
                                 <i class="fa fa-exclamation" aria-hidden="true"></i>
                                </span>
                            @else
                                <span class="label label-success"
                                      title="Leido"
                                      data-toggle="tooltip">

                                 <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                            @endif
                            <input type="hidden" name="leido[]" value="{{$reserva->leido}}">
                        </td>
                        <td>
                            {{$reserva->producto->descripcion}}
                        </td>
                        <td>
                            {{$reserva->lote}}
                        </td>
                        <td>
                            {{$reserva->cantidad}}
                        </td>
                        <td>
                            {{$reserva->bodega->descripcion}}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('produccion/picking')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>


@endsection
@section('scripts')
    <script>
        @if($requisicion->reservas->isEmpty())

        $('.loading').show();
        setTimeout(function () {
            $('.loading').hide();
            window.location.reload();
        }, 1500)

        @else
        function getReservas() {

            let reservas = @json($requisicion->reservas);
            return reservas;
        }

        @endif
        limpiar();
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function cargarInfoCodigoBarras(input) {


            let infoCodigoBarras = descomponerInput(input);
            mostrarInfoCodigoBarras(infoCodigoBarras);


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

                    } else {

                        let producto = productos[0];
                        document.getElementById('descripcion').value = producto.descripcion;
                        document.getElementById('id_producto').value = producto.id_producto;
                        document.getElementById('lote').value = infoCodigoBarras[POSICION_LOTE];
                        document.getElementById('cantidad').readOnly = false;
                        document.getElementById('cantidad').focus();

                    }
                    $('.loading').hide();

                },
                error: function (e) {
                    $('.loading').hide();
                    console.log(e);
                }

            })


        }

        function agregar() {

            let id_producto = document.getElementById('id_producto').value;
            let lote = document.getElementById('lote').value;
            let cantidad = parseFloat(document.getElementById('cantidad').value);
            let producto = getProducto(id_producto, lote);


            if (producto.length == 0) {
                alert("Producto y lote incorrecto");
            } else {

                if (estaLeido(id_producto, lote, 1)) {
                    alert("Producto ya leido");
                } else {

                    if (parseFloat(producto[0].cantidad) == cantidad) {
                        limpiar();
                        leer(producto[0].id_reserva);
                    } else {
                        alert("Cantidad incorrecta");
                    }
                }

            }


        }

        function limpiar() {
            document.getElementById('cantidad').value = "";
            document.getElementById('cantidad').readOnly = true;
            document.getElementById('lote').value = "";
            document.getElementById('descripcion').value = "";
            document.getElementById('codigo_producto').value = "";
            document.getElementById('codigo_producto').focus();
            document.getElementById('id_producto').value = "";

        }

        function estaLeido(id_producto, lote, bodega) {
            let estaLeido = document.getElementById(id_producto + "-" + lote + "-" + bodega).children[0].children[1].value == "S";
            return estaLeido;
        }

        function getProducto(id_producto, lote) {

            let reservas = getReservas();
            let producto = reservas
                .filter(element => element.id_producto == id_producto)
                .filter(element => element.lote.toUpperCase() == lote.toUpperCase());
            return producto;
        }

        function leer(id_reserva) {
            $('.loading').show();
            $.ajax({
                url: "{{url('produccion/picking/leer')}}" + "/" + id_reserva,
                type: "post",
                dataType: "json",
                success: function (response) {

                    if (response == 1) {
                        checkRow(id_reserva);
                    } else {
                        alert("Algo salió mal, por favor vuelva a intentarlo");
                    }
                    $('.loading').hide();

                },
                error: function (e) {
                    $('.loading').hide();
                    console.error(e);
                }
            })
        }

        function checkRow(id) {

            let span = document.getElementById('span-' + id);
            span.classList.remove('label-warning');
            span.classList.add('label-success');
            span.innerHTML = "<i class='fa fa-check'></i>";

        }
    </script>
@endsection

