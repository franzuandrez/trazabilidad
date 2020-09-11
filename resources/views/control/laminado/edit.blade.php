@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
        <h3>CONTROL DE LAMINADO DE CHAO MEIN</h3>
    </div>

    @component('componentes.nav',['operation'=>'Continuar',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-th',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Laminado
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/laminado/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" id="id_control" name="id_control" value="{{$laminado->id_control}}">
    <input type="hidden" disabled id="no_orden_produccion" name="no_orden_produccion" value="{{$laminado->id_control}}">

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$laminado->control_trazabilidad->producto->id_producto}}"
                        selected>{{$laminado->control_trazabilidad->liberacion_linea->presentacion->descripcion}}</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>
            <input class="form-control selectpicker valor"
                   disabled

                   value="{{$laminado->lote}}"
                   id="lote" name="lote">


        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

        <div class="form-group">
            <label for="turno">TURNO</label>
            <input class="form-control selectpicker "
                   value="{{$laminado->turno}}"
                   id="id_turno" name="id_turno" disabled>


        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="temperatura">TEMPERATURA REPOSO 33-40 °C</label>

            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="temperatura">VALOR</label>
                <input id="temperatura_inicial"
                       required
                       type="number" step="any"
                       name="temperatura_inicial"
                       onkeydown="if(event.keyCode==13)validacion(this,34,36,document.getElementById('temperatura_final'),document.getElementById('temperatura_observaciones'))"
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="temperatura">OBSERVACIONES</label>
                <input id="temperatura_observaciones"

                       type="text" name="temperatura_observaciones" value="{{old('temperatura_observaciones')}}"
                       class="form-control">
            </div>
        </div>

        <input type="hidden" id="hora" name="hora" required>


        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="temperatura">ESPESOR 1.20 A 1.25  (milimetros)</label>

            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="temperatura">VALOR</label>
                <input id="espesor_inicial"
                       type="number" step="any"
                       name="espesor_inicial"
                       required
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="temperatura">OBSERVACIONES</label>
            <div class="input-group">
                <input id="espesor_observaciones"
                       type="text" name="espesor_observaciones" value="{{old('espesor_observaciones')}}"
                       onkeydown="if(event.keyCode==13)agregar_a_table()"
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

        @include('componentes.loading')


        <div class="tab-pane" id="tab_3">

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                    <thead style="background-color: #01579B;  color: #fff;">
                    <th>HORA</th>
                    <th>PRODUCTO</th>
                    <th>LOTE</th>
                    <th>  TEMPERATURA REPOSO 34-36 °C</th>
                    <th>OBSERVACIONES</th>
                    <th> ESPESOR 1.25 A 1.30 (milimetros)</th>
                    <th>OBSERVACIONES</th>
                    </thead>
                    <tbody>
                    @foreach( $laminado->detalle as $detalle )
                        <tr>
                            <td>
                                {{$detalle->hora}}
                            </td>
                            <td>
                                {{$laminado->control_trazabilidad->liberacion_linea->presentacion->descripcion}}
                            </td>
                            <td>
                                {{$detalle->lote_producto}}
                            </td>
                            <td>
                                {{$detalle->temperatura_inicio}}
                            </td>
                            <td>
                                {{$detalle->temperatura_observaciones}}
                            </td>
                            <td>
                                {{$detalle->espesor_inicio}}
                            </td>
                            <td>
                                {{$detalle->espesor_observaciones}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
            <input type="text" name="observacion_correctiva"
                   value="{{$laminado->observaciones}}"
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
            <a href="{{url('control/laminado')}}">
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
        var gl_detalle_insumos = @json([$laminado->control_trazabilidad]);

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


        async function iniciar_control_laminado() {


            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('control/laminado/iniciar_laminado')}}";
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

        function deshabilitar_encabezado() {
            document.getElementById('no_orden_produccion').disabled = true;
            document.getElementById('id_producto').disabled = true;
            document.getElementById('id_turno').disabled = true;
            document.getElementById('btn_buscar_orden').disabled = true;
            document.getElementById('lote').disabled = true;
            $('#id_producto').selectpicker('refresh');
            $('#lote').selectpicker('refresh');
            $('#id_turno').selectpicker('refresh');
        }


        function get_id_control() {

            const id_producto = document.getElementById('id_producto').value;
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            document.getElementById('id_control').value = id_control;
            return id_control;
        }

        function inicio_formulario() {
            const id_producto = document.getElementById('id_producto').value;

            if (id_producto == "") {
                alert("Seleccione producto");
                return;
            }
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            return $.ajax(
                {
                    type: "POST",
                    url: "{{url('control/laminado/iniciar_formulario')}}",
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

        function detalle() {

            const id_producto = document.getElementById('id_producto');
            const lote = document.getElementById('lote');
            const temperatura_inicial = document.getElementById('temperatura_inicial');
            const temperatura_observaciones = document.getElementById('temperatura_observaciones');
            const espesor_inicial = document.getElementById('espesor_inicial');
            const espesor_observaciones = document.getElementById('espesor_observaciones');
            const hora = document.getElementById('hora');


            const fields = [
                ["hora", hora],
                ["id_producto", id_producto],
                ["lote_producto", lote],
                ["temperatura_inicio", temperatura_inicial],
                ["temperatura_observaciones", temperatura_observaciones],
                ["espesor_inicio", espesor_inicial],
                ["espesor_observaciones", espesor_observaciones]
            ];

            return fields;

        }

        let ultimo_registro = @json($laminado->detalle->last()->hora);


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
            mostrar_observaciones(hora);
            ultimo_registro = hora.clone().format('HH:mm:ss');

            const no_orden_produccion = get_no_orden_produccion();
            const no_orden_disabled = document.getElementById('no_orden_produccion').disabled;
            const no_orden_valida = no_orden_disabled && no_orden_produccion != "";
            document.getElementById('hora').value = moment().format('HH:mm:ss');
            const fields = detalle();

            if (existe_campo_vacio(fields)) {
                get_campo_vacio(fields).focus();
                return;
            }
            if (no_orden_valida) {
                $('.loading').show();
                const request = getRequest(fields);
                const url = "{{url('control/laminado/insertar_detalle')}}";
                const url_borrar = "'{{url('control/laminado/borrar_detalle')}}'";
                const response = await insertar_detalle(request, get_id_control(), url);
                if (response.status == 1) {
                    const url_update_enc = "{{url('control/laminado/nuevo_registro')}}";
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

            const fields = detalle().filter(e => e[0] != "id_producto" && e[0] != "lote_producto");
            limpiar_formulario(fields);
            document.getElementById('temperatura_inicial').focus();
        }

    </script>
@endsection
