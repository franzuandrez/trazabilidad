@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12      col-md-12   col-xs-12">
        <h3>
            CONTROL DE PRE-COCIDO DE PASTA PARA CHAO MEIN
            <button
                data-toggle="tooltip"
                title="Informacion"
                onclick="ver_informacion()"
                type="button" class="btn btn-default btn-sm">
                <i class="fa fa-info"
                   aria-hidden="true"></i>
            </button>
        </h3>
    </div>
    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-cutlery',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Pre-cocido de Pasta
        @endslot
    @endcomponent
    @include('control.precocido.tabla_informativa')

    {!!Form::open(array('url'=>'control/precocido/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <input type="hidden" id="id_control" name="id_control" value="{{$precocido->id_control}}">
    <input type="hidden" id="no_orden_produccion" disabled="" name="no_orden_produccion"
           value="{{$precocido->id_control}}">




    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$precocido->control_trazabilidad->id_producto}}" selected>
                    {{$precocido->control_trazabilidad->liberacion_linea->presentacion->descripcion}}
                </option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>
            <input class="form-control selectpicker valor"
                   disabled
                   id="lote"
                   value="{{$precocido->lote}}"
                   name="lote">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input class="form-control selectpicker"
                   id="id_turno"
                   name="id_turno"
                   value="{{$precocido->turno}}"
                   disabled>

        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <label for="hora_inicio">HORA INICIO</label>
            <div class="input-group">
                <input id="hora_inicio" type="text"
                       required
                       class="form-control timepicker" name="hora_inicio">

                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <label for="hora_salida">HORA SALIDA</label>
            <div class="input-group">
                <input id="hora_salida"
                       required
                       type="text" class="form-control timepicker" name="hora_salida">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="tiempo_efectivo">TIEMPO EFECTIVO</label>
                <input id="tiempo_efectivo" type="text"
                       required
                       name="tiempo_efectivo"

                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="alcance_presion">ALCANCE PRESIÓN</label>
                <input id="alcance_presion" type="text" name="alcance_presion"
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="temperatura">TEMPERATURA A (98-106 C)</label>
                <input id="temperatura" type="text" name="temperatura"

                       required
                       class="form-control">
            </div>
        </div>


        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <label for="observaciones">OBSERVACIONES</label>
            <div class="input-group">
                <input id="observaciones" type="text" name="observaciones"

                       class="form-control">
                <div class="input-group-btn">
                    <button class="btn btn-default block" type="button"
                            onclick="agregar_a_table()"
                            onkeydown="agregar_a_table()"
                    >
                        <span class=" fa fa-plus"></span></button>
                    <button
                        onclick="limpiar()"
                        onkeydown="limpiar()"
                        class="btn btn-default block" type="button">
                        <span class=" fa fa-trash"></span></button>
                </div>
            </div>
        </div>

        @include('componentes.loading')

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <tr>
                    <th>PRODUCTO</th>
                    <th>LOTE</th>
                    <th>HORA INICIO</th>
                    <th>HORA SALIDA</th>
                    <th>TIEMPO EFECTIVO</th>
                    <th>ALCANCE PRESIÓN</th>
                    <th>TEMPERATURA</th>
                    <th>OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $precocido->detalle as $detalle )
                    <tr>
                        <td>{{$precocido->control_trazabilidad->liberacion_linea->presentacion->descripcion}}</td>
                        <td>{{$detalle->lote}}</td>
                        <td>{{$detalle->hora_inicio}}</td>
                        <td>{{$detalle->hora_salida}}</td>
                        <td>{{$detalle->tiempo_efectivo}}</td>
                        <td>{{$detalle->alcance_presion}}</td>
                        <td>{{$detalle->temperatura}}</td>
                        <td>{{$detalle->observaciones}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default"
                    onclick="guardar()"
                    type="button">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('control/precocido')}}">
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
        $(function () {
            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false,
                minuteStep: 1,
                format: 'HH:mm',
                showMeridian: false,
            });
        })

    </script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment-with-locales.js')}}"></script>
    <script src="{{asset('js-brc/tools/nuevo_registro.js')}}"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function guardar() {

            document.getElementById('no_orden_produccion').disabled = false;
            $('form').submit();
        }

        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        var gl_detalle_insumos = @json([$precocido->control_trazabilidad]);

        function deshabilitar_encabezado() {
            document.getElementById('no_orden_produccion').disabled = true;
            document.getElementById('id_producto').disabled = true;
            document.getElementById('btn_buscar_orden').disabled = true;
            document.getElementById('lote').disabled = true;
            document.getElementById('id_turno').disabled = true;
            $('#id_producto').selectpicker('refresh');
            $('#lote').selectpicker('refresh');
            $('#id_turno').selectpicker('refresh');
        }

        function cargar_productos() {

            const select = document.getElementById('id_producto');
            $(select).empty();
            let option = '<option value="" selected>   SELECCIONE PRODUCTO </option>';
            gl_detalle_insumos.forEach(function (e) {
                option += `
                <option  value="${e.id_producto}" > ${e.control_trazabilidad.producto.descripcion}   /    ${e.presentacion.descripcion} </option>
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


        function get_id_control() {

            const id_producto = document.getElementById('id_producto').value;
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            document.getElementById('id_control').value = id_control;
            return id_control;
        }


        function inicia_formulario() {
            const id_producto = document.getElementById('id_producto').value;

            if (id_producto == "") {
                alert("Seleccione producto");
                return;
            }
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            $.ajax(
                {
                    type: "POST",
                    url: "{{url('control/precocido/iniciar_formulario')}}",
                    data: {
                        id_control: id_control,
                    },
                    success: function (response) {

                        if (response.status === 1) {
                            habilitar_formulario(detalle());
                            deshabilitar_encabezado();
                        } else {
                            alert(response.message);
                        }

                    },
                    error: function (error) {
                        console.log(error)
                    }
                }
            );
        }


        async function iniciar_control_precocido() {


            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('control/precocido/iniciar_laminado')}}";
            const response = await iniciar(url, no_orden_produccion);

            if (response.status == 0) {
                alert(response.message);
            } else {
                gl_detalle_insumos = response.data.data;
                document.getElementById('id_producto').disabled = false;
                document.getElementById('lote').disabled = false;
                document.getElementById('id_turno').disabled = false;
                $('#id_producto').selectpicker('refresh');
                $('#lote').selectpicker('refresh');
                $('#id_turno').selectpicker('refresh');
                cargar_productos();
                document.getElementById('no_orden_produccion').disabled = true;
            }


        }

        function detalle() {

            const id_producto = document.getElementById('id_producto');
            const lote = document.getElementById('lote');
            const hora_inicio = document.getElementById('hora_inicio');
            const hora_salida = document.getElementById('hora_salida');
            const tiempo_efectivo = document.getElementById('tiempo_efectivo');
            const alcance_presion = document.getElementById('alcance_presion');
            const temperatura = document.getElementById('temperatura');
            const observaciones = document.getElementById('observaciones');


            const fields = [
                ["id_producto", id_producto],
                ["lote", lote],
                ["hora_inicio", hora_inicio],
                ["hora_salida", hora_salida],
                ["tiempo_efectivo", tiempo_efectivo],
                ["alcance_presion", alcance_presion],
                ["temperatura", temperatura],
                ["observaciones", observaciones],
            ];

            return fields;

        }

        async function agregar_a_table() {


            const no_orden_produccion = get_no_orden_produccion();
            const no_orden_disabled = document.getElementById('no_orden_produccion').disabled;
            const no_orden_valida = no_orden_disabled && no_orden_produccion != "";

            const fields = detalle();

            if (existe_campo_vacio(fields)) {
               get_campo_vacio(fields).focus();
                return;
            }
            if (no_orden_valida) {
                $('.loading').show();
                const request = getRequest(fields);
                const url = "{{url('control/precocido/insertar_detalle')}}";
                const url_borrar = "'{{url('control/precocido/borrar_detalle')}}'";
                const response = await insertar_detalle(request, get_id_control(), url);
                if (response.status == 1) {
                    const url_update_enc = "{{url('control/precocido/nuevo_registro')}}";
                    const id_turno = document.getElementById('id_turno').value;
                    const registros = [
                        formato_registro('turno', id_turno),
                    ];
                    insertar_registros(url_update_enc, registros, get_id_control());
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

            const fields = detalle().filter(e => e[0] !== "id_producto" & e[0] !== "lote");
            limpiar_formulario(fields)

        }

        function ver_informacion() {

            $('#informacion').modal()
        }

    </script>
@endsection
