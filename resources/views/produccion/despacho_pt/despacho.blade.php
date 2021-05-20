@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'pickear',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>'fa fa-hand-rock-o',
    'operation_icon'=>'fa-angle-up',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Despacho
        @endslot
    @endcomponent
    @if($existenMovimientos)
        @include('produccion.despacho_pt.movimientos')
    @endif
    <form method="post" action="{{route('produccion.despacho.store')}}">
        @csrf
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="orden_compra">NO. FACTURA</label>
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
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">DESCRIPCION</label>
                <input type="text"
                       readonly
                       name="descripcion"
                       id="descripcion"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="lote">LOTE</label>
                <input type="text"
                       readonly
                       name="lote"
                       id="lote"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="ubicacion">UBICACION</label>
                <input type="text"
                       readonly
                       onkeydown="if(event.keyCode==13)buscar_ubicacion()"
                       name="ubicacion"
                       id="ubicacion"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
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

        <div id="content">
            @include('produccion.despacho_pt.listado_productos')
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <button class="btn btn-default"
                        onclick="guardar()"
                        type="button">
                    <span class=" fa fa-check"></span> GUARDAR
                </button>
                <a href="{{url('produccion/despacho')}}">
                    <button class="btn btn-default" type="button">
                        <span class="fa fa-backward"></span>
                        REGRESAR
                    </button>
                </a>

            </div>
        </div>

    </form>
