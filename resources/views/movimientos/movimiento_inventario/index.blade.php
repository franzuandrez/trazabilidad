@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-list-alt',
    'operation_icon'=>'',])
        @slot('menu')
            Movimientos
        @endslot
        @slot('submenu')
            Inventario
        @endslot
    @endcomponent

    <div id="content">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <label for="codigo_producto">CODIGO PRODUCTO</label>
                    <div class="input-group">
                        <input type="text"
                               name="codigo_producto"

                               onkeydown="if(event.keyCode==13)buscar_producto()"
                               id="codigo_producto"
                               class="form-control">
                        <div class="input-group-btn">
                            <button
                                onclick="buscar_producto()"
                                onkeydown="buscar_producto()"
                                type="button" class="btn btn-default">
                                <i class="fa fa-search"
                                   aria-hidden="true"></i>
                            </button>
                            <button type="button"
                                    onclick="limpiar()"
                                    onkeydown="limpiar()"
                                    class="btn btn-default">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="producto">PRODUCTO</label>
                        <input type="text"
                               name="producto"
                               readonly
                               id="producto"
                               class="form-control">

                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: #01579B;  color: #fff;">
                            <th>
                                LOTE
                            </th>
                            <th>
                                UBICACION
                            </th>
                            <th>
                                SALIDA
                            </th>
                            <th>
                                ENTRADA
                            </th>
                            <th>
                                NUEVA UBICACION
                            </th>
                            <th>
                                EXISTENCIA
                            </th>
                            <th>
                                CANTIDAD
                            </th>
                            <th>
                                ACCION
                            </th>
                            </thead>
                            <tbody id="listado_lotes">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <div class="loading">
            <i class="fa fa-refresh fa-spin "></i><br/>
            <span>Cargando</span>
        </div>
        @endsection
        @section('scripts')
            <script src="{{asset('js/moment.min.js')}}"></script>
            <script src="{{asset('js/moment-with-locales.js')}}"></script>

            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                function getMovimientosSalida() {

                    let salidas = '';
                    salidas = @json($tipo_movimientos_salida);
                    return salidas;
                }

                function getMovimientosEntrada() {
                    let entradas = [];
                    entradas = @json($tipo_movimientos_entrada);
                    return entradas;
                }

                function getUbicaciones(except = 0) {
                    let ubicaciones = [];
                    ubicaciones = @json($ubicaciones);
                    return ubicaciones.filter(x => x.id_sector !== except);
                }

                function buscar_producto() {
                    let search = document.getElementById('codigo_producto').value;
                    getExistencias(search)
                }

                function getExistencias(search) {

                    $('.loading').show();

                    $.ajax({
                        url: "{{url('movimientos/existencia/productos')}}" + "?search=" + search + '&con_lotes=1',
                        type: "get",
                        dataType: "json",
                        success: function (response) {

                            let noEncontrado = response.existencias.length == 0;

                            if (noEncontrado) {
                                alert("Producto no encontrado");

                            } else {
                                let sinExistencias = response.existencias.map(e => e.total).reduce((x, y) => parseFloat(x) + parseFloat(y), 0) === 0;
                                if (sinExistencias) {

                                    alert("Sin existencias");

                                } else {
                                    $('#listado_lotes').empty();
                                    let existencias = response.existencias;
                                    document.getElementById('producto').value = existencias[0].producto.descripcion;
                                    let row = '';
                                    existencias.forEach(function (e) {
                                        row += `
                                        <tr>
                                            <td><input  type="hidden"
                                            id=lote_${e.id_movimiento}
                                            value=${e.lote}>
                                            <input  type="hidden"
                                            id=fecha_vencimiento_${e.id_movimiento}
                                            value=${e.fecha_vencimiento}>
                                            <input  type="hidden"
                                            id="id_producto_${e.id_movimiento}"
                                            value=${e.id_producto}>
                                                ${e.lote}</td>
                                            <td><input  type="hidden"
                                            id=ubicacion_${e.id_movimiento}
                                            value=${e.sector.codigo_barras}>
                                            ${e.sector.descripcion}</td>
                                            <td>
                             <div class="form-group">
                                <select id="tipo_movimiento_salida_${e.id_movimiento}"
                                        class="form-control ">
                                       <option value="">SELECCIONE TIPO MOVIMIENTO</option>
                                              ${getMovimientosSalida().map(x => `<option value=${x.id_movimiento}>${x.descripcion}</option>`)}
                                        </select>
                                    </div>
                                                    </td>
        <td>
                             <div class="form-group">
                                <select id="tipo_movimiento_entrada_${e.id_movimiento}"
                                        class="form-control ">
                                       <option value="">SELECCIONE TIPO MOVIMIENTO</option>
                                              ${getMovimientosEntrada().map(x => `<option value=${x.id_movimiento}>${x.descripcion}</option>`)}
                                        </select>
                                    </div>
                                                    </td>
  </td>
        <td>
                             <select id="bodega_entrante_${e.id_movimiento}"
                                        class="form-control">
                                       <option value="">SELECCIONE BODEGA</option>
                                              ${getUbicaciones(e.sector.id_sector).map(x => `<option value=${x.codigo_barras}>${x.descripcion}</option>`)}
                                        </select>
                                    </div>
                                                    </td>

                                        <td>${e.total}</td>
                                        <td>
                                             <input class="form-control cantidad_utilizada "
                                               id="cantidad_utilizada_${e.id_movimiento}"
                                               onkeydown="return registar_cantidad_utilizada(${e.total},this)">
                                            </td>
                                            <td>
                                                <button
                                                onclick="realizar_movimiento(${e.id_movimiento})"
                                                type="button" class="btn btn-block btn-default">
                                                    <i class="fa fa-check"></i>
                                                    </button>
                                            </td>
                                                </tr>
`;

                                    });

                                    $('#listado_lotes').append(row);
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

                function setInputFilter(input, inputFilter) {

                    const events = ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"];
                    events.forEach(function (event) {
                        input.addEventListener(event, function () {
                            if (inputFilter(this.value)) {
                                this.oldValue = this.value;
                                this.oldSelectionStart = this.selectionStart;
                                this.oldSelectionEnd = this.selectionEnd;
                            } else if (this.hasOwnProperty("oldValue")) {
                                this.value = this.oldValue;
                                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                            } else {
                                this.value = "";
                            }
                        });
                    });
                }

                function registar_cantidad_utilizada(cantidad_limite, element) {


                    return setInputFilter(element, function (value) {

                        return parseFloat(value) <= parseFloat(cantidad_limite);
                    });

                }

                function realizar_movimiento(id) {

                    if (document.getElementById('tipo_movimiento_salida_' + id).value == "") {
                        alert("Seleccione motivo de salida");
                        return;
                    }
                    if (document.getElementById('tipo_movimiento_entrada_' + id).value == "") {
                        alert("Seleccione motivo de entrada");
                        return;
                    }
                    if (document.getElementById('bodega_entrante_' + id).value == "") {
                        alert("Seleccione nueva ubicacion");
                        return;
                    }
                    if (document.getElementById('cantidad_utilizada_' + id).value == "") {
                        alert("Cantidad a mover en blanco");
                        document.getElementById('cantidad_utilizada_' + id).focus();
                        return;
                    }

                    $.ajax({
                        url: "{{url('movimientos')}}",
                        type: "POST",
                        dataType: "json",
                        data:
                            {
                                no_documento: 'MOVIMIENTO_' + moment().format('YMDHHmmss'),
                                tipo_doc: 'MOVIMIENTO',
                                fecha_vencimiento: [document.getElementById('fecha_vencimiento_' + id).value],
                                lote: [document.getElementById('lote_' + id).value],
                                id_producto: [document.getElementById('id_producto_' + id).value],
                                bodega_saliente: [document.getElementById('ubicacion_' + id).value],
                                cantidad_saliente: [document.getElementById('cantidad_utilizada_' + id).value],
                                tipo_movimiento_salida: [document.getElementById('tipo_movimiento_salida_' + id).value],
                                bodega_entrante: [document.getElementById('bodega_entrante_' + id).value],
                                cantidad_entrante: [document.getElementById('cantidad_utilizada_' + id).value],
                                tipo_movimiento_entrada: [document.getElementById('tipo_movimiento_entrada_' + id).value],
                            }
                        ,
                        success: function (response) {
                            console.log(response);

                            alert("Movimiento realizado correctamente");
                            buscar_producto();

                        }, error: function (err) {

                        }
                    })
                }
            </script>
@endsection
