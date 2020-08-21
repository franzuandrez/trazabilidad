@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-2 col-sm-12     col-md-12  col-xs-12">
        <h3>REGISTRO DE PARAMETROS EN LAMINADO Y PRECOCCION DE SOPAS INSTANTANEAS</h3>
    </div>
    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-tasks',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Laminado y Precocción de Sopas
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'sopas/laminado/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" id="id_control" name="id_control" value="{{$laminado->id_control}}">
    <input type="hidden" id="no_orden_produccion" name="no_orden_produccion" disabled value="{{$laminado->id_control}}">






    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto"
                    name="id_producto">
                <option value="{{$laminado->control_trazabilidad->id_producto}}" selected>
                    {{$laminado->control_trazabilidad->liberacion_sopas->producto->descripcion}}
                </option>
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>

            <input class="form-control selectpicker valor"
                   disabled
                   value="{{$laminado->lote}}"
                   id="lote" name="lote">


        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input class="form-control selectpicker "
                   id="id_turno" name="id_turno"
                   value="{{$laminado->id_turno}}"
                   disabled>

        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">


        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="velocidad_laminado">VELOCIDAD DE LAMINADO (RPM)</label>
                <input id="velocidad_laminado"
                       type="number"
                       step="any"
                       name="velocidad_laminado"
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="espesor_lamina">ESPESOR DE LÁMINA 0.98 A 1.03 MM</label>
                <input id="espesor_lamina"  name="espesor_lamina"
                       type="number"
                       step="any"
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="presicion">PRESICIÓN REGULADOR DE VALOR (0.2 A 0.3 MPA)</label>
                <input id="presicion"  name="presicion"
                       type="number"
                       step="any"
                       required
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="indice_precoccion">INDICE PRECOCCIÓN (CUALITATIVO)</label>
                <input id="indice_precoccion"
                       type="number"
                       step="any"
                       name="indice_precoccion"
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="temperatura_inicio">TEMPERATURA DE PRECOCCIÓN MAS DE 90 C INICIO</label>
                <input id="temperatura_inicio"
                       type="number"
                       step="any"
                       name="temperatura_inicio"
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="temperatura_salida">TEMPERATURA DE PRECOCCIÓN MAS DE 90 C SALIDA</label>
                <input id="temperatura_salida"
                       type="number"
                       step="any"
                       name="temperatura_salida"
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="tiempo_precoccion">TIEMPO DE PRECOCCIÓN 2:00 A 2:55 MIN. (CADA 30 MIN)</label>
                <input id="tiempo_precoccion"
                       type="number"
                       step="any"
                       name="tiempo_precoccion"+
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="velocidad_cotres">VELOCIDAD (COTRES * MIN)</label>
                <input id="velocidad_cotres"  name="velocidad_cotres"
                       type="number"
                       step="any"
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <label for="observaciones">OBSERVACIONES</label>
            <div class="input-group">

                <input id="observaciones" type="text" name="observaciones"

                       class="form-control">
                <div class="input-group-btn">
                    <button
                        id="btn_buscar_orden"
                        onclick="agregar_a_table()"
                        onkeydown="agregar_a_table()"
                        type="button" class="btn btn-default">
                        <i class="fa fa-plus"
                           aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        <input type="hidden" name="hora" id="hora">


        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class=" table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <th>HORA (CADA 15 MIN)</th>
                <th>VELOCIDAD DE LAMINADO (RPM)</th>
                <th>ESPESOR DE LAMINA 0.98 A 1.03 MM</th>
                <th>PRESIÓN REGULADOR DE VAPOR (0.2 A 0.3 MPA)</th>
                <th>INDICE PRECOCCIÓN (CUALITATIVO)</th>
                <th>TEMPERATURA DE INICIO</th>
                <th>TEMPERATURA DE SALIDA</th>
                <th>TIEMPO DE PRECOCCIÓN 2:00 A 2:55 MIN</th>
                <th>VELOCIDAD (COTRES * MIN)</th>
                <th>OBSERVACIONES</th>
                </thead>
                <tbody>
                @foreach($laminado->detalle as $detalle)
                    <tr>
                        <td>{{$detalle->hora}}</td>
                        <td>{{$detalle->velocidad_laminado}}</td>
                        <td>{{$detalle->espesor_lamina}}</td>
                        <td>{{$detalle->presion_regulador_vapor}}</td>
                        <td>{{$detalle->indice_precoccion}}</td>
                        <td>{{$detalle->temperatura_precoccion_inicio}}</td>
                        <td>{{$detalle->temperatura_precoccion_salida}}</td>
                        <td>{{$detalle->tiempo_precoccion}}</td>
                        <td>{{$detalle->velocidad}}</td>
                        <td>{{$detalle->observaciones}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="acciones">ACCIONES/CORRECTIVAS</label>
                <input type="text" name="acciones" value="{{$laminado->observaciones}}"
                       class="form-control">
            </div>
        </div>
    </div>
    @include('componentes.loading')

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button
                onclick="guardar()"
                class="btn btn-default" type="button">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('sopas/laminado')}}">
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
                showInputs: false,
                minuteStep: 1,
                format: 'HH:mm',
                showMeridian: false,
            });
        })

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
    </script>
    <script>

        var gl_detalle_insumos = @json([$laminado->control_trazabilidad]);
        limpiar();
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

        async function iniciar_laminado() {

            $('.loading').show();
            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('sopas/laminado/iniciar_laminado')}}";
            const response = await iniciar(url, no_orden_produccion);

            console.log(response);
            if (response.status === 0) {
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

            $('.loading').hide();
        }

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
                    url: "{{url('sopas/laminado/iniciar_formulario')}}",
                    data: {
                        id_control: id_control,
                        id_producto: id_producto
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


        function removeFromTable(element) {
            //Removemos la fila
            let td = $(element).parent();
            td.parent().remove();
            let tdNext = td.next();
            let tdNextNext = tdNext.next();
        }

        function limpiar() {

            const fields = detalle();
            limpiar_formulario(fields);
            document.getElementById('velocidad_laminado').focus();
        }

        function detalle() {


            const hora = document.getElementById('hora');
            const velocidad_laminado = document.getElementById('velocidad_laminado');
            const espesor_lamina = document.getElementById('espesor_lamina');
            const presion_regulador_vapor = document.getElementById('presicion');
            const indice_precoccion = document.getElementById('indice_precoccion');
            const temperatura_precoccion_inicio = document.getElementById('temperatura_inicio');
            const temperatura_precoccion_salida = document.getElementById('temperatura_salida');
            const tiempo_precoccion = document.getElementById('tiempo_precoccion');
            const velocidad = document.getElementById('velocidad_cotres');
            const observaciones = document.getElementById('observaciones');


            const fields = [
                ["hora", hora],
                ["velocidad_laminado", velocidad_laminado],
                ["espesor_lamina", espesor_lamina],
                ["presion_regulador_vapor", presion_regulador_vapor],
                ["indice_precoccion", indice_precoccion],
                ["temperatura_precoccion_inicio", temperatura_precoccion_inicio],
                ["temperatura_precoccion_salida", temperatura_precoccion_salida],
                ["tiempo_precoccion", tiempo_precoccion],
                ["velocidad", velocidad],
                ["observaciones", observaciones],

            ];

            return fields;


        }


        function get_id_control() {

            const id_producto = document.getElementById('id_producto').value;
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            document.getElementById('id_control').value = id_control;
            return id_control;
        }

        let ultimo_registro = @json($laminado->detalle->last()->hora);


        async function agregar_a_table() {


            const no_orden_produccion = get_no_orden_produccion();
            const no_orden_disabled = document.getElementById('no_orden_produccion').disabled;
            const no_orden_valida = no_orden_disabled && no_orden_produccion != "";
            const fields = detalle();
            document.getElementById('hora').value = moment().format('HH:mm:ss');
            if (existe_campo_vacio(fields)) {
                get_campo_vacio(fields).focus();
                return;
            }

            const hora = moment();

            let observaciones = mostrar_observaciones(hora, ultimo_registro);
            document.getElementById('observaciones').value = document.getElementById('observaciones').value + " " + observaciones;
            ultimo_registro = hora.clone().format('HH:mm:ss');


            if (no_orden_valida) {

                $('.loading').show();
                const request = getRequest(fields);
                const url = "{{url('sopas/laminado/insertar_detalle')}}";
                const url_borrar = "'{{url('sopas/laminado/borrar_detalle')}}'";
                const response = await insertar_detalle(request, get_id_control(), url);
                if (response.status == 1) {
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


    </script>
@endsection

