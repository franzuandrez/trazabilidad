@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12     col-md-12    col-xs-12">
        <h3>CONTROL DE MEZCLA PARA BASE DE CONDIMENTOS
        </h3>
    </div>
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-cutlery',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Condimentos
        @endslot
        @slot('submenu')
            Bases
        @endslot
    @endcomponent

    @include('componentes.loading')

    {!!Form::open(array('url'=>'base_condimentos','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" id="id_control" name="id_control" value="{{$formulario->id_control}}">
    <input type="hidden" id="no_orden_produccion" disabled="" name="no_orden_produccion"
           value="{{$formulario->id_control}}">



    <div class="col-lg-6 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$formulario->control_trazabilidad->producto->id_producto}}" selected>{{$formulario->control_trazabilidad->producto->codigo_interno}}</option>
            </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <label for="lote">LOTE</label>
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

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12" style="display: none">
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
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12" style="display: none">
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
            <label for="observaciones">OBSERVACIONES</label>
            <div class="input-group">
                <input id="observaciones" type="text" name="observaciones"
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
                    <th>HORA CARGA</th>
                    <th>HORA DESCARGA</th>
                    <th>OBSERVACIONES</th>

                </tr>
                </thead>
                <tbody>
                @foreach( $formulario->detalle as $detalle )
                    <tr>
                        <td>
                            @if($detalle->hora_carga == null || $detalle->hora_descarga == null)
                                <button type="button"
                                        class="btn btn-success"
                                        onclick="marcar_hora_descarga('{{$detalle->id}}',this)">
                                    <span class="fa fa-check"></span></button>
                            @endif
                        </td>
                        <td>{{$detalle->hora_carga}}</td>
                        <td>{{$detalle->hora_descarga}}
                            <input  type="hidden" id="hora_descarga-{{$detalle->id}}">
                        </td>
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
            <input type="text" name="observacion_correctiva" value="{{$formulario->observacion_correctiva}}"
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
            <a href="{{url('bases_condimentos')}}">
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


        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        var gl_detalle_insumos = @json([$formulario->control_trazabilidad]);


        function buscar_no_orden_produccion_local() {

            let url = '{{url('bases_condimentos/buscar_orden_produccion')}}';
            buscar_no_orden_produccion(url);
        }


        function inicia_formulario_local() {
            let url = "{{url('bases_condimentos/iniciar_formulario')}}";
            intentar_iniciar_formulario(url);
        }


        function detalle() {

            const observaciones = document.getElementById('observaciones');
            const hora_inicio = document.getElementById('hora_inicio');
            const hora_salida = document.getElementById('hora_salida');

            const fields = [
                ["hora_carga", hora_inicio],
                ["hora_descarga", hora_salida],
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
                const url = "{{url('bases_condimentos/insertar_detalle')}}";
                const response = await insertar_detalle(request, get_id_control(), url);
                if (response.status == 1) {
                    const url_update_enc = "{{url('control/precocido/nuevo_registro')}}";
                    const id_turno = document.getElementById('id_turno').value;
                    const registros = [
                        formato_registro('turno', id_turno),
                    ];
                    insertar_registros(url_update_enc, registros, get_id_control());
                    add_to_table_harina(fields, response.id, 'detalles');
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
