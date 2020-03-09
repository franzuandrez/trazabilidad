@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12    col-md-12   col-xs-12">
        <h3>VERIFICACION DE MATERIA PRIMAS PARA SOLUCION DE CHAO MEIN</h3>
    </div>

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-th',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Verificacion Materias para Solucion Chao Mein
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/verificacion_materias_chao/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" id="id_control" name="id_control">

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="turno">NO ORDEN DE PRODUCCION</label>
        <div class="input-group">
            <input type="text"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==13)iniciar_control_laminado()"
                   name="no_orden_produccion" value="{{old('no_orden_produccion')}}"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    id="btn_buscar_orden"
                    onclick="iniciar_control_laminado()"
                    onkeydown="iniciar_control_laminado()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-search"
                       aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>


    @include('componentes.loading')
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="" selected>SELECCIONE UN PRODUCTO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="turno">TURNO</label>
        <div class="input-group">
            <select class="form-control selectpicker "
                    id="id_turno" name="id_turno" disabled>
                <option value="" selected>SELECCIONE UN TURNO</option>
                <option value="1">TURNO 1</option>
                <option value="2">TURNO 2</option>
            </select>
            <div class="input-group-btn">
                <button
                    data-toggle="tooltip"
                    title="Iniciar"
                    onclick="inicio_formulario()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-check"
                       aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        @include('control.verificacion_materia_prima_chao.insumos')
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="batch_no">BATCH NO.</label>
                <input id="batch_no"
                       type="number"
                       step="any"
                       required
                       disabled
                       name="batch_no"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="producto">PRODUCTO </label>
                <input id="producto"
                       disabled
                       onkeydown="if(event.keyCode==13)buscar_insumo()"
                       type="text" name="producto" value="{{old('producto')}}"
                       class="form-control">
            </div>
        </div>
        <input id="id_producto_insumo"
               disabled
               required
               type="hidden" name="id_producto_insumo" value="{{old('id_producto_insumo')}}"
               class="form-control">
        <input id="lote"
               disabled
               type="hidden" name="lote" value="{{old('lote')}}"
               class="form-control">
        <input id="cantidad_total"
               disabled
               type="hidden" name="cantidad_total" value="{{old('cantidad_total')}}"
               class="form-control">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad">CANTIDAD </label>
                <input id="cantidad"
                       disabled
                       required
                       type="number"
                       step="any"
                       name="cantidad" value="{{old('cantidad')}}"
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="equipo">EQUIPO</label>
                <input id="equipo"
                       disabled
                       type="text" name="equipo" value="{{old('equipo')}}"
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="observaciones">OBSERVACIONES</label>
            <div class="input-group">
                <input id="observaciones"
                       disabled
                       type="text" name="observaciones" value="{{old('observaciones')}}"
                       class="form-control">
                <div class="input-group-btn">
                    <button
                        data-toggle="tooltip"
                        title="Agregar"
                        onclick="agregar_a_table()"
                        type="button" class="btn btn-default">
                        <i class="fa fa-plus"
                           aria-hidden="true"></i>
                    </button>
                    <button
                        data-toggle="tooltip"
                        title="Limpiar"
                        onclick="limpiar()"
                        type="button" class="btn btn-default">
                        <i class="fa fa-trash"
                           aria-hidden="true"></i>
                    </button>
                </div>

            </div>
        </div>


        <div class="tab-pane" id="tab_3">

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                    <thead style="background-color: #01579B;  color: #fff;">
                    <th>BATCH NO</th>
                    <th>ID PRODUCTO</th>
                    <th>PRODUCTO</th>
                    <th>LOTE</th>
                    <th>CANTIDAD</th>
                    <th>EQUIPO</th>
                    <th>OBSERVACIONES</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
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
            <button class="btn btn-default"
                    onclick="guardar()"
                    type="button">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('control/verificacion_materias_chao')}}">
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
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment-with-locales.js')}}"></script>
    <script src="{{asset('js-brc/tools/nuevo_registro.js')}}"></script>
    <script>
        $(function () {
            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            });
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    </script>

    <script>
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            setDate: new Date()

        });

        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    </script>
    <script>
        var gl_detalle_insumos = null;

        function guardar() {

            document.getElementById('no_orden_produccion').disabled = false;
            $('form').submit();
        }

        function cargar_productos() {

            const select = document.getElementById('id_producto');
            $(select).empty();
            let option = '<option value="" selected>   SELECCIONE PRODUCTO </option>';
            gl_detalle_insumos.forEach(function (e) {
                option += `
                <option  value="${e.id_producto}" > ${e.presentacion.descripcion} </option>
                `
            });
            $(select).append(option);
            $(select).selectpicker('refresh');
        }

        function cargar_lotes(id) {

            if (id != "") {
                const select = document.getElementById('lote');
                $(select).empty();
                let option = '<option value="" selected>SELECCIONE LOTE</option>';
                var id_producto = id;
                const filtered = gl_detalle_insumos.filter(function (e) {
                    return e.id_producto == id_producto;
                });

                const es_unico_lote = filtered.length == 1;

                if (es_unico_lote) {
                    option += `<option selected value="${filtered[0].control_trazabilidad.lote}" >${filtered[0].control_trazabilidad.lote}</option>`;
                } else {
                    filtered.forEach(function (e) {
                        option += `<option value="${e.control_trazabilidad.lote}" >${e.control_trazabilidad.lote}</option>`;
                    })
                }
                $(select).append(option);
                $(select).selectpicker('refresh');
            }


        }


        async function iniciar_control_laminado() {

            $('.loading').show();
            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('control/verificacion_materias_chao/iniciar_harina')}}";
            const response = await iniciar(url, no_orden_produccion);

            if (response.status == 0) {
                alert(response.message);
            } else {
                gl_detalle_insumos = response.data.data;
                document.getElementById('id_producto').disabled = false;

                document.getElementById('id_turno').disabled = false;
                $('#id_producto').selectpicker('refresh');
                $('#id_turno').selectpicker('refresh');
                cargar_productos();
                document.getElementById('no_orden_produccion').disabled = true;
            }

            $('.loading').hide();
        }

        function deshabilitar_encabezado() {
            document.getElementById('no_orden_produccion').disabled = true;
            document.getElementById('id_producto').disabled = true;
            document.getElementById('id_turno').disabled = true;
            document.getElementById('btn_buscar_orden').disabled = true;

            $('#id_producto').selectpicker('refresh');

            $('#id_turno').selectpicker('refresh');
        }

        function get_insumos() {

            return gl_detalle_insumos[0].control_trazabilidad.detalle_insumos;
        }

        var productos_agregados = [];

        function buscar_insumo() {


            let regexp = new RegExp(document.getElementById('producto').value.trim(), 'i');
            const productos = get_insumos().filter(function (e) {
                return e.producto.descripcion.trim().match(regexp);
            });
            $('#tbody-productos').empty();
            let row = '<tr>';
            productos.forEach(function (e) {
                row += `
                <td> <input type="radio"  value="${e.id_detalle_insumo}"  name="detalle_insumo[]"  id="detalle_insumo-${e.id_detalle_insumo}"  > </td>
                <td>   <input type="hidden"  value="${e.producto.descripcion}"  name="descripcion_insumo[]"  id="descripcion_insumo-${e.id_detalle_insumo}"  >     ${e.producto.descripcion} </td>
                <td>  <input type="hidden"  value="${e.cantidad}"  name="cantidad_insumo[]"  id="cantidad_insumo-${e.id_detalle_insumo}"  >   ${e.cantidad} </td>
                <td >   <input type="hidden"  value="${e.lote}"  name="lote_insumo[]"  id="lote_insumo-${e.id_detalle_insumo}"  >
                        <input type="hidden"  value="${e.id_producto}"  name="id_producto_insumo[]"  id="id_producto_insumo-${e.id_detalle_insumo}"  >
                    ${e.lote} </td>
                <td> ${e.fecha_vencimiento} </td>
                `
            });
            row += '</tr>';
            $('#tbody-productos').append(row);
            $('#modal-productos').modal()
        }

        function set_producto() {

            const productos = document.getElementsByName('detalle_insumo[]');

            const producto = Object.keys(productos).map(function (key) {
                return [Number(key), productos[key]];
            }).filter(function (e) {
                return e[1].checked;
            });

            if (producto.length > 0) {
                document.getElementById('lote').value = document.getElementById('lote_insumo-' + producto[0][1].value).value;
                document.getElementById('producto').value = document.getElementById('descripcion_insumo-' + producto[0][1].value).value;
                document.getElementById('cantidad_total').value = document.getElementById('cantidad_insumo-' + producto[0][1].value).value;
                document.getElementById('id_producto_insumo').value = document.getElementById('id_producto_insumo-' + producto[0][1].value).value;
            }


        }

        function producto_agregado() {

            const lote = document.getElementById('lote').value;
            const id_producto = document.getElementById('id_producto_insumo');

            const productos = document.getElementsByName('lote[]');

            const producto = Object.keys(productos).map(function (key) {
                return [Number(key), productos[key]];
            }).map(function (e) {
                return parseFloat(e[1].parentElement.parentElement.children[4].innerText);
            }).reduce(function (anterior, actual) {
                return anterior + actual;
            }, 0);

            return producto;

        }


        function get_id_control() {

            const id_producto = document.getElementById('id_producto').value;
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            document.getElementById('id_control').value = id_control;
            return id_control;
        }


        function inicio_formulario() {
            const id_producto = document.getElementById('id_producto').value;

            const id_turno = document.getElementById('id_turno').value;

            if (id_producto == "") {
                alert("Seleccione producto");
                return;
            }

            if (id_turno == "") {
                alert("Seleccione Turno");
                return;
            }
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            $('.loading').show();
            return $.ajax(
                {
                    type: "POST",
                    url: "{{url('control/verificacion_materias_chao/iniciar_formulario')}}",
                    data: {
                        id_control: id_control,
                        id_turno: id_turno
                    },
                    success: function (response) {

                        if (response.status === 1) {
                            habilitar_formulario(detalle());
                            deshabilitar_encabezado();
                        } else {
                            alert(response.message);
                        }
                        $('.loading').hide();

                    },
                    error: function (error) {
                        console.log(error);
                        $('.loading').hide();
                    }
                }
            );
        }

        function detalle() {


            const batch_no = document.getElementById('batch_no');
            const id_producto = document.getElementById('id_producto_insumo');
            const producto = document.getElementById('producto');
            const lote = document.getElementById('lote');
            const cantidad = document.getElementById('cantidad');
            const equipo = document.getElementById('equipo');
            const observaciones = document.getElementById('observaciones');


            const fields = [

                ["batch_no", batch_no],
                ["id_producto", id_producto],
                ["producto", producto],
                ["lote", lote],
                ["cantidad", cantidad],
                ["equipo", equipo],
                ["observaciones", observaciones],
            ];

            return fields;

        }

        let ultimo_registro = null;


        function mostrar_observaciones(hora) {
            let observaciones = '';
            if (ultimo_registro != null) {

                ultimo_registro = moment(moment().format('Y-M-D') + " " + ultimo_registro);

                if (ultimo_registro.clone().add('15', 'minutes').isAfter(hora, 'minute')) {
                    observaciones = hora.clone().diff(ultimo_registro.add('15', 'minutes'), 'minutes') + " minutos antes";
                }
                if (ultimo_registro.clone().add('15', 'minutes').isBefore(hora, 'minute')) {
                    observaciones = "Excede " + ultimo_registro.clone().add('15', 'minutes').diff(hora, 'minutes') + " minutos";
                }
                document.getElementById('temperatura_observaciones').value = document.getElementById('temperatura_observaciones').value + " " + observaciones;


            }
        }

        async function agregar_a_table() {

            const hora = moment();


            const no_orden_produccion = get_no_orden_produccion();
            const no_orden_disabled = document.getElementById('no_orden_produccion').disabled;
            const no_orden_valida = no_orden_disabled && no_orden_produccion != "";

            const fields = detalle();


            if (existe_campo_vacio(fields)) {
                get_campo_vacio(fields).focus();
                return;
            }
            if (producto_agregado() + parseFloat(document.getElementById('cantidad').value) > parseFloat(document.getElementById('cantidad_total').value)) {
                alert("Cantidad insuficiente");
                return;
            }
            if (no_orden_valida) {
                $('.loading').show();
                const request = getRequest(fields);
                const url = "{{url('control/verificacion_materias_chao/insertar_detalle')}}";
                const url_borrar = "'{{url('control/verificacion_materias_chao/borrar_detalle')}}'";
                const response = await insertar_detalle(request, get_id_control(), url);
                if (response.status == 1) {
                    const url_update_enc = "{{url('control/verificacion_materias_chao/nuevo_registro')}}";
                    const id_turno = document.getElementById('id_turno').value;
                    insertar_registros(url_update_enc, array_registros('turno', id_turno), get_id_control());
                    add_to_table(fields, response.id, 'detalles', url_borrar);
                    limpiar()
                } else {
                    alert(response.message);
                }
                $('.loading').hide();
            } else {
                alert("Orden de produccion no valida");
            }


        }

        function limpiar() {

            const fields = detalle();
            limpiar_formulario(fields)
            document.getElementById('batch_no').focus();

        }

    </script>
@endsection
