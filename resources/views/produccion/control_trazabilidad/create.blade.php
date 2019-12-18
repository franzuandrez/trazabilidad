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
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa fa-hand-rock-o  ',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Requisiciones
        @endslot
    @endcomponent

    {!!Form::open(array('url'=>'produccion/trazabilidad_chao_mein/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_producto">CODIGO PRODUCTO</label>
            <input type="text"
                   name="codigo_producto"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)buscar_producto_terminado()"
                   class="form-control">
        </div>
    </div>
    <input type="hidden" name="id_producto" id="id_producto">
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input type="text"
                   name="producto"
                   readonly
                   id="producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-1 col-sm-2 col-md-2 col-xs-6">
        <div class="form-group">
            <label for="unidad_medida">U.MEDIDA</label>
            <input type="text"
                   name="unidad_medida"
                   readonly
                   id="unidad_medida"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-sm-4 col-md-4 col-xs-6">
        <div class="form-group">
            <label for="best_by">BEST BY</label>
            <input type="text"
                   name="best_by"
                   readonly
                   id="best_by"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_orden_produccion">NO. ORDEN PRODUCION</label>
            <input type="text"
                   name="no_orden_produccion"
                   readonly
                   onkeydown="if(event.keyCode==13)buscar_orden_produccion()"
                   id="no_orden_produccion"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote_pt">LOTE</label>
            <input type="text"
                   name="lote_pt"
                   id="lote"
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
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad_programada">CANTIDAD PROGRAMADA</label>
            <input type="text"
                   name="cantidad_programada"
                   id="cantidad_programada"
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
                <div style="display: none">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
                        <label for="materia_prima">MATERIA PRIMA</label>
                        <div class="input-group">
                            <input type="text"
                                   name="materia_prima"
                                   id="materia_prima"
                                   onkeydown="if(event.keyCode==13)buscar_producto_mp()"
                                   class="form-control">
                            <div class="input-group-btn">
                                <button
                                    type="button" class="btn btn-default">
                                    <i class="fa fa-search"
                                       onclick="buscar_producto_mp()"
                                       aria-hidden="true"></i>
                                </button>
                                <button type="button"
                                        class="btn btn-default">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
                        <div class="form-group">
                            <label for="producto_mp">PRODUCTO</label>
                            <input type="text"
                                   name="producto_mp"
                                   id="producto_mp"
                                   readonly
                                   class="form-control">
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
                        <div class="form-group">
                            <label for="color">COLOR</label>
                            <input type="text"
                                   name="color"
                                   id="color"
                                   readonly
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
                        <div class="form-group">
                            <label for="olor">OLOR</label>
                            <input type="text"
                                   name="olor"
                                   id="olor"
                                   readonly
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">
                        <div class="form-group">
                            <label for="impresion">IMPRESION</label>
                            <select name="impresion"
                                    id="impresion"
                                    disabled

                                    class="form-control selectpicker">
                                <option value="S">SI</option>
                                <option value="N">N/A</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">
                        <div class="form-group">
                            <label for="ausencia_material">AUSENCIA DE MATERIAL EXTRAÑO</label>
                            <select name="ausencia_material"
                                    id="ausencia_material"
                                    disabled
                                    class="form-control selectpicker">
                                <option value="S">SI</option>
                                <option value="N">NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">

                        <div class="form-group">
                            <label for="cantidad_mp">CANTIDAD</label>
                            <input type="text"
                                   name="cantidad_mp"
                                   id="cantidad_mp"
                                   readonly
                                   class="form-control">
                        </div>

                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">
                        <div class="form-group">
                            <label for="ausencia_material">NO. LOTE</label>
                            <input type="no_lote_mp"
                                   name="no_lote_mp"
                                   id="no_lote_mp"
                                   readonly
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input id="fecha_vencimiento"
                                       disabled
                                       type="text" class="form-control pull-right" id="datepicker">
                            </div>

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
            <button class="btn btn-default" type="submit">
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
    <script>
        var formato = 'D/M/Y';

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

        function buscar_orden_produccion() {

            let orden_produccion = document.getElementById('no_orden_produccion').value;

            $.ajax({
                url: '{{url('produccion/trazabilidad_chao_mein/buscar_orden_produccion')}}' + '?q=' + orden_produccion,
                type: 'get',
                dataType: "json",
                success: function (response) {
                    let orden_produccion = response.orden_produccion;
                    console.log(orden_produccion)
                    if (orden_produccion == null) {
                        alert("Orden de produccion no encontrada");
                    } else if (orden_produccion.estado != 'D') {
                        alert("Orden de produccion en proceso ");
                    } else {
                        cargar_insumos(orden_produccion.reservas);
                        document.getElementById('no_orden_produccion').readOnly = true;
                        document.getElementById('lote').readOnly = false;
                        document.getElementById('lote').focus();
                        document.getElementById('turno').readOnly = false;
                        document.getElementById('cantidad_programada').readOnly = false;
                    }
                },
                error: function (e) {
                    console.log(e)
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
                             <input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                        </td>
                        <td>
                                <input type="hidden" name=olor[] value="0">
                                 <input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">

                            </td>
                        <td><input type="hidden" name=impresion[] value="0">
                                <input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                            </td>
                        <td><input type="hidden" name=ausencia_me[] value=0>
                        <input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"></td>
                        <td><input type="hidden" name=lote[] value="${insumo.lote}" >${insumo.lote}</td>
                        <td><input type="hidden" name=cantidad[] value="${insumo.cantidad}">${insumo.cantidad}</td>
                        <td><input type="hidden" name=fecha_vencimiento[] value="${(insumo.fecha_vencimiento)}">  ${moment(insumo.fecha_vencimiento).format('DD/MM/Y')} </td>
                    </tr>
                `;
            });


            $('#tbody_insumos').append(row);
        }

        function buscar_producto_mp() {
            let codigo_producto = document.getElementById('materia_prima').value;

            $.ajax({
                url: "{{url('registro/productos/search/')}}" + "/" + codigo_producto,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let cantidadProductos = response.length;

                    if (cantidadProductos == 0) {
                        alert("Producto no encontrado");
                    } else {
                        let producto = response[0];
                        document.getElementById('producto_mp').value = producto.descripcion;
                        document.getElementById('materia_prima').value = producto.codigo_interno;
                        document.getElementById('materia_prima').readOnly = true;
                        document.getElementById('olor').readOnly = false;
                        document.getElementById('color').readOnly = false;
                        document.getElementById('color').focus();
                        document.getElementById('impresion').disabled = false;
                        document.getElementById('ausencia_material').disabled = false;
                        $('#impresion').selectpicker('refresh');
                        $('#ausencia_material').selectpicker('refresh');
                        document.getElementById('cantidad_mp').readOnly = false;
                        document.getElementById('no_lote_mp').readOnly = false;
                        document.getElementById('fecha_vencimiento').disabled = false;

                    }

                },
                error: function (e) {

                }
            })
        }

        function buscar_producto_terminado() {

            let codigo_interno = document.getElementById('codigo_producto').value;

            $.ajax({
                url: "{{url('produccion/trazabilidad_chao_mein/buscar_producto')}}" + "?codigo_interno=" + codigo_interno,
                type: "get",
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.producto != null) {
                        document.getElementById('id_producto').value = response.producto.id_producto;
                        document.getElementById('producto').value = response.producto.descripcion;
                        document.getElementById('best_by').value = response.fecha_vencimiento;
                        document.getElementById('unidad_medida').value = response.producto.unidad_medida;
                        document.getElementById('no_orden_produccion').readOnly = false;
                        document.getElementById('no_orden_produccion').focus();

                    } else {
                        alert('Producto no encontrado');
                    }
                },
                error: function (e) {
                    alert("Producto no encontrado");
                    console.log(e);
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
                        $('.loading').hide();
                        alert("Colaborador no encontrado");
                    } else if (colaboradores.length == 1) {
                        document.getElementById('id_colaborador').value = colaboradores[0].id_colaborador;
                        document.getElementById('colaborador').value = colaboradores[0].nombre + " " + colaboradores[0].apellido;
                        document.getElementById('colaborador').readOnly = true;
                        next('btn_agregar');
                        $('.loading').hide();
                    } else {
                        document.getElementById('nombre-colaboradores').innerText = $('#actividades option:selected').text();
                        cargar_colaboradores(colaboradores);
                        mostrar_colaboradores();
                    }

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

        function agregar_insumo() {

            const producto_element = $('#producto_mp');
            const color_element = $('#color');
            const olor_element = $('#olor');
            const impresion_element = $('#impresion');
            const ausencia_material_element = $('#ausencia_material');

        }
    </script>
@endsection
