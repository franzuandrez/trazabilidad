@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12     col-md-12    col-xs-12">
        <h3>CONTROL DE PESO SECO DE CHAO MEIN
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
    @component('componentes.nav',['operation'=>'Continuar',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-bar-chart',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Peso Seco
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/peso_seco/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}


    <input type="hidden" id="id_control" name="id_control" value="{{$peso_seco->id_control}}">
    <input type="hidden" id="no_orden_produccion" name="no_orden_produccion" disabled
           value="{{$peso_seco->id_control}}">


    @include('control.peso_seco.tabla_informativa')

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="id_producto">Producto</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$peso_seco->control_trazabilidad->id_producto}}" selected>
                    {{$peso_seco->control_trazabilidad->liberacion_linea->presentacion->descripcion}}
                </option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input class="form-control selectpicker"
                   id="id_turno"
                   value="{{$peso_seco->turno}}"
                   name="id_turno" disabled>

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="lote">No.  Lote</label>
            <input class="form-control selectpicker valor"
                   disabled
                   id="lote" name="lote"
                   value="{{$peso_seco->lote}}"
            >


        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="no_1">NO. 1</label>
                <input id="no_1" name="no_1"
                       required
                       type="number"
                       step="any"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="no_2">NO. 2</label>
                <input id="no_2" name="no_2"
                       required
                       type="number"
                       step="any"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="no_3">NO. 3</label>
                <input id="no_3" name="no_3"
                       required
                       type="number"
                       step="any"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="no_4">NO. 4</label>
                <input id="no_4"
                       type="number"
                       step="any"
                       name="no_4"
                       required
                       class="form-control">
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="no_5">NO. 5</label>
                <input id="no_5"
                       type="number"
                       step="any"
                       name="no_5"
                       required

                       class="form-control">
            </div>
        </div>


        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <label for="observaciones">OBSERVACIONES</label>
            <div class="input-group">
                <input id="observaciones" type="text" name="observaciones"
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
        @include('componentes.loading')

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #f7b633;  color: #fff;">
                <tr>

                    <th>HORA</th>
                    <th>Producto</th>
                    <th>No. Lote</th>
                    <th>NO. 1</th>
                    <th>NO. 2</th>
                    <th>NO. 3</th>
                    <th>NO. 4</th>
                    <th>NO. 5</th>
                    <th>OBSERVACIONES</th>
                </tr>

                </thead>
                <tbody>
                @foreach($peso_seco->detalle as $detalle)
                    <tr>
                        <td>{{$detalle->hora}}</td>
                        <td>  {{$peso_seco->control_trazabilidad->liberacion_linea->presentacion->descripcion}}</td>
                        <td>{{$detalle->lote}}</td>
                        <td>{{$detalle->muestra_no1}}</td>
                        <td>{{$detalle->muestra_no2}}</td>
                        <td>{{$detalle->muestra_no3}}</td>
                        <td>{{$detalle->muestra_no4}}</td>
                        <td>{{$detalle->muestra_no5}}</td>
                        <td>{{$detalle->observaciones}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
            <input type="text" name="observacion_correctiva" value="{{$peso_seco->observaciones}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-primary" type="button"
                    onclick="guardar()"
            >
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('control/peso_seco ')}}">
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
        var gl_detalle_insumos = @json([$peso_seco->control_trazabilidad]);

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

        async function iniciar_control_peso_seco() {


            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('control/peso_seco/iniciar_laminado')}}";
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
                    url: "{{url('control/peso_seco/iniciar_formulario')}}",
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

        let ultimo_registro = @json($peso_seco->detalle->last()->hora);

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


            const hora = moment();

            let observaciones = mostrar_observaciones(hora, ultimo_registro);
            document.getElementById('observaciones').value = document.getElementById('observaciones').value + " " + observaciones;
            ultimo_registro = hora.clone().format('HH:mm:ss');

            if (no_orden_valida) {
                $('.loading').show();
                const request = getRequest(fields);
                const url = "{{url('control/peso_seco/insertar_detalle')}}";
                const url_borrar = "'{{url('control/peso_seco/borrar_detalle')}}'";
                const response = await insertar_detalle(request, get_id_control, url);
                if (response.status == 1) {
                    const url_update_enc = "{{url('control/peso_seco/nuevo_registro')}}";
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

            const fields = detalle();
            limpiar_formulario(fields);
            document.getElementById('no_1').focus();
        }

        function ver_informacion() {

            $('#informacion').modal()
        }

    </script>
@endsection
