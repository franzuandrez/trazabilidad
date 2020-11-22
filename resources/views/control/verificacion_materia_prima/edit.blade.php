@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12    col-md-12   col-xs-12">
        <h3>VERIFICACION DE MATERIA PRIMA EN MEZCLADORA</h3>
    </div>

    @component('componentes.nav',['operation'=>'Continuar',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa fa-check-circle',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Verificacion Materias
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/verificacion_materias/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" id="id_control" name="id_control" value="{{$verificacion->id_control}}">
    <input type="hidden" id="no_orden_produccion" name="no_orden_produccion" disabled
           value="{{$verificacion->id_control}}">




    @include('componentes.loading')
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">Producto</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$verificacion->control_trazabilidad->id_producto}}" selected>
                    {{$verificacion->control_trazabilidad->liberacion_linea->presentacion->descripcion}}
                </option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input class="form-control selectpicker "
                   value="{{$verificacion->id_turno}}"
                   id="id_turno" name="id_turno" disabled>

        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="batch_no">BATCH NO.</label>
                <input id="batch_no"
                       type="number"
                       step="any"
                       required
                       name="batch_no"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="equipo">EQUIPO</label>
                <input id="equipo"
                       type="number"
                       step="any"
                       required

                       name="equipo"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad_ph">CANTIDAD PH</label>
                <input id="cantidad_ph"
                       type="number"
                       step="any"
                       required

                       name="cantidad_ph"
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad_carga">CANTIDAD CARGA</label>
                <input id="cantidad_carga"
                       type="number"
                       step="any"
                       required

                       name="cantidad_carga"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad_agua">AGUA</label>
                <input id="cantidad_agua"
                       type="number"
                       step="any"
                       required

                       name="cantidad_agua"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad_base_vitamina">BASE VITAMINA</label>
                <input id="cantidad_base_vitamina"
                       type="number"
                       step="any"
                       required

                       name="cantidad_base_vitamina"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <label>CARBONATO SODIO</label>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="lote_carbonato_sodio">No. Lote</label>
                    <input id="lote_carbonato_sodio"
                           type="text"
                           required

                           name="lote_carbonato_sodio"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="cantidad_carbonato_sodio">Cantidad</label>
                    <input id="cantidad_carbonato_sodio"
                           type="number"
                           step="any"
                           required

                           name="cantidad_carbonato_sodio"
                           class="form-control">
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <label>COLORANTE AMARILLO HUEVO</label>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="lote_colorante_amarillo">No. Lote</label>
                    <input id="lote_colorante_amarillo"
                           type="text"
                           required
                           name="lote_colorante_amarillo"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="cantidad_colorante_amarillo">Cantidad</label>
                    <input id="cantidad_colorante_amarillo"
                           type="number"
                           step="any"
                           required

                           name="cantidad_colorante_amarillo"
                           class="form-control">
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <label>CMC</label>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="lote_cmc">No. Lote</label>
                    <input id="lote_cmc"
                           type="text"
                           required

                           name="lote_cmc"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="cantidad_cmc">Cantidad</label>
                    <input id="cantidad_cmc"
                           type="number"
                           step="any"
                           required

                           name="cantidad_cmc"
                           class="form-control">
                </div>
            </div>
        </div>

        <input type="hidden" id="hora" name="" required>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="observaciones">OBSERVACIONES</label>
            <div class="input-group">
                <input id="observaciones"

                       type="text" name="observaciones" value="{{old('observaciones')}}"
                       class="form-control">
                <div class="input-group-btn">
                    <button
                        data-toggle="tooltip"
                        title="Agregar"
                        onclick="agregar_a_table()"
                        type="button" class="btn btn-primary">
                        <i class="fa fa-plus"
                           aria-hidden="true"></i>
                    </button>
                    <button
                        data-toggle="tooltip"
                        title="Limpiar"
                        onclick="limpiar()"
                        type="button" class="btn btn-primary">
                        <i class="fa fa-trash"
                           aria-hidden="true"></i>
                    </button>
                </div>

            </div>
        </div>


        <div class="tab-pane" id="tab_3">

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                    <thead style="background-color: #f7b633;  color: #fff;">
                    <th>HORA</th>
                    <th>BATCH NO</th>
                    <th>EQUIPO</th>
                    <th>CANTIDAD PH</th>
                    <th>CANTIDAD CARGA</th>
                    <th>AGUA</th>
                    <th>BASE VITAMINA</th>
                    <th>CARBONATO SODIO - LOTE</th>
                    <th>CARBONATO SODIO - CANTIDAD</th>
                    <th>COLORANTE - LOTE</th>
                    <th>COLORANTE - CANTIDAD</th>
                    <th>CMC - LOTE</th>
                    <th>CMC - CANTIDAD</th>
                    <th>OBSERVACIONES</th>
                    </thead>
                    <tbody>
                    @foreach($verificacion->detalle as $detalle)
                        <tr>
                            <td>{{$detalle->hora}}</td>
                            <td>{{$detalle->batch_no}}</td>
                            <td>{{$detalle->equipo}}</td>
                            <td>{{$detalle->cantidad_ph}}</td>
                            <td>{{$detalle->cantidad_carga}}</td>
                            <td>{{$detalle->cantidad_agua}}</td>
                            <td>{{$detalle->cantidad_base_vitamina}}</td>
                            <td>{{$detalle->lote_carbonato_sodio}}</td>
                            <td>{{$detalle->cantidad_carbonato_sodio}}</td>
                            <td>{{$detalle->lote_colorante_amarillo}}</td>
                            <td>{{$detalle->cantidad_colorante_amarillo}}</td>
                            <td>{{$detalle->lote_cmc}}</td>
                            <td>{{$detalle->cantidad_cmc}}</td>
                            <td>{{$detalle->observaciones}}</td>

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
            <input type="text" name="observacion_correctiva" value="{{$verificacion->observaciones}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-primary"
                    onclick="guardar()"
                    type="button">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('control/verificacion_materias ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
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
        var gl_detalle_insumos = @json([$verificacion->control_trazabilidad]);

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
            const url = "{{url('control/verificacion_materias/iniciar_harina')}}";
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
                    url: "{{url('control/verificacion_materias/iniciar_formulario')}}",
                    data: {
                        id_control: id_control,
                        id_producto: id_producto,
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
            const equipo = document.getElementById('equipo');
            const cantidad_ph = document.getElementById('cantidad_ph');
            const cantidad_carga = document.getElementById('cantidad_carga');
            const agua = document.getElementById('cantidad_agua');
            const base_vitamina = document.getElementById('cantidad_base_vitamina');
            const lote_carbonato_sodio = document.getElementById('lote_carbonato_sodio');
            const cantidad_carbonato_sodio = document.getElementById('cantidad_carbonato_sodio');
            const lote_colorante_amarillo = document.getElementById('lote_colorante_amarillo');
            const cantidad_colorante_amarillo = document.getElementById('cantidad_colorante_amarillo');
            const lote_cmc = document.getElementById('lote_cmc');
            const cantidad_cmc = document.getElementById('cantidad_cmc');
            const observaciones = document.getElementById('observaciones');
            const hora = document.getElementById('hora');


            const fields = [
                ["hora", hora],
                ["batch_no", batch_no],
                ["equipo", equipo],
                ["cantidad_ph", cantidad_ph],
                ["cantidad_carga", cantidad_carga],
                ["cantidad_agua", agua],
                ["cantidad_base_vitamina", base_vitamina],
                ["lote_carbonato_sodio", lote_carbonato_sodio],
                ["cantidad_carbonato_sodio", cantidad_carbonato_sodio],
                ["lote_colorante_amarillo", lote_colorante_amarillo],
                ["cantidad_colorante_amarillo", cantidad_colorante_amarillo],
                ["lote_cmc", lote_cmc],
                ["cantidad_cmc", cantidad_cmc],
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
            document.getElementById('hora').value = hora.format('HH:mm:ss');
            const fields = detalle();

            if (existe_campo_vacio(fields)) {
                get_campo_vacio(fields).focus();
                return;
            }
            if (no_orden_valida) {
                $('.loading').show();
                const request = getRequest(fields);
                const url = "{{url('control/verificacion_materias/insertar_detalle')}}";
                const url_borrar = "'{{url('control/verificacion_materias/borrar_detalle')}}'";
                const response = await insertar_detalle(request, get_id_control(), url);
                if (response.status == 1) {
                    const url_update_enc = "{{url('control/verificacion_materias/nuevo_registro')}}";
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
