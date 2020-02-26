@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">

@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12   col-sm-push-3   col-md-12   col-md-push-3  col-xs-12">
        <h3>CONTROL MEZCLA DE HARINA Y SOLUCION CHAO MEIN</h3>
    </div>

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-spoon',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Mezcla Harina
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/mezcla_harina/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}


    <input type="hidden" id="id_control" name="id_control">
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <label for="turno">NO ORDEN DE PRODUCCION</label>
        <div class="input-group">
            <input type="text"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==13)iniciar_mezcla_harina()"
                   name="no_orden_produccion" value="{{old('no_orden_produccion')}}"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    id="btn_buscar_orden"
                    onclick="iniciar_mezcla_harina()"
                    onkeydown="iniciar_mezcla_harina()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-search"
                       aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>




    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
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

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

        <label for="lote">LOTE</label>
        <div class="input-group">
            <input class="form-control selectpicker valor"
                    disabled
                    required
                    id="lote" name="lote">
            <div class="input-group-btn">
                <button
                    onclick="iniciar_formulario()"
                    onkeydown="iniciar_formulario()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-check"
                       aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>

    @include('componentes.loading')
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="hora_carga">HORA CARGA</label>
            <div class="input-group">
                <input id="hora_carga" type="text"
                       disabled
                       required
                       class="form-control timepicker" name="hora_carga">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="hora_descarga">HORA DESCARGA</label>
            <div class="input-group">
                <input id="hora_descarga" type="text"
                       disabled
                       required
                       class="form-control timepicker" name="hora_descarga">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-sm-12 col-md-12  col-xs-12">
            <div class="form-group">
                <label for="solucion">LBS DE SOLUCIÓN (158.4 A 168.5)</label>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="_solucion_inicial">VALOR</label>
                <input id="solucion_inicial"
                       type="number"
                       step="any"
                       name="solucion_inicial"
                       disabled
                       required
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6  col-xs-12">
            <div class="form-group">
                <label for="observacion">OBSERVACIONES</label>
                <input id="solucion_observacion"
                       disabled
                       type="text" name="solucion_observacion"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="_solucion_final"> </label>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="ph">PH (8-11 PPM)</label>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="_solucion_inicial">VALOR</label>
                <input id="ph_inicial" name="ph_inicial"
                       disabled
                       required
                       type="number"
                       step="any"
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="observacion">OBSERVACIONES</label>
            <div class="input-group">
                <input id="ph_observacion" type="text" name="ph_observacion"
                       disabled
                       class="form-control">
                <div class="input-group-btn">
                    <button
                        onclick="agregar_a_table()"
                        onkeydown="agregar_a_table()"
                        type="button" class="btn btn-default">
                        <i class="fa fa-plus"
                           aria-hidden="true"></i>
                    </button>
                    <button
                        onclick="limpiar()"
                        onkeydown="limpiar()"
                        type="button" class="btn btn-default">
                        <i class="fa fa-trash"
                           aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <tr>

                    <th>PRODUCTO</th>
                    <th>LOTE</th>
                    <th>HORA CARGA</th>
                    <th>HORA DESCARGA</th>
                    <th>SOLUCION INICAL</th>
                    <th>OBSERVACIONES</th>
                    <th>PH INICIAL</th>
                    <th>OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
            <input type="text" name="observacion" id="observacion" value="{{old('observacion')}}"
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
            <a href="{{url('control/mezcla_harina')}}">
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
                <option  value="${e.id_producto}" >   ${e.presentacion.descripcion} </option>
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

        async function iniciar_mezcla_harina() {

            $('.loading').show();
            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('control/mezcla_harina/iniciar_harina')}}";
            const response = await iniciar(url, no_orden_produccion);

            if (response.status == 0) {
                alert(response.message);
            } else {
                gl_detalle_insumos = response.data.data;
                document.getElementById('id_producto').disabled = false;
                document.getElementById('lote').disabled = false;
                $('#id_producto').selectpicker('refresh');
                $('#lote').selectpicker('refresh');
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
            $('#id_producto').selectpicker('refresh');
            $('#lote').selectpicker('refresh');

        }

        function iniciar_formulario() {

            const id_producto = document.getElementById('id_producto').value;
            const lote = document.getElementById('lote').value;

            if (id_producto == "") {
                alert("Seleccione producto");
                return;
            }
            if (lote == "") {
                alert("Lote en blanco");
                return;
            }
            $('.loading').show();
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            return $.ajax(
                {
                    type: "POST",
                    url: "{{url('control/mezcla_harina/iniciar_formulario')}}",
                    data: {
                        id_control: id_control,
                        lote:lote
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
                        console.log(error)
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

            const fields = detalle().filter(e => e[0] != "id_producto" & e[0] != "lote");
            limpiar_formulario(fields);
            document.getElementById('hora_carga').focus();

        }

        function detalle() {


            const id_producto = document.getElementById('id_producto');
            const lote = document.getElementById('lote');
            const hora_carga = document.getElementById('hora_carga');
            const hora_descarga = document.getElementById('hora_descarga');
            const solucion_inicial = document.getElementById('solucion_inicial');
            const solucion_observacion = document.getElementById('solucion_observacion');
            const ph_inicial = document.getElementById('ph_inicial');
            const ph_observacion = document.getElementById('ph_observacion');


            const fields = [
                ["id_producto", id_producto],
                ["lote", lote],
                ["hora_carga", hora_carga],
                ["hora_descarga", hora_descarga],
                ["solucion_inicial", solucion_inicial],
                ["solucion_observacion", solucion_observacion],
                ["ph_inicial", ph_inicial],
                ["ph_observacion", ph_observacion],
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

            if (existe_campo_vacio(fields)) {
                alert("Campos incompletos");
                return;
            }
            if (no_orden_valida) {
                $('.loading').show();
                const request = getRequest(fields);
                const url = "{{url('control/mezcla_harina/insertar_detalle')}}";
                const url_borrar = "'{{url('control/mezcla_harina/borrar_detalle')}}'";
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

