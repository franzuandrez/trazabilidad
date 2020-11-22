@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12     col-md-12    col-xs-12">
        <h3>CONTROL DE PESOS CONDIMENTOS
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
    @include('condimentos.pesos.tabla_informativa')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-cutlery',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Condimentos
        @endslot
        @slot('submenu')
            Pesos
        @endslot
    @endcomponent

    @include('componentes.loading')

    {!!Form::open(array('url'=>'peso_condimentos/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" id="id_control" name="id_control" value="{{$formulario->id_control}}">
    <input type="hidden" id="no_orden_produccion" name="no_orden_produccion" disabled
           value="{{$formulario->id_control}}">


    <div class="col-lg-6 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">Producto</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$formulario->control_trazabilidad->producto->id_producto}}"
                        selected>{{$formulario->control_trazabilidad->producto->codigo_interno}}</option>
            </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <label for="lote">No.  Lote</label>
        <div class="form-group">
            <input class="form-control selectpicker valor"
                   disabled
                   required
                   value="{{$formulario->lote}}"
                   id="lote" name="lote">
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <label for="id_turno">TURNO</label>
        <div class="form-group">
            <input class="form-control selectpicker valor"
                   disabled
                   required
                   value="{{$formulario->turno}}"
                   id="id_turno" name="id_turno">
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

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
                @foreach($formulario->detalle as $detalle)
                    <tr>
                        <td>{{$detalle->hora}}</td>
                        <td>{{$detalle->no_1}}</td>
                        <td>{{$detalle->no_2}}</td>
                        <td>{{$detalle->no_3}}</td>
                        <td>{{$detalle->no_4}}</td>
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
            <input type="text" name="observacion_correctiva"    readonly  value="{{$formulario->observaciones}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('peso_condimentos')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
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


        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        var gl_detalle_insumos = @json([$formulario->control_trazabilidad]);


        function buscar_no_orden_produccion_local() {

            let url = '{{url('peso_condimentos/buscar_orden_produccion')}}';
            buscar_no_orden_produccion(url);
        }


        function inicia_formulario_local() {
            let url = "{{url('peso_condimentos/iniciar_formulario')}}";
            intentar_iniciar_formulario(url);
        }


        function detalle() {

            const observaciones = document.getElementById('observaciones');
            const no_1 = document.getElementById('no_1');
            const no_2 = document.getElementById('no_2');
            const no_3 = document.getElementById('no_3');
            const no_4 = document.getElementById('no_4');
            const hora = document.getElementById('hora');
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


            if (no_orden_valida) {

                $('.loading').show();
                const request = getRequest(fields);
                const url = "{{url('peso_condimentos/insertar_detalle')}}";
                const url_borrar = "'{{url('peso_condimentos/borrar_detalle')}}'";
                const response = await insertar_detalle(request, get_id_control, url);
                if (response.status == 1) {
                    const url_update_enc = "{{url('peso_condimentos/nuevo_registro')}}";
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

        function limpiar() {

            const fields = detalle().filter(e => e[0] !== "id_producto" & e[0] !== "lote");
            limpiar_formulario(fields);


        }


        function add_to_table_harina(fields, id, table, url = '') {


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

            let hora_descarga = document.getElementById('hora_descarga-' + id);


            hora_descarga.parentNode.innerText = moment().format('HH:mm:ss');
            hora_descarga.value = moment().format('HH:mm:ss');
            $('.loading').show();
            $.ajax({

                url: "{{url('bases_condimentos/actualizar_detalle')}}",
                data: {
                    id: id,
                    hora_descarga: moment().format('HH:mm:ss'),
                },
                type: 'POST',
                success: function (response) {

                    if (response.status === 0) {
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