@endsection
@section('scripts')
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/tools/lectura_codigo.js')}}"></script>
    <script>

        let TARIMAS_LEIDAS = [];
        @if(!$existenMovimientos)
        @if($requisicion->reservas->isEmpty() )
        $('#spiner-calculando').show();
        setTimeout(function () {
            $('#spiner-calculando').hide();
            window.location.reload();
        }, 1500)
        @endif
        @else
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

        function leer_movimiento(input, id_producto, lote, codigo_producto) {

            let infoCodigoBarras = descomponerCodigoSSCCInput(input);

            verificar_sscc(infoCodigoBarras, id_producto, lote, codigo_producto)
        }

        function verificar_sscc(sscc, id_producto, lote, codigo_producto) {

            $.ajax({

                url: "{{url('unidad_distribucion?sscc=')}}" + sscc + '&id_producto=' + id_producto + '&lote=' + lote,
                type: "get",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        console.log(response);
                        marcar_movimiento_leido(codigo_producto + lote)
                    } else {
                        alert(response.message)
                    }

                },
                error: function (response) {

                    alert(response.message);
                }
            });

        }

        function marcar_movimiento_leido(id) {

            document.getElementById('check-' + id).style.display = 'block';
            document.getElementById('warning-' + id).style.display = 'none';
            document.getElementById('unidad_distribucion-' + id).readOnly = true;

            let habilitar_formulario = Array.prototype.slice.call(document.getElementsByClassName('label-warning')).filter(x => x.style.display != 'none').length === 0;

            document.getElementById('btn_aceptar').disabled = !habilitar_formulario;

        }

        function cargarInfoCodigoBarras(input) {


            const codigo = input.value.trim();

            if (codigo.length == 20) {

                buscar_producto_by_tarima(codigo);

            } else {
                let infoCodigoBarras = descomponerInput(input, false);
                mostrarInfoCodigoBarras(infoCodigoBarras);

            }


        }

        function buscar_producto_by_tarima(no_tarima) {
            $.ajax({

                url: "{{url('tarima?no_tarima=')}}" + no_tarima + '&reservar=1',
                type: "get",
                dataType: "json",
                success: function (response) {

                    if (response.success) {
                        document.getElementById('ubicacion').value = response.data.ubicacion;
                        document.getElementById('cantidad').value = response.data.total_cajas_tarima;
                        document.getElementById('lote').value = response.data.lote;
                        document.getElementById('descripcion').value = response.data.producto;
                        document.getElementById('id_producto').value = response.data.id_producto;

                        agregar(true, no_tarima)
                    } else {

                        alert(response.data);
                    }
                    console.log(response);

                },
                error: function (error) {

                }
            });
        }


        function mostrarInfoCodigoBarras(infoCodigoBarras) {

            buscar_producto_by_codigo(infoCodigoBarras);


        }


        function reservar_tarima(tarima) {
            $.ajax({

                url: "{{url('reservar_tarima?no_tarima=')}}" + tarima,
                type: "post",
                dataType: "json",
                success: function (response) {

                },
                error: function (err) {

                }
            });
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
                                document.getElementById('ubicacion').readOnly = false;
                                document.getElementById('ubicacion').focus();
                            } else {
                                alert("El producto no es el siguiente a leer ");
                            }
                            @else
                            document.getElementById('descripcion').value = producto.descripcion;
                            document.getElementById('id_producto').value = producto.id_producto;
                            document.getElementById('lote').value = infoCodigoBarras[POSICION_LOTE];
                            document.getElementById('ubicacion').readOnly = false;
                            document.getElementById('ubicacion').focus();
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


        function agregar(es_tarima = false, tarima = '') {


            let id_producto = document.getElementById('id_producto').value;
            let lote = document.getElementById('lote').value;
            let cantidad = parseFloat(document.getElementById('cantidad').value);

            let ubicacion = document.getElementById('ubicacion').value;
            let producto = getProducto(id_producto, lote).filter(e => e.ubicacion.codigo_barras == ubicacion);
            if (producto.length == 0) {
                alert("Producto y lote incorrecto");
            } else {

                if (estaLeido(id_producto, lote, ubicacion)) {
                    alert("Producto ya leido");
                } else {

                    if (parseFloat(producto[0].cantidad) >= cantidad) {

                        const cantidad_acumulada_node = document.getElementById('cantidad_acumulada-' + id_producto + '-' + lote + '-' + ubicacion);
                        const td_cantidad_acumulada = document.getElementById('td_cantidad_acumulada-' + id_producto + '-' + lote + '-' + ubicacion);
                        const cantidad_node = document.getElementById('cantidad-' + id_producto + '-' + lote + '-' + ubicacion);
                        let cantidad_acumulada = parseFloat(cantidad_acumulada_node.value);
                        const cantidad_requerida = parseFloat(cantidad_node.value);


                        if (cantidad_acumulada + cantidad <= cantidad_requerida) {

                            td_cantidad_acumulada.innerText =
                                (parseFloat(td_cantidad_acumulada.innerText) + parseFloat(cantidad)).toString();
                            cantidad_acumulada_node.value = parseFloat(cantidad_acumulada_node.value) + cantidad;
                            cantidad_acumulada = parseFloat(cantidad_acumulada_node.value);

                            if (es_tarima) {
                                reservar_tarima(tarima);
                            }

                            leer(producto[0].id_reserva);

                            limpiar();
                        } else {
                            alert("Algo salió mal, cantidad incorrecta");
                        }



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
            document.getElementById('ubicacion').value = "";

        }

        function estaLeido(id_producto, lote, bodega) {
            let row = document.getElementById(id_producto + "-" + lote + "-" + bodega);
            let estaLeido = row.children[0].children[1].value == "S";
            return estaLeido;
        }

        function getProducto(id_producto, lote) {

            let reservas = getReservas();
            let producto = reservas
                .filter(element => element.id_producto == id_producto)
                .filter(element => element.lote.toUpperCase() == lote.toUpperCase());
            return producto;
        }

        function leer(id_reserva, tarima = '') {

            $('#spiner-buscando').show();
            const cantidad = document.getElementById('cantidad').value;
            $.ajax({
                url: "{{url('produccion/despacho/leer/')}}" + "/" + id_reserva + '?tarima=' + tarima + '&cantidad=' + cantidad,
                type: "post",
                dataType: "json",
                success: function (response) {

                    if (response.status == 1) {
                        checkRow(id_reserva, response.reserva);
                        recalcular();
                    } else if (response.status == 2) {
                        recalcular();
                    } else if (response.status == 3) {
                        //alert(response.message)
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
            recargarListadoProductos();
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

        function buscar_ubicacion() {

            let codigo_barras = document.getElementById('ubicacion').value;
            let lote = document.getElementById('lote').value;
            let id_producto = document.getElementById('id_producto').value;
            if (codigo_barras !== "") {
                $.ajax({
                    url: "{{url('registro/ubicaciones/search')}}" + "/" + codigo_barras,
                    type: "get",
                    dataType: "json",
                    success: function (response) {

                        let ubicacion = response;
                        if (ubicacion.length == 0) {
                            alert("Ubicacion no encontrada");
                        } else if (ubicacion[0].estado == 0) {
                            alert("Ubicacion no disponible");
                        } else {
                            let posicion_valida = document.getElementById(id_producto + "-" + lote + "-" + codigo_barras);

                            if (posicion_valida == null) {
                                alert("El producto no se encuentra en esta ubicacion");
                                document.getElementById('ubicacion').value = "";
                                document.getElementById('ubicacion').focus();
                                return;
                            }
                            document.getElementById('cantidad').readOnly = false;
                            document.getElementById('cantidad').value = "";
                            document.getElementById('cantidad').focus();
                            document.getElementById('ubicacion').readOnly = true;
                        }

                    },
                    error: function (e) {
                        alert("Algo salió mal");
                        console.log(e);
                    }
                })
            } else {

            }
        }

        function recargarListadoProductos() {
            $('#spiner-calculando').show();
            $('#icon-recalcular').addClass('fa-spin');
            setTimeout(async function () {
                let ruta = "{{route('produccion.despacho.despachar',['id'=>$requisicion->id])}}";
                await ajaxLoad(ruta);
            }, 1000);

        }

        async function guardar() {


            let todoLeido = Array.prototype.slice.call(document.getElementsByName('leido[]')).filter(x => x.value === "N").length === 0;
            if (todoLeido) {
                $('form').submit();
            } else {
                alert("Falta producto por recoger");
            }

        }
    </script>
@endsection

