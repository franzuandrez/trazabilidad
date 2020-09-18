@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12     col-md-12    col-xs-12">
        <h3>CONTROL DE PRE-COCIDO DE PASTA PARA CHAO MEIN
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
    @component('componentes.nav',['operation'=>'Crear',
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

    @include('componentes.loading')
    @include('control.precocido.tabla_informativa')
    {!!Form::open(array('url'=>'control/precocido/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <input type="hidden" id="id_control" name="id_control">
    @include('produccion.partials.orden_produccion_sugerida')
    <div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
        <label for="turno">NO ORDEN DE PRODUCCION</label>
        <div class="input-group">
            <input type="text" name="no_orden_produccion" value="{{old('no_orden_produccion')}}"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==13)iniciar_control_precocido()"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    id="btn_buscar_orden"
                    onclick="iniciar_control_precocido()"
                    onkeydown="iniciar_control_precocido()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-search"
                       aria-hidden="true"></i>
                </button>
                <button
                    onclick="ver_ordenes_sugeridas()"
                    onkeydown="ver_ordenes_sugeridas()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-info"
                       aria-hidden="true"></i>
                </button>
            </div>

        </div>
    </div>
    <div class="col-lg-6 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <select class="form-control selectpicker"
                    id="id_turno"
                    name="id_turno" disabled>
                <option value="" selected>SELECCIONE UN TURNO</option>
                <option value="1">TURNO 1</option>
                <option value="2">TURNO 2</option>
            </select>
        </div>
    </div>


    <div class="col-lg-6 col-sm-4 col-md-6 col-xs-12">
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

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="lote">LOTE</label>
        <div class="input-group">
            <input class="form-control selectpicker valor"
                   disabled
                   required
                   id="lote" name="lote">
            <div class="input-group-btn">
                <button
                    onclick="inicia_formulario()"
                    onkeydown="inicia_formulario()"
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

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12" style="display: none" >
            <label for="hora_inicio">HORA INICIO</label>
            <div class="input-group">
                <input id="hora_inicio" type="text"
                       disabled
                       required
                       class="form-control timepicker" name="hora_inicio">

                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12"  style="display: none">
            <label for="hora_salida">HORA SALIDA</label>
            <div class="input-group">
                <input id="hora_salida"
                       disabled
                       type="text" class="form-control timepicker" name="hora_salida">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="tiempo_efectivo">TIEMPO EFECTIVO</label>
                <input id="tiempo_efectivo"
                       type="number"
                       step="any"
                       disabled
                       required
                       name="tiempo_efectivo"

                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="alcance_presion">ALCANCE PRESIÓN</label>
                <input id="alcance_presion"
                       type="number"
                       step="any"
                       name="alcance_presion"
                       disabled
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="temperatura">TEMPERATURA A (98-106 C)</label>
                <input id="temperatura"
                       type="number"
                       step="any"
                       name="temperatura"
                       disabled
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="precocedora">PRECOCEDORA</label>
                <select name="precocedora" class="form-control selectpicker "
                        disabled="" id="precocedora">
                    <option value="1"> #1</option>
                    <option value="2"> #2</option>
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <label for="observaciones">OBSERVACIONES</label>
            <div class="input-group">
                <input id="observaciones" type="text" name="observaciones"
                       disabled
                       onkeydown="if(event.keyCode==13)agregar_a_table()"
                       class="form-control">
                <div class="input-group-btn">
                    <button class="btn btn-default block" type="button"
                            onclick="agregar_a_table()"
                    >
                        <span class=" fa fa-plus"></span></button>
                    <button
                        onclick="limpiar()"
                        class="btn btn-default block" type="button">
                        <span class=" fa fa-trash"></span></button>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <tr>
                    <th></th>
                    <th>PRODUCTO</th>
                    <th>LOTE</th>
                    <th>HORA INICIO</th>
                    <th>HORA SALIDA</th>
                    <th>TIEMPO EFECTIVO</th>
                    <th>ALCANCE PRESIÓN</th>
                    <th>TEMPERATURA</th>
                    <th>OBSERVACIONES</th>
                    <th>PRECOCEDORA</th>
                </tr>
                </thead>
                <tbody>
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
        var gl_detalle_insumos = null;

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
                <option  value="${e.id_producto}" >  ${e.presentacion.descripcion} </option>
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
            const lote = document.getElementById('lote').value;
            const turno = document.getElementById('id_turno').value;

            if (id_producto === "") {
                alert("Seleccione producto");
                return;
            }
            if (turno === "") {
                alert("Seleccione turno");
                return;
            }
            if (lote === "") {
                alert("Lote en blanco");
                return;
            }
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            $('.loading').show();
            $.ajax(
                {
                    type: "POST",
                    url: "{{url('control/precocido/iniciar_formulario')}}",
                    data: {
                        id_control: id_control,
                        lote: lote,
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


        async function iniciar_control_precocido() {

            $('.loading').show();
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

            $('.loading').hide();
        }

        function detalle() {

            const id_producto = document.getElementById('id_producto');
            const lote = document.getElementById('lote');
            const hora_inicio = document.getElementById('hora_inicio');
            const hora_salida = document.getElementById('hora_salida');
            const tiempo_efectivo = document.getElementById('tiempo_efectivo');
            const alcance_presion = document.getElementById('alcance_presion');
            const temperatura = document.getElementById('temperatura');
            const precocedora = document.getElementById('precocedora');
            const observaciones = document.getElementById('observaciones');


            const fields = [
                ["id_producto", id_producto],
                ["lote", lote],
                ["hora_inicio", hora_inicio],
                ["hora_salida", hora_salida],
                ["tiempo_efectivo", tiempo_efectivo],
                ["alcance_presion", alcance_presion],
                ["temperatura", temperatura],
                ["precocedora", precocedora],
                ["observaciones", observaciones],
            ];

            return fields;

        }

        async function agregar_a_table() {


            const no_orden_produccion = get_no_orden_produccion();
            const no_orden_disabled = document.getElementById('no_orden_produccion').disabled;
            const no_orden_valida = no_orden_disabled && no_orden_produccion != "";

            const fields = detalle();
            document.getElementById('hora_inicio').value = moment().format('HH:mm:ss');
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
                    add_to_table_harina(fields, response.id, 'detalles', url_borrar);
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
            limpiar_formulario(fields);


        }

        function ver_informacion() {

            $('#informacion').modal()
        }

        function add_to_table_harina(fields, id, table, url) {


            let row = `<tr>
                <td> <button  type="button"
                    class="btn btn-success"
                    onclick="marcar_hora_descarga(${id},this)">
                    <span class="fa fa-check"></span></button> </td>
            `;
            fields.forEach(function (e) {

                let value = e[1].value;
                let text = '';
                if (e[1].tagName === "SELECT") {
                    text = $('#' + e[1].id + ' option:selected').text();

                } else {

                    text = value;
                }
                row += `
                <td > <input type="hidden" value="${value}"  id="${e[0]}-${id}"  name="${e[0]}[]" >
                  ${text}
                  </td>
        `
                ;
            });

            row += '</tr>';
            $('#' + table).append(row);

        }


        function marcar_hora_descarga(id, ele) {

            let hora_descarga = document.getElementById('hora_salida-' + id);


            hora_descarga.parentNode.innerText = moment().format('HH:mm:ss');
            hora_descarga.value = moment().format('HH:mm:ss');
            $('.loading').show();
            $.ajax({

                url: "{{url('control/precocido/actualizar_detalle')}}",
                data: {
                    id: id,
                    hora_descarga: moment().format('HH:mm:ss'),
                },
                type: 'POST',
                success: function (response) {

                    if (response.status == 0) {
                        alert(response.message);
                    }
                    $(ele).remove();
                    $('.loading').hide();
                },
                error: function (err) {
                    $('.loading').hide();
                }
            })


        }
    </script>
@endsection
