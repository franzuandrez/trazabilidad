@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
        <h3>CONTROL DE PESO SECO DE CHAO MEIN</h3>
    </div>
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-bar-chart',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Peso Seco
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/peso_seco/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <label for="turno">NO ORDEN DE PRODUCCION</label>
        <div class="input-group">
            <input type="text" name="no_orden_produccion"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==13)iniciar_control_peso_seco()"
                   value="{{old('no_orden_produccion')}}"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    onclick="iniciar_control_peso_seco()"
                    onkeydown="iniciar_control_peso_seco()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-search"
                       aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>




    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
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

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    onchange="cargar_lotes(this.value)"
                    id="id_producto" name="id_producto">
                <option value="" selected>SELECCIONE UN PRODUCTO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="lote" name="lote">
                <option value="" selected>SELECCIONE LOTE</option>
            </select>
        </div>
    </div>



    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_1">NO. 1</label>
            <input id="no_1" type="text" name="no_1"
                   required
                   disabled
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_2">NO. 2</label>
            <input id="no_2" type="text" name="no_2"
                   required
                   disabled
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_3">NO. 3</label>
            <input id="no_3" type="text" name="no_3"
                   required
                   disabled
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_4">NO. 4</label>
            <input id="no_4" type="text" name="no_4"
                   required
                   disabled
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_5">NO. 5</label>
            <input id="no_5" type="text" name="no_5"
                   required
                   disabled
                   class="form-control">
        </div>
    </div>



    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-10">
        <div class="form-group">
            <label for="observaciones">OBSERVACIONES</label>
            <input id="observaciones" type="text" name="observaciones"
                   disabled
                   class="form-control">
        </div>
    </div>
    <input  type="hidden" name="hora" id="hora">
    <div class="col-lg-2 col-sm-4 col-md-2 col-xs-2">
        <br>
        <div class="form-group">
            <button class="btn btn-default block"
                    onclick="agregar_a_table()"
                    style="margin-top: 5px;" type="button">
                <span class=" fa fa-plus"></span></button>
            <button
                onclick="limpiar()"
                class="btn btn-default block" style="margin-top: 5px;" type="button">
                <span class=" fa fa-trash"></span></button>
        </div>

    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #01579B;  color: #fff;">
            <tr>
                <th>OPCION</th>
                <th>HORA</th>
                <th>PRODUCTO</th>
                <th>LOTE</th>
                <th>NO. 1</th>
                <th>NO. 2</th>
                <th>NO. 3</th>
                <th>NO. 4</th>
                <th>NO. 5</th>
                <th>OBSERVACIONES</th>
            </tr>

            </thead>
            <tbody>
            </tbody>
        </table>
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
            <button class="btn btn-default" type="button"
                    onclick="guardar()"
            >
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('control/peso_seco')}}">
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
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
                <option  value="${e.id_producto}" > ${e.producto.descripcion} </option>
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
                    option += `<option selected value="${filtered[0].lote}" >${filtered[0].lote}</option>`;
                } else {
                    filtered.forEach(function (e) {
                        option += `<option value="${e.lote}" >${e.lote}</option>`;
                    })
                }
                $(select).append(option);
                $(select).selectpicker('refresh');
            }


        }

        async function iniciar_control_peso_seco() {


            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('control/peso_seco/iniciar_laminado')}}";
            const response = await iniciar(url, no_orden_produccion);

            if (response.status == 0) {
                alert(response.message);
            } else {
                const fields = detalle();
                gl_detalle_insumos = response.data.data.control_trazabilidad.detalle_insumos;
                document.getElementById('id_turno').disabled = false;
                $('#id_turno').selectpicker('refresh');
                habilitar_formulario(fields);
                cargar_productos();
                document.getElementById('no_orden_produccion').disabled = true;
            }


        }

        function detalle() {

            const id_producto = document.getElementById('id_producto');
            const lote = document.getElementById('lote');
            const no_1 = document.getElementById('no_1');
            const no_2 = document.getElementById('no_2');
            const no_3 = document.getElementById('no_3');
            const no_4 = document.getElementById('no_4');
            const no_5 = document.getElementById('no_5');
            const observaciones = document.getElementById('observaciones');

            const hora = document.getElementById('hora');


            const fields = [
                ["hora", hora],
                ["producto", id_producto],
                ["lote", lote],
                ["muestra_no1", no_1],
                ["muestra_no2", no_2],
                ["muestra_no3", no_3],
                ["muestra_no4", no_4],
                ["muestra_no5", no_5],
                ["observaciones", observaciones],
            ];

            return fields;

        }

        async function agregar_a_table() {


            const no_orden_produccion = get_no_orden_produccion();
            const no_orden_disabled = document.getElementById('no_orden_produccion').disabled;
            const no_orden_valida = no_orden_disabled && no_orden_produccion != "";
            document.getElementById('hora').value = moment().format('HH:mm:ss');
            const fields = detalle();

            if (existe_campo_vacio(fields)) {
                alert("Campos incompletos");
                return;
            }
            if (no_orden_valida) {

                const request = getRequest(fields);
                const url = "{{url('control/peso_seco/insertar_detalle')}}";
                const url_borrar = "'{{url('control/peso_seco/borrar_detalle')}}'";
                const response = await insertar_detalle(request, no_orden_produccion, url);
                if (response.status == 1) {
                    const url_update_enc = "{{url('control/peso_seco/nuevo_registro')}}";
                    const id_turno = document.getElementById('id_turno').value;
                    const registros = [
                        formato_registro('turno', id_turno),
                    ]   ;
                    insertar_registros(url_update_enc, registros, no_orden_produccion);
                    add_to_table(fields, response.id, 'detalles', url_borrar);
                    limpiar()
                } else {
                    alert(response.message);
                }
            } else {
                alert("Orden de produccion no valida");
            }


        }

        function limpiar() {

            const fields = detalle();
            limpiar_formulario(fields)

        }


    </script>
@endsection
