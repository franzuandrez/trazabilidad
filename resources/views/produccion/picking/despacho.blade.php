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
    <div class="loading" id="spiner-buscando">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    <div class="loading" id="spiner-calculando">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Recalculando</span>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
        <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff">
                <th></th>
                <th>PRODUCTO</th>
                <th>LOTE</th>
                <th>CANTIDAD</th>
                <th>UBICACION</th>
                </thead>
                <tbody>
                @foreach( $requisicion->reservas as $reserva  )
                    <tr id="{{$reserva->id_producto}}-{{$reserva->lote}}-{{$reserva->ubicacion}}">
                        <td>
                            @if($reserva->leido == 'N')
                                <span class="label label-warning"
                                      id="span-{{$reserva->id_reserva}}"
                                      data-html="true"
                                      title="
                                      <strong>Estado :</strong> Pendiente
                                                "
                                      data-toggle="tooltip">
                                 <i class="fa fa-exclamation" aria-hidden="true"></i>
                                </span>
                            @else
                                <span class="label label-success"
                                      data-html="true"
                                      title="
                                      <strong>Estado :</strong> Leido<br>
                                      <strong>Por : </strong>{{$reserva->usuario_picking->nombre}}<br>
                                      <strong>Fecha : </strong>{{$reserva->fecha_lectura->format('d/m/Y')}}<br>
                                      <strong>Hora: </strong>{{$reserva->fecha_lectura->format('H:i:s')}}
                                          "
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
                            {{$reserva->ubicacion}}
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
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script>
        @if($requisicion->reservas->isEmpty())
        $('#spiner-calculando').show();
        setTimeout(function () {
            $('#spiner-calculando').hide();
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
            $('#spiner-buscando').show();
            $.ajax({

                url: "{{url('registro/productos/search')}}" + "/" + codigo,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let productos = response;
                    let totalProductos = productos.length;

                    if (totalProductos == 0) {
                        alert("Producto no encontrado");
                    } else {
                        let producto = productos[0];

                        let id_producto = producto.id_producto;
                        let lote = infoCodigoBarras[POSICION_LOTE];

                        let existeProducto = getProducto(id_producto, lote).length != 0;

                        if (existeProducto) {
                            let producto_a_leer = getProximoLeer();
                            let id_producto_a_leer = producto_a_leer[0];
                            let lote_a_leer = producto_a_leer[1];
                            let es_proximo_a_leer = id_producto == id_producto_a_leer && lote == lote_a_leer;

                            @if($validarOrdenProductos)
                            if (es_proximo_a_leer) {
                                document.getElementById('descripcion').value = producto.descripcion;
                                document.getElementById('id_producto').value = producto.id_producto;
                                document.getElementById('lote').value = infoCodigoBarras[POSICION_LOTE];
                                document.getElementById('cantidad').readOnly = false;
                                document.getElementById('cantidad').focus();
                            } else {
                                alert("El producto no es el siguiente a leer ");
                            }
                            @else
                            document.getElementById('descripcion').value = producto.descripcion;
                            document.getElementById('id_producto').value = producto.id_producto;
                            document.getElementById('lote').value = infoCodigoBarras[POSICION_LOTE];
                            document.getElementById('cantidad').readOnly = false;
                            document.getElementById('cantidad').focus();
                            @endif


                        } else {
                            alert("Producto y lote no válido");
                        }

                    }
                    $('#spiner-buscando').hide();

                },
                error: function (e) {
                    $('#spiner-buscando').hide();
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

                if (estaLeido(id_producto, lote, '0101010110112')) {
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
            $('#spiner-buscando').show();
            $.ajax({
                url: "{{url('produccion/picking/leer')}}" + "/" + id_reserva,
                type: "post",
                dataType: "json",
                success: function (response) {


                    if (response.status == 1) {

                        checkRow(id_reserva, response.reserva);
                    } else if (response.status == 2) {
                        recalcular();
                    } else {
                        alert("Algo salió mal, por favor vuelva a intentarlo");
                    }
                    $('#spiner-buscando').hide();

                },
                error: function (e) {
                    alert("Algo salió mal, por favor vuelva a intentarlo");
                    $('#spiner-buscando').hide();
                    console.error(e);
                }
            })
        }


        function recalcular() {

            $('#spiner-calculando').show();
            setTimeout(function () {
                $('#spiner-calculando').hide();
                window.location = "{{route('produccion.picking.despachar',['id'=>$requisicion->id])}}";
            }, 1500)


        }

        function checkRow(id, reserva) {


            let tooltip = `
             <strong>Estado :</strong> Leido<br>
             <strong>Por : </strong>${reserva[1]}<br>
             <strong>Fecha : </strong>${moment(reserva[0].fecha_lectura).format('DD/MM/Y')}<br>
             <strong>Hora: </strong>${moment(reserva[0].fecha_lectura).format('HH:mm:ss')}
                `;


            let span = document.getElementById('span-' + id);
            span.classList.remove('label-warning');
            span.classList.add('label-success');
            span.originalTitle = "Leido";
            span.title = "Leido";
            span.dataset.originalTitle = tooltip;
            span.innerHTML = "<i class='fa fa-check'></i>";
            span.nextElementSibling.value = "S";


        }


        function getProximoLeer() {

            let productosNoLeidos = Array.prototype.slice.call(document.getElementsByName('leido[]')).filter(x => x.value == "N");
            let existeProximoLeer = productosNoLeidos.length != 0;

            let productoProximoLeer = [0, 0, 0];// Id_produdcto , lote , bodega
            if (existeProximoLeer) {
                let row = $(productosNoLeidos[0]).closest('tr').attr('id');
                productoProximoLeer = row.split('-');
            }

            return productoProximoLeer;

        }
    </script>
@endsection

