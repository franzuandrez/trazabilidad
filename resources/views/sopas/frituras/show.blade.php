@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12    col-md-12    col-xs-12">
        <h3>REGISTRO DE PARAMETROS EN FRITURA DE SOPAS INSTANTANEAS</h3>
    </div>
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-fire',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Frituras de Sopas
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'sopas/fritura/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" id="id_control" name="id_control" value="{{$fritura->id_control}}">
    <input type="hidden" id="no_orden_produccion" disabled name="no_orden_produccion" value="{{$fritura->id_control}}">




    @include('componentes.loading')

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">Producto</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$fritura->control_trazabilidad->id_producto}}" selected>
                    {{$fritura->control_trazabilidad->liberacion_sopas->producto->descripcion}}
                </option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">No.  Lote</label>
            <input class="form-control selectpicker valor"
                   disabled
                   value="{{$fritura->lote}}"
                   id="lote" name="lote">

        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="id_turno">TURNO</label>
        <div class="form-group">
            <input class="form-control selectpicker "
                   id="id_turno" name="id_turno" disabled
                   value="{{$fritura->id_turno}}"
            >

        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">



        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>HORA (CADA 15 MIN)</th>
                <th>INICIAL 125 A 140 °C</th>
                <th>FINAL 140 A 160 °C</th>
                <th>GENERAL 148 A 160 °C</th>
                <th>SET 150 A 160 °C</th>
                <th>TIEMPO DE FRITURA 1:30 A 2:20 MIN</th>
                <th>OBSERVACIONES</th>
                </thead>
                <tbody>
                @foreach($fritura->detalle as $detalle)
                    <tr>
                        <td>{{$detalle->hora}}</td>
                        <td>{{$detalle->temperatura_inicial}}</td>
                        <td>{{$detalle->temperatura_final}}</td>
                        <td>{{$detalle->temperatura_general}}</td>
                        <td>{{$detalle->temperatura_set}}</td>
                        <td>{{$detalle->tiempo_fritura}}</td>
                        <td>{{$detalle->observaciones}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="acciones">ACCIONES/CORRECTIVAS</label>
                <input type="text" name="acciones"
                       readonly
                       value="{{$fritura->observaciones}}"
                       class="form-control">
            </div>
        </div>

        <input type="hidden" id="hora">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <a href="{{url('sopas/fritura')}}">
                    <button class="btn btn-primary" type="button">
                        <span class="fa fa-backward"></span>
                    Regresar
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

        var gl_detalle_insumos = @json([$fritura->control_trazabilidad]);
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
            const url = "{{url('sopas/fritura/iniciar_fritura')}}";
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
                    url: "{{url('sopas/fritura/iniciar_formulario')}}",
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
            limpiar_formulario(fields)
            document.getElementById('inicial').focus();

        }

        function detalle() {


            const hora = document.getElementById('hora');
            const temperatura_inicial = document.getElementById('inicial');
            const temperatura_final = document.getElementById('final');
            const temperatura_general = document.getElementById('general');
            const temperatura_set = document.getElementById('set');
            const tiempo_fritura = document.getElementById('tiempo');
            const observaciones = document.getElementById('observaciones');


            const fields = [
                ["hora", hora],
                ["temperatura_inicial", temperatura_inicial],
                ["temperatura_final", temperatura_final],
                ["temperatura_general", temperatura_general],
                ["temperatura_set", temperatura_set],
                ["tiempo_fritura", tiempo_fritura],
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
            if (no_orden_valida) {
                $('.loading').show();
                const request = getRequest(fields);
                const url = "{{url('sopas/fritura/insertar_detalle')}}";
                const url_borrar = "'{{url('sopas/fritura/borrar_detalle')}}'";
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
