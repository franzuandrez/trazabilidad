@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
        <h3>CONTROL SECADO
        </h3>
    </div>
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-bar-chart',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Secado
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/secado/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    @include('control.peso_seco.tabla_informativa')
    @include('componentes.loading')
    <input type="hidden" id="id_control" name="id_control">
    @include('produccion.partials.orden_produccion_sugerida')
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="turno">NO ORDEN DE PRODUCCION</label>
        <div class="input-group">
            <input type="text" name="no_orden_produccion"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==13)iniciar_control_peso_seco()"
                   value="{{old('no_orden_produccion')}}"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    id="btn_buscar_orden"
                    onclick="iniciar_control_peso_seco()"
                    onkeydown="iniciar_control_peso_seco()"
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
                    onclick="inicia_formulario()"
                    onkeydown="inicia_formulario()"
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
                <label for="principal_set">PRINCIPAL SET</label>
                <input id="principal_set"
                       type="number"
                       step="any"
                       onkeydown="if(event.keyCode==13)next('principal_real')"
                       name="principal_set"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="principal_real">PRINCIPAL REAL</label>
                <input id="principal_real"
                       type="number"
                       step="any"
                       name="principal_real"
                       required
                       onkeydown="if(event.keyCode==13)next('inicial_ar')"
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="inicial_ar">INICIAL AR</label>
                <input id="inicial_ar"
                       type="number"
                       step="any"
                       onkeydown="if(event.keyCode==13)next('inicial_ab')"
                       name="inicial_ar"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="inicial_ab">INICIAL AB</label>
                <input id="inicial_ab"
                       type="number"
                       step="any"
                       name="inicial_ab"
                       required
                       onkeydown="if(event.keyCode==13)next('central_ar')"
                       disabled
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="central_ar">CENTRAL AR</label>
                <input id="central_ar"
                       type="number"
                       step="any"
                       onkeydown="if(event.keyCode==13)next('central_ab')"
                       name="central_ar"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="central_ab">CENTRAL AB</label>
                <input id="central_ab"
                       type="number"
                       step="any"
                       onkeydown="if(event.keyCode==13)next('final_ar')"
                       name="central_ab"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="final_ar">FINAL AR</label>
                <input id="final_ar"
                       type="number"
                       step="any"
                       onkeydown="if(event.keyCode==13)next('final_ab')"
                       name="final_ar"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="final_ab">FINAL AB</label>
                <input id="final_ab"
                       type="number"
                       step="any"
                       onkeydown="if(event.keyCode==13)next('velocidad')"
                       name="final_ab"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="velocidad">VELOCIDAD HRZ</label>
                <input id="velocidad"
                       type="number"
                       onkeydown="if(event.keyCode==13)next('tasa_salida')"
                       step="any"
                       name="velocidad"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="tasa_salida">TASA SALIDA</label>
                <input id="tasa_salida"
                       type="number"
                       step="any"
                       name="tasa_salida"
                       onkeydown="if(event.keyCode==13)next('humedad_secadora')"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="humedad_secadora">HUMEDAD SECADORA</label>
                <input id="humedad_secadora"
                       type="number"
                       step="any"
                       onkeydown="if(event.keyCode==13)next('humedad_pasta')"
                       name="humedad_secadora"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <label for="humedad_pasta">HUMEDAD PASTA</label>
            <div class="input-group">
                        <span class="input-group-addon">
                            <b>N/A</b>
                          <input type="checkbox"
                            onclick="setNoAplica('humedad_pasta',this)"
                          >
                        </span>
                <input id="humedad_pasta"
                       type="number"
                       step="any"
                       name="humedad_pasta"
                       required
                       disabled
                       class="form-control">
            </div>
        </div>


    </div>

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ambiente_humedad">AMBIENTE HUMEDAD</label>
            <input id="ambiente_humedad"
                   type="number"
                   step="any"
                   name="ambiente_humedad"
                   required
                   onkeydown="if(event.keyCode==13)next('ambiente_temp')"
                   disabled
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ambiente_temperatura">AMBIENTE TEMP</label>
            <input id="ambiente_temperatura"
                   type="number"
                   step="any"
                   onkeydown="if(event.keyCode==13)next('observaciones')"
                   name="ambiente_temp"
                   required
                   disabled
                   class="form-control">
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
                <th>PRINCIPAL SET</th>
                <th>PRINCIPAL REAL</th>
                <th>INICIAL AR</th>
                <th>INICIAL AB</th>
                <th>CENTRAL AR</th>
                <th>CENTRAL AB</th>
                <th>FINAL AR</th>
                <th>FINAL AB</th>
                <th>VELOCIDAD</th>
                <th>TASA SALIDA</th>
                <th>HUMEDAD EN SECADORA</th>
                <th>HUMEDAD PASTA</th>
                <th>AMBIENTE HUMEDAD</th>
                <th>AMBIENTE TEMP</th>
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
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-primary" type="button"
                    onclick="guardar()"
            >
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('control/secado ')}}">
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


        function setNoAplica(id,element) {

            if(element.checked){
                document.getElementById(id).value = 0;
                document.getElementById(id).disabled = true;
            }else{
                document.getElementById(id).value = '';
                document.getElementById(id).disabled = false;
            }


        }

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
                  <option  value="${e.id_producto}" > ${e.control_trazabilidad.producto.codigo_interno} </option>
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

        async function iniciar_control_peso_seco() {

            $('.loading').show();
            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('control/secado/iniciar_laminado')}}";
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


            const principal_set = document.getElementById('principal_set');
            const principal_real = document.getElementById('principal_real');
            const inicial_ar = document.getElementById('inicial_ar');
            const inicial_ab = document.getElementById('inicial_ab');
            const central_ar = document.getElementById('central_ar');
            const central_ab = document.getElementById('central_ab');
            const final_ar = document.getElementById('final_ar');
            const final_ab = document.getElementById('final_ab');
            const velocidad = document.getElementById('velocidad');
            const tasa_salida = document.getElementById('tasa_salida');
            const humedad_secadora = document.getElementById('humedad_secadora');
            const humedad_pasta = document.getElementById('humedad_pasta');
            const ambiente_humedad = document.getElementById('ambiente_humedad');
            const ambiente_temp = document.getElementById('ambiente_temperatura');
            const observaciones = document.getElementById('observaciones');

            const hora = document.getElementById('hora');


            const fields = [
                ["hora", hora],
                ["principal_set", principal_set],
                ["principal_real", principal_real],
                ["inicial_ar", inicial_ar],
                ["inicial_ab", inicial_ab],
                ["central_ar", central_ar],
                ["central_ab", central_ab],
                ["final_ar", final_ar],
                ["final_ab", final_ab],
                ["velocidad", velocidad],
                ["tasa_salida", tasa_salida],
                ["humedad_secadora", humedad_secadora],
                ["humedad_pasta", humedad_pasta],
                ["ambiente_humedad", ambiente_humedad],
                ["ambiente_temperatura", ambiente_temp],
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

        function inicia_formulario() {


            const id_producto = document.getElementById('id_producto').value;
            const lote = document.getElementById('lote').value;
            const turno = document.getElementById('id_turno').value;

            if (id_producto === "") {
                alert("Seleccione producto");
                return;
            }
            if (lote === "") {
                alert("Lote en blanco");
                return;
            }
            if (turno === "") {
                alert("Seleccione Turno");
                return;
            }
            $('.loading').show();
            const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
            $.ajax(
                {
                    type: "POST",
                    url: "{{url('control/secado/iniciar_formulario')}}",
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
                        console.log(error)
                    }
                }
            );

        }

        let ultimo_registro = null;

        async function agregar_a_table() {


            const no_orden_produccion = get_no_orden_produccion();
            const no_orden_disabled = document.getElementById('no_orden_produccion').disabled;
            const no_orden_valida = no_orden_disabled && no_orden_produccion != "";
            document.getElementById('hora').value = moment().format('HH:mm:ss');
            const fields = detalle();

            if (existe_campo_vacio(fields)) {
                get_campo_vacio(fields).focus();
                return;
            }

            const hora = moment();

            let observaciones = mostrar_observaciones(hora, ultimo_registro, 30);
            document.getElementById('observaciones').value = document.getElementById('observaciones').value + " " + observaciones;
            ultimo_registro = hora.clone().format('HH:mm:ss');
            if (no_orden_valida) {

                $('.loading').show();
                const request = getRequest(fields);
                const url = "{{url('control/secado/insertar_detalle')}}";
                const url_borrar = "'{{url('control/secado/borrar_detalle')}}'";
                const response = await insertar_detalle(request, get_id_control, url);
                if (response.status == 1) {
                    const url_update_enc = "{{url('control/secado/nuevo_registro')}}";
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

        function limpiar() {

            const fields = detalle().filter(e => e[0] !== "id_producto" & e[0] !== "lote");
            limpiar_formulario(fields);


        }

        function ver_informacion() {

            $('#informacion').modal()
        }

        function next(id) {
            document.getElementById(id).focus();
        }
    </script>
@endsection
