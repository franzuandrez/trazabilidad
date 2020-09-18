@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    @include('sopas.materias_primas_solucion.title')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa fa-check-circle',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Sopas
        @endslot
        @slot('submenu')
            Verificacion Materias
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'sopas/solucion/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" id="id_control" name="id_control">
    @include('produccion.partials.orden_produccion_sugerida')

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="turno">NO ORDEN DE PRODUCCION</label>
        <div class="input-group">
            <input type="text"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==13)buscar_no_orden_produccion_local()"
                   name="no_orden_produccion" value="{{old('no_orden_produccion')}}"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    id="btn_buscar_orden"
                    onclick="buscar_no_orden_produccion_local()"
                    onkeydown="buscar_no_orden_produccion_local()"
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

    @include('componentes.loading')
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
        <label for="lote">LOTE</label>
        <div class="form-group">
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
                    onclick="inicia_formulario_local()"
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

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="batch_no">BATCH NO.</label>
                <input id="batch_no"
                       type="number"
                       step="any"
                       required
                       disabled
                       name="batch_no"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="equipo">EQUIPO</label>
                <input id="equipo"
                       type="number"
                       step="any"
                       required
                       disabled
                       name="equipo"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad_ph">CANTIDAD PH</label>
                <input id="cantidad_ph"
                       type="number"
                       step="any"
                       required
                       disabled
                       name="cantidad_ph"
                       class="form-control">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad_agua">AGUA</label>
                <input id="cantidad_agua"
                       type="number"
                       step="any"
                       required
                       disabled
                       name="cantidad_agua"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <label>SAL</label>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="lote_sal">LOTE</label>
                    <input id="lote_sal"
                           type="text"
                           required
                           disabled
                           name="lote_sal"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="cantidad_sal">CANTIDAD</label>
                    <input id="cantidad_sal"
                           type="number"
                           step="any"
                           required
                           disabled
                           name="cantidad_sal"
                           class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <label>CARBONATO SODIO</label>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="lote_carbonato_sodio">LOTE</label>
                    <input id="lote_carbonato_sodio"
                           type="text"
                           required
                           disabled
                           name="lote_carbonato_sodio"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="cantidad_carbonato_sodio">CANTIDAD</label>
                    <input id="cantidad_carbonato_sodio"
                           type="number"
                           step="any"
                           required
                           disabled
                           name="cantidad_carbonato_sodio"
                           class="form-control">
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <label>HEXAMETAFOSFATO DE SODIO</label>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="lote_hex_sodio">LOTE</label>
                    <input id="lote_hex_sodio"
                           type="text"
                           required
                           disabled
                           name="lote_hex_sodio"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="cantidad_hex_sodio">CANTIDAD</label>
                    <input id="cantidad_hex_sodio"
                           type="number"
                           step="any"
                           required
                           disabled
                           name="cantidad_hex_sodio"
                           class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <label>GOMA XANTAN</label>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="lote_goma_xantan">LOTE</label>
                    <input id="lote_goma_xantan"
                           type="text"
                           required
                           disabled
                           name="lote_goma_xantan"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="cantidad_goma_xantan">CANTIDAD</label>
                    <input id="cantidad_goma_xantan"
                           type="number"
                           step="any"
                           required
                           disabled
                           name="cantidad_goma_xantan"
                           class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <label>CMC</label>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="lote_cmc">LOTE</label>
                    <input id="lote_cmc"
                           type="text"
                           required
                           disabled
                           name="lote_cmc"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <div class="form-group">
                    <label for="cantidad_cmc">CANTIDAD</label>
                    <input id="cantidad_cmc"
                           type="number"
                           step="any"
                           required
                           disabled
                           name="cantidad_cmc"
                           class="form-control">
                </div>
            </div>
        </div>

        <input type="hidden" id="hora" name="" required>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="observaciones">OBSERVACIONES</label>
            <div class="input-group">
                <input id="observaciones"
                       disabled
                       type="text" name="observaciones" value="{{old('observaciones')}}"
                       class="form-control">
                <div class="input-group-btn">
                    <button
                        data-toggle="tooltip"
                        title="Agregar"
                        onclick="agregar_a_table()"
                        type="button" class="btn btn-default">
                        <i class="fa fa-plus"
                           aria-hidden="true"></i>
                    </button>
                    <button
                        data-toggle="tooltip"
                        title="Limpiar"
                        onclick="limpiar()"
                        type="button" class="btn btn-default">
                        <i class="fa fa-trash"
                           aria-hidden="true"></i>
                    </button>
                </div>

            </div>
        </div>


        <div class="tab-pane" id="tab_3">

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                    @include('sopas.materias_primas_solucion.header_tabla')
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
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
            <button class="btn btn-default"
                    onclick="guardar()"
                    type="button">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('control/verificacion_materias')}}">
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
        var gl_detalle_insumos = null;


        function buscar_no_orden_produccion_local() {

            let url = '{{url('sopas/solucion/buscar_orden_produccion')}}';
            buscar_no_orden_produccion(url);
        }


        function inicia_formulario_local() {
            let url = "{{url('sopas/solucion/iniciar_formulario')}}";
            intentar_iniciar_formulario(url);
        }


        function detalle() {

            const batch_no = document.getElementById('batch_no');
            const equipo = document.getElementById('equipo');
            const cantidad_ph = document.getElementById('cantidad_ph');
            const agua = document.getElementById('cantidad_agua');
            const lote_sal = document.getElementById('lote_sal');
            const cantidad_sal = document.getElementById('cantidad_sal');
            const lote_carbonato_sodio = document.getElementById('lote_carbonato_sodio');
            const cantidad_carbonato_sodio = document.getElementById('cantidad_carbonato_sodio');
            const lote_hex_sodio = document.getElementById('lote_hex_sodio');
            const cantidad_hex_sodio = document.getElementById('cantidad_hex_sodio');
            const lote_goma_xantan = document.getElementById('lote_goma_xantan');
            const cantidad_goma_xantan = document.getElementById('cantidad_goma_xantan');
            const lote_cmc = document.getElementById('lote_cmc');
            const cantidad_cmc = document.getElementById('cantidad_cmc');
            const observaciones = document.getElementById('observaciones');
            const hora = document.getElementById('hora');


            const fields = [
                ["hora", hora],
                ["batch_no", batch_no],
                ["equipo", equipo],
                ["cantidad_ph", cantidad_ph],
                ["cantidad_agua", agua],
                ["lote_sal", lote_sal],
                ["cantidad_sal", cantidad_sal],
                ["lote_carbonato_sodio", lote_carbonato_sodio],
                ["cantidad_carbonato_sodio", cantidad_carbonato_sodio],
                ["lote_hex_sodio", lote_hex_sodio],
                ["cantidad_hex_sodio", cantidad_hex_sodio],
                ["lote_goma_xantan", lote_goma_xantan],
                ["cantidad_goma_xantan", cantidad_goma_xantan],
                ["lote_cmc", lote_cmc],
                ["cantidad_cmc", cantidad_cmc],
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
                const url = "{{url('sopas/solucion/insertar_detalle')}}";
                const url_borrar = "'{{url('sopas/solucion/borrar_detalle')}}'";
                const response = await insertar_detalle(request, get_id_control, url);
                if (response.status == 1) {
                    const url_update_enc = "{{url('sopas/solucion/nuevo_registro')}}";
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



    </script>
@endsection
