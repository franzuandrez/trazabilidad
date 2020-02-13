@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <style>
        .ocultar {
            visibility: hidden;
        }

        .mostrar {
            visibility: visible;
        }
    </style>
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
        <h3>CONTROL DE TRAZABILIDAD</h3>
    </div>
    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>'fa fa-list-alt ',
    'operation_icon'=>'fa-edit',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Control Trazabilidad
        @endslot
    @endcomponent

    {!!Form::open(array('url'=>'produccion/trazabilidad_chao_mein/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}


    <input type="hidden" name="id_producto" id="id_producto" value="{{$control->id_producto}}">
    <input type="hidden" name="id_control" id="id_control" value="{{$control->id_control}}">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input type="text"
                   name="producto"
                   readonly
                   value="{{$control->producto->descripcion}}"
                   id="producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-2 col-md-2 col-xs-6">
        <div class="form-group">
            <label for="unidad_medida">U.MEDIDA</label>
            <input type="text"
                   name="unidad_medida"
                   readonly
                   value="{{$control->producto->unidad_medida}}"
                   id="unidad_medida"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-6">
        <div class="form-group">
            <label for="best_by">BEST BY</label>
            <input type="text"
                   name="best_by"
                   readonly
                   value="{{$control->fecha_vencimiento->format('d/m/Y')}}"
                   id="best_by"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ordenes">ORDENES</label>
            <input type="text"
                   name="ordenes"
                   id="ordenes"
                   value="{{
                   substr_replace(
                           $control->requisiciones->reduce(function($carry,$item){
                                return $item->no_orden_produccion.",".$carry;
                           }),"",-1
                       )
                   }}"
                   readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote_pt">LOTE</label>
            <input type="text"
                   name="lote_pt"
                   id="lote"
                   value="{{$control->lote}}"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input type="text"
                   name="turno"
                   id="turno"
                   readonly
                   value="{{$control->id_turno}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad_programada">CANTIDAD PROGRAMADA</label>
            <input type="text"
                   name="cantidad_programada"
                   id="cantidad_programada"
                   value="{{$control->cantidad_programada}}"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#insumos" data-toggle="tab" aria-expanded="false">
                    INSUMOS
                </a>
            </li>
            <li class="">
                <a href="#involucrados" data-toggle="tab" aria-expanded="false">
                    OPERARIOS INVOLUCRADOS
                </a>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="insumos">
                <br>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>CODIGO PRODUCTO</label>
                        <input type="text"
                               name="codigo_producto_mp"
                               id="codigo_producto_mp"
                               onkeydown="if(event.keyCode==13)buscar_producto_mp_pp()"
                               placeholder="CODIGO PRODUCTO"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="descripcion_producto_mp">DESCRIPCION</label>
                        <input type="text"
                               readonly
                               name="descripcion_producto_mp"
                               id="descripcion_producto_mp"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="lote_producto_mp">LOTE</label>
                        <input type="text"
                               readonly
                               name="lote_producto_mp"
                               id="lote_producto_mp"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <label for="cantidad_producto_mp">CANTIDAD</label>
                    <div class="input-group">
                        <input type="text"
                               readonly
                               onkeydown="if(event.keyCode==13)verificar_existencia_lote()"
                               name="cantidad_producto_mp"
                               id="cantidad_producto_mp"
                               class="form-control">
                        <div class="input-group-btn">
                            <button
                                type="button"
                                onclick="verificar_existencia_lote()"
                                class="btn btn-default">
                                <i class="fa fa-plus"
                                   aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                    <table class="table table-bordered table-responsive">
                        <thead style="background-color: #01579B;  color: #fff;">
                        <tr>
                            <th>MP</th>
                            <th>COLOR</th>
                            <th>OLOR</th>
                            <th>IMPRESION</th>
                            <th>AUSENCIA M.E.</th>
                            <th>NO LOTE</th>
                            <th>CANTIDAD</th>
                            <th>FECHA VENC.</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_insumos">
                        @foreach($control->detalle_insumos as $insumo )
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane " id="involucrados">
                <br>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="actividades">ACTIVIDADES</label>
                        <select name="actividades"
                                onchange="next('colaborador')"
                                id="actividades" class="form-control selectpicker">
                            <option value="">SELECCIONE ACTIVIDAD</option>
                            @foreach( $actividades  as $actividad)
                                <option value="{{$actividad->id_actividad}}">{{$actividad->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <label for="colaborador"> COLABORADOR</label>
                    <div class="input-group">
                        <input type="text"
                               name="colaborador"
                               id="colaborador"
                               onkeydown="if(event.keyCode==13)buscar_colaborador()"
                               class="form-control">
                        <div class="input-group-btn">
                            <button
                                onclick="buscar_colaborador()"
                                onkeydown="buscar_colaborador()"
                                type="button" class="btn btn-default">
                                <i class="fa fa-search"
                                   aria-hidden="true"></i>
                            </button>
                            <button type="button"
                                    id="btn_agregar"
                                    onclick="agregar_asociacion()"
                                    onkeydown="agregar_asociacion()"
                                    class="btn btn-default">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <button type="button"
                                    id="btn_limpiar"
                                    onclick="limpiar()"
                                    onkeydown="limpiar()"
                                    class="btn btn-default">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" id="id_colaborador">
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table class="table table-bordered table-responsive">
                        <thead style="background-color: #01579B;  color: #fff;">
                        <tr>
                            <th>

                            </th>
                            <th>
                                ACTIVIDAD
                            </th>
                            <th>
                                COLABORADORES
                            </th>
                        </tr>
                        </thead>
                        <tbody id="asociaciones">
                        @foreach( $control->actividades as $actividad)
                            <tr id="actividad-{{$actividad->id_actividad}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$actividad->actividad->descripcion}}</td>
                                <td>
                                    <table class="table table-bordered">
                                        <thead>

                                        </thead>
                                        @php
                                            $i = 0;
                                        @endphp
                                        <tbody id="asociacion-{{$actividad->id_actividad}}">
                                        @foreach($control->asistencias as $asistencia )
                                            @if($asistencia->id_actividad == $actividad->id_actividad)
                                                <tr
                                                    id="act-{{$actividad->id_actividad}}-col-{{$asistencia->colaborador->id_colaborador}}"
                                                    class="{{$asistencia->fecha_hora_fin==null?'':'success'}}"
                                                >
                                                    <td>
                                                        @if($asistencia->fecha_hora_fin == null)
                                                            <button
                                                                data-toggle="tooltip"
                                                                title="Finalizar"
                                                                onclick="finalizar_asistencia('{{$actividad->id_actividad}}','{{$asistencia->colaborador->id_colaborador}}')"
                                                                type="button" class="btn btn-success">
                                                                <span class="fa fa-check"></span>
                                                            </button>
                                                        @else
                                                            {{$asistencia->fecha_hora_fin->format('h:i:s')}}
                                                        @endif

                                                    </td>
                                                    <td>{{$asistencia->colaborador->nombre .' '. $asistencia->colaborador->apellido  }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>

    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    @include('produccion.control_trazabilidad.colaboradores')


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default"
                    type="button"
                    onclick="guardar()"
            >
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('produccion/trazabilidad_chao_mein')}}">
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
    <script src="{{asset('js/moment.min.js')}}">
    </script>
    <script src="{{asset('js-brc/tools/lectura_codigo.js')}}">
    </script>
    <script>
        var formato = 'D/M/Y';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            setDate: new Date()
        });
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }

        });


        function guardar() {

            const total_asociaciones = $('#asociaciones').children().length;
            if (total_asociaciones == 0) {
                alert("Debe agregar a los operarios involucrados");
                return;
            }
            const total_insumos = $('#tbody_insumos').children().length;

            if (total_insumos == 0) {
                alert("Orden de produccion sin insumos");
                return;
            }

            $('form').submit();

        }

        function limpiar_formulario() {
            limpiar_orden_produccion();
            limpiar_producto();

        }

        function limpiar_producto() {
            document.getElementById('codigo_producto').value = "";
            document.getElementById('codigo_producto').focus();
            document.getElementById('codigo_producto').readOnly = false;
            document.getElementById('producto').value = "";
            document.getElementById('id_producto').value = "";
            document.getElementById('unidad_medida').value = "";
            document.getElementById('best_by').value = "";
            document.getElementById('no_orden_produccion').readOnly = true;
        }

        function limpiar_orden_produccion() {
            document.getElementById('no_orden_produccion').value = "";
            document.getElementById('ordenes').value = "";
            document.getElementById('no_orden_produccion').readOnly = false;
            document.getElementById('no_orden_produccion').focus();
            document.getElementById('lote').value = "";
            document.getElementById('lote').readOnly = true;
            document.getElementById('turno').value = "";
            document.getElementById('turno').readOnly = true;
            document.getElementById('cantidad_programada').value = "";
            document.getElementById('cantidad_programada').readOnly = true;
            $("#tbody_insumos").empty();
            $("#asociaciones").empty();

        }

        function agregar_orden_produccion() {

            const old_value = document.getElementById('ordenes').value;
            const new_value = document.getElementById('no_orden_produccion').value;

            if (old_value === "") {
                document.getElementById('ordenes').value = new_value;
            } else {
                document.getElementById('ordenes').value = old_value + ',' + new_value;
            }

        }

        function existe_orden_produccion(orden_produccion) {

            let ordenes = document.getElementById('ordenes').value.split(',');
            const existe_orden = ordenes.find(e => e === orden_produccion);

            return typeof existe_orden !== "undefined";

        }

        function buscar_orden_produccion() {

            let orden_produccion = document.getElementById('no_orden_produccion').value;
            let id_producto = document.getElementById('id_producto').value;

            if (id_producto == "") {
                alert("Producto no válido");
                return;
            }
            $('.loading').show();
            $.ajax({
                url: '{{url('produccion/trazabilidad_chao_mein/buscar_orden_produccion')}}' + '?q=' + orden_produccion + "&id_producto=" + id_producto,
                type: 'get',
                dataType: "json",
                success: function (response) {

                    if (response.status == 1) {
                        let orden_produccion = response.data;
                        if (orden_produccion == null) {
                            alert("Orden de produccion no encontrada");
                        } else if (orden_produccion.estado != 'D') {
                            alert("Orden de produccion en proceso ");
                        } else {
                            if (existe_orden_produccion(orden_produccion.no_orden_produccion)) {
                                alert("Orden de produccion ya agregada");
                            } else {
                                agregar_orden_produccion();
                                document.getElementById('id_requisicion').value = orden_produccion.id;
                                document.getElementById('lote').readOnly = false;
                                document.getElementById('lote').focus();
                                document.getElementById('turno').readOnly = false;
                                document.getElementById('cantidad_programada').readOnly = false;
                                document.getElementById('no_orden_produccion').value = "";
                            }

                        }
                    } else {
                        alert(response.message);
                    }
                    $('.loading').hide();

                },
                error: function (e) {
                    console.log(e);
                    alert(e);
                    $('.loading').hide();
                }
            })

        }

        function mostrar_icono_observaciones(element) {

            element.children[1].classList.add('mostrar');
            element.children[1].classList.remove('ocultar');

        }

        function remover_icono_observaciones(element) {
            element.children[1].classList.add('ocultar');
            element.children[1].classList.remove('mostrar');
        }

        function cargar_insumos(insumos) {

            let row = '';
            insumos.forEach(function (insumo) {

                row += `
                    <tr>
                        <td  >
                            <input type="hidden" name='id_producto_mp[]' value="${insumo.producto.id_producto}">
                            ${insumo.producto.codigo_interno}
                        </td>
                        <td>
                             <input type="hidden" name="color[]" value="0">
                             <input type="checkbox" onclick="asignar(this)">
                        </td>
                        <td>
                                <input type="hidden" name=olor[] value="0">
                                 <input type="checkbox" onclick="asignar(this)">

                            </td>
                        <td><input type="hidden" name=impresion[] value="0">
                                <input type="checkbox" onclick="asignar(this)">
                            </td>
                        <td><input type="hidden" name=ausencia_me[] value=0>
                        <input type="checkbox" onclick="asignar(this)"></td>
                        <td><input type="hidden" name=lote[] value="${insumo.lote}" >${insumo.lote}</td>
                        <td><input type="hidden" name=cantidad[] value="${insumo.cantidad}">${insumo.cantidad}</td>
                        <td><input type="hidden" name=fecha_vencimiento[] value="${(insumo.fecha_vencimiento)}">  ${moment(insumo.fecha_vencimiento).format('DD/MM/Y')} </td>
                    </tr>
                `;
            });


            $('#tbody_insumos').append(row);
        }

        function asignar(e) {

            e.previousElementSibling.value = 1 - e.previousElementSibling.value;

        }

        function buscar_producto_mp_pp() {


            const no_orden_produccion_element = document.getElementById('ordenes');
            const no_orden_produccion_valida = no_orden_produccion_element.value !== "" && (no_orden_produccion_element.disabled || no_orden_produccion_element.readOnly);

            if (!no_orden_produccion_valida) {
                alert(" No. orden no valido ");
                return;
            }

            const codigo_barras_completo = document.getElementById('codigo_producto_mp').value;
            const codigo_barras_descompuesto = descomponerString(codigo_barras_completo);
            const codigo_barras = codigo_barras_descompuesto[1];
            const lote = codigo_barras_descompuesto[3];


            const query = "?codigo_barras=" + codigo_barras + "&no_orden_produccion=" + no_orden_produccion_element.value + "&lote=" + lote;
            $('.loading').show();
            $.ajax({
                url: "{{url('produccion/trazabilidad_chao_mein/verificar_proximo_lote')}}" + query,
                type: "GET",
                success: function (response) {

                    if (response.status === 1) {
                        document.getElementById('descripcion_producto_mp').value = response.data.siguiente_lote.producto.descripcion;
                        document.getElementById('lote_producto_mp').value = lote;
                        document.getElementById('cantidad_producto_mp').readOnly = false;
                        document.getElementById('cantidad_producto_mp').focus();
                    } else {
                        alert(response.message);
                    }
                    $('.loading').hide();
                }, error: function (e) {
                    alert("Algo salió mal , error: " + e.responseJSON.message);
                    $('.loading').hide();
                }

            })
            ;
        }


        function verificar_existencia_lote() {

            const no_orden_produccion_element = document.getElementById('ordenes');
            const no_orden_produccion_valida = no_orden_produccion_element.value !== "" && (no_orden_produccion_element.disabled || no_orden_produccion_element.readOnly);

            if (!no_orden_produccion_valida) {
                alert(" No. orden no valido ");
                return;
            }

            const codigo_barras_completo = document.getElementById('codigo_producto_mp').value;
            const codigo_barras_descompuesto = descomponerString(codigo_barras_completo);
            const codigo_barras = codigo_barras_descompuesto[1];
            const lote = codigo_barras_descompuesto[3];
            const cantidad = document.getElementById('cantidad_producto_mp').value;
            const id_producto = document.getElementById('id_producto').value;
            const fecha_vencimiento = document.getElementById('best_by').value;
            const turno = document.getElementById('turno').value;
            const lote_pt = document.getElementById('lote').value;
            const cantidad_programada = document.getElementById('cantidad_programada').value;

            let query = "?codigo_barras=" + codigo_barras + "&no_orden_produccion=";
            query += no_orden_produccion_element.value + "&lote=" + lote + "&cantidad=" + cantidad;
            query += "&id_producto=" + id_producto + "&turno=" + turno + "&best_by=" + fecha_vencimiento;
            query += "&cantidad_programada=" + cantidad_programada + "&lote_pt=" + lote_pt;
            $('.loading').show();
            $.ajax({
                url: "{{url('produccion/trazabilidad_chao_mein/verificar_existencia_lote')}}" + query,
                type: "get",
                success: function (response) {
                    if (response.status === 1) {
                        agregar_insumo(response.data.id_detalle_insumo);
                        limpiar_insumo();
                        set_id_orden(response.data.id_control);
                    } else {
                        alert(response.message);
                    }
                    $('.loading').hide();
                }, error: function (e) {
                    console.log(e);
                    $('.loading').hide();
                }
            });


        }

        function set_id_orden(id) {
            document.getElementById('id_control').value = id;
        }

        function buscar_producto_terminado() {

            let codigo_interno = document.getElementById('codigo_producto').value;
            $('.loading').show();
            $.ajax({
                url: "{{url('produccion/trazabilidad_chao_mein/buscar_producto')}}" + "?codigo_interno=" + codigo_interno,
                type: "get",
                dataType: "json",
                success: function (response) {

                    if (response.producto != null) {
                        document.getElementById('codigo_producto').readOnly = true;
                        document.getElementById('id_producto').value = response.producto.id_producto;
                        document.getElementById('producto').value = response.producto.descripcion;
                        document.getElementById('best_by').value = response.fecha_vencimiento;
                        document.getElementById('unidad_medida').value = response.producto.unidad_medida;
                        document.getElementById('no_orden_produccion').readOnly = false;
                        document.getElementById('no_orden_produccion').value = "";
                        document.getElementById('ordenes').value = "";
                        document.getElementById('no_orden_produccion').focus();

                    } else {
                        alert('Producto no encontrado');
                    }
                    $('.loading').hide();
                },
                error: function (e) {
                    alert("Producto no encontrado");
                    console.log(e);
                    $('.loading').hide();
                }
            })
        }

        function limpiar() {

            document.getElementById('colaborador').value = "";
            document.getElementById('id_colaborador').value = "";
            document.getElementById('colaborador').readOnly = false;
            next('colaborador')
        }

        function agregar_asociacion() {
            let actividad_seleccionada = $('#actividades option:selected');
            let id_actividad = actividad_seleccionada.val();
            let descripcion_actividad = actividad_seleccionada.text();
            let id_colaborador = $('#id_colaborador').val();
            let nombre_colaborador = $('#colaborador').val();


            if (id_actividad == "") {
                alert('Debe seleccionar una actividad');
                return;
            }
            if (id_colaborador == "") {
                alert("Debe buscar un colaborador");
                return;
            }
            let estaActividadAgregada = document.getElementById('actividad-' + id_actividad) != null;
            if (estaActividadAgregada) {
                let estaColaboradorAgregado = document.getElementById('act-' + id_actividad + '-col-' + id_colaborador) != null;

                if (estaColaboradorAgregado) {
                    alert('El colaborador ya pertence a este actividad');
                } else {
                    agregarColaborador(id_actividad, id_colaborador, nombre_colaborador);
                }

            } else {
                agregarActividad(id_actividad, descripcion_actividad, id_colaborador, nombre_colaborador)
            }
            document.getElementById('colaborador').readOnly = false;
            limpiarElement('colaborador');
            next('colaborador');

        }

        function limpiarElement(id_element) {

            document.getElementById(id_element).value = "";
        }

        function agregarColaboradores() {

            Array.prototype.slice.call(document.getElementsByName('resultado_colaborador'))
                .filter(e => e.checked)
                .map(e => e.parentElement.parentElement)
                .forEach(function (e) {
                    let actividad_seleccionada = $('#actividades option:selected');
                    let id_actividad = actividad_seleccionada.val();
                    let descripcion_actividad = actividad_seleccionada.text();
                    let id_colaborador = e.children[0].firstChild.value;
                    let nombre_colaborador = e.children[2].innerText

                    let estaActividadAgregada = document.getElementById('actividad-' + id_actividad) != null;

                    if (estaActividadAgregada) {
                        let estaColaboradorAgregado = document.getElementById('act-' + id_actividad + '-col-' + id_colaborador) != null;
                        if (!estaColaboradorAgregado) {
                            agregarColaborador(id_actividad, id_colaborador, nombre_colaborador);
                        }
                    } else {
                        agregarActividad(id_actividad, descripcion_actividad, id_colaborador, nombre_colaborador)
                    }
                })
            ;
            setTimeout(function () {
                limpiarElement('colaborador');
                next('colaborador');
            }, 100)

        }

        function agregarColaborador(id_actividad, id_colaborador, nombre_colaborador) {
            let row = `
                        <tr id="act-${id_actividad}-col-${id_colaborador}">
                                            <td><input type="hidden" name="id_actividad[]" value="${id_actividad}">
                                                    <button
                                                     onclick="eliminarColaborador('${id_actividad}','${id_colaborador}')"
                                                     type="button" class="btn btn-warning">x</button>
                                            </td>
                                            <td><input type="hidden" name="id_colaborador[]" value="${id_colaborador}">  ${nombre_colaborador}</td>
                        </tr>
                      `;
            $('#asociacion-' + id_actividad).append(row);
        }

        function agregarActividad(id_actividad, descripcion_actividad, id_colaborador, nombre_colaborador) {
            let row = `
                <tr id="actividad-${id_actividad}">
                        <td>
                               <button onclick="eliminarActividad('${id_actividad}')" type="button" class="btn btn-warning">x</button>
                        </td>
                        <td>
                            ${descripcion_actividad}
                        </td>
                        <td>
                         <table class="table table-bordered table-responsive " >
                            <thead>
                            </thead>
                            <tbody id="asociacion-${id_actividad}" >

                            </tbody>
                         </table>
                        </td>
                </tr>
            `;
            $('#asociaciones').append(row);
            agregarColaborador(id_actividad, id_colaborador, nombre_colaborador)
        }

        function buscar_colaborador() {
            let colaborador = document.getElementById('colaborador').value;
            let id_actividad = $('#actividades option:selected').val();


            const is_orden_produccion_valida = document.getElementById('ordenes').value != "" && document.getElementById('ordenes').readOnly == true;
            if (!is_orden_produccion_valida) {
                alert("Orden de produccion  invalida");
                return;
            }

            if (id_actividad == "") {
                alert("Seleccione Actividad");
                return;
            }
            $('.loading').show();
            $.ajax({
                url: "{{url('registro/colaboradores/search')}}" + "?q=" + colaborador,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let colaboradores = response.colaboradores;

                    if (colaboradores.length == 0) {

                        alert("Colaborador no encontrado");
                    } else if (colaboradores.length == 1) {
                        document.getElementById('id_colaborador').value = colaboradores[0].id_colaborador;
                        document.getElementById('colaborador').value = colaboradores[0].nombre + " " + colaboradores[0].apellido;
                        document.getElementById('colaborador').readOnly = true;
                        next('btn_agregar');

                    } else {
                        document.getElementById('nombre-colaboradores').innerText = $('#actividades option:selected').text();
                        cargar_colaboradores(colaboradores);
                        mostrar_colaboradores();
                    }
                    $('.loading').hide();
                },
                error: function (e) {
                    console.log(e);
                    $('.loading').hide();
                }
            })

        }

        function seleccionar(id_colaborador, element) {

            if (element.tagName != "INPUT") {
                document.getElementById('colaborador_item-' + id_colaborador).checked = !document.getElementById('colaborador_item-' + id_colaborador).checked;
            }

            let totalSeleccionados = Array.prototype.slice.call(document.getElementsByName('resultado_colaborador')).filter(e => e.checked).length;
            document.getElementById('btn_aceptar').disabled = totalSeleccionados == 0;


        }

        function cargar_colaboradores(colaboradores) {

            $("#tbody-colaboradores").empty();
            let row = "";
            colaboradores.forEach(function (colaborador) {
                row += `<tr  onclick="seleccionar('${colaborador.id_colaborador}',event.target)">
                    <td><input  type='checkbox' name='resultado_colaborador' value='${colaborador.id_colaborador}' id="colaborador_item-${colaborador.id_colaborador}" ></td>
                    <td> ${colaborador.codigo_barras} </td>
                    <td> ${colaborador.nombre} ${colaborador.apellido} </td>
                </tr> `;
            });

            $('#tbody-colaboradores').append(row);
        }

        function mostrar_colaboradores() {
            setTimeout(function () {
                $('.loading').hide();
                $('#modal-colaboradores').modal();
            }, 1000);
        }

        function next(id) {

            document.getElementById(id).focus();
        }

        function eliminarActividad(id_actividad) {

            let cantidadColaboradores = $('#asociacion-' + id_actividad + " tr").length;
            if (cantidadColaboradores > 1) {
                if (confirm('¿Está seguro de remover la actividad?')) {
                    $('#actividad-' + id_actividad).remove();
                }
            } else {
                $('#actividad-' + id_actividad).remove();
            }
            next('colaborador')


        }

        function eliminarColaborador(id_actividad, id_colaborador) {

            let cantidadColaboradores = $('#asociacion-' + id_actividad + " tr").length;

            if (cantidadColaboradores == 1) {
                eliminarActividad(id_actividad);
            } else {
                $('#act-' + id_actividad + '-col-' + id_colaborador).remove();
            }
        }

        function agregar_insumo(id) {

            const descripcion = document.getElementById('descripcion_producto_mp').value;
            const lote = document.getElementById('lote_producto_mp').value;
            const cantidad = document.getElementById('cantidad_producto_mp').value;


            let row = `
                    <tr>
                        <td>     <input type="hidden" name="id_insumo[]" value="${id}">   ${descripcion}</td>
                        <td>        <input type="hidden" name="color[]" value="0">
                                      <input type="checkbox" onclick="asignar(this)">
                        </td>
                        <td>
                             <input type="hidden" name="olor[]" value="0">
                                      <input type="checkbox" onclick="asignar(this)">
                        </td>
                        <td>
                                  <input type="hidden" name="impresion[]" value="0">
                                      <input type="checkbox" onclick="asignar(this)">
                        </td>
                        <td>
                                    <input type="hidden" name="ausencia_me[]" value="0">
                                      <input type="checkbox" onclick="asignar(this)">
                        </td>
                        <td>              <input type="hidden" name="lote_pt[]" value="${lote}">
                                          ${lote}
                        </td>
                        <td>                <input type="hidden" name="cantidad[]" value="${cantidad}">
                                           ${cantidad}
                        </td>
                        <td>

                        </td>
                    </tr>
            `;

            $('#tbody_insumos').append(row);


        }


        function limpiar_insumo() {

            document.getElementById('codigo_producto_mp').value = "";
            document.getElementById('descripcion_producto_mp').value = "";
            document.getElementById('lote_producto_mp').value = "";
            document.getElementById('cantidad_producto_mp').value = "";
            document.getElementById('cantidad_producto_mp').readOnly = true;
            document.getElementById('codigo_producto_mp').focus();

        }

        function finalizar_asistencia(id_actividad, id_colaborador) {

            const id_control = document.getElementById('id_control').value;

            $('.loading').show();
            $.ajax({
                url: "{{url('produccion/trazabilidad_chao_mein/finalizar_asistencia')}}",
                type: 'post',
                dataType: "json",
                data: {
                    id_control: id_control,
                    id_actividad: id_actividad,
                    id_colaborador: id_colaborador
                },
                success: function (response) {

                    if (response.status == 1) {
                        let row = document.getElementById('act-' + id_actividad + '-col-' + id_colaborador);
                        marcar_finalizado(row);
                        marcar_hora_finalizado(row, response.data);

                    } else {
                        alert(response.message);
                    }
                    $('.loading').hide();
                },
                error: function (e) {
                    alert(e);
                    $('.loading').hide();
                },


            })

        }

        function marcar_finalizado(element) {

            $(element).find('.btn').remove();
            element.classList.add('success');
        }

        function marcar_hora_finalizado(element, hour) {
            $(element).find('td')[0].innerText = hour;

        }

    </script>
@endsection
