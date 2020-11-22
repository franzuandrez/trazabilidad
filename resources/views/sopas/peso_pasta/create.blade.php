@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12     col-md-12    col-xs-12">
        <h3>CONTROL DE PESO DE PASTA DE SOPAS INSTANTANEAS
            <button
                data-toggle="tooltip"
                title="Informacion"
                onclick="ver_informacion()"
                type="button" class="btn btn-primary btn-sm">
                <i class="fa fa-info"
                   aria-hidden="true"></i>
            </button>
        </h3>

    </div>
    @include('sopas.peso_pasta.tabla_informativa')
    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-signal',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Peso Pasta
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'sopas/peso_pasta/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    @include('componentes.loading')
    <input type="hidden" id="id_control" name="id_control">
    @include('produccion.partials.orden_produccion_sugerida')
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="turno">NO ORDEN DE PRODUCCION</label>
        <div class="input-group">
            <input type="text" name="no_orden_produccion"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==13)iniciar_laminado()"
                   value="{{old('no_orden_produccion')}}"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    id="btn_buscar_orden"
                    onclick="iniciar_laminado()"
                    onkeydown="iniciar_laminado()"
                    type="button" class="btn btn-primary">
                    <i class="fa fa-search"
                       aria-hidden="true"></i>
                </button>
                <button
                    onclick="ver_ordenes_sugeridas()"
                    onkeydown="ver_ordenes_sugeridas()"
                    type="button" class="btn btn-primary">
                    <i class="fa fa-info"
                       aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>


    @include('componentes.loading')
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
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

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">Producto</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="" selected>SELECCIONE UN PRODUCTO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="lote">No.  Lote</label>
        <div class="input-group">
            <input class="form-control selectpicker valor"
                    disabled
                    required
                    id="lote" name="lote">
            <div class="input-group-btn">
                <button
                    onclick="inicio_formulario()"
                    onkeydown="inicio_formulario()"
                    type="button" class="btn btn-primary">
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
            <div class="form-group">
                <label for="no_1">NO. 1</label>
                <input id="no_1"
                       step="any"
                       type="number"
                       name="no_1"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="no_2">NO. 2</label>
                <input id="no_2"
                       step="any"
                       type="number"
                       name="no_2"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="no_3">NO. 3</label>
                <input id="no_3"
                       step="any"
                       type="number"
                       name="no_3"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="no_4">NO. 4</label>
                <input id="no_4"
                       step="any"
                       type="number"
                       name="no_4"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12" style="display: none">
            <div class="form-group">
                <label for="no_5">Largo Fideo</label>
                <input id="no_5" type="text" name="no_5"
                       disabled
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
                    <button class="btn btn-primary block"
                            onclick="agregar_a_table()"
                            type="button">
                        <span class=" fa fa-plus"></span></button>
                    <button
                        onclick="limpiar()"
                        class="btn btn-primary block" type="button">
                        <span class=" fa fa-trash"></span></button>
                </div>
            </div>
        </div>

        <input type="hidden" name="hora" id="hora">


        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #f7b633;  color: #fff;">
                <tr>
                    <th>HORA</th>

                    <th>NO. 1</th>
                    <th>NO. 2</th>
                    <th>NO. 3</th>
                    <th>NO. 4</th>
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
                <button class="btn btn-primary"
                        onclick="guardar()"
                        type="button">
                    <span class=" fa fa-check"></span> Guardar
                </button>
                <a href="{{url('sopas/peso_pasta ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
            </button>
            </a>


            </div>
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

        async function iniciar_laminado() {

            $('.loading').show();
            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('sopas/peso_pasta/inciar_peso')}}";
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
                alert("Seleccione Turno");
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
                    url: "{{url('sopas/peso_pasta/iniciar_formulario')}}",
                    data: {
                        id_control: id_control,
                        id_producto: id_producto,
                        lote:lote,
                        turno:turno,
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

        }

        function detalle() {


            const hora = document.getElementById('hora');
            const no_1 = document.getElementById('no_1');
            const no_2 = document.getElementById('no_2');
            const no_3 = document.getElementById('no_3');
            const no_4 = document.getElementById('no_4');

            const observaciones = document.getElementById('observaciones');


            const fields = [
                ["hora", hora],
                ["no_1", no_1],
                ["no_2", no_2],
                ["no_3", no_3],
                ["no_4", no_4],
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

        var ultimo_registro = null;
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
                const url = "{{url('sopas/peso_pasta/insertar_detalle')}}";
                const url_borrar = "'{{url('sopas/peso_pasta/borrar_detalle')}}'";
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

        function ver_informacion() {

            $('#informacion').modal()
        }
    </script>
@endsection
