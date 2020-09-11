@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12    col-md-12     col-xs-12">
        <h3>CONTROL MEZCLADO DE SOPAS INSTANTANEAS</h3>
    </div>
    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-dot-circle-o',
    'submenu_icon'=>'fa fa-balance-scale',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control Sopas
        @endslot
        @slot('submenu')
            Mezclado Sopas
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'sopas/mezclado_sopas/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    @include('componentes.loading')
    <input type="hidden" id="id_control" name="id_control">
    <input type="hidden" id="tiempo_optimo" name="tiempo_optimo">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="turno">NO ORDEN DE PRODUCCION</label>
        <div class="input-group">
            <input type="text"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==13)iniciar_mezclado_sopas()"
                   name="no_orden_produccion" value="{{old('no_orden_produccion')}}"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    id="btn_buscar_orden"
                    onclick="iniciar_mezclado_sopas()"
                    onkeydown="iniciar_mezclado_sopas()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-search"
                       aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>




    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
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
        <div class="form-group">
            <label for="lote">LOTE</label>
            <input class="form-control selectpicker valor"
                    disabled
                    required
                    id="lote" name="lote">

        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
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

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <label for="no_bach">NO. BACH</label>
            <div class="input-group-text">
                <input id="no_bach" type="text" name="no_bach"
                       disabled=""
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12" style="display: none;">
            <label for="hora_inicio">HORA INICIO</label>
            <div class="input-group">
                <input id="hora_inicio"
                       disabled
                       required
                       type="text" class="form-control timepicker" name="hora_inicio">

                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12"  style="display: none">
            <label for="hora_finalizo">HORA FINALIZO</label>
            <div class="input-group">
                <input id="hora_finalizo"
                       disabled
                       type="text" class="form-control timepicker" name="hora_finalizo">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="tiempo_alta">TIEMPO DE VELOCIDAD ALTA</label>
                <input id="tiempo_alta"
                       disabled
                       type="text" name="tiempo_alta"
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="tiempo_baja">TIEMPO DE VELOCIDAD BAJA</label>
                <input id="tiempo_baja" type="text" name="tiempo_baja"
                       disabled
                       required
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="tiempo_seco">TIEMPO DE VELOCIDAD SECO</label>
                <input id="tiempo_seco" type="text" name="tiempo_seco"
                       disabled
                       required
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="verificacion_tamiz">VERIFICACION TAMIZ</label>
                <input id="verificacion_tamiz" type="text" name="verificacion_tamiz"
                       disabled
                       required
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <label for="observaciones">OBSERVACIONES</label>
            <div class="input-group">
                <input id="observaciones" type="text" name="observaciones"
                       disabled
                       class="form-control">
                <div class="input-group-btn">
                    <button id="btnAdd" class="btn btn-default block"
                            onclick="agregar_a_table()"
                            type="button">
                        <span class=" fa fa-plus"></span></button>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <th></th>
                <th>NO. BACH</th>
                <th>HORA INICIO</th>
                <th>HORA FINALIZO</th>
                <th>TIEMPO VELOCIDAD SECO</th>
                <th>TIEMPO VELOCIDAD ALTA</th>
                <th>TIEMPO VELOCIDAD BAJA</th>
                <th>V. TAMIZ</th>
                <th>OBSERVACIONES</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observaciones_generales">OBSERVACIONES</label>
            <input type="text" name="observaciones_generales" value="{{old('observaciones_generales')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default"
                    onclick="guardar()"
                    type="button">
                <span class=" fa fa-check"></span>
                GUARDAR

            </button>
            <a href="{{url('sopas/mezclado_sopas')}}">
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
    <script src="{{asset('js-brc/tools/nuevo_registro.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment-with-locales.js')}}"></script>
    <script>


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
                <option  value="${e.id_producto}" >   ${e.control_trazabilidad.producto.descripcion} </option>
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

        async function iniciar_mezclado_sopas() {

            $('.loading').show();
            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('sopas/mezclado_sopas/iniciar_mezclado_sopas')}}";
            const response = await iniciar(url, no_orden_produccion);


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
            $('.loading').show();
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            return $.ajax(
                {
                    type: "POST",
                    url: "{{url('sopas/mezclado_sopas/iniciar_formulario')}}",
                    data: {
                        id_control: id_control,
                        id_producto: id_producto,
                        lote:lote,
                        turno:turno
                    },
                    success: function (response) {

                        if (response.status === 1) {
                            habilitar_formulario(detalle());
                            deshabilitar_encabezado();
                            const linea = gl_detalle_insumos.find(e => e.id_producto == id_producto);
                            document.getElementById('tiempo_optimo').value = parseFloat(linea.tiempos_mezcla_seco) + parseFloat(linea.tiempos_mezcla_alta) + parseFloat(linea.tiempos_mezcla_baja);
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


        function removeFromTable(element) {
            //Removemos la fila
            let td = $(element).parent();
            td.parent().remove();
            let tdNext = td.next();
            let tdNextNext = tdNext.next();
        }

        function limpiar() {

            const fields = detalle();
            limpiar_formulario(fields)
            document.getElementById('no_bach').focus();
        }

        function detalle() {


            const no_batch = document.getElementById('no_bach');
            const hora_inicio_mezcla = document.getElementById('hora_inicio');
            const hora_fin_mezcla = document.getElementById('hora_finalizo');
            const tiempo_velocidad_alta = document.getElementById('tiempo_alta');
            const tiempo_velocidad_baja = document.getElementById('tiempo_baja');
            const tiempo_velocidad_seco = document.getElementById('tiempo_seco');
            const verificacion_tamiz = document.getElementById('verificacion_tamiz');
            const observaciones = document.getElementById('observaciones');


            const fields = [
                ["no_batch", no_batch],
                ["hora_inicio_mezcla", hora_inicio_mezcla],
                ["hora_fin_mezcla", hora_fin_mezcla],
                ["tiempo_velocidad_seco", tiempo_velocidad_seco],
                ["tiempo_velocidad_alta", tiempo_velocidad_alta],
                ["tiempo_velocidad_baja", tiempo_velocidad_baja],
                ["verificacion_tamiz", verificacion_tamiz],
                ["observaciones", observaciones]

            ];

            return fields;


        }


        function get_id_control() {

            const id_producto = document.getElementById('id_producto').value;
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            document.getElementById('id_control').value = id_control;
            return id_control;
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
                const url = "{{url('sopas/mezclado_sopas/insertar_detalle')}}";
                const url_borrar = "'{{url('sopas/mezclado_sopas/borrar_detalle')}}'";
                const response = await insertar_detalle(request, get_id_control(), url);
                if (response.status == 1) {
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

            let hora_descarga = document.getElementById('hora_fin_mezcla-' + id);

            let segundo_optimos = parseFloat(document.getElementById('tiempo_optimo').value);


            let hora_carga = moment(moment().format('YYYY-MM-DD') + " " + document.getElementById('hora_inicio_mezcla-' + id).value);
            let hora_carga2 = moment(moment().format('YYYY-MM-DD') + " " + document.getElementById('hora_inicio_mezcla-' + id).value);
            var observaciones = document.getElementById('observaciones-' + id).value;
            let hora_top = hora_carga2.add(segundo_optimos, 'seconds');
            if (hora_top.isBefore(moment())) {
                observaciones = observaciones + " ,excedente de " + moment().diff(hora_carga.add(segundo_optimos, 'seconds'), 'seconds') + " segundos";
                document.getElementById('observaciones-' + id).parentNode.innerText = observaciones;

            }
            hora_descarga.parentNode.innerText = moment().format('HH:mm:ss');
            hora_descarga.value = moment().format('HH:mm:ss');
            $('.loading').show();
            $.ajax({

                url: "{{url('sopas/mezclado_sopas/actualizar_detalle')}}",
                data: {
                    id: id,
                    hora_descarga: moment().format('HH:mm:ss'),
                    observaciones: observaciones
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

